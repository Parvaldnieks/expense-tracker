<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoalController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('expenses', ExpenseController::class);
Route::resource('categories', CategoryController::class);
Route::resource('goals', GoalController::class);

Route::post('/goals/{goal}/assign-expense', [GoalController::class, 'assignExpense'])->name('goals.assignExpense');
