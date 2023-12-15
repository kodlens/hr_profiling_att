<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\TrainingSeminar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTrainingSeminarController extends Controller
{
    //


    public function index(){
        return view('administrator.training_seminar.training-seminar-index');
    }


    public function show($id){
        return TrainingSeminar::find($id);
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
        $data = TrainingSeminar::find($id);
        return view('administrator.training_seminar.training-seminar-create-edit')
            ->with('id', $id)
            ->with('data', $data);
    }


    public function store(Request $req){

        $req->validate([
            'seminar_title' => ['required'],
            'date_from' => ['required'],
            'date_to' => ['required'],
            'seminar_desc' => ['required'],
            'sponsored_by' => ['required'],
        ]);

        $n = [];
        if($req->hasFile('file')) {
            $pathFile = $req->file->store('public/trainings'); //get path of the file
            $n = explode('/', $pathFile); //split into array using /
        }
        TrainingSeminar::create([
            'seminar_title' => strtoupper($req->seminar_title),
            'date_from' => $req->date_from,
            'date_to' => $req->date_to,
            'seminar_desc' => $req->seminar_desc,
            'sponsored_by' => $req->sponsored_by,
            'no_hours' => $req->no_hours,
            'speaker' => strtoupper($req->speaker),
            'attach_path' => $req->hasFile('file') ? $n[2] : ''
        ]);


        return response()->json([
            'status' => 'saved'
        ], 200);

    }

    public function updateTrainingDSeminar(Request $req, $id){


        $req->validate([
            'seminar_title' => ['required'],
            'date_from' => ['required'],
            'date_to' => ['required'],
            'seminar_desc' => ['required'],
            'sponsored_by' => ['required'],
        ]);

        $data = TrainingSeminar::find($id);
        $n = [];
        if($req->hasFile('file')) {

            $pathFile = $req->file->store('public/trainings'); //get path of the file
            $n = explode('/', $pathFile); //split into array using /

            //if an image has already in database, it will delete from events folder to avoid redundancy
            if(Storage::exists('public/events/' .$data->attach_path)) {
                Storage::delete('public/events/' . $data->attach_path);
            }
        }

        $data->seminar_title = strtoupper($req->seminar_title);
        $data->date_from = $req->date_from;
        $data->date_to = $req->date_to;
        $data->seminar_desc = $req->seminar_desc;
        $data->sponsored_by = $req->sponsored_by;
        $data->no_hours = $req->no_hours;
        $data->speaker = strtoupper($req->speaker);
        if($req->hasFile('file')) {
            $data->attach_path = $n[2];
        }
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }


}
