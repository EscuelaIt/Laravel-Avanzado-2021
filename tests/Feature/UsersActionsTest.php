<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\MockiService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UsersActionsTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_authenticated_user_can_see_users_and_dispatch_job()
    {
        $user = User::factory()->create();

        $mock = $this->mock(MockiService::class);

        $mock->shouldReceive('resolveUsersNames')
            ->andReturn(collect(['Juan', 'Pepe']));

        $response = $this->actingAs($user)->get('/users');

        $response->assertStatus(200);
        $response->assertSee('Juan');
        $response->assertSee('Pepe');
    }

    public function test_can_create_a_user()
    {
        $user = User::factory()->create();

        $disk = config('filesystems.default');

        Storage::fake($disk);

        $file = UploadedFile::fake()->image('testing.png');

        $response = $this->actingAs($user)->post('/users', ['image' => $file]);

        Storage::disk($disk)->assertExists(storage_path('app/images/image.png'));

        $response->assertStatus(200);
        // $response->assertStatus(asset($file->path));
    }
}
