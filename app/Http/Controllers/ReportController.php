<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Employee;
use App\Models\EmployeeItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function employee(Request $request, Employee $employee)
    {
        $data = ['title' => "Личная карточка {$employee->id}"];
        $employeeItems = EmployeeItem::query()
            ->where('is_active', true)
            ->with(['employee', 'item'])
            ->where('employee_id', '=', $employee->id);


        if ($request->input('category') === "skin") {
            $employeeItems->whereHas('item', function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->whereIn('name_eng', ['hands', 'clear']);
                });
            });
            $description = "учета выдачи СИЗ (средства для защиты рук, смывающие и обезжиривающие средства)";
        } else {
            $employeeItems->whereHas('item', function ($query) {
                $query->wherehas('category', function ($query) {
                    $query->whereNotIn('name_eng', ['hands', 'clear']);
                });
            });
            $description = "учета выдачи СИЗ (специальная обувь и специальная одежда)";
        }

        $employeeItems = $employeeItems->get();

        $data += ['items' => $employeeItems, 'employee' => $employee, 'description' => $description];

        return view('reports.employee', $data);
    }

    public function order(Request $request)
    {
        $sizData = EmployeeItem::query()
            ->select(
                'item_brands.name as brand',
                'sizes.size as size',
                DB::raw("SUM(employee_items.quantity) as count"),
                'departments.name as department',
            )
            ->with('brand')
            ->where('is_active', true)
            ->where('employee_items.deleted_at', null)
            ->when(($untilAt = $request->input('until_at', 31)), function ($q) use ($untilAt) {
                $untilAt = now()->addDays((int)$untilAt)->endOfDay();
                $q->where('employee_items.expiry_date', '<', $untilAt);
            })
            ->where('employee_items.expiry_date', '!=', null)
            ->join('items', 'items.id', '=', 'employee_items.item_id')
            ->join('sizes', 'employee_items.size_id', '=', 'sizes.id')
            ->join('employees', 'employees.id', '=', 'employee_items.employee_id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->join('item_brands','employee_items.brand_id','=','item_brands.id')
            ->groupBy('item_brands.name', 'sizes.size', 'departments.name')
            ->get()
            ->groupBy(['brand', 'department'])
            ->map(function ($group, $name) {
                return $group->map(function ($items, $department) use ($name) {
                    return [
                        'name' => $name,
                        'sizes' => $items->map(fn($item) => ['size' => $item->size, 'count' => $item->count])->values()->toArray(),
                        'department' => $department,
                    ];
                });
            })
            ->values()
            ->flatten(1)
            ->toArray();


        $months = [
            'January' => 'января', 'February' => 'февраля', 'March' => 'марта',
            'April' => 'апреля', 'May' => 'мая', 'June' => 'июня',
            'July' => 'июля', 'August' => 'августа', 'September' => 'сентября',
            'October' => 'октября', 'November' => 'ноября', 'December' => 'декабря'
        ];

        $date = Carbon::now();
        $month = $months[$date->format('F')]; // Получаем название месяца
        $year = $date->year;

        $data = ['title' => 'Заявка', 'sizData' => $sizData, 'date' => "{$month}&nbsp;&nbsp;{$year}"];
        return view('reports.order', $data);
    }

    // Ведомость
    public function statement()
    {
        $data = ['title' => 'Ведомость на выдачу СИЗ'];

        $items = Employee::query()
            ->with(['items' => function ($query) {
                $query->where('received', true)
                    ->where('is_active', true)
                    ->with(['item', 'size']);
            }, 'department', 'profession'])
            ->orderBy('department_id')
            ->get();

        $data += ['rows' => $items];
        return view('reports.statement', $data);
    }

    public function employeeBack(int $employeeId)
    {
        $items = EmployeeItem::query()
            ->with('item')
            ->where('employee_id', $employeeId)
            ->get();

        $data = ['title' => 'Оборотная сторона личной карточки', 'items' => $items];
        return view('reports.employee-back', $data);
    }
}
