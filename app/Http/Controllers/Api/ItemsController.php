<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Items\StoreRequest;
use App\Http\Requests\Items\UpdateRequest;
use App\Services\ItemsService;

class ItemsController extends Controller
{
    public function __construct(private ItemsService $itemsService)
    {

    }

    public function index()
    {
        $items = $this->itemsService->index();
        return response()->json(['message' => "СИЗ Получены", 'items' => $items], 200);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->itemsService->store($data);
        return response()->json(['message' => 'СИЗ Создана'], 200);
    }

    public function update(UpdateRequest $request, int $itemId)
    {
        $data = $request->validated();
        $this->itemsService->update($itemId, $data);
        return response()->json(['message' => 'СИЗ обновлена'], 200);
    }

    public function destroy(int $itemId)
    {
        $this->itemsService->destroy($itemId);
        return response()->json(['message' => 'СИЗ удалена'], 200);
    }
}
