<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidSubRole extends Model
{
    use HasFactory;


    
    protected $table = 'cid_sub_roles';
    protected $primaryKey = 'cid_sub_role_id';

    protected $fillable = ['cid_sub_role'];

}
