<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingAttendee;
use App\Models\TrainingParticipant;

class QrScannerController extends Controller
{
    //

    public function index(){
        return view('control-panel.training_seminar.qr-scanner');
    }


    public function store(Request $req){
        $req->validate([
            'attendance_status' => ['required']
        ]);

        $exist = TrainingParticipant::where('user_id', $req->user_id)
            ->where('training_seminar_id', $req->training_seminar_id)
            ->where('approval_status', 1)
            ->exists();

            
        $existAttendance = TrainingAttendee::where('user_id', $req->user_id)
            ->where('training_seminar_id', $req->training_seminar_id)
            ->where('attendance_status', $req->attendance_status)
            ->exists();



        if(!$exist){
            return response()->json([
                'message' => 'Invalid.',
                'errors' => [
                    'user' => ['User is not registered in this Training/Seminar']
                ]
            ], 422);
        }

        if($existAttendance){
            return response()->json([
                'message' => 'Invalid.',
                'errors' => [
                    'attendance' => ['Already have an attendance.']
                ]
            ], 422);
        }


        TrainingAttendee::create([
            'user_id' => $req->user_id,
            'datetime_scanned' => date('Y-m-d H:i'),
            'training_seminar_id' => $req->training_seminar_id,
            'attendance_status' => $req->attendance_status,
        ]);


        return response()->json([
            'status' => 'saved'
        ], 200);
    }
       

    
}
