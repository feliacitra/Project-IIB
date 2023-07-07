<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMember extends Model
{
    use HasFactory;

    protected $table = "master_members";

    protected $guarded = [
        'mm_id'
    ];

    public function civitas()
    {
        return $this->belongsTo(MasterCivitas::class);
    }

    public function programInkubasi()
    {
        return $this->belongsTo(MasterProgramInkubasi::class);
    }
}
