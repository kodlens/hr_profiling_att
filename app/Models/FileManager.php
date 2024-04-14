<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileManager extends Model
{
    use HasFactory;

    protected $table = 'file_managers';
    protected $primaryKey = 'file_manager_id';


    protected $fillable = [
        'user_id',
        'file_description',
        'file_dir',
        'file_type'
    ];

}
