<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManagePhotosTest extends TestCase
{
    use DatabaseMigrations;

    function test_a_user_can_upload_a_photo()
    {
        $this->signIn();
        Storage::fake('public');
        $this->json("POST", route('photos.add'), ['photo' => $file = UploadedFile::fake()->image('image.jpg')]);


        Storage::disk('public')->assertExists('photos/' . $file->hashname());
    }

}
