<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;


Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function($router) {
    Route::post('me', [AuthController::class, 'me']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('get-customers', [CustomerController::class, 'getCustomers']);
    Route::get('edit-customer/{customerId}', [CustomerController::class, 'editCustomer']);
    Route::post('create-customer', [CustomerController::class, 'createCustomer']);
    Route::put('update-customer', [CustomerController::class, 'updateCustomer']);
    Route::delete('delete-customer/{customerId}', [CustomerController::class, 'deleteCustomer']);
});