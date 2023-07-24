<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUniversitas extends Model
{
    use HasFactory;
    protected $primaryKey = 'mu_id';

    protected $fillable = [
    'mu_name',
    'mu_description'
    ];

    public function faculties()
    {
      return $this->hasMany(MasterFakultas::class, 'mu_id', 'mu_id');
    }
}
