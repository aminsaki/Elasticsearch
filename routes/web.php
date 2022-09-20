<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 /// test  optionstion  elasitcSerach
Route::get('version', [Controller\WorkersController::class,'version']);
Route::get('Indexing', [Controller\WorkersController::class,'Indexing']);
Route::get('update', [Controller\WorkersController::class,'update']);
Route::get('serach', [Controller\WorkersController::class,'serach']);
Route::get('lists', [Controller\WorkersController::class,'lists']);
Route::get('delete', [Controller\WorkersController::class,'delete']);
Route::get('getId', [Controller\WorkersController::class,'getId']);
Route::get('sort/{order}', [Controller\WorkersController::class,'sort']);
Route::get('match', [Controller\WorkersController::class,'match']);
Route::get('multi_match', [Controller\WorkersController::class,'multi_match']); ///  query
Route::get('boolent', [Controller\WorkersController::class,'boolent']); /// filter
Route::get('boolent_must', [Controller\WorkersController::class,'boolent_must']); //and
Route::get('boolent_must_not', [Controller\WorkersController::class,'boolent_must_not']); //not
Route::get('boolent_should', [Controller\WorkersController::class,'boolent_should']); // or
Route::get('query', [Controller\WorkersController::class,'query']);
Route::get('count', [Controller\WorkersController::class,'count']);
Route::get('mapping', [Controller\WorkersController::class,'mapping']);
Route::get('bulk', [Controller\WorkersController::class,'bulk']);
Route::get('queryString', [Controller\WorkersController::class,'queryString']);
Route::get('deleteByQuery', [Controller\WorkersController::class,'deleteByQuery']);
Route::get('mget', [Controller\WorkersController::class,'mget']);
Route::get('update_by_query', [Controller\WorkersController::class,'update_by_query']);
Route::get('asyncSearch', [Controller\WorkersController::class,'asyncSearch']);
Route::get('reindex', [Controller\WorkersController::class,'reindex']);
Route::get('Regexp', [Controller\WorkersController::class,'Regexp']);
Route::get('fuzzy', [Controller\WorkersController::class,'fuzzy']);
Route::get('mserach', [Controller\WorkersController::class,'msearch']);
Route::get('combined_fields', [Controller\WorkersController::class,'combined_fields']);
Route::get('indices', [Controller\WorkersController::class,'indices']);
Route::get('mtermvectors', [Controller\WorkersController::class,'mtermvectors']);




Route::get('index', [Controller\HomeController::class,'index']);

Route::post('myserach', [Controller\HomeController::class,'serach']);




