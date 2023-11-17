<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventEmployeeAttendance extends Model
{
    use HasFactory;

    protected $table = 'event_employee_attendances';
    protected $primaryKey = 'event_employee_attendance_id';


    protected $fillable = [
        'event_id',
        'user_id',
        'img_description',
        'img_path',
    ];

  


}
