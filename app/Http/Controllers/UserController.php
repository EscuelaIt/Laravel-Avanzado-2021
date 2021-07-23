<?php

namespace App\Http\Controllers;

use App\Events\CustomEvent;
use App\Jobs\LongExecutionJob;
use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use App\Services\MockiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    protected $service;

    public function __construct(MockiService $service)
    {
        // $this->middleware('can:create,' . User::class)
        //     ->only(['create', 'store']);

        // $this->middleware('can:update,' . User::class)
        //     ->only(['create', 'store']);

        $this->middleware('can:update,user')
            ->only(['edit', 'update']);

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

        $job = new LongExecutionJob();

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
        // $this->authorize('create', User::class);

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
        CustomEvent::dispatch();

        $number = mt_rand(1, 100);
        $email = "test{$number}@test.com";

        if ($request->has('email')) {
            $email = $request->email;
        }

        $user = User::factory()->create([
            // 'name',
            'email' => $email,
            // 'password',
            // 'is_admin',
        ]);
        // $this->authorize('create', User::class);

        // $path = $request->file('image')->store('images');
        $extension = $request->file('image')->extension();

        $path = $request->file('image')->storeAs('images', "image.{$extension}");

        // $request->user()->notify(new WelcomeNotification('Welcome'));

        Mail::to('test@test.com')->send(new WelcomeEmail('Test'));

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
        return request()->user()->id .  ' - ' . $user->id;
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
        return $request->user()->id .  ' - ' . $user->id;
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
