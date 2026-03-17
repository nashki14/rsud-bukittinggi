<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title','slug','category','image','excerpt','content','is_published'];
    protected $casts = ['is_published' => 'boolean'];
}
