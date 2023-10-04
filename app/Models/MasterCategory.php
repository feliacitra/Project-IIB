<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCategory extends Model
{
    use HasFactory;

    protected $guarded = [
        'mc_id',
    ];

    public function masterStartup(){
        return $this->hasMany(MasterStartup::class, 'mc_id');
    }
}
