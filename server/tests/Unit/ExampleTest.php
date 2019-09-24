<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testValidCreate()
    {
        $response = $this->json('POST', 'api/books', ['author' => 'Sally', 'title' => 'A', 'price' => '12.33']);
        $response
            ->assertStatus(201);
    }

    public function testInvalidCreate()
    {
        $response = $this->json('POST', 'api/books', ['author' => 'S', 'title' => 'A', 'price' => '12.33']);
        $response
            ->assertStatus(422);
    }

    public function testValidEdit()
    {
        $response = $this->json('POST', 'api/books', ['author' => 'S', 'title' => 'A', 'price' => '12.33']);
        $response
            ->assertStatus(422);
    }
}
