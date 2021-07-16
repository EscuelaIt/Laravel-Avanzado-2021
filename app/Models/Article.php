<?php

namespace App\Models;

use App\Models\Tag;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, Taggable;

    protected $fillable = [
        'title',
        'content',
    ];
}
