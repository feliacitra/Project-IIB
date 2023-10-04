<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryStartup extends Model
{
    use HasFactory;

    protected $table = "history_startup";
    protected $primaryKey = 'hs_id';
    protected $fillable = ['ms_id', 'mpd_id'];

    public function masterStartup(){
        return $this->belongsTo(MasterStartup::class,'ms_id', 'ms_id');
    }
}
