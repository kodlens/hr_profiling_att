<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationalBackground;

class ReportByEducationalBackgroundController extends Controller
{
    //
    public function index(){
        return view('report.report-educational-background');
    }

    public function loadReportEducationalBackground(Request $req){
        $data = EducationalBackground::select('educational_backgrounds.level')
            ->selectRaw('COUNT(educational_backgrounds.level) AS count_level')
            ->join('users', 'users.user_id', '=', 'educational_backgrounds.user_id')
            ->groupBy('educational_backgrounds.level')
            ->orderByRaw("FIELD(educational_backgrounds.level, 'ELEMENTARY', 'SECONDARY', 'VOCATIONAL/TRADE COURSE', 'COLLEGE', 'GRADUATE STUDIES', 'POST GRADUATE')")
            
            ->where('users.designation', 'like', strtolower($req->designation) . '%')
            ->get();

        return $data;
    }

    
}
