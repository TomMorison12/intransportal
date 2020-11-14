<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ManagePhotosTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_upload_a_photo()
    {
        $this->signIn();
        Storage::fake('public');
        $this->json('POST', route('photos.add'), ['photo' => $file = UploadedFile::fake()->image('image.jpg')]);

        Storage::disk('public')->assertExists('photos/'.$file->hashname());
    }
}
