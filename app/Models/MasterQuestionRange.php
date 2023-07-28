<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterQuestionRange extends Model
{
    use HasFactory;

    protected $table = 'master_questionrange';

    public function question()
    {
        return $this->belongsTo(MasterQuestion::class, 'mq_id', 'mq_id');
    }
}
