<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportByAgeRangeController extends Controller
{
    //
    public function index(){
        return view('report.report-age-range');
    }

    public function loadReport(Request $req){
        $age = explode("-",$req->range);

        $minAge = $age[0];
        $maxAge = $age[1];

        return User::select(
                    DB::raw('UPPER(designation) AS designation'), 
                    DB::raw('COUNT(*) AS count')
                )
                ->where(DB::raw('TIMESTAMPDIFF(YEAR, date_birth, CURDATE())'), '>=', $minAge)
                ->where(DB::raw('TIMESTAMPDIFF(YEAR, date_birth, CURDATE())'), '<=', $maxAge)
                ->whereIn('designation', ['faculty', 'staff'])
                ->groupBy('designation')
                ->get();
    }


}
