<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Children;

class EmployeeChildController extends Controller
{
    //


    public function destroy($id){
        
        Children::destroy($id);
    
        return response()->json([
            'status' => 'deleted'
        ],200);
    }
}
