<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{

    public function create(){
        $user = new User;

        $departments = Department::all();
        $roles = Role::all();
        return view('user.create', compact('roles', 'departments', 'user'));
    }

    public function edit($user_id){

        $user = User::find($user_id);
        $departments = Department::all();
        $roles = Role::all();
        return view('user.edit', compact('roles', 'departments', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname'     => ['required', 'string', 'max:255'],
            'lastname'      => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'integer'],
            'role_id'       => ['required', 'integer'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required','min:8', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'firstname'     => $request->firstname,
            'lastname'      => $request->lastname,
            'department_id' => $request->department_id,
            'role_id'       => $request->role_id,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        return redirect('/dashboard');
    }
}

