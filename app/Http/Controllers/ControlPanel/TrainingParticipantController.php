<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingParticipant;
use App\Models\TrainingSeminar;


class TrainingParticipantController extends Controller
{
    //

    public function index($id){
        $data = TrainingSeminar::find($id);

        return view('control-panel.training-seminar-participant')
            ->with('id', $id)
            ->with('data', $data);
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = TrainingParticipant::with(['training_seminar', 'user'])
            ->where('training_seminar_id', $req->trainingid . '%')
            ->whereHas('user', function($q) use ($req){
                $q->where('lname', 'like', $req->name . '%');
            })
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function approve($id){
        $data = TrainingParticipant::find($id);

        $data->approval_status = 1;
        $data->save();

        return response()->json([
            'status' => 'approved'
        ], 200);
    }
}
