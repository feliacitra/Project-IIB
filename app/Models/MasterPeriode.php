<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPeriode extends Model
{
    use HasFactory;

    protected $guarded = [
        'mpe_id',
    ];

    protected $table = 'master_periode';
}
