<?php

namespace App\Services;

use App\Exceptions\CannotStoreEmployeeException;
use App\Exceptions\CannotUpdateEmployeeException;
use App\Exceptions\CannotUpdateEmployeeItemsException;
use App\Models\Employee;
use App\Models\EmployeeItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeesService
{

    /**
     * @param array $data
     * @return void
     * @throws CannotStoreEmployeeException
     */
    public function store(array $data): void
    {
        DB::beginTransaction();
        try {

            $employee = Employee::query()->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'middle_name' => $data['middle_name'] ?? null,
                'external_id' => $data['external_id'],
                'gender_id' => $data['gender_id'],
                'employment_date' => Carbon::createFromFormat('d.m.Y', $data['employment_date'])->format('Y-m-d H:i:s'),
                'height' => $data['height'],
                'clothes_size_id' => $data['size_clothes'],
                'shoes_size_id' => $data['size_shoes'],
                'hats_size_id' => $data['size_hats'],
                'department_id' => $data['department_id'],
                'profession_id' => $data['profession_id'],
            ]);

            $this->storeItems($employee->id, $data['employment_date'], $data['items']);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            throw new CannotStoreEmployeeException();
        }
    }

    /**
     * @param array $data
     * @param int $employeeId
     * @return void
     * @throws CannotUpdateEmployeeException
     */
    public function update(array $data, int $employeeId): void
    {
        $data['employment_date'] = Carbon::createFromFormat('d.m.Y', $data['employment_date'])->format('Y-m-d H:i:s');

        DB::beginTransaction();
        try {
            Employee::query()->where('id', $employeeId)->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new CannotUpdateEmployeeException();
        }
    }

    /**
     * @param array $data
     * @param int $employeeId
     * @return void
     * @throws CannotUpdateEmployeeItemsException
     */
    public function updateItems(array $data, int $employeeId): void
    {
        $employee = Employee::query()->where('id', $employeeId)->first();
        $employmentDate = Carbon::parse($employee->employment_date)->format('d.m.Y');
        DB::beginTransaction();
        try {
            $this->storeItems($employeeId, $employmentDate, $data['items'] ?? []);
            $this->deletedItems($employeeId, $data['deleted_items'] ?? []);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new CannotUpdateEmployeeItemsException();
        }
    }

    /**
     * @param int $employeeId
     * @param array $items
     * @return void
     */
    private function storeItems(int $employeeId, string $employmentDateOwn, array $items): void
    {
        $data = [];
        if (!empty($items)) {
            foreach ($items as $item) {
                $employmentDate = Carbon::createFromFormat('d.m.Y', $employmentDateOwn);

                if ($item['dateType'] === 'days') {
                    $untilAt = $employmentDate->addDays((float)$item['dateValue']);
                } elseif ($item['dateType'] === 'months') {
                    $untilAt = $employmentDate->addMonths((float)$item['dateValue']);
                } elseif ($item['dateType'] === 'years') {
                    $untilAt = $employmentDate->addYears((float)$item['dateValue']);
                } else {
                    $untilAt = null;
                }

                if ($untilAt != null) {
                    $untilAt = $untilAt->format('Y-m-d H:i:s');
                }

                $data[] = [
                    'employee_id' => $employeeId,
                    'item_id' => $item['id'],
                    'size_id' => $item['size'] === 'without' ? null : $item['size'],
                    'quantity' => $item['conditionValue'],
                    'quantity_type' => $item['conditionType'] ?? null,
                    'until_at' => $untilAt,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

            }
            EmployeeItem::query()->insert($data);
        }
    }

    /**
     * @param int $employeeId
     * @param array $data
     * @return void
     */
    private function deletedItems(int $employeeId, array $data): void
    {
        if (!empty($data) && is_array($data)) {
            EmployeeItem::query()
                ->where('employee_id', '=', $employeeId)
                ->whereIn('item_id', $data)
                ->delete();
        }
    }
}
