<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\Profession;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class EmployeesController extends Controller
{
    private Collection $genders;
    private Collection $professions;
    private Collection $departments;

    public function __construct()
    {
        $this->genders = Gender::all();
        $this->professions = Profession::all();
        $this->departments = Department::all();
    }

    public function index(Request $request)
    {
        $employees = Employee::query()
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->orderBy('middle_name')
            ->with(['department', 'gender', 'profession']);

        if (($professionId = $request->input('profession'))) {
            $employees->where('profession_id', '=', $professionId);
        }

        if (($departmentId = $request->input('department'))) {
            $employees->where('department_id', '=', $departmentId);
        }

        if (($genderId = $request->input('gender'))) {
            $employees->where('gender_id', '=', $genderId);
        }

        if (($name = $request->input('name'))) {
            $employees->where(function ($q) use ($name) {
                $q->where('first_name', 'like', '%' . $name . '%');
                $q->orWhere('last_name', 'like', '%' . $name . '%');
                $q->orWhere('middle_name', 'like', '%' . $name . '%');
            });
        }

        $employees = $employees->paginate(20);

        $data = [
            'title' => "Список сотрудников",
            'employees' => $employees,
            'genders' => $this->genders,
            'professions' => $this->professions,
            'departments' => $this->departments
        ];

        return view('employees.index', $data);
    }

    public function edit(int $employeeId)
    {
        $employee = Employee::query()->with(['department', 'gender', 'profession', 'items'])->where('id', $employeeId)->first();

        $data = [
            'title' => "Личная карточка {$employeeId}",
            'employee' => $employee,
            'departments' => $this->departments,
            'genders' => $this->genders,
            'professions' => $this->professions,
            'items' => $employee->items()->where('is_active', '=', 1)->get(),
        ];

        return view('employees.pages.edit', array_merge($data, $this->getSizes()));
    }

    public function create()
    {

        $data = ['title' => "Добавить сотрудника",
            'genders' => $this->genders,
            'professions' => $this->professions,
            'departments' => $this->departments
        ];


        return view('employees.pages.create', array_merge($data, $this->getSizes()));
    }

    private function getSizes(): array
    {
        return [
            'clothesSizes' => Size::query()->where('type', '=', Size::CLOTHES)->get(),
            'shoesSizes' => Size::query()->where('type', '=', Size::SHOES)->get(),
            'hatsSizes' => Size::query()->where('type', '=', Size::HATS)->get()
        ];
    }
}
