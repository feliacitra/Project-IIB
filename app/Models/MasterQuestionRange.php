<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterQuestionRange extends Model
{
    use HasFactory;

    protected $table = 'master_questionrange';
    protected $primaryKey = 'mqr_id';

    protected $fillable = [
        'mqr_description',
        'mqr_poin',
        'mq_id'
    ];

    protected $attributes = [
        'mqr_poin' => 0,
    ];

    public function question()
    {
        return $this->belongsTo(MasterQuestion::class, 'mq_id');
    }
}
