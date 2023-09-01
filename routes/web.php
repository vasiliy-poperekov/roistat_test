<?php

use App\Http\Controllers\RedicrectController;
use App\Http\Controllers\LeadFormController;
use App\Http\Controllers\SaveUserController;
use App\Http\Controllers\SendLeadController;
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

Route::get('/', [RedicrectController::class, 'redirectToAuth']);

Route::get('/auth', [SaveUserController::class, 'save']);

Route::post('/send', [SendLeadController::class, 'sendLead']);

Route::get('/form', [LeadFormController::class, 'showForm']);
