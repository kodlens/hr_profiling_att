<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngagementStatus extends Model
{
    use HasFactory;

    protected $table = 'engagement_status';
    protected $primaryKey = 'engagement_status_id';


    protected $fillable = [
        'engagement_status'
    ];
}
