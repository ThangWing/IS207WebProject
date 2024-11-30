<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BenhnhanController;
use App\Http\Controllers\HsbaController;
use App\Http\Controllers\BacsiController;
use App\Http\Controllers\CtbaController;

Route::post('/ctba', [CtbaController::class, 'store']);
Route::put('/ctba/{maba}/{mabl}', [CtbaController::class, 'update']);
Route::delete('/ctba/{maba}/{mabl}', [CtbaController::class, 'destroy']);
Route::get('/benhly/{maba}', [BenhlyController::class, 'getTenbl']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/benhnhan', [BenhnhanController::class, 'index']);
Route::post('/benhnhan', [BenhnhanController::class, 'store']);
Route::get('/benhnhan/{mabn}', [BenhnhanController::class, 'show']);
Route::put('/benhnhan/{mabn}', [BenhnhanController::class, 'update']);
Route::delete('/benhnhan/{mabn}', [BenhnhanController::class, 'destroy']);

Route::get('/hsba', [HsbaController::class, 'index']);
Route::post('/hsba', [HsbaController::class, 'store']);
Route::get('/hsba/{mabn}/{maba}', [HsbaController::class, 'show']);
Route::put('/hsba/{mabn}/{maba}', [HsbaController::class, 'update']);
Route::delete('/hsba/{mabn}/{maba}', [HsbaController::class, 'destroy']);

Route::get('/doctors', [BacsiController::class, 'index']);
Route::post('/doctors', [BacsiController::class, 'store']);
Route::get('/doctors/{id}', [BacsiController::class, 'show']);
Route::put('/doctors/{id}', [BacsiController::class, 'update']);
Route::delete('/doctors/{id}', [BacsiController::class, 'destroy']);

Route::get('/ctcls/details/{maba}', [CtclsController::class, 'getCtclsDetails']);
Route::post('/ctcls', [CtclsController::class, 'createCtcls']);
Route::put('/ctcls/{maba}/{mapcn}', [CtclsController::class, 'updateCtcls']);
Route::delete('/ctcls/{maba}/{mapcn}', [CtclsController::class, 'deleteCtcls']);