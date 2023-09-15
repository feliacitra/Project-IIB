<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'mc_id',
        'ms_website',
        'ms_logo',
        'ms_socialmedia',
        'ms_legal',
        'ms_link_legal',
        'ms_riset',
        'ms_proposal',
        'ms_pitchdeck',
        'ms_yearly_income',
        'ms_year_founded',
        'ms_funding_sources',
        'ms_focus_area',
        'mm_id',
        'ms_npwp',
        'user_id',
        'mpd_id',
        'ms_status',
    ];

    public function masterMember()
    {
        return $this->hasMany(MasterMember::class, 'mm_id');
    }

    public function startupComponentStatus() : HasOne {
        return $this->hasOne(StartupComponentStatus::class,'ms_id');
    }

    public function masterPeriodeProgram(){
        return $this->belongsTo(MasterPeriodeProgram::class, 'mpd_id', 'mpd_id');
    }

    public function masterCategory(){
        return $this->belongsTo(MasterCategory::class, 'mc_id', 'mc_id');
    }

    public function registationStatus(){
        return $this->hasOne(RegistationStatus::class, 'ms_id');
    }
}
