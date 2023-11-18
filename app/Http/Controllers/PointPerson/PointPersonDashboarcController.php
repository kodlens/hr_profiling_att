<?php

namespace App\Http\Controllers\PointPerson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PointPersonDashboarcController extends Controller
{
    //
    public function index(){
        return view('point_person.point-person-dashboard');
    }
}
