<?php

namespace App\Http\Controllers;

use App\Jobs\LongExecutionJob;
use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Services\MockiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    protected $service;

    public function __construct(MockiService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersNames = $this->service->resolveUsersNames();

        $job = new LongExecutionJob($user);

        $job::dispatch()->onQueue('random');
        // $job::dispatchSync();
        // $job::dispatchAfterResponse();

        return view('users.index')->with([
            'usersNames' => $usersNames,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $path = $request->file('image')->store('images');
        $extension = $request->file('image')->extension();

        $path = $request->file('image')->storeAs('images', "image.{$extension}");

        Mail::to('test@test.com')->send(new WelcomeEmail('Pepe'));

        return asset($path);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
