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

Route::get('/login/user/scan', [MainController::class, 'redirectToScanQRCodePage']);

Route::get('/login/doctor', [MainController::class, 'redirectToDoctorLoginPage']);

Route::get('/login/user', [MainController::class, 'redirectToUserLoginPage']);

Route::get('/about', [MainController::class, 'redirectToAboutPage']);

Route::post('/authenticate/doctor', [LoginController::class, 'authenticateDoctor']);

Route::post('/authenticate/user/upload', [LoginController::class, 'authenticateUserByUpload']);

Route::post('/authenticate/user/scan', [LoginController::class, 'authenticateUserByScan']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard/user', [UserController::class, 'redirectToUserDashboard']);

Route::get('/readinglist', [UserController::class, 'redirectToReadingListPage']);

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

Route::get('/dashboard/doctor', [UserController::class, 'redirectToDoctorDashboard']);

Route::get('/userlist', [UserController::class, 'redirectToUserListPage']);

Route::post('/userlist/order', [FilterController::class, 'getUserSelector']);

Route::get('/userlist/order-by-{filter}-{order}', [FilterController::class, 'orderUser']);

Route::get('/userlist/id-{user_id}', [UserController::class, 'redirectToUserInfoPage']);

Route::get('/userlist/id-{user_id}/report', [UserController::class, 'redirectToUserReportPage']);

Route::get('/update', [UserController::class, 'redirectToUpdateInformationPage']);

Route::post('/update/profile_picture', [UserController::class, 'updateProfilePicture']);

Route::post('/update/info', [UserController::class, 'updateInfo']);

Route::post('/update/password', [UserController::class, 'updatePassword']);