<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSeminar extends Model
{
    use HasFactory;

    protected $table = 'training_seminars';
    protected $primaryKey = 'training_seminar_id';


    protected $fillable = [
        'seminar_title',
        'seminar_desc',
        'date_from',
        'date_to',
        'no_hours',
        'type_ld',
        'sponsored_by',
        'attach_path'
    ];


}
