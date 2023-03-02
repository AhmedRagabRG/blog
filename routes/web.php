<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect(route('dashboard.dashboard'));
});

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'user_role']], function () {
    Route::get('/', function () {
        return view('dashboard.pages.home');
    })->name('dashboard');

    Route::get('/settings', function () {
        return view('dashboard.pages.settings');
    })->name('settings');

    Route::post("/settings/update/{setting}", [SettingsController::class, 'update'])->name('settings.update');

    require __DIR__.'/user.php';

    require __DIR__.'/category.php';
});

require __DIR__.'/auth.php';
