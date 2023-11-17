<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingDevelopment extends Model
{
    use HasFactory;

    protected $table = 'training_developments';
    protected $primaryKey = 'training_development_id';


    protected $fillable = [
        'specialization'
    ];
}
