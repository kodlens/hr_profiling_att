<?php

namespace App\Http\Controllers\TrainingOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrainingSeminarDashboard extends Controller
{
    //

    public function index(){
        return view('training_officer.training-seminar-dashboard');
    }

    public function getData(Request $req){

        $data = TrainingSeminar::where('seminar_title', 'like', $req->title . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function store(Request $req){
        
    }


}
