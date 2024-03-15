<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PrintPDSController extends Controller
{
    //

    public function index($id){
        $user = User::with([
            'children',
            'eligibilities',
            'work_experiences',
            'educational_backgrounds',
            'voluntary_works',
            'learning_developments',
            'other_informations',
            'engagement',
            'residential_province',
            'residential_city',
            'residential_barangay',

            'permanent_province',
            'permanent_city',
            'permanent_barangay'
        ])
        ->where('user_id', $id)
        ->first();
        //return $user;

        return view('pds')
            ->with('user', $user);
    }
}
