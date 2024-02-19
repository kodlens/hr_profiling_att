<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ReportBySexController extends Controller
{
    //

    public function index(){
        return view('report.report-by-sex');
    }


    public function loadReportBySex(Request $req){
        $designation = $req->designation == '' || $req->designation == null ? '' : $req->designation;
        $data = User::where('designation', 'like', $designation . '%')
            ->get();

        return $data;
    }
}
