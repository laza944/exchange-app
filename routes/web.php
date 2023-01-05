<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CurrencyController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::get('/confirmation', [CheckoutController::class, 'store'])->name('confirmation');

Route::get('/currency_converter', [CurrencyController::class, 'currencyConverter'])->name('currencyConverter');
Route::get('/checkout_currency', [CurrencyController::class, 'checkoutCurrency'])->name('checkoutCurrency');
Route::post('/confirmation_currency', [CurrencyController::class, 'confirmationCurrency'])->name('confirmationCurrency');




