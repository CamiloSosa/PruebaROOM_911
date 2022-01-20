<?php

namespace App\Http\Controllers;

Use Alert;
use App\Models\Department;
use App\Models\Permission;
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
            'user_pin'       => ['required', 'integer', 'max:9999'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required','min:8', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'firstname'     => $request->firstname,
            'lastname'      => $request->lastname,
            'department_id' => $request->department_id,
            'role_id'       => $request->role_id,
            'email'         => $request->email,
            'user_pin'         => $request->user_pin,
            'password'      => Hash::make($request->password),
        ]);

        Alert::success('User created', 'The user was created successfuly');

        return redirect('/dashboard');
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'firstname'     => ['required', 'string', 'max:255'],
            'lastname'      => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'integer'],
            'role_id'       => ['required', 'integer'],
        ]);

        $user = User::find($user_id);

        if($user->update($request->all())){
            Alert::success('User updated', 'The user was updated successfuly');
        } else {
            Alert::error('ERROR', 'There was an error');
        }

        return redirect('/dashboard');
    }

    public function allowAccess($user_id){

        $user = User::find($user_id);

        $permission = Permission::where('name', 'room_access')->first();

        $roomAccessPermission = $user->permissions()->where('name', 'room_access')->first();

        $status = '';
        if(isset($roomAccessPermission)){
            $user->permissions()->detach($permission->id);
            $status = 'detached';
        }else{
            $user->permissions()->attach($permission->id);
            $status = 'attached';
        }

        return response($status, 200);

    }
}

