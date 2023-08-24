<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
    use HasFactory;
    protected $table = 'startup';
    protected $primaryKey = 'ms_id';
    protected $fillable =[
        'ms_startdate',
        'ms_enddate',
        'ms_pks',
        'ms_link_pks',
        'ms_phone',
        'ms_name',
        'ms_address',
        'ms_website',
        'ms_logo',
        'ms_socialmedia',
        'ms_legal',
        'ms_link_legal',
        'ms_riset',
        'ms_proposal',
        'ms_pithdeck',
        'mm_id',
        'ms_npwp',
        'user_id',
        'mpd_id',
        'ms_status'
    ];
}
