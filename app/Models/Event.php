<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'event_id';


    protected $fillable = [
        'event_datetime',
        'event_title',
        'event_desc',
        'img_path'
    ];


    public function event_attachment(){

        return $this->hasOne(EventEmployeeAttendance::class, 'event_id', 'event_id');
    }

    public function attendees(){
        return $this->hasMany(EventEmployeeAttendance::class, 'event_id', 'event_id');
    }


}
