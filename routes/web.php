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
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ReportController;

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

Route::get('/login/user/upload', [MainController::class, 'redirectToUploadQRCodePage']);

Route::get('/login/doctor', [MainController::class, 'redirectToDoctorLoginPage']);

Route::get('/login/user', [MainController::class, 'redirectToUserLoginPage']);

Route::get('/about', [MainController::class, 'redirectToAboutPage']);

Route::post('/authenticate/doctor', [LoginController::class, 'authenticateDoctor']);

Route::post('/authenticate/user', [LoginController::class, 'authenticateUser']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard/user', [UserController::class, 'redirectToUserDashboard']);

Route::get('/readinglist', [UserController::class, 'redirectToReadingList']);

Route::post('/readinglist/order', [FilterController::class, 'getReadingSelector']);

Route::get('/readinglist/order-by-{filter}-{order}', [FilterController::class, 'orderReading']);

Route::get('/manage', [UserController::class, 'redirectToManagePage']);

Route::post('/manage/export', [ReportController::class, 'exportCsv']);

Route::post('/manage/generate', [ReportController::class, 'generateReport']);

Route::get('/manage/update', [UserController::class, 'redirectToUpdateInformationPage']);

Route::post('/manage/update/profile_picture', [UserController::class, 'updateProfilePicture']);

Route::post('/manage/update/info', [UserController::class, 'updateInfo']);

Route::post('/manage/update/password', [UserController::class, 'updatePassword']);

Route::get('/manage/update/password/download', [UserController::class, 'redirectToQRCodeDownloadPage']);

Route::get('/manage/update/password/download/{path}', [ReportController::class, 'generateQRCode']);

Route::get('/dashboard/doctor', [DoctorController::class, 'redirectToDoctorDashboard']);

Route::get('/userlist', [DoctorController::class, 'redirectToUserList']);

Route::post('/userlist/order', [FilterController::class, 'getUserSelector']);

Route::get('/userlist/order-by-{filter}-{order}', [FilterController::class, 'orderUser']);