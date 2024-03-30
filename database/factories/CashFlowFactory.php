<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CashFlow>
 */
class CashFlowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = Auth::user() ? Auth::user() : User::factory()->create();
        $category = Category::where('user_id', $user->id)->first() ?? (new CategoryFactory())->create(['user_id' => $user->id]);

        return [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'name' => $this->faker->sentence(3),
            'amount' => rand(1, 1000),
            'note'  => $this->faker->sentence(),
        ];
    }
}
