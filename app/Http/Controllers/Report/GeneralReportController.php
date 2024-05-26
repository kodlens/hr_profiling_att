<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GeneralReportController extends Controller
{
    //
    public function index(){
        return view('report.general-report');
    }

    public function cleanArray($input){
        // Step 1: Trim the string
        $trimmedString = trim($input, ',');
        // Step 2: Explode the string into an array
        $inputArray = explode(',', $trimmedString);
        $cleanInput = array_filter(array_map('trim', $inputArray), function ($value) {
            return !empty($value);
        });

        return $cleanInput;
    }
    


    
    public function loadGeneralReport(Request $req){
        //return $req;
       
        $engagements = $this->cleanArray($req->engagement);
        $sex = $req->sex == 'all' ? '' : $req->sex;

        $data = User::with(['engagement', 'eligibilities', 'educational_backgrounds', 'learning_developments'])
            ->where('sex', 'like',  $sex . '%');

        if($req->range != null){

            $age = explode("-",$req->range);
            $minAge = $age[0];
            $maxAge = $age[1];

            $data->where(DB::raw('TIMESTAMPDIFF(YEAR, date_birth, CURDATE())'), '>=', $minAge)
                ->where(DB::raw('TIMESTAMPDIFF(YEAR, date_birth, CURDATE())'), '<=', $maxAge);
        }
            
            //->whereIn('designation', ['faculty', 'staff'])

        if(count($engagements) > 0){
            $data->whereHas('engagement', function($q) use ($engagements){
                $q->whereIn('engagement_status', $engagements);
            });
        }

        if($req->eligibility != null  || $req->eligibility != ''){
            $data->whereHas('eligibilities', function($q) use ($req){
                $q->where('career_exam', 'like', '%'. $req->eligibility . '%');
            });
        }
        if($req->education != null  || $req->education != ''){
            $data->whereHas('educational_backgrounds', function($q) use ($req){
                $q->where('degree', 'like', '%'. $req->education . '%')
                    ->orWhere('level', 'like', '%'. $req->education . '%');
            });
        }
        if($req->learningdev != null  || $req->learningdev != ''){
            $data->whereHas('learning_developments', function($q) use ($req){
                $q->where('title_learning_dev', 'like', '%'. $req->learningdev . '%');
            });
        }

        

        return $data->get();
       
    }
}
