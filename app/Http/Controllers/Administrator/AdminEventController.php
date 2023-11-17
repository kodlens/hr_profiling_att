<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;


class AdminEventController extends Controller
{
    //

    public function index(){
        return view('administrator.event.event-index');
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
            'event_desc' => ['required'],
            'event_datetime' => ['required'],
        ]);

        $n = [];
        if($req->hasFile('event_img')) {
            $pathFile = $req->event_img->store('public/events'); //get path of the file
            $n = explode('/', $pathFile); //split into array using /
        }

        Event::create([
            'event_title' => $req->event_title,
            'event_desc' => $req->event_desc,
            'event_datetime' => $event_date,
            'img_path' => $req->hasFile('event_img') ? $n[2] : ''
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);

    }



    public function updateEvent(Request $req, $id){

        //format the date
        $event_date = date('Y-m-d H:i:s', strtotime($req->event_datetime));

        $req->validate([
            'event_title' => ['required'],
            'event_desc' => ['required'],
            'event_datetime' => ['required'],
        ]);

        $data = Event::find($id);
        $n = [];

        if($req->hasFile('event_img')) {
            $pathFile = $req->event_img->store('public/events'); //get path of the file
            $n = explode('/', $pathFile); //split into array using /

            //if an image has already in database, it will delete from events folder to avoid redundancy
            if(Storage::exists('public/events/' .$data->img_path)) {
                Storage::delete('public/events/' . $data->img_path);
            }
        }

        //get data from database

        $data->event_title = $req->event_title;
        $data->event_desc = $req->event_desc;
        $data->event_datetime = $event_date;

        if($req->hasFile('event_img')){
            $data->img_path = $n[2];
        }

        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);

    }


    //revise to delete image of event in storage
    public function destroy($id){

        Event::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }


}
