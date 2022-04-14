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
use App\Http\Controllers\User\BikeCommentsController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\InquiryController;

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

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::resource('bikes', BikeController::class)
    ->middleware('auth:users')
    ->except(['index', 'show']);
Route::get('bikes', [BikeController::class, 'index'])->name('bikes.index');
Route::get('bikes/{bike}', [BikeController::class, 'show'])->name('bikes.show');

Route::resource('roads', RoadController::class)
    ->middleware('auth:users')
    ->except(['index', 'show']);
Route::get('roads', [RoadController::class, 'index'])->name('roads.index');
Route::get('roads/{road}', [RoadController::class, 'show'])->name('roads.show');

Route::resource('boards', BoardController::class)
    ->middleware('auth:users')
    ->except(['index', 'show']);
Route::get('boards', [BoardController::class, 'index'])->name('boards.index');
Route::get('boards/{board}', [BoardController::class, 'show'])->name('boards.show');

Route::resource('bike.comment', BikeCommentsController::class)
    ->middleware('auth:users')
    ->only(['store', 'destroy']);

Route::resource('road.comment', RoadCommentsController::class)
    ->middleware('auth:users')
    ->only(['store', 'destroy']);

Route::resource('board.comment', BoardCommentsController::class)
->middleware('auth:users')
->only(['store', 'destroy']);

Route::prefix('users')
    ->middleware('auth:users')->group(function () {
        Route::get('profile/{user:uid}', [UsersController::class, 'Profile'])->name('profile');
        Route::get('{user:uid}/edit', [UsersController::class, 'Edit'])->name('edit');
        Route::put('update/{user:uid}', [UsersController::class, 'Update'])->name('update');
    });

Route::group(['middleware' => ['auth']], function () {
    Route::post('road_like', [RoadController::class, 'Like'])->name('road.like');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('bike_like', [BikeController::class, 'Like'])->name('bike.like');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth:users'])->name('dashboard');

Route::get('/inquiry', [InquiryController::class, 'Inquiry'])->name('inquiry');
Route::post('/send_inquiry', [InquiryController::class, 'Send_Inquiry'])->name('send.inquiry');

Route::get('/terms_of_service', [WelcomeController::class, 'Terms_Of_Service'])->name('terms_of_service');
Route::get('/privacy_policy', [WelcomeController::class, 'Privacy_Policy'])->name('privacy_policy');
Route::post('/roads_import', [RoadController::class, 'import'])->name('import');


require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

# v2
Route::get('v2/welcome', [WelcomeController::class, 'v2_welcome'])->name('v2_welcome');
