<?php

namespace App\Models;

use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, Taggable;

    protected $fillable = [
        'title',
        'url',
    ];
}
