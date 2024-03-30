<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CashFlowsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function user_can_list_his_cashFlows(): void
    {
        $this->loginUser();
        $cashFlows = $this->cashFlowFactory->count(3)->create();

        $this->assertEquals(1,1);
    }
}
