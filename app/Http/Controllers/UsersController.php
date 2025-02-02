<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    private array $data = [];

    public function __construct()
    {
        $this->data = ['roles' => Role::all()];
    }

    public function index(Request $request)
    {
        $user = Auth::guard('web')->user();

        $users = User::query()
            ->where('id', '!=', $user->id)
            ->with('role');

        if (($name = $request->input('name'))) {
            $users->where(function ($q) use ($name) {
                $q->where('last_name', 'like', '%' . $name . '%');
                $q->orWhere('first_name', 'like', '%' . $name . '%');
                $q->orWhere('middle_name', 'like', '%' . $name . '%');
            });
        }

        if (($role = $request->input('role'))) {
            $users->where('role_id', '=', $role);
        }

        $users = $users->paginate(20);
        $this->data += ['title' => 'Сотрудники ПУ', 'users' => $users];
        return view('users.index', $this->data);
    }

    public function create()
    {
        $roles = Role::all();

        $this->data += ['title' => 'Добавить сотрудника в ПУ'];

        return view('users.pages.create', $this->data);
    }

    public function edit(Request $request, User $user)
    {
        $this->data += ['title' => "Редактировать сотрудника", 'user' => $user];

        return view('users.pages.edit', $this->data);
    }
}
