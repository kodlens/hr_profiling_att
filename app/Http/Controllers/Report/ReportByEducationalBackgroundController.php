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

        $data = \DB::select("
            SELECT 'ELEMENTARY' AS level, COUNT(*) AS count_level
            FROM users
            WHERE user_id IN (
                SELECT user_id
                FROM educational_backgrounds
                GROUP BY user_id
                HAVING MAX(CASE WHEN LEVEL = 'ELEMENTARY' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'SECONDARY' THEN 1 ELSE 0 END) = 0
                AND MAX(CASE WHEN LEVEL = 'VOCATIONAL/TRADE COURSE' THEN 1 ELSE 0 END) = 0
                AND MAX(CASE WHEN LEVEL = 'COLLEGE' THEN 1 ELSE 0 END) = 0
                AND MAX(CASE WHEN LEVEL = 'GRADUATE STUDIES' THEN 1 ELSE 0 END) = 0
                AND MAX(CASE WHEN LEVEL = 'POST GRADUATE' THEN 1 ELSE 0 END) = 0
            )
            AND users.designation LIKE ?
            UNION ALL
            SELECT 'SECONDARY' AS level, COUNT(*) AS count_level
            FROM users
            WHERE user_id IN (
                SELECT user_id
                FROM educational_backgrounds
                GROUP BY user_id
                HAVING MAX(CASE WHEN LEVEL = 'SECONDARY' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'ELEMENTARY' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'VOCATIONAL/TRADE COURSE' THEN 1 ELSE 0 END) = 0
                AND MAX(CASE WHEN LEVEL = 'COLLEGE' THEN 1 ELSE 0 END) = 0
                AND MAX(CASE WHEN LEVEL = 'GRADUATE STUDIES' THEN 1 ELSE 0 END) = 0
                AND MAX(CASE WHEN LEVEL = 'POST GRADUATE' THEN 1 ELSE 0 END) = 0
            )
            AND users.designation LIKE ?
            UNION ALL
            SELECT 'VOCATIONAL/TRADE COURSE' AS level, COUNT(*) AS count_level
            FROM users
            WHERE user_id IN (
                SELECT user_id
                FROM educational_backgrounds
                GROUP BY user_id
                HAVING MAX(CASE WHEN LEVEL = 'SECONDARY' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'ELEMENTARY' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'VOCATIONAL/TRADE COURSE' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'COLLEGE' THEN 1 ELSE 0 END) = 0
                AND MAX(CASE WHEN LEVEL = 'GRADUATE STUDIES' THEN 1 ELSE 0 END) = 0
                AND MAX(CASE WHEN LEVEL = 'POST GRADUATE' THEN 1 ELSE 0 END) = 0
            )
            AND users.designation LIKE ?
            UNION ALL
            SELECT 'COLLEGE' AS level, COUNT(*) AS count_level
            FROM users
            WHERE user_id IN (
                SELECT user_id
                FROM educational_backgrounds
                GROUP BY user_id
                HAVING MAX(CASE WHEN LEVEL = 'SECONDARY' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'ELEMENTARY' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'COLLEGE' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'GRADUATE STUDIES' THEN 1 ELSE 0 END) = 0
                AND MAX(CASE WHEN LEVEL = 'POST GRADUATE' THEN 1 ELSE 0 END) = 0
            )
            AND users.designation LIKE ?
            UNION ALL
            SELECT 'GRADUATE STUDIES' AS level, COUNT(*) AS count_level
            FROM users
            WHERE user_id IN (
                SELECT user_id
                FROM educational_backgrounds
                GROUP BY user_id
                HAVING MAX(CASE WHEN LEVEL = 'SECONDARY' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'ELEMENTARY' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'COLLEGE' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'GRADUATE STUDIES' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'POST GRADUATE' THEN 1 ELSE 0 END) = 0
            )
            AND users.designation LIKE ?
            UNION ALL
            SELECT 'POST GRADUATE' AS level, COUNT(*) AS count_level
            FROM users
            WHERE user_id IN (
                SELECT user_id
                FROM educational_backgrounds
                GROUP BY user_id
                HAVING MAX(CASE WHEN LEVEL = 'SECONDARY' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'ELEMENTARY' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'COLLEGE' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'GRADUATE STUDIES' THEN 1 ELSE 0 END) = 1
                AND MAX(CASE WHEN LEVEL = 'POST GRADUATE' THEN 1 ELSE 0 END) = 1
            )
            AND users.designation LIKE ?
        
        ", [$req->designation . '%', $req->designation . '%', $req->designation . '%', $req->designation . '%', $req->designation . '%', $req->designation . '%']);

        return $data;
    }

    
}
