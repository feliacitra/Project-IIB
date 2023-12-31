<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCivitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'mci_name',
        'mci_description',
    ];

    public function member() {
        return $this->hasMany(MasterMember::class);
    }
}
