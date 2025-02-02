<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employees\StoreRequest;
use App\Http\Requests\Employees\UpdateItemsRequest;
use App\Http\Requests\Employees\UpdateRequest;
use App\Services\EmployeesService;

class EmployeesController extends Controller
{
    public function __construct(private EmployeesService $employeesService)
    {

    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->employeesService->store($data);
        return response()->json(['message' => "Сотрудник добавлен"], 200);
    }

    public function update(UpdateRequest $request, int $employeeId)
    {
        $data = $request->validated();
        $this->employeesService->update($data, $employeeId);
        return response()->json(['message' => "Сотрудник обновлен"], 200);
    }

    public function updateItems(UpdateItemsRequest $request, int $employeeId)
    {
        $data = $request->validated();
        $this->employeesService->updateItems($data, $employeeId);
        return response()->json(['message' => "Сотрудник обновлен"], 200);
    }

    public function destroy()
    {

    }
}
