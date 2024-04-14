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
        $data = EducationalBackground::select('educational_backgrounds.*', 'users.designation', 'users.role')
            ->selectRaw('COUNT(educational_backgrounds.level) AS count_level')
            ->join('users', 'users.user_id', '=', 'educational_backgrounds.user_id')
            ->groupBy('educational_backgrounds.level')
            ->where('users.designation', 'like', strtolower($req->designation) . '%')
            ->get();

        return $data;
    }

    
}
