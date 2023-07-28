<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterQuestion extends Model
{
    use HasFactory;

    protected $table = 'master_question';
    protected $fillable = [
        'mq_question'
    ];

    public function component()
    {
        $this->belongsTo(MasterComponent::class, 'mct_id', 'mct_id');
    }

    public function questionRange()
    {
        $this->hasMany(MasterQuestionRange::class, 'mq_id', 'mq_id');
    }

}
