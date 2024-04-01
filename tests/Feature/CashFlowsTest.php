<?php

namespace Tests\Feature;

use App\Models\CashFlow;
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

    /**
     * @test
     */
    public function user_can_create_a_new_cash_flow(): void
    {
        $this->withoutExceptionHandling();
        $this->loginUser();
        $category = $this->categoryFactory->create();

        $cashFlowParams = $this->cashFlowFactory->raw(['category_id', $category->id]);

        $cashFlow = $this->post(route('cashFlows.store'), $cashFlowParams)->assertOk()->json();

        $this->assertDatabaseHas('cash_flows', $cashFlow);
    }
}
