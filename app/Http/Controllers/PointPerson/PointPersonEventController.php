<?php

namespace App\Http\Controllers\PointPerson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventEmployeeAttendance;

class PointPersonEventController extends Controller
{
    //


    public function index(){
        return view('point_person.point-person-event');
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $event = Event::where('event_title', 'like', $req->event . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $event;
    }


    public function eventView($id){
        $eventAttendees = Event::with(['attendees.user'])
            ->where('event_id', $id)
            ->first();

        return view('point_person.point-person-event-view')
            ->with('eventAttendees', $eventAttendees);
    }

    public function getEventView(Request $req){
        $sort = explode('.', $req->sort_by);
        $attendees = EventEmployeeAttendance::with(['attendees.user'])
        ->where('event_id', $id)
        ->paginate();
    }

}
