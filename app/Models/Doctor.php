<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name','specialty','photo','schedule','education','sip','bio','is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
