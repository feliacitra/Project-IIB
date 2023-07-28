<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPeriodeProgram extends Model
{
    use HasFactory;

    protected $table = 'master_periodeprogram';

    public function component()
    {
        return $this->hasMany(MasterComponent::class, 'mpd_id', 'mpd_id');
    }

}
