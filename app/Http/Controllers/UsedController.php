<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use App\Models\EmployeeItem;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsedController extends Controller
{
    public function index(Request $request)
    {
        $items = EmployeeItem::query()
            ->whereHas('employee')
            ->where('is_active', true)
            ->with(['employee', 'item'])
            ->orderby('issued_date')
            ->orderByDesc('id');

        if (($nameItem = $request->input('nameItem'))) {
            $items->whereHas('item', function ($query) use ($nameItem) {
                $query->where('name', 'LIKE', "%{$nameItem}%");
            });
        }

        if (($days = $request->input('days'))) {
            $untilAt = now()->addDays((int)$days)->endOfDay();
            $items
                ->where('expiry_date', '<', $untilAt)
                ->where('expiry_date', '!=', null);
        }

        if (($received = $request->input('received'))) {
            $items
                ->where('received', '=', (bool)$received);
        }

        if (($name = $request->input('name'))) {
            $items->whereHas('employee', function ($query) use ($name) {
                $query->where(function ($query) use ($name) {
                    $query->where('first_name', 'LIKE', "%{$name}%");
                    $query->orWhere('last_name', 'LIKE', "%{$name}%");
                    $query->orWhere('middle_name', 'LIKE', "%{$name}%");
                });
            });
        }

        if (($category = $request->input('category'))) {
            $items->whereHas('item', function ($query) use ($category) {
                $query->where('category_id', $category);
            });
        }

        $items = $items->paginate(20)->appends(request()->query());
        $categories = Category::query()->get();

        $items->setCollection(
            $items->getCollection()->transform(function ($item) {
                if ($item->expiry_date) {
                    $item->format_until_at = $item->expiry_date != null ? floor(Carbon::now()->diffInDays($item->expiry_date)) : "До износа";
                } else {
                    $item->format_until_at = $item->usage_months ? "Поставьте дату получения" : 'До износа';

                }
                return $item;
            })
        );

        $departments = Department::query()
            ->orderBy('name', 'desc')
            ->get();

        $sizes = Size::query()->get();

        $data = [
            'title' => "Выданные СИЗ",
            'sizes' => $sizes,
            'sizeTypes' => ['clothes' => 'Одежда', 'shoes' => 'Обувь', 'hats' => 'Головной убор', 'nosize' => 'Без размера'],
            'departments' => $departments,
            'items' => $items,
            'categories' => $categories];


        return view('used.index', $data);
    }
}
