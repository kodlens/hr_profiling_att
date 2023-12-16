<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingSeminar;
use App\Models\TrainingParticipant;
use Auth;

class EmployeeTrainingSeminarController extends Controller
{
    //
    public function index(){
        return view('employee.employee-training-seminar-index');
    }

    public function getData(Request $req){
        
        $sort = explode('.', $req->sort_by);
        $data = TrainingSeminar::where('seminar_title', 'like', $req->title . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function participateMe(Request $req){
        $user = Auth::user();

        // $req->validate([
        //     'status' => ['required']
        // ]);

        $exist = TrainingParticipant::where('user_id', $user->user_id)
            ->where('training_seminar_id', $req->training_seminar_id)
            ->exists();

        if($exist){
            return response()->json([
                'message' => 'Already registered.',
                'errors' => [
                    'exist' => ['Aready registered in the seminar.']
                ]
            ], 422);
        }

        TrainingParticipant::create([
            'user_id' => $user->user_id,
            'date_register' => date('Y-m-d H:i:s'),
            'training_seminar_id' => $req->training_seminar_id,
            'approval_status' => 0,
        ]);

        return response()->json([
            'status' => 'participated'
        ], 200);
    }

}
