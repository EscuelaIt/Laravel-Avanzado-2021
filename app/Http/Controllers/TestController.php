<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{
    public function test()
    {
        // $articles = Article::with('tags')->get();
        // $videos = Video::with('tags')->get();
        // $videos = Video::with('tags')->get();

        // $articles = Article::with('tags')->get();

        $video = Cache::remember('random.video', 5, function() {
            return Video::inRandomOrder()->first();
        });

        return view('test')->with([
            'video' => $video,
        ]);
    }
}
