<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\StoreRequest;
use App\Http\Requests\Employees\UpdateItemsRequest;
use App\Http\Requests\Employees\UpdateRequest;
use App\Services\EmployeesService;
use Illuminate\Http\JsonResponse;

class EmployeesController extends Controller
{
    /**
     * @param EmployeesService $employeesService
     */
    public function __construct(private EmployeesService $employeesService)
    {

    }

    /**
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws \App\Exceptions\CannotStoreEmployeeException
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->employeesService->store($data);
        return response()->json(['message' => "Сотрудник добавлен"], 200);
    }

    /**
     * @param UpdateRequest $request
     * @param int $employeeId
     * @return JsonResponse
     * @throws \App\Exceptions\CannotUpdateEmployeeException
     */
    public function update(UpdateRequest $request, int $employeeId): JsonResponse
    {
        $data = $request->validated();
        $this->employeesService->update($data, $employeeId);
        return response()->json(['message' => "Сотрудник обновлен"], 200);
    }

    /**
     * @param UpdateItemsRequest $request
     * @param int $employeeId
     * @return JsonResponse
     * @throws \App\Exceptions\CannotUpdateEmployeeItemsException
     */
    public function updateItems(UpdateItemsRequest $request, int $employeeId): JsonResponse
    {
        $data = $request->validated();
        $this->employeesService->updateItems($data, $employeeId);
        return response()->json(['message' => "Сотрудник обновлен"], 200);
    }

    /**
     * @param int $employeeId
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $employeeId): JsonResponse
    {
        $this->employeesService->delete($employeeId);
        return response()->json(['message' => "Сотрудник удален"], 200);
    }
}
