<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Collection;
use Tests\TestCase;

class CashFlowTest extends TestCase
{
    /**
     * @test
     */
    public function test_example(): void
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(Collection::class, $user->cashFlows);
    }
}
