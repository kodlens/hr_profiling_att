<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ReportByEngagementStatus extends Controller
{
    //

    public function index(){
        return view('report.report-engagement-status');
    }

    public function loadReport(Request $req){
        return User::select(
            'users.user_id',
            'users.date_birth',
            'users.designation',
            'engagement_status.engagement_status as engagement_status',
            \DB::raw('COUNT(*) as count')
        )
        ->join('engagement_status', 'users.engagement_status_id', '=', 'engagement_status.engagement_status_id')
        ->whereIn('users.designation', ['faculty', 'staff'])
        ->groupBy('users.engagement_status_id')
        ->get();
    }
}
