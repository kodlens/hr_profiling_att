<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EngagementStatus;

class EngagementStatusController extends Controller
{
    //
    public function index(){
        return view('control-panel.engagement_status.engagement-status-index');
    }


    public function show($id){
        return EngagementStatus::find($id);
    }

    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = EngagementStatus::where('engagement_status', 'like', $req->engagement . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
        return $data;
    }



    public function store(Request $req){

        $req->validate([
            'engagement_status' => ['required', 'unique:engagement_status'],
        ]);

        EngagementStatus::create([
            'engagement_status' => strtoupper($req->engagement_status),
        ]);


        return response()->json([
            'status' => 'saved'
        ], 200);

    }

    public function update(Request $req, $id){

        $req->validate([
            'engagement_status' => ['required','unique:engagement_status,engagement_status,' . $id . ',engagement_status_id'],
        ]);


        $data = EngagementStatus::find($id);
        $data->engagement_status = strtoupper($req->engagement_status);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }

    public function destroy($id){
        EngagementStatus::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }



}
