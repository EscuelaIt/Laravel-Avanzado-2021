<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
