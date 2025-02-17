<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::query()
            ->withCount('employees');

        if (($name = $request->input('name'))) {
            $departments->where('name', 'LIKE', '%' . $name . '%');
        }

        $departments = $departments->paginate(20);
        $data = ['title' => 'Структурное подразделение', 'departments' => $departments];
        return view('departments.index', $data);
    }

    public function create(Request $request)
    {
        $data = ['title' => 'Добавить участок'];
        return view('departments.pages.create', $data);
    }

    public function edit(Request $request, Department $department)
    {
        $data = ['title' => "Редактировать участок #{$department->name}", 'department' => $department];
        return view('departments.pages.edit', $data);
    }
}
