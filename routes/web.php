<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;

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

Route::get('/', [MainController::class, 'redirectToIndexPage']);

Route::get('/login/upload', [MainController::class, 'redirectToUploadQRCodePage']);

Route::get('/login/doctor', [MainController::class, 'redirectToDoctorLoginPage']);

Route::get('/login/user', [MainController::class, 'redirectToUserLoginPage']);

Route::get('/about', [MainController::class, 'redirectToAboutPage']);

Route::post('/authenticate/doctor', [UserController::class, 'authenticateDoctor']);

Route::post('/authenticate/user', [UserController::class, 'authenticateUser']);

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/test', function(){
    return view('auth.userpage');
});