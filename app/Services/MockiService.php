<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MockiService
{
    protected $url;

    public function __construct($path)
    {
        //d4867d8b-b5d5-4a48-a4ab-79131b5809b8
        $this->url = "https://mocki.io/v1/{$path}";
    }


    public function resolveUsersNames()
    {
        // Http::baseUrl();
        $users = Http::get($this->url)->object();

        return collect($users)->pluck('name');
    }
}
