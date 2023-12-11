<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\TrainingSeminar;
use Illuminate\Http\Request;

class AdminTrainingSeminarController extends Controller
{
    //


    public function index(){
        return view('administrator.training_seminar.training-seminar-index');
    }


    public function show($id){

    }


    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $event = TrainingSeminar::where('seminar_title', 'like', $req->seminar . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
        return $event;
    }

    public function create(){
        return view('administrator.training_seminar.training-seminar-create-edit')
            ->with('id', 0)
            ->with('data', []);
    }

    public function edit($id){
        $event = TrainingSeminar::find($id);
        return view('administrator.training_seminar.training-seminar-create-edit')
            ->with('id', $event->event_id)
            ->with('data', $event);
    }


    public function store(Request $req){
       
        $req->validate([
            'seminar_title' => ['required'],
            'seminar_date' => ['required'],
            'seminar_desc' => ['required'],
            'sponsored_by' => ['required'],
        ]);
    
        $n = [];
        if($req->hasFile('file')) {
            $pathFile = $req->file->store('public/trainings'); //get path of the file
            $n = explode('/', $pathFile); //split into array using /
        }

        TrainingSeminar::create([
            'seminar_title' => $req->seminar_title,
            'seminar_date' => $req->seminar_date,
            'seminar_desc' => $req->seminar_desc,
            'sponsored_by' => $req->sponsored_by,
            'no_hours' => $req->no_hours,
            'speaker' => $req->speaker,
            'attach_path' => $req->hasFile('file') ? $n[2] : ''
        ]);


        return response()->json([
            'status' => 'saved'
        ], 200);

    }

    public function updateTrainingDev(Request $req){

    }


}
