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

        // $users = User::with(['engagement', 'eligibilities_join'])
        //     ->where(function($q) use ($req){
        //         $q->where('lname', 'like', $req->key . '%')
        //         ->orWhere('fname', 'like', $req->key . '%')
        //         ->orWhere('sex', 'like', $req->key . '%');
                
        //     })
        //     // ->where(function($q) use ($req) {
        //     //     $q->whereHas('eligibilities', function($q) use ($req) {
        //     //         $q->where('career_exam', 'like', $req->key . '%')
        //     //             ->orWhereNull('career_exam')
        //     //             ->orWhere('place_exam', 'like', $req->key . '%')
        //     //             ->orWhereNull('place_exam');
        //     //     })
        //     //     ->orWhereDoesntHave('eligibilities');
        //     // })

        //     // ->whereHas('eligibilities', function($q) use ($req) {
        //     //     $q->where('career_exam', 'like', $req->key . '%')
        //     //         //->orWhereNull('career_exam')
        //     //         ->orWhere('place_exam', 'like', $req->key . '%');
        //     //         // ->orWhereNull('career_exam')
        //     //         // ->orWhereNull('place_exam');
        //     // })
        
        $users = User::leftJoin('civil_service_eligibilities', 'users.user_id', 'civil_service_eligibilities.user_id')
            ->leftJoin('learning_developments', 'users.user_id', 'learning_developments.user_id')
            ->leftJoin('work_experiences', 'users.user_id', 'work_experiences.user_id')

            ->where(function($q) use ($req){
                $q->where('lname', 'like', $req->key . '%')
                    ->orWhere('fname', 'like', $req->key . '%')
                    ->orWhere('sex', 'like', $req->key . '%')
                    ->orWhere('pagibig', 'like', $req->key . '%')
                    ->orWhere('sss', 'like', $req->key . '%')
                    ->orWhere('tin', 'like', $req->key . '%')
                    ->orWhere('agency_idno', 'like', $req->key . '%')
                    ->orWhere('career_exam', 'like', $req->key . '%')
                    ->orWhere('position_title', 'like', $req->key . '%')
                    ->orWhere('department_agency', 'like', $req->key . '%');
                    
            })
           // ->where('career_exam', 'like', '%'. $req->key . '%')
            ->where('is_archive', 0)
            ->where('role', 'EMPLOYEE')
            ->orderBy($sort[0], $sort[1]);

        if($req->engagement){
            $users->where('engagement_status_id',$req->engagement);
        }

        return $users->paginate($req->perpage);
    }

}
