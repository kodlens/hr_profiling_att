<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingParticipant;
use Auth;


class EmployeeMySeminarController extends Controller
{
    //


    public function index(){
        return view('employee.employee-my-seminar');
    }


    public function getMySeminars(Request $req){
        $sort = explode('.', $req->sort_by);

        $user = Auth::user();

        $data = TrainingParticipant::with(['training_seminar', 'user', 'attendances'])
            ->whereHas('training_seminar', function($q) use ($req){
                $q->where('seminar_title', 'like', $req->training . '%');
            })
            ->where('user_id', $user->user_id)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }

    public function removeMe($id){
        TrainingParticipant::destroy($id);
        return response()->json([
            'status' => 'removed'
        ], 200);
    }



}
