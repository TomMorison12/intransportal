<?php

namespace tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use tests\TestCase;

class AddAvatarTest extends TestCase
{
    use DatabaseMigrations;

    public function test_only_members_can_add_avatars()
    {
        $this->json('POST', page_url(null, '/api/users/1/avatar'))->assertStatus(401);
    }

    public function test_a_valid_avatar_must_be_provided()
    {
        $this->withExceptionHandling()->signIn();

        $this->json('POST', page_url(null, '/api/users/'.auth()->id().'/avatar'),
            ['avatar' => 'not-an-image'])->assertStatus(422);
    }

    public function test_a_user_may_add_an_avatar_to_their_profile()
    {
        $this->signIn();
        Storage::fake('public');

        $this->json('POST', page_url(null, '/api/users/'.auth()->id().'/avatar'),
            ['avatar' => $file = UploadedFile::fake()->image('avatar.jpg')]);

        $this->assertEquals('avatars/'.$file->hashname(), auth()->user()->avatar_path);
        Storage::disk('public')->assertExists('avatars/'.$file->hashname());
    }
}
