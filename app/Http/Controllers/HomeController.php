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
    public function index(Request $request){
        $departments = Department::all();
        $users = User::with(['roomAccess' => function($query) use($request){
                    if(isset($request->initial_access) && isset($request->final_access) ){
                        $initial_access = new Carbon($request->initial_access);//->format('Y-m-d');
                        $final_access = new Carbon($request->final_access);//->format('Y-m-d');
                        $query->whereBetween('created_at', [$initial_access, $final_access]);
                    }
                }
        ])->where('role_id', '!=', 1);

        if(isset($request->user_id)){
            $users->where('id', $request->user_id);
        }
        if(isset($request->department_id)){
            $users->where('department_id', $request->department_id);
        }

        $users = $users->paginate(10);
        return view('dashboard', compact('departments', 'users', 'request'));
    }

    public function operator(){
        return view('operator.index');
    }

    public function accessExport($user_id){

        return Excel::download(new AccessExport($user_id), 'access.xlsx');

    }
}
