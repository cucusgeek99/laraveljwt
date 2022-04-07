<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\BinanceApi;
use App\Http\Controllers\UserController;
use App\Http\Controllers\paymentMethodController;
use App\Http\Controllers\HistoricalController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',

], function ($router) {
    Route::resource('cryptos', CryptoController::class);

    Route::resource('transactions', TransactionController::class);

    Route::resource('wallets', WalletController::class);

    Route::resource('users', UserController::class);

    Route::resource('paymentmethod', paymentMethodController::class);
    Route::resource('annonces', AnnonceController::class);
    Route::get('getannones', [AnnonceController::class]);




    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']); 
    Route::get('/annoncebycrypto/{sigle}', [AnnonceController::class, 'annoncebycrypto']);
    Route::get('/userAllTransactions', [TransactionController::class, 'getUserAllTransac']);
    Route::get('/userwallets', [WalletController::class, 'getUserWallet']);
    Route::post('/makeCryptoDeposit', [HistoricalController::class, 'MakeCryptoDeposit']);




   
});


