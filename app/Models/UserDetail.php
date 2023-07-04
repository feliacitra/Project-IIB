<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ud_photo',
        'ud_address',
        'ud_gender',
        'ud_phone',
        'ud_birthday',
        'ud_placeofbirth',
        'ud_accountnumber',
        'ud_bank',
        'ud_lasteducation',
        'ud_university',
        'ud_programstudy',
        'ud_faculty',
    ];

    protected $primaryKey = [
        'ud_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
