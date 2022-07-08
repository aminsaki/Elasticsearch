<?php

use App\Http\Controllers as Controller;

use Illuminate\Support\Facades\Route;



 Route::get("/create",[Controller\HomeController::class ,'create']);

 Route::get("/serachOne",[Controller\HomeController::class ,'serachOne']);


 Route::get("/serachTow",[Controller\HomeController::class ,'serachTow']);


