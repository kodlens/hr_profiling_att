<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportBySexController extends Controller
{
    //

    public function index(){
        return view('report.report-by-sex');
    }


    public function loadReportBySex(Request $req){
        $designation = $req->designation == '' || $req->designation == null ? '' : $req->designation;
        
        $data = DB::select('
            SELECT sex, COUNT(*) as count
            FROM users
            users where users.designation like ?
            GROUP BY sex
        ', [$designation . '%']);

        return $data;
    }
}
