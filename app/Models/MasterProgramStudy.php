<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProgramStudy extends Model
{
    use HasFactory;

    protected $table = 'master_programstudy';
    protected $fillable = ['mps_name', 'mps_description', 'mf_id'];

    public function faculty()
    {
        return $this->belongsTo(MasterFakultas::class, 'mf_id', 'mf_id');
    }
}
