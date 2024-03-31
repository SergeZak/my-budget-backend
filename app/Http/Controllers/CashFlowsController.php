<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashFlowsController extends Controller
{
    public function index()
    {
        $cashFlows = Auth::user()->cashFlows()->get();

        return response()->json($cashFlows);
    }
}
