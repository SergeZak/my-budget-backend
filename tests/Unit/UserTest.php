<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Collection;
use Tests\TestCase;


class UserTest extends TestCase
{
    /**
     * @test
     */
    public function user_has_many_categories(): void
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(Collection::class, $user->categories);
    }
}
