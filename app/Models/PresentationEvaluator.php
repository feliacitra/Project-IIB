<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentationEvaluator extends Model
{
    use HasFactory;

    protected $table = 'presentation_schedules';
    protected $primaryKey = 'mu_id';

    protected $fillable = [
        'ps_id',
        'user_id',
        'ra_id',
        ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function presentationSchedule()
    {
        return $this->belongsTo(PresentationSchedule::class, 'ps_id', 'ps_id');
    }
    public function registationAnswer()
    {
        return $this->belongsTo(RegistationAnswer::class, 'ra_id', 'ra_id');
    }
    
}
