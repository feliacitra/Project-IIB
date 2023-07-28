<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProgramInkubasi extends Model
{
    use HasFactory;

    protected $table = "master_programinkubasi";
    protected $fillable = ['mpi_name', 'mpi_description', 'mpi_type'];

    public function masterPeriode()
    {
        return $this->belongsToMany(MasterPeriode::class);
    }
}
