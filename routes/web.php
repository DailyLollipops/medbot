<?php

use App\Models\User;
use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [MainController::class, 'redirect']);

Route::get('/login/upload', [MainController::class, 'redirectToUploadQRCodePage']);

Route::get('/login/doctor', [MainController::class, 'redirectToDoctorLoginPage']);

Route::get('/login/user', [MainController::class, 'redirectToUserLoginPage']);

Route::get('/about', [MainController::class, 'redirectToAboutPage']);

Route::post('/authenticate/doctor', [LoginController::class, 'authenticateDoctor']);

Route::post('/authenticate/user', [LoginController::class, 'authenticateUser']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [UserController::class, 'redirectToUserDashboard']);

Route::get('/list', [UserController::class, 'redirectToReadingList']);

Route::post('/list/order', [FilterController::class, 'getSelector']);

Route::get('/list/order-by-{filter}-{order}', [FilterController::class, 'order']);

Route::get('/manage', [UserController::class, 'redirectToManagePage']);