<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $departments = Department::all();
        $users = User::all();
        return view('dashboard', compact('departments', 'users'));
    }
}
