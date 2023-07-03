<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Feature extends Model
{
    use HasFactory;

    protected $table = 'feature';

    protected $fillable = ['name'];

    /**
     * The roles that belong to the Feature
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_feature', 'role_id', 'feature_id');
    }
}
