<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventEmployeeAttendance;
use App\Models\Event;

class ReportEventAttendanceController extends Controller
{
    //

    public function index($id){
        return view('report.report-event-attendance')
            ->with('id', $id);
    }

    public function loadReportAttendances(Request $req){

        $data = EventEmployeeAttendance::with(['user'])
            ->where('event_id', $req->id)
            ->where('attendance_status', 1)
            ->get();
        return $data;

    }

    public function loadEventName($id){

        $event = Event::find($id);
        return $event;
    }
}
