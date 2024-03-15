<?php

namespace App\Http\Controllers\ControlPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    //

    public function index(){
        return view('control-panel.employees'); //blade.php
    }

    public function getEmployees(Request $req){
        $sort = explode('.', $req->sort_by);

        // $users = User::with(['engagement', 'eligibilities_join'])
        //     ->where(function($q) use ($req){
        //         $q->where('lname', 'like', $req->key . '%')
        //         ->orWhere('fname', 'like', $req->key . '%')
        //         ->orWhere('sex', 'like', $req->key . '%');
                
        //     })
        //     // ->where(function($q) use ($req) {
        //     //     $q->whereHas('eligibilities', function($q) use ($req) {
        //     //         $q->where('career_exam', 'like', $req->key . '%')
        //     //             ->orWhereNull('career_exam')
        //     //             ->orWhere('place_exam', 'like', $req->key . '%')
        //     //             ->orWhereNull('place_exam');
        //     //     })
        //     //     ->orWhereDoesntHave('eligibilities');
        //     // })

        //     // ->whereHas('eligibilities', function($q) use ($req) {
        //     //     $q->where('career_exam', 'like', $req->key . '%')
        //     //         //->orWhereNull('career_exam')
        //     //         ->orWhere('place_exam', 'like', $req->key . '%');
        //     //         // ->orWhereNull('career_exam')
        //     //         // ->orWhereNull('place_exam');
        //     // })
        
        $users = User::leftJoin('civil_service_eligibilities', 'users.user_id', 'civil_service_eligibilities.user_id')
            ->leftJoin('learning_developments', 'users.user_id', 'learning_developments.user_id')
            ->leftJoin('work_experiences', 'users.user_id', 'work_experiences.user_id')
            ->select(

                'users.user_id',
                'users.username',
                'users.lname',
                'users.fname',
                'users.mname',
                'users.suffix',
                'users.date_birth',
                'users.place_birth',
                'users.sex',
                'users.civil_status',
                'users.civil_status_others',
                'users.height',
                'users.weight',
                'users.blood_type',
                'users.gsis',
                'users.pagibig',
                'users.philhealth',
                'users.sss',
                'users.tin',
                'users.agency_idno',
                'users.citizenship',
                'users.dual_citizenship',
                'users.select_citizenship',
                'users.res_province',
                'users.res_city',
                'users.res_barangay',
                'users.res_street',
                'users.res_houseno_blockno',
                'users.res_zipcode',

                'users.per_province',
                'users.per_city',
                'users.per_barangay',
                'users.per_street',
                'users.per_houseno_blockno',
                'users.per_zipcode',

                'users.tel_no',
                'users.contact_no',
                'users.spouse_surname',
                'users.spouse_fname',
                'users.spouse_mname',
                'users.spouse_suffix',
                'users.spouse_occupation',
                'users.business_name',
                'users.business_address',
                'users.business_contact_no',
                'users.father_surname',
                'users.father_fname',
                'users.father_mname',
                'users.father_suffix',

                'users.mother_maiden_name',
                'users.mother_fname',
                'users.mother_mname',
                'users.mother_suffix',

                'users.role',
                'users.designation',

                'users.related_with_third_degree',
                'users.related_with_fourth_degree',
                'users.related_with_fourth_degree_yes',
                'users.is_guilty_administrative_offense',
                'users.is_guilty_administrative_offense_yes',
                'users.is_criminally_charge',
                'users.is_criminally_charge_yes',
                'users.date_filed',
                'users.case_status',
                'users.is_convicted',
                'users.is_convicted_yes',
                'users.is_separated',
                'users.is_separated_yes_details',
                'users.is_candidate_election',
                'users.is_candiadte_election_yes',
                'users.is_immigrant',
                'users.is_immigrant_yes',
                'users.is_resigned',
                'users.is_resigned_yes',
                'users.is_indigenous',
                'users.is_indigenous_yes',
                'users.is_disable',
                'users.is_disable_id_no',
                'users.is_solo_parent',
                'users.is_solo_parent_yes',
                'users.is_archive',
                'users.engagement_status_id',
                'users.is_approve',
                'users.is_partime',

                'work_experiences.work_ex_from',
                'work_experiences.work_ex_id',
                'work_experiences.work_ex_to',
                'work_experiences.position_title',

                'civil_service_eligibilities.career_exam',
                'civil_service_eligibilities.rating',
                'civil_service_eligibilities.date_exam',
                'civil_service_eligibilities.place_exam',
               
                'civil_service_eligibilities.license_no',
                'civil_service_eligibilities.license_validity',

                'learning_developments.title_learning_dev',
                'learning_developments.date_from as ld_date_from',
                'learning_developments.date_to as ld_date_to',
                'learning_developments.no_hours',
                'learning_developments.type_ld',
                'learning_developments.sponsored_by',

            )
            ->where(function($q) use ($req){
                $q->where('lname', 'like', $req->key . '%')
                    ->orWhere('fname', 'like', $req->key . '%')
                    ->orWhere('sex', 'like', $req->key . '%')
                    ->orWhere('pagibig', 'like', $req->key . '%')
                    ->orWhere('sss', 'like', $req->key . '%')
                    ->orWhere('tin', 'like', $req->key . '%')
                    ->orWhere('agency_idno', 'like', $req->key . '%')
                    ->orWhere('career_exam', 'like', $req->key . '%')
                    ->orWhere('position_title', 'like', $req->key . '%')
                    ->orWhere('department_agency', 'like', $req->key . '%');
                    
            })
           // ->where('career_exam', 'like', '%'. $req->key . '%')
            ->where('is_archive', 0)
            ->where('role', 'EMPLOYEE')
            ->orderBy($sort[0], $sort[1]);

        if($req->engagement){
            $users->where('engagement_status_id',$req->engagement);
        }

        return $users->paginate($req->perpage);
    }

}
