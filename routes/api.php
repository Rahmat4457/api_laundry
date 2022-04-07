<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiController;

Route::post('login', [UserController::class, 'login']);
Route::post('transaksi/report', [TransaksiController::class, 'report']);

Route::group(['middleware' => ['jwt.verify:admin,kasir,owner']], function(){
    Route::get('login/check', [UserController::class,'loginCheck']);
    Route::post('logout', [UserController::class,'logout']);
    Route::get('outlet', [OutletController::class, 'getAll']);
    Route::get('outlet/{id_outlet}', [OutletController::class, 'getById']);
    
});

Route::group(['middleware'=>['jwt.verify:admin']], function(){

    

    Route::post('user', [UserController::class, 'insert']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'delete']);
    Route::get('user', [UserController::class, 'getAll']); 
    Route::get('user/{id_user}', [UserController::class, 'getById']); 

    Route::post('outlet', [OutletController::class, 'insert']);
    Route::put('outlet/{id}', [OutletController::class, 'update']);
    Route::delete('outlet/{id}', [OutletController::class, 'delete']);

    Route::post('paket', [PaketController::class, 'insert']);
    Route::put('paket/{id}', [PaketController::class, 'update']);
    Route::delete('paket/{id}', [PaketController::class, 'delete']);
    Route::get('paket/{id_paket}', [PaketController::class, 'getById']);

});

Route::group(['middleware'=>['jwt.verify:admin,kasir']], function(){

    Route::post('member', [MemberController::class, 'insert']);
    Route::put('member/{id}', [MemberController::class, 'update']);
    Route::delete('member/{id}', [MemberController::class, 'delete']);
    Route::get('member', [MemberController::class, 'getAll']);
    Route::get('member/{id_member}', [MemberController::class, 'getById']);

    Route::post('transaksi', [TransaksiController::class, 'insert']);
    Route::put('transaksi/status', [TransaksiController::class, 'updateStatus']);
    Route::put('transaksi/bayar', [TransaksiController::class, 'updateBayar']);

    Route::get('paket', [PaketController::class, 'getAll']);

    


});
