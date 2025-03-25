<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    private array $data;

    public function __construct()
    {
        $this->data = ['categories' => Category::all()];
    }

    public function index(Request $request)
    {
        $items = Item::query()
            ->orderBy('name')
            ->with('category');

        if (($categoryId = $request->input('category'))) {
            $items->where('category_id', $categoryId);
        }

        if (($name = $request->input('name'))) {
            $items->where('name', 'LIKE', '%' . $name . '%');
        }

        $items = $items->paginate(20);

        $this->data += [
            'title' => 'Список СИЗ',
            'items' => $items,
        ];
        return view('items.index', $this->data);
    }

    public function create()
    {
        $this->data += ['title' => 'Добавить СИЗ'];
        return view('items.pages.create', $this->data);
    }

    public function edit(Item $item)
    {
        $this->data += ['title' => 'Редактировать СИЗ', 'item' => $item];
        return view('items.pages.edit', $this->data);
    }
}
