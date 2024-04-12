<?php

namespace App\Http\Controllers\RecordOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FileManager;

class FileManagerController extends Controller
{
    //

    public function index($id){

        $data = User::where('user_id', $id)
            ->first();

        return view('record-officer.file-manager.file-manager-index')
            ->with('data', $data);
    }

    public function getData($id){
        $data = FileManager::where('user_id', $id)
            ->get();

        return $data;
    }
}
