<?php

namespace App\Http\Controllers;

use App\Models\CashFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashFlowsController extends Controller
{
    public function index()
    {
        $cashFlows = Auth::user()->cashFlows()->get();

        return response()->json($cashFlows);
    }

    public function store(Request $request)
    {
        $cashFlow = Auth::user()->cashFlows()->create($request->all());

        return response()->json($cashFlow);
    }

    public function update(CashFlow $cashFlow, Request $request)
    {
        if (Auth::user()->id !== $cashFlow->user_id) {
            abort(403);
        }

        $cashFlow->update($request->all());

        return response()->json($cashFlow);
    }
}
