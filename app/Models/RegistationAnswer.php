<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistationAnswer extends Model
{
    public $table = "registation_answer";
    use HasFactory;

    protected $primaryKey = 'ra_id';

    protected $fillable = [
        'mq_id',
        'mqr_id',
        'user_id',
        'ra_score',
        'scs_id',
        ];

    public function startupComponentStatus(){
        return $this->belongsTo(StartupComponentStatus::class, 'scs_id', 'scs_id');
    }
    
}
