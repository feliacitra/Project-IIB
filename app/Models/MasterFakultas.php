<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class MasterFakultas extends Model
{
    use HasFactory;
    protected $table = 'master_fakultas';
    protected $primaryKey = 'mf_id';
    protected $fillable =[
        'mf_name',
        'mu_id',
        'mf_description',
        'created_at',
        'updated_at',
    ];
    protected $casts =[
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function university(){
        return $this -> belongsTo(MasterUniversitas::class, 'mu_id');
    }
}
