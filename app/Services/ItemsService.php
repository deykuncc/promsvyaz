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
                return ['item_id' => $item->id, 'name' => $brand, 'created_at' => now(), 'updated_at' => now()];
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
                ItemBrand::query()->insert(array_map(function ($brand) use ($itemId) {
                    return ['item_id' => $itemId, 'name' => $brand, 'created_at' => now(), 'updated_at' => now()];
                }, $brands));
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
