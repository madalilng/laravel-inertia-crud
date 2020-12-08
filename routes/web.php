<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('api/users', [UserController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/user/{user}', [UserController::class, 'show'])->name('user.view');

    Route::post('/user/register', [UserController::class, 'store']);

    Route::delete('/user/{user}', [UserController::class, 'destroy']);

    Route::patch('/user/{user}', [UserController::class, 'update']);
});
