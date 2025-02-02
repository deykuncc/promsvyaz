<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeItem;
use App\Models\Item;

class HomeController extends Controller
{
    public function index()
    {
        $itemsCount = Item::all()->count();
        $employeesCount = Employee::all()->count();
        $employeesItemsCount = EmployeeItem::all()->count();
        $employeesItemsExpiredCount = EmployeeItem::query()
            ->where('until_at', '<', now())
            ->count();
        $data = [
            'title' => "Главная страница",
            'itemsCount' => $itemsCount,
            'employeesCount' => $employeesCount,
            'employeesItemsCount' => $employeesItemsCount,
            'employeesItemsExpiredCount' => $employeesItemsExpiredCount
        ];
        return view('home', $data);
    }
}
