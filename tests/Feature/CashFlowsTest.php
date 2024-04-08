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

    /**
     * @test
     * @return void
     */
    public function user_can_update_a_cash_flow(): void
    {
        $this->loginUser();

        $cashFlow = $this->cashFlowFactory->create();

        $amount = $this->faker->randomFloat(nbMaxDecimals: 2, min: 10, max: 1000);

        $params = [
            'amount' => $amount,
        ];

        $this->post(route('cashFlows.update', ['cashFlow' => $cashFlow->id]), $params)->assertOk();
        $this->assertDatabaseHas('cash_flows', [
            'amount' => $amount,
            'name' => $cashFlow->name,
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function user_can_delete_a_cash_flow(): void
    {
        $this->withoutExceptionHandling();
        $this->loginUser();

        $cashFlow = $this->cashFlowFactory->create();

        $this->post(route('cashFlows.delete', ['cashFlow' => $cashFlow->id]))->assertOk();
        $this->assertDatabaseMissing('cash_flows', $cashFlow->toArray());
    }
}
