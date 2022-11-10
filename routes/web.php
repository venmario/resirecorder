<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MerchantController;
use App\Models\Merchant;
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

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/dashboard', function () {
    $merchant = Merchant::all();
    return view('dashboard',compact('merchant'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('admin')->group(function(){
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');
    Route::resource('admin',AdminController::class);
    Route::resource('merchant', MerchantController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/logs/{min?}/{max?}/{merchant?}',[LogController::class,'index'])->name('logs.index');
    Route::post('/logs/',[LogController::class,'store'])->name('logs.store');
});

require __DIR__.'/auth.php';
