<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportHighestEducationalAttainmentController extends Controller
{
    //

    public function index(){
        return view('report.report-highest-educational-attainment');
    }


    public function loadReportHighestEducationalAttainment(Request $req){
        
    }
}
