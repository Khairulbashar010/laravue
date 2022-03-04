<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;


Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('me', [AuthController::class, 'me']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('get-customers', [UserController::class, 'getCustomers']);
    Route::get('edit-customer/{customerId}', [UserController::class, 'editCustomer']);
    Route::post('create-customer', [UserController::class, 'createCustomer']);
    Route::put('update-customer', [UserController::class, 'updateCustomer']);
    Route::delete('delete-customer/{customerId}', [UserController::class, 'deleteCustomer']);
    Route::post('add-bill', [UserController::class, 'addBill']);
    Route::put('update-bill', [UserController::class, 'updateBill']);

    Route::get('view-bill', [CustomerController::class, 'viewBill']);
});