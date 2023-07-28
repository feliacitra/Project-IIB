<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterComponent extends Model
{
    use HasFactory;

    protected $table = 'master_component';
    protected $fillable = [
        'mct_id',
        'mct_step',
    ];

    public function periodeProgram()
    {
        return $this->belongsTo(MasterPeriodeProgram::class, 'mpd_id', 'mpd_id');
    }

    public function question()
    {
        return $this->hasMany(MasterQuestion::class, 'mct_id', 'mct_id');
    }
}
