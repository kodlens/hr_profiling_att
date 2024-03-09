<?php

namespace App\Http\Controllers\ControlPanel;

use App\Models\Office;
use App\Models\OtherInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Env;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use App\Mail\AccountApprovalMail;



class UserController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

    }

    public function index(){
        return view('control-panel.user'); //blade.php
    }

    public function getUsers(Request $req){
        $sort = explode('.', $req->sort_by);

        $users = User::with(['engagement'])
            ->where('lname', 'like', $req->lname . '%')
            ->where('is_archive', $req->archive)
            ->orderBy($sort[0], $sort[1]);

        if($req->engagement){
            $users->where('engagement_status_id',$req->engagement);
        }

        return $users->paginate($req->perpage);
    }

    public function show($id){
        return User::find($id);
    }

    public function storeOtherInfo(Request $req, $id){

        $validate = $req->validate([
            'skill_hobbies' => ['required']
        ]);

        OtherInformation::updateOrCreate([
            'user_id' => $id,
            'skill_hobbies' => $req->skill_hobbies,
        ],[
            'user_id' => $id,
            'skill_hobbies' => $req->skill_hobbies,
            'non_academic_distinction' => $req->non_academic_distinction,
            'member_association' => $req->member_association
        ]);

        return response()->json([
            'status' => 'saved'
        ]);
    }

    public function store(Request $req){
        //this will create random unique QR code
        $qr_code = substr(md5(time() . $req->lname . $req->fname), -8);

        $validate = $req->validate([
            'username' => ['required', 'max:50', 'unique:users'],
            'lname' => ['required', 'string', 'max:100'],
            'fname' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string', 'max:20'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'is_partime' => ['required'],
            'role' => ['required'],
            'res_province' => ['required', 'string'],
            'res_city' => ['required', 'string'],
            'res_barangay' => ['required', 'string'],
        ]);

        User::create([
            'qr_ref' => $qr_code,
            'username' => $req->username,
            'password' => Hash::make($req->password),
            'lname' => strtoupper($req->lname),
            'fname' => strtoupper($req->fname),
            'mname' => strtoupper($req->mname),
            'sex' => $req->sex,
            'email' => $req->email,
            'contact_no' => $req->contact_no,
            'designation' => $req->designation,
            'role' => $req->role,
            'is_partime' => $req->is_partime,
            'res_province' => $req->res_province,
            'res_city' => $req->res_city,
            'res_barangay' => $req->res_barangay,
            'res_street' => strtoupper($req->res_street),
            'engagement_status_id' => $req->engagement_status_id
        ]);

        return response()->json([
            'status' => 'saved'
        ]);
    }

    public function update(Request $req, $id){
   
        $validate = $req->validate([
            'username' => ['required', 'max:50', 'unique:users,username,'.$id.',user_id'],
            'lname' => ['required', 'string', 'max:100'],
            'fname' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string', 'max:20'],
            'email' => ['required', 'unique:users,email,'.$id.',user_id'],
            'role' => ['required', 'string'],
            'is_partime' => ['required'],
            'res_province' => ['required', 'string'],
            'res_city' => ['required', 'string'],
            'res_barangay' => ['required', 'string'],
        ]);

        $data = User::find($id);
        $data->username = $req->username;
        $data->lname = strtoupper($req->lname);
        $data->fname = strtoupper($req->fname);
        $data->mname = strtoupper($req->mname);
        $data->sex = $req->sex;
        $data->email = $req->email;
        $data->designation = $req->designation;
        $data->role = $req->role;
        $data->is_partime = $req->is_partime;
        $data->res_province = $req->res_province;
        $data->res_city = $req->res_city;
        $data->res_barangay = $req->res_barangay;
        $data->res_street = strtoupper($req->res_street);
        $data->engagement_status_id = $req->engagement_status_id;

        $data->save();

        return response()->json([
            'status' => 'updated'
        ]);
    }


    public function resetPassword(Request $req, $id){

        $req->validate([
            'password' => ['required', 'confirmed']
        ]);

        $user = User::find($id);
        $user->password = Hash::make($req->password);
        $user->save();

        return response()->json([
            'status' => 'changed'
        ],200);

    }

    public function destroy($id){
        User::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);
    }


    public function setArchive($id, $value){
        $data = User::find($id);
        $data->is_archive = $value;
        $data->save();

        return response()->json([
            'status' => $value
        ], 200);
    }

    public function setApprove($id){
        $data = User::find($id);
        $data->is_approve = 1;
        $data->save();

        if(Env::get('MAIL_OPEN') == 1){
            $when = now()->addSeconds(10);
            Mail::to($data->email)
                ->later($when, new AccountApprovalMail($data));
        }

        return response()->json([
            'status' => 'approved'
        ], 200);
    }
}
