<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterPeriode extends Model
{
    use HasFactory;

    protected $primaryKey = 'mpe_id';
    protected $guarded = [
        'mpe_id'
    ];

    protected $table = 'master_periode';

    public function masterProgramInkubasi()
    {
        return $this->belongsToMany(MasterProgramInkubasi::class, 'master_periodeprogram', 'mpi_id', 'mpe_id');
    }

    public function masterPeriodeProgram()
    {
        return $this->hasMany(MasterPeriodeProgram::class, 'mpe_id', 'mpe_id');
    }

    

}
