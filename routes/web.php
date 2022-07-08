<?php

use App\Http\Controllers as Controller;

use Illuminate\Support\Facades\Route; 



 Route::get("/",[Controller\HomeController::class ,'index']);


 Route::get("/create",[Controller\HomeController::class ,'create']);

 Route::get("/serachOne",[Controller\HomeController::class ,'serachOne']);

 Route::get("/serachTow",[Controller\HomeController::class ,'serachTow']);


 Route::get("/delete",[Controller\HomeController::class ,'delete']);
 Route::get("/update",[Controller\HomeController::class ,'update']);
