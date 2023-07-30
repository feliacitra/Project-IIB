<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProgramInkubasi extends Model
{
    use HasFactory;

    protected $table = "master_programinkubasi";
    protected $primaryKey = 'mpi_id';
    protected $fillable = ['mpi_name', 'mpi_description', 'mpi_type'];

    public function masterPeriode()
    {
        return $this->belongsToMany(MasterPeriode::class, 'master_periodeprogram', 'mpi_id', 'mpe_id');
    }

    public function masterPeriodeProgram()
    {
        return $this->hayMany(masterPeriodeProgram::class, 'mpi_id', 'mpi_id');
    }
}
