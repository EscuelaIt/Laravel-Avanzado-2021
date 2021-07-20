<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::factory(50)->create()->pluck('id')->toArray();

        $videos = Video::factory(10)->create();
        $articles = Article::factory(10)->create();


        $videos->each(function($video) use ($tags) {
            $tagsIds = Arr::random($tags, mt_rand(5, 10));

            $video->tags()->attach($tagsIds);
        });

        $articles->each(function($article) use ($tags) {
            $tagsIds = Arr::random($tags, mt_rand(5, 10));

            $article->tags()->attach($tagsIds);
        });
    }
}
