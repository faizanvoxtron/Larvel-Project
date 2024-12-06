<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    ApiTokenController,
    UserController,
    FamilyMemberController,
    MedicalRecordController,
    ReviewController,
    ClinicController,
    SubscriptionController,
    AppointmentController,
    ArticleController,
    HealthScanController,
    PageController,
    PaymentController,
    SettingController,
    InstantConsultationController,
    ApiGeneralController,
    CronJobController,

    AddressController,
};
use App\Http\Common\{ResponseHelper};

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

Route::post('/get/token', [ApiTokenController::class, 'getToken']);

Route::post('/get-users', [UserController::class, 'getUsers']);
// AUTH ROUTES
Route::group(['middleware' => 'api_auth'], function () {});
