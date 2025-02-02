<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Used\UpdateRequest;
use App\Models\EmployeeItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UsedController extends Controller
{
    public function receivedChange(int $id)
    {
        $itemEmployee = EmployeeItem::query()->where('id', $id)->first();
        if (!$itemEmployee) {
            return response()->json(['message' => 'Запись не найдена'], 400);
        }

        DB::beginTransaction();
        try {
            $itemEmployee->received = !$itemEmployee->received;
            $itemEmployee->save();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return response()->json(['message' => "Не удалось обновить информацию"], 500);
        }

        return response()->json(['message' => "Информация обновлена"], 200);
    }

    public function update(UpdateRequest $request, int $id)
    {
        $data = $request->validated();

        if ($data['is_unlimited']) {
            $data['until_at'] = null;
        }else{
            $data['until_at'] = Carbon::createFromFormat('d.m.Y', $data['until_at'])->format('Y-m-d H:i:s');
        }
        unset($data['is_unlimited']);


        DB::beginTransaction();
        try {
            EmployeeItem::query()
                ->lockForUpdate()
                ->where('id', $id)
                ->update($data);
            DB::commit();
            return response()->json(['message' => "Запись обновлена"], 200);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return response()->json(['message' => "Произошла непредвиденная ошибка"], 500);
        }

    }
}
