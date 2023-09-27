<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresentationSchedule extends Model
{
    protected $table = 'presentation_schedules';
    protected $primaryKey = 'ps_id';
    public $timestamps = false;

    protected $fillable = [
        'ps_date',
        'ps_timestart',
        'ps_timeend',
        'ps_online',
        'ps_place',
        'ps_link',
        'mpd_id',
    ];

    protected $casts = [
        'ps_date' => 'date',
        'ps_timestart' => 'time',
        'ps_timeend' => 'time',
        'ps_online' => 'boolean',
    ];

    public function masterPeriodeProgram()
    {
        return $this->belongsTo(MasterPeriodeProgram::class, 'mpd_id');
    }
}