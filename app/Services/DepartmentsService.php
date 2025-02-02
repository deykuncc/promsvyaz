<?php

namespace App\Services;

use App\Exceptions\CannotDestroyDepartmentsException;
use App\Exceptions\CannotStoreDepartmentsException;
use App\Exceptions\CannotUpdateDepartmentsDublicateNameException;
use App\Exceptions\CannotUpdateDepartmentsException;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartmentsService
{
    /**
     * @param array $data
     * @return void
     * @throws CannotStoreDepartmentsException
     */
    public function store(array $data): void
    {
        DB::beginTransaction();
        try {
            Department::query()->create($data);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            throw new CannotStoreDepartmentsException();
        }
    }

    /**
     * @param int $departmentId
     * @param array $data
     * @return void
     * @throws CannotUpdateDepartmentsDublicateNameException
     * @throws CannotUpdateDepartmentsException
     */
    public function update(int $departmentId, array $data): void
    {
        $department = Department::query()->where('id', '=', $departmentId)->first();
        if (mb_strtolower($department->name) != mb_strtolower($data['name'])) {
            if (Department::query()->where('name', '=', mb_strtolower($data['name']))->exists()) {
                throw new CannotUpdateDepartmentsDublicateNameException();
            }
        }

        DB::beginTransaction();
        try {
            $department->fill($data)->save();
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            throw new CannotUpdateDepartmentsException();
        }
    }


    /**
     * @param int $departmentId
     * @return void
     * @throws CannotDestroyDepartmentsException
     */
    public function destroy(int $departmentId): void
    {
        DB::beginTransaction();
        try {
            Department::query()->where('id', '=', $departmentId)->delete();
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            throw new CannotDestroyDepartmentsException();
        }
    }
}
