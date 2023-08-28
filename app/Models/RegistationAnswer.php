<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistationAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'ra_score',
        'mqr_score',
        'mq_score',
        ];
}
