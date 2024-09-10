<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanDetailsController;

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


Auth::routes();

/**
 * Routes related to loan details and EMI processing
 */

Route::get('/', [LoanDetailsController::class, 'index'])
	->name('loan-details-home');

Route::get('/loan-details', [LoanDetailsController::class, 'index'])
	->name('loan-details.index');

Route::get('/process-emi', [LoanDetailsController::class, 'processEMI'])
	->name('process-emi');
	
Route::get('/emi-details', [LoanDetailsController::class, 'showEMI'])
	->name('emi-details');