<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $departments = Department::all();

        return view('dashboard', compact('departments'));
    }
}
