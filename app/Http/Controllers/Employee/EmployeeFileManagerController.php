<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FileManager;
use Auth;
use Illuminate\Support\Facades\Storage;


class EmployeeFileManagerController extends Controller
{
    //

    public function index(){

        return view('employee.file-manager.file-manager-index');
    }

    public function getData(){
        $id = Auth::user()->user_id;
        $data = FileManager::where('user_id', $id)
            ->get();

        return $data;
    }

    public function store(Request $req){
        //return $req;
        $id = Auth::user()->user_id;

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
