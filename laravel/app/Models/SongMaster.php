<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongMaster extends Model
{
    use HasFactory;
    protected $table = 'song_master';
    protected $fillable = ['song_title','song_para'];

}
