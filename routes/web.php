<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\User\Link\DeactivateLinkController;
use App\Http\Controllers\User\Link\LinkController;
use App\Http\Controllers\User\Link\RegenerateLinkController;
use App\Http\Controllers\User\Lottery\LotteryController;
use App\Http\Controllers\User\Lottery\PlayLotteryGameController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegisteredUserController::class, 'create']);

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/logout', [SessionsController::class, 'destroy'])->name('logout');

Route::get('/login', [SessionsController::class, 'create'])->name('login');
Route::post('/login', [SessionsController::class, 'store']);

Route::middleware('auth')->group(function () {
    // Links
    Route::get('/user/link', [LinkController::class, 'index'])->name('user.links');
    Route::patch('/user/link/regenerate', RegenerateLinkController::class)->name('user.link.regenerate');
    Route::patch('/user/link/deactivate', DeactivateLinkController::class)->name('user.link.deactivate');

    // Lotteries
    Route::get('/user/lottery/{token}', [LotteryController::class, 'show'])->name('user.lottery.show');
    Route::post('/user/lottery/{token}/play', PlayLotteryGameController::class)->name('user.lottery.play');
});
