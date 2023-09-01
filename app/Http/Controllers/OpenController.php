<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningDevelopmentType;
use App\Models\Specialization;
use App\Models\CidSubRole;


class OpenController extends Controller
{
    //

    public function loadLearningDevTypes(Request $req){

        return LearningDevelopmentType::orderBy('ld_type', 'asc')
            ->get();
        
    }

    public function loadSpecializations(Request $req){

        return Specialization::orderBy('specialization', 'asc')
            ->get();
        
    }


    public function loadSubRoles(){
        return CidSubRole::orderBy('cid_sub_role', 'asc')
            ->get();
    }

}
