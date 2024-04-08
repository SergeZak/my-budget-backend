<?php

namespace App\Http\Controllers;

use App\Models\CashFlow;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashFlowsController extends Controller
{
    public function index(): JsonResponse
    {
        $cashFlows = Auth::user()->cashFlows()->get();

        return response()->json($cashFlows);
    }

    public function store(Request $request)
    {
        $cashFlow = Auth::user()->cashFlows()->create($request->all());

        return response()->json($cashFlow);
    }

    public function update(CashFlow $cashFlow, Request $request): JsonResponse
    {
        if (Auth::user()->id !== $cashFlow->user_id) {
            abort(403);
        }

        $cashFlow->update($request->all());

        return response()->json($cashFlow);
    }

    public function delete(CashFlow $cashFlow): JsonResponse
    {
        if (Auth::user()->id !== $cashFlow->user_id) {
            abort(403);
        }

        $cashFlow->delete();

        return response()->json(['success' => 'ok']);
    }
}
