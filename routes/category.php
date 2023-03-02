<?php


use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get("/categories/all", [CategoriesController::class, 'getUsersDataTable'])->name('categories.all');
Route::post("/categories/store", [CategoriesController::class, 'store'])->name('categories.store');
Route::patch("/categories/update", [CategoriesController::class, 'update'])->name('categories.update');
Route::get("/categories/delete/{id}", [CategoriesController::class, 'destroy'])->name('categories.delete');

