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
    public function user_can_list_categories(): void
    {
        $this->loginUser();
        $categories = $this->categoryFactory->count(3)
            ->create()
            ->sortBy('title')
            ->map(function($c) {
                $arr = $c->toArray();
                ksort($arr);
                return $arr;
            })
            ->toArray();

        $categoryList = $this->get(route('categories.index'))->assertOk()->json();
        $categoryList = collect($categoryList)
            ->map(function($c) {
                ksort($c);
                return $c;
            })
            ->toArray();

        $this->assertEqualsCanonicalizing($categories, $categoryList);
    }

    /**
     * @test
     * @return void
     */
    public function user_can_create_a_category(): void
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
    public function user_can_update_a_category(): void
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

    /**
     * @test
     * @return void
     */
    public function user_can_delete_a_category(): void
    {
        $this->loginUser();

        $category = $this->categoryFactory->create();

        $this->post(route('categories.delete', ['category' => $category->id]))->assertOk();
        $this->assertDatabaseMissing('categories', $category->toArray());
    }

    /**
     * @test
     * @return void
     */
    public function only_auth_user_can_perform_actions_on_categories(): void
    {
        $categories = $this->categoryFactory->count(3)->create();
        $this->get(route('categories.index'))->assertRedirect(route('login'));


        $params = [
            'title' => $this->faker->sentence(2),
        ];
        $this->post(route('categories.update', ['category' => $categories[0]->id]), $params)
            ->assertRedirect(route('login'));

        $this->post(route('categories.delete', ['category' => $categories[0]->id]))
            ->assertRedirect(route('login'));

    }
}
