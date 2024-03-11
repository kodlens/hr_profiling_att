<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    //

    public function index(){
        return view('control-panel.employees'); //blade.php
    }

    public function getEmployees(Request $req){
        $sort = explode('.', $req->sort_by);

        $users = User::with(['engagement'])
            ->where('lname', 'like', $req->lname . '%')
            ->where('is_archive', $req->archive)
            ->where('role', 'EMPLOYEE')
            ->orderBy($sort[0], $sort[1]);

        if($req->engagement){
            $users->where('engagement_status_id',$req->engagement);
        }

        return $users->paginate($req->perpage);
    }

}
