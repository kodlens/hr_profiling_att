<?php

namespace App\Http\Controllers\RecordOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RODashboardController extends Controller
{
    //
    public function index(){
        return view('record-officer.ro-dashboard');
    }
}
