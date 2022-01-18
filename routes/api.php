<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Apis; 
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/first-api',[Apis::class,'firstApi']); 

// Route::get('/second-api/{id}',[Apis::class,'secondApi']); 

// Route::post('/post-api',[Apis::class,'postApi']); 

// Route::get('/taskList',[Apis::class,'getTaskList']); 

// Route::get('/singleTask/{id}',[Apis::class,'getSingleTaskList']); 

// //// PASSPORT //////


// Route::post('/register',[Apis::class,'register']); 



// Route::get('/login',[Apis::class,'login'])->name('login');

Route::get('/demo-url',  function  (Request $request)  {
   return response()->json(['Laravel 8 CORS Demo']);
});

Route::post('/login',[Apis::class,'login']);


 Route::middleware('auth:api')->group(function ()
    {
    Route::get('getTemplates',[Apis::class,'getTemplate']);
    Route::get('getCategories',[Apis::class,'getCategories']);
});