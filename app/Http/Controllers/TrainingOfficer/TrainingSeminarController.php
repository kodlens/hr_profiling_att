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

    public function create(){ 
        return view('training_officer.training-seminar-create-edit');
    }
    

    public function store(Request $req){
        
        $req->validate([
            'seminar_title' => ['required'],
            'seminar_desc' => ['required'],
            'seminar_date' => ['required'],
            'no_hours' => ['required'],
            'sponsored_by' => ['required'],
            'file' => ['required','mimes:jpeg,png', 'max:1024']
        ]);

        $n = [];
        if($req->hasFile('file')) {
            $pathFile = $req->file->store('public/training_seminars'); //get path of the file
            $n = explode('/', $pathFile); //split into array using /
        }

        TrainingSeminar::create([
            'seminar_title' =>  strtolower($req->seminar_title),
            'seminar_desc' =>  strtolower($req->seminar_desc),
            'seminar_date' =>  $req->seminar_date,
            'no_hours' =>  $req->no_hours,
            'sponsored_by' =>  strtolower($req->sponsored_by),
            'speaker' =>  strtolower($req->speaker),
            'attach_path' => $req->hasFile('file') ? $n[2] : ''
        ]);


        return response()->json([
            'status' => 'saved'
        ], 200);
    }




    public function updateEvent(Request $req, $id){

        //format the date
        $req->validate([
            'seminar_title' => ['required'],
            'seminar_desc' => ['required'],
            'seminar_date' => ['required'],
            'no_hours' => ['required'],
            'sponsored_by' => ['required'],
        ]);

        $data = Event::find($id);
        $n = [];

        if($req->hasFile('file')) {
            $pathFile = $req->file->store('public/training_seminars'); //get path of the file
            $n = explode('/', $pathFile); //split into array using /

            //if an image has already in database, it will delete from events folder to avoid redundancy
            if(Storage::exists('public/training_seminars/' .$data->attach_path)) {
                Storage::delete('public/training_seminars/' . $data->attach_path);
            }
        }

        //get data from database

        $data->seminar_title = strtoupper($req->seminar_title);
        $data->seminar_desc = strtoupper($req->seminar_desc);
        $data->seminar_date = $req->seminar_date;
        $data->no_hours = $req->no_hours;
        $data->sponsored_by = strtoupper($req->sponsored_by);
        $data->speaker = strtoupper($req->speaker);

        if($req->hasFile('file')){
            $data->attach_path = $n[2];
        }

        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);

    }


}
