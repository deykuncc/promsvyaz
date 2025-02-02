<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Departments\StoreRequest;
use App\Http\Requests\Departments\UpdateRequest;
use App\Services\DepartmentsService;

class DepartmentsController extends Controller
{
    public function __construct(private DepartmentsService $departmentsService)
    {

    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->departmentsService->store($data);
        return response()->json(['message' => "Участок создан"], 200);
    }

    public function update(UpdateRequest $request, int $departmentId)
    {
        $data = $request->validated();
        $this->departmentsService->update($departmentId, $data);
        return response()->json(['message' => "Участок обновлен"], 200);
    }

    public function destroy(int $departmentId)
    {
        $this->departmentsService->destroy($departmentId);
        return response()->json(['message' => "Участок удален"], 200);
    }
}
