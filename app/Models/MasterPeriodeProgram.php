<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPeriodeProgram extends Model
{
    use HasFactory;

    protected $table = 'master_periodeprogram';
    public $timestamps = true;

    public function component()
    {
        return $this->hasMany(MasterComponent::class, 'mpd_id', 'mpd_id');
    }

    public function masterPeriode()
    {
        return $this->belongsTo(MasterPeriode::class, 'mpe_id', 'mpe_id');
    }

    public function masterProgramInkubasi()
    {
        return $this->belongsTo(masterProgramInkubasi::class, 'mpi_id', 'mpi_id');
    }

}
