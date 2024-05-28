<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportEventAttendanceController extends Controller
{
    //

    public function index($id){
        return view('report.report-event-attendance')
            ->with('id', $id);
    }
}
