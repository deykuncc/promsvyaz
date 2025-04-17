<?php

namespace App\Services;

use App\Exceptions\CannotDestroyItemException;
use App\Exceptions\CannotStoreItemException;
use App\Exceptions\CannotUpdateItemException;
use App\Models\ActionLog;
use App\Models\Item;
use App\Models\ItemBrand;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemsService
{

    public function index(): Collection
    {
        return Item::query()
            ->orderBy('name')
            ->with(['brands', 'category'])->get();
    }

    /**
     * @param array $data
     * @return void
     * @throws CannotStoreItemException
     */
    public function store(array $data): void
    {
        $brands = $data['brands'];
        unset($data['brands']);
        DB::beginTransaction();
        try {
            $item = Item::query()->create($data);
            ItemBrand::query()->insert(array_map(function ($brand) use ($item) {
                return ['item_id' => $item->id, 'name' => $brand['name'], 'model' => $brand['model'], 'article' => $brand['article'], 'created_at' => now(), 'updated_at' => now()];
            }, $brands));
            ActionLogger::log(ActionLog::STORE, ActionLog::ITEM, $item?->id, ['name' => $item?->name]);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            throw new CannotStoreItemException();
        }
    }

    /**
     * @param int $itemId
     * @param array $data
     * @return void
     * @throws CannotUpdateItemException
     */
    public function update(int $itemId, array $data): void
    {
        $brands = $data['brands'] ?? null;
        unset($data['brands']);

        DB::beginTransaction();
        try {
            if ($brands) {
                $this->updateBrands($itemId, $brands);
            }
            Item::query()->lockForUpdate()->where('id', '=', $itemId)->update($data);
            ActionLogger::log(ActionLog::UPDATE, ActionLog::ITEM, $itemId, ['name' => Item::query()->where('id', '=', $itemId)->first()?->name]);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            throw new CannotUpdateItemException();
        }
    }

    public function updateBrands(int $itemId, array $brands): void
    {
        $now = now();

        $inserts = [];
        foreach ($brands as $brand) {
            if ($brand['id'] === null) {
                $inserts[] = [
                    'item_id' => $itemId,
                    'name' => $brand['name'],
                    'model' => $brand['model'],
                    'article' => $brand['article'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            } else {
                ItemBrand::query()->where('id', $brand['id'])->update([
                    'name' => $brand['name'],
                    'model' => $brand['model'],
                    'article' => $brand['article'],
                    'updated_at' => $now,
                ]);
            }
        }

        if (!empty($inserts)) {
            ItemBrand::query()->insert($inserts);
        }
    }

    /**
     * @param int $itemId
     * @return void
     * @throws CannotDestroyItemException
     */
    public function destroy(int $itemId): void
    {
        DB::beginTransaction();
        try {
            ActionLogger::log(ActionLog::DELETE, ActionLog::ITEM, $itemId, ['name' => Item::query()->where('id', '=', $itemId)->first()?->name]);
            Item::query()->where('id', '=', $itemId)->delete();
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            throw new CannotDestroyItemException();
        }
    }
}
