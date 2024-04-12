<?php

namespace App\Http\Controllers\RecordOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    //

    public function index($id){
        return view('record-officer.file-manager.file-manager-index')
            ->with('id', $id);
    }
}
