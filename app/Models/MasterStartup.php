<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStartup extends Model
{
    use HasFactory;
    protected $table = 'master_startup';
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
        'ms_yearly_income',
        'ms_year_founded',
        'ms_funding_sources',
        'ms_focus_area',
        'mm_id',
        'ms_npwp',
        'user_id',
        'mpd_id',
        'ms_status'
    ];

    public function masterMember()
    {
        return $this->hasMany(MasterMember::class, 'mm_id');
    }
}
