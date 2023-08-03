<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterQuestion extends Model
{
    use HasFactory;

    protected $table = 'master_question';
    // protected $primaryKey = 'mq_id';
    protected $fillable = [
        'mq_question',
        'mct_id'
    ];

    public function component()
    {
        return $this->belongsTo(MasterComponent::class, 'mct_id', 'mct_id');
    }

    public function questionRange()
    {
        return $this->hasMany(MasterQuestionRange::class, 'mq_id');
    }

}
