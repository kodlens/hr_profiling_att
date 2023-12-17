<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingAttendee extends Model
{
    use HasFactory;


    protected $table = 'training_attendees';
    protected $primaryKey = 'training_attendee_id';


    protected $fillable = [
        'user_id',
        'datetime_scanned',
        'training_seminar_id',
        'attendance_status'
    ];

    public function training_seminar(){
        return $this->hasOne(TrainingSeminar::class, 'training_seminar_id', 'training_seminar_id');
    }

    
    public function user(){
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }



}
