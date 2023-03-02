<?php


use App\Http\Controllers\Dashboard\UsersController;
use Illuminate\Support\Facades\Route;

Route::get("/users/all", [UsersController::class, 'getUsersDataTable'])->name('users.all');
Route::patch("/users/update", [UsersController::class, 'update'])->name('users.updates');
Route::get("/users/delete/{id}", [UsersController::class, 'delete'])->name('users.delete');
Route::resource('/users', UsersController::class);
