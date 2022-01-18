<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', function() {
    return redirect('/login');
});

Route::post('/register', function() {
    return redirect('/login');
});
  
    Route::middleware('auth')->group(function ()
    {
Route::get('/dashboard', function () {


    return view('dashboard');
})->name('dashboard');



Route::get('category', [CategoryController::class, 'index'])->name('category');
Route::get('categoryadd', [CategoryController::class, 'create'])->name('categoryadd');
Route::post('categoryinsert', [CategoryController::class, 'store'])->name('categoryinsert');
Route::get('categoryedit/{id}', [CategoryController::class, 'edit'])->name('categoryedit');
Route::post('categoryupdate', [CategoryController::class, 'update'])->name('categoryupdate');
Route::post('categorydel', [CategoryController::class, 'destroy'])->name('categorydel');


//////////////////////  Temp//////////////////////////////


Route::get('temp', [TemplateController::class, 'index'])->name('temp');
Route::get('tempadd', [TemplateController::class, 'create'])->name('tempadd');
Route::post('tempinsert', [TemplateController::class, 'store'])->name('tempinsert');
Route::get('tempedit/{id}', [TemplateController::class, 'edit'])->name('tempedit');
Route::post('tempupdate', [TemplateController::class, 'update'])->name('tempupdate');
Route::post('tempdel', [TemplateController::class, 'destroy'])->name('tempdel');

   


////////////////////////////////////////////////////////////users////////////////////////
Route::get('users', [UserController::class, 'index'])->name('users');
Route::get('usersadd', [UserController::class, 'create'])->name('usersadd');
Route::post('usersinsert', [UserController::class, 'store'])->name('usersinsert');
Route::get('usersedit/{id}', [UserController::class, 'edit'])->name('usersedit');
Route::post('usersupdate', [UserController::class, 'update'])->name('usersupdate');
Route::post('usersdel', [UserController::class, 'destroy'])->name('usersdel');

});


require __DIR__.'/auth.php';
