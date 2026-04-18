<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackgroundImage extends Model
{
    protected $table = 'background_images';
    protected $fillable = ['image_path', 'is_active'];
}
