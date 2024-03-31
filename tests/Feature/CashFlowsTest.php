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
        $this->cashFlowFactory->count(10)->create();
        $this->loginUser();
        $this->cashFlowFactory->count(3)->create();

        $cashFlows = $this->get(route('cashFlows.index'))->assertOk()->json();

        $this->assertCount(3, $cashFlows);
    }
}
