<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingParticipant;
use App\Models\TrainingSeminar;
use App\Models\TrainingAttendee;

class ReportTrainingAttendanceController extends Controller
{
    //

    public function index($id){
        return view('report.report-training-attendance')
            ->with('id', $id);
    }

    public function loadReportAttendances(Request $req){

        $data = TrainingAttendee::with(['user'])
            ->where('training_seminar_id', $req->id)
            ->get();
        return $data;

    }

    public function loadTrainingName($id){

        $event = TrainingSeminar::find($id);
        return $event;
    }
}
