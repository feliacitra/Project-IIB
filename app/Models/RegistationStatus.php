<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistationStatus extends Model
{
    public $table = "status_regist";
    use HasFactory;

    protected $primaryKey = 'srt_id';

    protected $fillable = [
        'srt_step',
        'srt_status',
        'ms_id',
        ];
}
