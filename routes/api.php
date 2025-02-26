<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UmpanBalikController;


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

Route::apiResource('admins', AdminController::class);

Route::apiResource('customers', CustomerController::class);

Route::apiResource('umpan_baliks', UmpanBalikController::class);

Route::apiResource('interactions', InteractionController::class);

Route::apiResource('transactions', TransactionController::class);

Route::apiResource('reports', ReportController::class);