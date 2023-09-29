<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMember extends Model
{
    use HasFactory;

    protected $guarded = [
        'mm_id'
    ];

    public function civitas()
    {
        return $this->belongsTo(MasterCivitas::class, 'mci_id', 'mci_id');
    }

    public function universitas(){
        return $this->belongsTo(MasterUniversitas::class, 'mu_id', 'mu_id');
    }

    public function fakultas(){
        return $this->belongsTo(MasterFakultas::class, 'mf_id', 'mf_id');
    }

    public function prodi(){
        return $this->belongsTo(MasterProgramStudy::class, 'mps_id', 'mps_id');
    }

}
