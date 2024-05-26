<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OtherInformation;

class EmployeeOtherInformationController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }


    public function destroy($id){
        OtherInformation::destroy($id);
        return response()->json([
            'status' => 'deleted'
        ],200);
    }

}
