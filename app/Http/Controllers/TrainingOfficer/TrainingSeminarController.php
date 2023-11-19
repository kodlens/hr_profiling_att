<?php

namespace App\Http\Controllers\TrainingOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingSeminar;

class TrainingSeminarController extends Controller
{
    //

    public function index(){
        return view('training_officer.training-seminar-index');
    }

    public function getData(Request $req){
        
        $sort = explode('.', $req->sort_by);
        $data = TrainingSeminar::where('seminar_title', 'like', $req->title . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


}
