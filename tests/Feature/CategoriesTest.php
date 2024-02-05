<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function user_can_create_a_category()
    {
        $this->loginUser();

        $params = [
            'title' => 'fake title',
            'description' => 'fake description',
        ];

        $this->post(route('categories.store'), $params)->assertOk();
        $this->assertDatabaseHas('categories', $params);
    }
}
