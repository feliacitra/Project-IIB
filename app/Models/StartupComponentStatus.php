<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartupComponentStatus extends Model
{
    public $table = "startup_componentstatus";
    use HasFactory;

    protected $primaryKey = 'scs_id';

    protected $fillable = [
        'scs_notes',
        'ms_id',
        'scs_totalscore',
        ];

    public function registationAnswer(){
        return $this->hasMany(RegistationAnswer::class, 'scs_id', 'scs_id');
    }
}
