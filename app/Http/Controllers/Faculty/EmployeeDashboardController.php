<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\Event;
use App\Models\EventEmployeeAttendance;


class EmployeeDashboardController extends Controller
{
    //

    public function index(){
        return view('employee.employee-dashboard');
    }


    public function getPostedEvents(Request $req){
        return Event::orderBy('event_id', 'desc')
            ->get();
    }

    // public function imIn(Request $req){
    //     //return $req;
    //     $user = Auth::user();

    //     $arrData = [
    //         'seminar_post_id' => $req->seminar_post_id,
    //         'teacher_id' => $user->user_id,
    //         'lname' => $user->lname,
    //         'fname' => $user->fname,
    //         'mname' => $user->mname,
    //         'sex' => $user->sex,
    //         'specialization' => $req->specialization,
    //         'title' => $req->title,
    //         'remarks' => 'REQUEST'
    //     ];
    //     FacultyParticipant::create($arrData);

    //     return response()->json([
    //         'status' => 'saved'
    //     ], 200);
    // }


    public function uploadAttachment(Request $req){

        $req->validate([
            'event_id' => ['required']
        ]);

        $n = [];
        if($req->hasFile('attachment')) {
            $pathFile = $req->attachment->store('public/attachments'); //get path of the file
            $n = explode('/', $pathFile); //split into array using /
        }
        $user = Auth::user();

        EventEmployeeAttendance::create([
            'event_id' => $req->event_id,
            'user_id' => $user->user_id,
            'img_path' => $req->hasFile('event_img') ? $n[2] : ''
        ]);


        return response()->json([
            'status' => 'uploaded'
        ], 200);
    }

}
