<?php

namespace App\Services;

use App\Enums\ConditionType;
use App\Exceptions\CannotStoreEmployeeException;
use App\Exceptions\CannotUpdateEmployeeException;
use App\Exceptions\CannotUpdateEmployeeItemsException;
use App\Models\Employee;
use App\Models\EmployeeItem;
use App\Models\Item;
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
            $employee = $this->createEmployee($data);
            $this->storeItems($employee, $data['items'] ?? []);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new \Exception("Произошла непредвиденная ошибка");
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
        DB::beginTransaction();
        try {
            $this->storeItemsManual($employee, $data['items'] ?? []);
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
     * @param array $data
     * @return void
     */
    private function deletedItems(int $employeeId, array $data): void
    {
        if (!empty($data)) {
            EmployeeItem::query()
                ->where('employee_id', '=', $employeeId)
                ->whereIn('item_id', $data)
                ->delete();
        }
    }

    public function storeItemsManual(Employee $employee, array $items): void
    {
        if (!empty($items)) {
            $employeeItems = [];

            foreach ($items as $item) {
                if ($item['dateType'] == 'unlimited') {
                    $employeeItems[] = [
                        'employee_id' => $employee->id,
                        'item_id' => $item['id'],
                        'size_id' => $item['size'] === 'without' ? null : $item['size'],
                        'issued_date' => $employee->employment_date,
                        'expiry_date' => null,
                        'usage_months' => null,
                        'quantity' => $item['conditionValue'],
                        'quantity_type' => $item['conditionType'] ?? null,
                        'is_active' => true,
                    ];
                } else {
                    $usagePeriod = (int)$item['dateValue'];

                    $dateHired = Carbon::createFromFormat('d.m.Y', $item['issuedDate']);

                    $expiryDate = (clone $dateHired)->addMonths($usagePeriod)->format('Y-m-d H:i:s');
                    $employeeItems[] = [
                        'employee_id' => $employee->id,
                        'item_id' => $item['id'],
                        'size_id' => $item['size'] === 'without' ? null : $item['size'],
                        'issued_date' => (clone $dateHired),
                        'expiry_date' => $expiryDate,
                        'usage_months' => $usagePeriod,
                        'quantity' => $item['conditionValue'],
                        'quantity_type' => $item['conditionType'] ?? null,
                        'is_active' => true,
                    ];
                }
            }

            EmployeeItem::query()->insert($employeeItems);
        }
    }

    /**
     * @param int $employeeId
     * @param array $items
     * @return void
     */
    private function storeItems(Employee $employee, array $items): void
    {
        if (!empty($items) && is_array($items)) {
            $employeeItems = [];

            foreach ($items as $item) {
                if ($item['dateType'] == 'unlimited') {
                    $employeeItems[] = [
                        'employee_id' => $employee->id,
                        'item_id' => $item['id'],
                        'size_id' => $item['size'] === 'without' ? null : $item['size'],
                        'issued_date' => $employee->employment_date,
                        'expiry_date' => null,
                        'usage_months' => null,
                        'quantity' => $item['conditionValue'],
                        'quantity_type' => $item['conditionType'] ?? null,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                } else {
                    $usagePeriod = (int)$item['dateValue'];

                    $dateHired = Carbon::parse($employee->employment_date);
                    $currentDate = Carbon::now();

                    $diffInMonths = $dateHired->diffInMonths($currentDate);

                    $issueCount = ($diffInMonths < $usagePeriod) ? 1 : ((int)floor($diffInMonths / $usagePeriod));

                    for ($i = 0; $i < $issueCount; $i++) {
                        $issuedDate = (clone $dateHired)->addMonths($usagePeriod * $i);
                        $expiryDate = (clone $issuedDate)->addMonths($usagePeriod);

                        $employeeItems[] = [
                            'employee_id' => $employee->id,
                            'item_id' => $item['id'],
                            'size_id' => $item['size'] === 'without' ? null : $item['size'],
                            'issued_date' => ($i === $issueCount - 1) ? (clone Carbon::createFromFormat('d.m.Y', $item['issuedDate']))->format('Y-m-d H:i:s') : $issuedDate,
                            'expiry_date' => ($i === $issueCount - 1) ? (clone Carbon::createFromFormat('d.m.Y', $item['issuedDate']))->addMonths($usagePeriod)->format('Y-m-d H:i:s') : $expiryDate,
                            'usage_months' => $usagePeriod,
                            'quantity' => $item['conditionValue'],
                            'quantity_type' => $item['conditionType'] ?? null,
                            'is_active' => ($i === $issueCount - 1) ? true : false,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }

            EmployeeItem::query()->insert($employeeItems);
        }
    }

    /**
     * @param int $employeeId
     * @return void
     * @throws \Exception
     */
    public function delete(int $employeeId): void
    {
        DB::beginTransaction();
        try {
            Employee::query()->where('id', $employeeId)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new \Exception("Произошла непредвиденная ошибка");
        }
    }

    /**
     * @param array $data
     * @return Employee
     */
    public function createEmployee(array $data): Employee
    {
        return Employee::query()->create([
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
    }

    public function addItemsByUpdateProfession(int $professionId, array $data): void
    {
        $issuedDate = Carbon::now();
        $employees = Employee::query()->where('profession_id', $professionId)->get();
        $itemsInsert = [];
        foreach ($data as $item) {
            if ($item['expiryType'] == 'unlimited') {
                $expiryDate = null;
            } else {
                $months = (int)$item['expiryValue'];
                $expiryDate = (clone $issuedDate)->addMonths($months);
            }


            $getItem = Item::query()
                ->with('category')
                ->where('id', $item['id'])
                ->first();

            foreach ($employees as $employee) {
                $sizeId = null;
                $quantity = 1;
                $quantityType = 1;
                if ($getItem->category->name_eng === 'clothes') {
                    $sizeId = $employee->clothes_size_id;
                } else if ($getItem->category->name_eng === 'shoes') {
                    $sizeId = $employee->shoes_size_id;
                    $quantityType = 2;
                } else if ($getItem->category->name_eng === 'hats') {
                    $sizeId = $employee->hats_size_id;
                } else if ($getItem->category->name_eng === 'hands') {
                    $quantityType = 2;
                } else if ($getItem->category->name_eng === 'clear') {
                    $quantityType = $data['conditionType'] ?? 3;
                    $quantity = $data['conditionValue'] ?? 1000;
                }

                $itemsInsert[] = [
                    'employee_id' => $employee->id,
                    'item_id' => $item['id'],
                    'size_id' => $sizeId,
                    'usage_months' => $item['expiryType'] == 'unlimited' ? null : $item['expiryValue'],
                    'expiry_date' => $expiryDate,
                    'issued_date' => $issuedDate,
                    'quantity' => $quantity,
                    'quantity_type' => $quantityType,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        EmployeeItem::query()->insert($itemsInsert);
    }

}
