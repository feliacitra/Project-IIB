<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationAnswer extends Model
{
    use HasFactory;

    protected $table = 'registration_answers';
    protected $primaryKey = 'ra_id';
    public $timestamps = false;

    protected $fillable = [
        'mqr_id',
        'mq_id',
        'user_id',
        'ra_score',
    ];

    public function masterQuestionRange()
    {
        return $this->belongsTo(MasterQuestionRange::class, 'mqr_id');
    }

    public function masterQuestion()
    {
        return $this->belongsTo(MasterQuestion::class, 'mq_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}