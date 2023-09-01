<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CidSubRole;


class CidSubRoleController extends Controller
{
    //

    public function index(){
        return view('administrator.cid-sub-role');
    }

    public function getCidSubRoles(Request $req){
        $sort = explode('.', $req->sort_by);

        return CidSubRole::where('cid_sub_role', 'like', $req->cid_sub_role . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function show($id){
        return CidSubRole::find($id);
    }

    public function store(Request $req){
        $req->validate([
            'cid_sub_role' => ['required']
        ]);

        CidSubRole::create([
            'cid_sub_role' => strtoupper($req->cid_sub_role),
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function update(Request $req, $id){
        $req->validate([
            'cid_sub_role' => ['required', 'unique:cid_sub_roles,cid_sub_role,' .$id. ',cid_sub_role_id']
        ]);

        $data = CidSubRole::find($id);
        $data->cid_sub_role =  strtoupper($req->cid_sub_role);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }

    public function destroy($id){
        CidSubRole::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }

    
}
