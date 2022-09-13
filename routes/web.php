<?php

use App\Models\User;
use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\FilterController;

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

Route::get('/', [UserController::class, 'redirect']);

Route::get('/login/upload', [MainController::class, 'redirectToUploadQRCodePage']);

Route::get('/login/doctor', [MainController::class, 'redirectToDoctorLoginPage']);

Route::get('/login/user', [MainController::class, 'redirectToUserLoginPage']);

Route::get('/about', [MainController::class, 'redirectToAboutPage']);

Route::post('/authenticate/doctor', [UserController::class, 'authenticateDoctor']);

Route::post('/authenticate/user', [UserController::class, 'authenticateUser']);

Route::get('/logout', [UserController::class, 'logout']);

Route::post('/list/order', [FilterController::class, 'getSelector']);

Route::get('/list/order-by-{filter}-{order}', [FilterController::class, 'order']);

Route::get('/list', [UserController::class, 'showReadingList']);

Route::get('/dashboard', [ChartController::class, 'renderCharts']);