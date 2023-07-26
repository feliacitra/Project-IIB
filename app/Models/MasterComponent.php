<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'mct_id',
        'mct_step',
    ];

    public function periode() {
        return $this->belongsTo(MasterPeriode::class, 'mpd_id', 'mpd_id');
    }
}
