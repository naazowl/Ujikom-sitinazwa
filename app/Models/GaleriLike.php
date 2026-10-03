<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriLike extends Model
{
    protected $fillable = ['galeri_id', 'visitor_token'];
}