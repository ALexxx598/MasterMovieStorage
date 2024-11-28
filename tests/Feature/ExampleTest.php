<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        Firebase::storage()
            ->getBucket()
            ->upload(UploadedFile::fake()->image('test.png')->getContent(), ['name' => 'test.png']);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
