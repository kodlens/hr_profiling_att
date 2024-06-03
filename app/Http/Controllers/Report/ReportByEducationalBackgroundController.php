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


        // $data = EducationalBackground::select('educational_backgrounds.level')
        //     ->selectRaw('COUNT(educational_backgrounds.level) AS count_level')
        //     ->join('users', 'users.user_id', '=', 'educational_backgrounds.user_id')
        //     ->groupBy('educational_backgrounds.level')
        //     ->orderByRaw("FIELD(educational_backgrounds.level, 'ELEMENTARY', 'SECONDARY', 'VOCATIONAL/TRADE COURSE', 'COLLEGE', 'GRADUATE STUDIES', 'POST GRADUATE')")
            
        //     ->where('users.designation', 'like', strtolower($req->designation) . '%')
        //     ->get();

        $data = \DB::select('
            SELECT 
            `level`,
            `designation`,
            COUNT(`level`) AS count_level FROM (SELECT
            a.user_id,
            a.level,
            b.designation
            FROM
            educational_backgrounds a
            JOIN users AS b ON a.user_id = b.user_id
            WHERE b.designation LIKE ?
            GROUP BY a.user_id, a.level) AS aa
            GROUP BY aa.level
            ORDER BY FIELD(aa.level, "ELEMENTARY", "SECONDARY", "VOCATIONAL/TRADE COURSE", "COLLEGE", "GRADUATE STUDIES", "POST GRADUATE")
        ', [$req->designation . '%']);

        return $data;
    }

    
}
