<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgetpasswordController;
use App\Http\Controllers\ResetpasswordController;
use App\Http\Controllers\PaymentController;
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
    'middleware' => ['DbBackup'],
    'prefix' => 'auth/admin'
], function () {
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/register', [AdminController::class, 'register']);
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::post('/refresh', [AdminController::class, 'refresh']);
    Route::get('/user-profile', [AdminController::class, 'userProfile']);    
});

Route::group([
    'middleware' => ['DbBackup'],
    'prefix' => 'auth/worker'
], function () {
    Route::post('/login', [WorkerController::class, 'login']);
    Route::post('/register', [WorkerController::class, 'register']);
    Route::post('/logout', [WorkerController::class, 'logout']);
    Route::post('/refresh', [WorkerController::class, 'refresh']);
    Route::get('/user-profile', [WorkerController::class, 'userProfile']);    
    Route::post('/email_verification_worker', [EmailVerificationController::class, 'Email_verification_worker']);
    Route::post('/forgetPassword', [ForgetpasswordController::class, 'forgetPassword']);
    Route::post('/Reset_password', [ResetpasswordController::class, 'Reset_password']);
});

Route::group([
    'middleware' => ['DbBackup'],
    'prefix' => 'auth/client'
], function () {
    Route::post('/login', [ClientController::class, 'login']);
    Route::post('/register', [ClientController::class, 'register']);
    Route::post('/logout', [ClientController::class, 'logout']);
    Route::post('/refresh', [ClientController::class, 'refresh']);
    Route::get('/user-profile', [ClientController::class, 'userProfile']);    
    Route::get('/pay', [PaymentController::class, 'payment']);    
});