<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';

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

    protected $primaryKey = 'ud_id';

    protected $dates = [
        'ud_birthday'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'ud_birthday' => 'datetime'
    ];

    protected static function booted() {
        static::creating(function($model) {
            $model->ud_photo = asset('back/images/logo/user.png');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
