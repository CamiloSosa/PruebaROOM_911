<?php

namespace App\Http\Controllers;

use App\Exports\AccessExport;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * This function displays the dashboard
     * */
    public function index(Request $request){ 
        $departments = Department::all();

        $users = User::with(['roomAccess']);

        if(isset($request->user_id)){
            $users->where('id', $request->user_id);
        }
        if(isset($request->department_id)){
            $users->where('department_id', $request->department_id);
        }

        $users = $users->paginate(10);
        return view('dashboard', compact('departments', 'users', 'request'));
    }

    /**
     * This function displays users who are not administrators
     * */
    public function operator(){
        return view('operator.index');
    }

    /**
     * This function exports the excel file
     * */
    public function accessExport($user_id){

        return Excel::download(new AccessExport($user_id), 'access.xlsx');

    }
}
