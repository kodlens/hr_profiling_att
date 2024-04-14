<?php

namespace App\Http\Controllers\RecordOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FileManager;

// if storage is use,, import this Storage
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $req, $id){
        //return $req;

        $req->validate([
            'file' => ['required'],
            'file_description' => ['required','string']
        ]);

        $extension = '';

        $upload_file = [];
        if($req->hasFile('file')) {
            $file = $req->file('file');
            $pathFile = $req->file->store('public/upload_files'); //get path of the file
            $upload_file = explode('/', $pathFile); //split into array using /
            $extension = $file->getClientOriginalExtension();
        }

        FileManager::create([
            'user_id' => $id,
            'file_description' => strtoupper($req->file_description),
            'file_dir' => $req->hasFile('file') ? $upload_file[2] : '',
            'file_type' => $extension
        ]);

        return response()->json([
            'status' => 'saved',
            'message' => 'Success'
        ], 200);


    }

    public function destroy($id){
        //return $id;

        $data = FileManager::find($id);

       
        if(Storage::exists('public/upload_files/' .$data->file_dir)) {
            Storage::delete('public/upload_files/' . $data->file_dir);
        }

        FileManager::destroy($id);

        return response()->json([
            'status' => 'deleted',
            'message' => 'Success'
        ], 200);

    }
}
