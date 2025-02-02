<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professions\StoreRequest;
use App\Http\Requests\Professions\UpdateRequest;
use App\Services\ProfessionsService;
use Illuminate\Http\Request;

class ProfessionsController extends Controller
{
    public function __construct(private ProfessionsService $professionsService)
    {

    }


    // TODO: Переделать добавление (удаление косвенное)

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->professionsService->store($data);
        return response()->json(['message' => 'Профессия добавлена'], 200);
    }

    public function update(UpdateRequest $request, int $professionId)
    {
        $data = $request->validated();
        $this->professionsService->update($professionId, $data);
        return response()->json(['message' => 'Профессия обновлена'], 200);
    }

    public function destroy(int $professionId)
    {
        $this->professionsService->destroy($professionId);
        return response()->json(['message' => "Профессия удалена"], 200);
    }

    public function items(int $professionId)
    {
        $items = $this->professionsService->items($professionId);
        return response()->json(['message' => 'СИЗ Получены', 'items' => $items], 200);
    }
}
