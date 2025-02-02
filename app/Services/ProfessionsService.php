<?php

namespace App\Services;

use App\Exceptions\CannotStoreProfessionException;
use App\Models\ActionLog;
use App\Models\Profession;
use App\Models\ProfessionItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfessionsService
{
    /**
     * @param array $data
     * @return void
     * @throws CannotStoreProfessionException
     */
    public function store(array $data): void
    {
        DB::beginTransaction();
        try {
            $profession = Profession::query()->create(['name' => $data['name']]);

            $items = $this->getItems($profession->id, $data['items']);

            unset($data['items']);

            ProfessionItem::query()->insert($items);
            ActionLogger::log(ActionLog::STORE, ActionLog::PROFESSION, $profession?->id, ['name' => $profession?->name]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            throw new CannotStoreProfessionException($exception->getMessage());
        }
    }

    /**
     * @param int $professionId
     * @param array $data
     * @return void
     * @throws CannotStoreProfessionException
     */
    public function update(int $professionId, array $data): void
    {
        $items = $this->getItems($professionId, $data['items']);
        unset($data['items']);

        DB::beginTransaction();
        try {
            ProfessionItem::query()->where('profession_id', $professionId)->delete();
            ProfessionItem::query()->insert($items);

            $profession = $this->getProfession($professionId);
            $profession->fill($data)->save();

            $profession = $this->getProfession($professionId);
            ActionLogger::log(ActionLog::UPDATE, ActionLog::PROFESSION, $profession?->id, ['name' => $profession?->name]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            throw new CannotStoreProfessionException($exception->getMessage());
        }
    }

    /**
     * @param int $professionId
     * @return void
     * @throws CannotStoreProfessionException
     */
    public function destroy(int $professionId)
    {
        DB::beginTransaction();
        try {
            $profession = $this->getProfession($professionId);
            Profession::query()->where('id', '=', $professionId)->delete();
            ActionLogger::log(ActionLog::STORE, ActionLog::PROFESSION, $profession?->id, ['name' => $profession?->name]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            throw new CannotStoreProfessionException($exception->getMessage());
        }
    }

    public function items(int $professionId)
    {
        $professionItems = ProfessionItem::query()
            ->select('item_id', 'profession_id')
            ->with('item', function ($query) {
                $query->with('category')
                    ->select('id', 'name');
            })
            ->where('profession_id', $professionId)->get();

        return $professionItems;
    }

    /**
     * @param int $professionId
     * @param array $items
     * @return array
     */
    private function getItems(int $professionId, array $items): array
    {
        $result = [];
        foreach ($items as $itemId) {
            $result[] = ['profession_id' => $professionId, 'item_id' => $itemId];
        }
        return $result;
    }

    /**
     * @param int $professionId
     * @return Profession|null
     */
    private function getProfession(int $professionId): ?Profession
    {
        return Profession::query()->where('id', '=', $professionId)->lockForUpdate()->first();
    }
}
