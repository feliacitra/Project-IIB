<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUniversitas extends Model
{
  use HasFactory;

  protected $fillable = [
    'mu_name',
    'mu_description'
  ];
}
