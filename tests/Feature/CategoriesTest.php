<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     * @return void
     */
    public function user_can_create_a_category()
    {
        $this->loginUser();

        $params = $this->categoryFactory->raw();

        $this->post(route('categories.store'), $params)->assertOk();
        $this->assertDatabaseHas('categories', $params);
    }

    /**
     * @test
     * @return void
     */
    public function user_can_update_a_category()
    {
        $this->withoutExceptionHandling();
        $this->loginUser();
        $category = $this->categoryFactory->create();

        $params = [
            'title' => $this->faker->sentence(2),
        ];

        $this->post(route('categories.update', ['category' => $category->id]), $params)->assertOk();
        $this->assertDatabaseHas('categories', [
            'title' => $params['title'],
            'description' => $category->description,
        ]);
    }
}
