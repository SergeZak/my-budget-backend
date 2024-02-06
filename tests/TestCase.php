<?php

namespace Tests;

use App\Models\User;
use Database\Factories\CategoryFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected CategoryFactory $categoryFactory;

    public function setUp(): void
    {
        parent::setUp();
        $this->categoryFactory = new CategoryFactory();
    }

    /**
     * @param int|null $userId
     * @return User
     */
    public function loginUser(?int $userId = null): User
    {
        if ($userId) {
            $user = User::find($userId);
        } else {
            $user = $this->createUser();
        }

        $this->actingAs($user);

        return $user;
    }

    private function createUser()
    {
        return User::factory()->create();
    }
}
