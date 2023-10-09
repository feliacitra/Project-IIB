<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MasterPeriodeProgram extends Model
{
    use HasFactory;

    protected $table = 'master_periodeprogram';
    protected $primaryKey = 'mpd_id';
    public $incrementing = true;
    
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

    public function masterStartup(){
        return $this->hasMany(MasterStartup::class, 'mpd_id');
    }

}
