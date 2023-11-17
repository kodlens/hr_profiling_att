<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\TrainingDevelopment;
use Illuminate\Http\Request;

class AdminTrainingDevelopmentController extends Controller
{
    //


    public function index(){
        return view('administrator.training_development.training-development-index');
    }


    public function show($id){

    }


    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $event = Event::where('event_title', 'like', $req->event . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
        return $event;
    }

    public function create(){
        return view('administrator.event.event-create-edit')
            ->with('id', 0)
            ->with('data', []);
    }

    public function edit($id){
        $event = Event::find($id);
        return view('administrator.event.event-create-edit')
            ->with('id', $event->event_id)
            ->with('data', $event);
    }


    public function store(Request $req){

        $event_date = date('Y-m-d H:i:s', strtotime($req->event_datetime));

        $req->validate([
            'event_title' => ['required'],
            'content' => ['required'],
            'event_datetime' => ['required'],
        ]);

        $n = [];
        if($req->hasFile('event_img')) {
            $pathFile = $req->event_img->store('public/events'); //get path of the file
            $n = explode('/', $pathFile); //split into array using /
        }

        TrainingDevelopment::create([
            'event_title' => $req->event_title,
            'content' => $req->event_desc,
            'event_datetime' => $event_date,
            'img_path' => $req->hasFile('event_img') ? $n[2] : ''
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);

    }

    public function updateTrainingDev(Request $req){

    }


}
