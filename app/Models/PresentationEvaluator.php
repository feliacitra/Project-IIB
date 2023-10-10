<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentationEvaluator extends Model
{
    use HasFactory;

    protected $table = 'presentation_evaluator';
    protected $primaryKey = 'pe_id';

    protected $fillable = [
        'ps_id',
        'user_id',
        'scs_id',
        ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function presentationSchedule()
    {
        return $this->belongsTo(PresentationSchedule::class, 'ps_id', 'ps_id');
    }
    public function startupComponentStatus()
    {
        return $this->belongsTo(startupComponentStatus::class, 'scs_id', 'scs_id');
    }
    
}
