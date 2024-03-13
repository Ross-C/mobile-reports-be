<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HireReport\HireReportController;
use App\Http\Controllers\SpendingReport\SpendingReportController;
use App\Http\Controllers\PIReport\PIReportController;
use App\Http\Controllers\RecoveryReport\RecoveryReportController;
use App\Http\Controllers\RepairReport\RepairReportController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
    
    Route::post('/socialLogin', [AuthController::class, 'socialLogin']);

    Route::get('/google', [AuthController::class, 'redirectToGoogleLogin']);
    Route::get('/google/login/callback', [AuthController::class, 'handleGoogleLoginCallback']);
    Route::get('/google/register/employer', [AuthController::class, 'redirectToGoogleRegisterEmployer']);
    Route::get('/google/register', [AuthController::class, 'redirectToGoogleRegisterStaff']);
    Route::get('/google/register/employer/callback', [AuthController::class, 'handleGoogleRegisterEmployerCallback']);
    Route::get('/google/register/callback', [AuthController::class, 'handleGoogleRegisterStaffCallback']);
    Route::get('/disconnectGoogle', [AuthController::class, 'disconnectGoogle']);

    Route::get('/facebook', [AuthController::class, 'redirectToFacebook']);
    Route::get('/facebook/callback', [AuthController::class, 'handleFacebookCallback']);
    Route::get('/disconnectFacebook', [AuthController::class, 'disconnectFacebook']);
});


Route::group(['namespace' => 'HireReport'], function() {
    //table with pagination
    Route::post('/hireReport/hireSent', [HireReportController::class, 'hireSent']);  
    Route::post('/hireReport/fetch', [HireReportController::class, 'fetch']);  
});

Route::group(['namespace' => 'SpendingReport'], function() {
    //table with pagination
    Route::post('/spendingReport/hireSent', [SpendingReportController::class, 'hireSent']);  
    Route::post('/spendingReport/hireAccepted', [SpendingReportController::class, 'hireAccepted']);  
    Route::post('/spendingReport/advertSpend', [SpendingReportController::class, 'advertSpend']);
});

Route::group(['namespace' => 'PIReport'], function() {
    //table with pagination
    Route::post('/piReport/piSent', [PIReportController::class, 'piSent']);  
    Route::post('/piReport/fetch', [PIReportController::class, 'fetch']);  
});

Route::group(['namespace' => 'RecoveryReport'], function() {
    //table with pagination
    Route::post('/recoveryReport/recoverySent', [RecoveryReportController::class, 'recoverySent']);  
    Route::post('/recoveryReport/fetch', [RecoveryReportController::class, 'fetch']);  
});

Route::group(['namespace' => 'RepairReport'], function() {
    //table with pagination
    Route::post('/repairReport/repairSent', [RepairReportController::class, 'repairSent']);  
    Route::post('/repairReport/fetch', [RepairReportController::class, 'fetch']);  
});