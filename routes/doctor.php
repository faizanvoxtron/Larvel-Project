<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    DoctorController,
    UserController,
    AppointmentController,
    BankDetailController,
    ClinicController,
};
use App\Http\Common\{ResponseHelper};

    // Routes for Doctors
    Route::prefix('doctor')->group(function(){
        Route::get('listing', [DoctorController::class, 'getDoctors']);
        Route::post('/registration', [UserController::class, 'doctorRegistration']);
        Route::post('/login', [UserController::class, 'doctorLogin']);
        Route::post('/update', [UserController::class, 'updateDoctor']);
        Route::get('/service/delete/{id}', [UserController::class, 'deleteService']);
        Route::get('/education/delete/{id}', [UserController::class, 'deleteEducation']);
        Route::post('/forgot/password', [UserController::class, 'forgotPasswordMail']);
        Route::post('/forgot/password/otp', [UserController::class, 'forgotPassword']);
        Route::post('/password/reset', [UserController::class, 'resetPassword']);
        Route::post('/password/update', [UserController::class, 'updatePassword']);
        Route::get('/earning', [DoctorController::class, 'getEarning']);
        Route::prefix('appointment')->group(function(){
            Route::get('/dashboard', [AppointmentController::class, 'dashboard']);
            Route::get('/{appointmentId}', [AppointmentController::class, 'getAppointment']);
            Route::post('/details/add/{appointment}', [AppointmentController::class, 'addAppointmentDetails']);
        });
        Route::get('/availability', [DoctorController::class, 'updateAvailablity']);
        Route::get('/clinic-listing', [DoctorController::class, 'clinicListing']);
        Route::get('/clinic-status/{clinicId}', [ClinicController::class, 'updateStatus']);
        Route::delete('/clinic-delete/{clinicId}', [ClinicController::class, 'deleteClinic']);
    });

    // Routes for Clinic Routes
    Route::prefix('clinic-record')->group(function(){
        Route::post('/{id?}', [ClinicController::class, 'createClinic']);
    });
    
    // Routes for Doctor's bank details
    Route::prefix('bank-detail')->group(function(){
        Route::post('/', [BankDetailController::class, 'createBankdetail']);
        Route::get('/', [BankDetailController::class, 'getBankDetail']);
    });