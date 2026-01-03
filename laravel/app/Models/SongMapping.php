<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongMapping extends Model
{
    use HasFactory;
    protected $table = 'song_mapping';
    protected $fillable = ['song_id','song_category_id','song_language_id','created_at','updated_at'];

}
