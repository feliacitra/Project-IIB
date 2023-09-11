<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistationAnswer extends Model
{
    public $table = "registation_answer";
    use HasFactory;

    protected $fillable = [
        'ra_score',
        ];
}
