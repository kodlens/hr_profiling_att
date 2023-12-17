<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingParticipant extends Model
{
    use HasFactory;


    protected $table = 'training_participants';
    protected $primaryKey = 'training_participant_id';


    protected $fillable = [
        'qr_code',
        'user_id',
        'date_register',
        'training_seminar_id',
        'approval_status'
    ];

    public function training_seminar(){
        return $this->hasOne(TrainingSeminar::class, 'training_seminar_id', 'training_seminar_id');
    }

    
    public function user(){
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
    public function attendances(){
        return $this->hasMany(TrainingAttendee::class, 'training_seminar_id', 'training_seminar_id');
    }

    


}
