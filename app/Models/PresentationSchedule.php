<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresentationSchedule extends Model
{
    protected $table = 'presentation_schedules';
    protected $primaryKey = 'ps_id';
    public $timestamps = false;
    protected $casts = [
        'ps_date' => 'date',
        // 'ps_timestart' => 'time',
        // 'ps_timeend' => 'time',
        'ps_online' => 'boolean',
    ];

    protected $fillable = [
        'ps_date',
        'ps_timestart',
        'ps_timeend',
        'ps_online',
        'ps_place',
        'ps_link',
        'mpd_id',
        'ms_id'
    ];


    public function masterPeriodeProgram()
    {
        return $this->belongsTo(MasterPeriodeProgram::class, 'mpd_id');
    }

    public function masterStartup()
    {
        return $this->belongsTo(MasterStartup::class, 'ms_id');
    }

    public function presentationEvaluator()
    {
        return $this->belongsTo(presentationEvaluator::class, 'ps_id', 'ps_id');
    }
}