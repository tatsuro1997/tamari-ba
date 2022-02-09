<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComponentTestController;
use App\Http\Controllers\LifeCycleTestController;
use App\Http\Controllers\User\RoadController;
use App\Http\Controllers\User\BoardController;
use App\Http\Controllers\User\RoadCommentsController;
use App\Http\Controllers\User\BoardCommentsController;
use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\User\BikeController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', [WelcomeController::class, 'welcome']);

Route::resource('bikes', BikeController::class)
    ->middleware('auth:users');

Route::resource('roads', RoadController::class)
    ->middleware('auth:users');

Route::resource('boards', BoardController::class)
->middleware('auth:users');

Route::resource('road.comment', RoadCommentsController::class)
    ->middleware('auth:users')
    ->only(['store', 'destroy']);

Route::resource('board.comment', BoardCommentsController::class)
->middleware('auth:users')
->only(['store', 'destroy']);

Route::prefix('users')
    ->middleware('auth:users')->group(function () {
        Route::get('profile', [UsersController::class, 'Profile'])->name('profile');
        Route::get('{user}/edit', [UsersController::class, 'Edit'])->name('edit');
        Route::put('update/{user}', [UsersController::class, 'Update'])->name('update');
    });

Route::group(['middleware' => ['auth']], function () {
    Route::post('like', [RoadController::class, 'Like'])->name('road.like');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users'])->name('dashboard');

Route::get('/component-test1', [ComponentTestController::class, 'showComponent1']);
Route::get('/component-test2', [ComponentTestController::class, 'showComponent2']);
Route::get('/servicecontainertest', [LifeCycleTestController::class, 'showServiceContainerTest']);
Route::get('/serviceprovidertest', [LifeCycleTestController::class, 'showServiceProviderTest']);


require __DIR__.'/auth.php';
