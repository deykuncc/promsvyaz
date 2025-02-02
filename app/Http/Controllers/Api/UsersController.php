<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Services\UsersService;

class UsersController extends Controller
{
    public function __construct(private UsersService $usersService)
    {
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->usersService->store($data);
        return response()->json(['message' => "Сотрудник добавлен"], 200);
    }

    public function update(UpdateRequest $request, int $userId)
    {
        $data = $request->validated();
        $this->usersService->update($userId, $data);
        return response()->json(['message' => "Сотрудник отредактирован"], 200);
    }

    public function destroy(int $userId)
    {
        $this->usersService->destroy($userId);
        return response()->json(['message' => "Сотрудник удален"], 200);
    }
}
