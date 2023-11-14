<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    
    }



    public function update(Request $req, $id){
    
    }
}
