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
    public function __construct(private EmployeesService $employeesService)
    {

    }

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
        if (!empty($data['items'])) {
            $items = $this->getItems($professionId, $data['items']);
        }

        DB::beginTransaction();
        try {

            if (!empty($data['removed_items'])) {
                ProfessionItem::query()->whereIn('item_id', $data['removed_items'])->delete();
                unset($data['removed_items']);
            }
            if (!empty($items)) {
                ProfessionItem::query()->insert($items);
                $this->employeesService->addItemsByUpdateProfession($professionId, $data['items']);
                unset($data['items']);
            }

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
            ->select('item_id', 'profession_id', 'quantity', 'quantity_type', 'expiry_months')
            ->with('item', function ($query) {
                $query->with(['category' => function ($query) {
                    $query->select('id', 'name_eng');
                }])->select('id', 'category_id', 'name', 'brand');
            })
            ->where('profession_id', $professionId)
            ->get()
            ->transform(function ($item) {
                $item->quantity_type_orig = $item->quantityTypeOrig();
                return $item;
            });

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
        foreach ($items as $item) {
            $result[] = [
                'profession_id' => $professionId,
                'item_id' => (int)$item['id'],
                'expiry_months' => $item['expiryType'] == 'months' ? (int)$item['expiryValue'] : null,
                'quantity_type' => !empty($item['conditionType']) ? $item['conditionType'] : null,
                'quantity' => !empty($item['conditionValue']) ? $item['conditionValue'] : null,
            ];
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
