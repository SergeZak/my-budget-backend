<?php

use App\Http\Controllers\CashFlowsController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')
    ->name('categories.')
    ->group(function() {
        Route::get('/categories', [CategoriesController::class, 'index'])->name('index');
        Route::post('/categories', [CategoriesController::class, 'store'])->name('store');
        Route::post('/categories/{category}', [CategoriesController::class, 'update'])->name('update');
        Route::post('/categories/{category}/delete', [CategoriesController::class, 'delete'])->name('delete');
    });

Route::middleware('auth:sanctum')
    ->name('cashFlows.')
    ->group(function() {
        Route::get('/cash-flows', [CashFlowsController::class, 'index'])->name('index');
        Route::post('/cash-flows', [CashFlowsController::class, 'store'])->name('store');
        Route::get('/cash-flows/{cashFlow}', [CashFlowsController::class, 'read'])->name('read');
        Route::put('/cash-flows/{cashFlow}', [CashFlowsController::class, 'update'])->name('update');
        Route::delete('/cash-flows/{cashFlow}/delete', [CashFlowsController::class, 'delete'])->name('delete');
    });
