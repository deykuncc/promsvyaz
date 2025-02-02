<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionsController extends Controller
{
    public function index(Request $request)
    {
        $professions = Profession::query()->withCount('employees');

        if (($professionId = $request->input('id'))) {
            $professions->where('id', '=', $professionId);
        }

        if (($professionName = $request->input('name'))) {
            {
                $professions->where('name', 'LIKE', '%' . $professionName . '%');
            }
        }

        $professions = $professions->paginate(20);

        $data = ['title' => 'Список профессией', 'professions' => $professions];
        return view('professions.index', $data);
    }

    public function create()
    {
        $items = Item::all();
        $data = ['title' => 'Добавить профессию', 'items' => $items];
        return view('professions.pages.create', $data);
    }

    public function edit(Profession $profession)
    {
        $profession->load(['items' => function ($query) {
            $query->with('item');
        }]);
        $items = Item::query()->whereNotIn('id', $profession->items()->pluck('item_id'))->get();
        $data = ['title' => 'Редактировать профессию', 'profession' => $profession, 'items' => $items];
        return view('professions.pages.edit', $data);
    }
}
