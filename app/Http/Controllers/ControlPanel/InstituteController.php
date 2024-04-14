<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institute;

class InstituteController extends Controller
{
    //

    public function index(){
        return view('control-panel.institute.institutes-index');
    }


    public function getData(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Institute::where('code', 'like', $req->institute . '%')
            ->orWhere('institute', $req->institute)
            ->orderBy($sort[0], $sort[1]);
        return $data->paginate($req->perpage);
    }


    public function show($id){
        return Institute::find($id);
    }
    
    public function store(Request $req){
        
        $req->validate([
            'code' => ['required', 'string', 'unique:institutes'],
            'institute' => ['required', 'string'],
        ]);

        Institute::create([
            'code' => strtoupper($req->code),
            'institute' => strtoupper($req->institute),
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }

    public function update(Request $req, $id){
        
        $req->validate([
            'code' => ['required', 'string', 'unique:institutes,code,'. $id . ',institute_id'],
            'institute' => ['required', 'string'],
        ]);

        $data = Institute::find($id);
        $data->code = strtoupper($req->code);
        $data->institute = strtoupper($req->institute);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }


    public function destroy($id){
        Institute::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
}
