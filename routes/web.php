<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\AuthenController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Middleware\IsMember;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/', function () {
//     return view('client.index');
// });

// Route::get('/', [ClientController::class, 'index'])->name('index');
// Route::get('/chitiet', [ClientController::class, 'chitiet'])->name('chitiet');
// Route::get('/listdanhsach', [ClientController::class, 'listdanhsach'])->name('listdanhsach');
// Route::get('/lienhe', [ClientController::class, 'lienhe'])->name('lienhe');



Route::get('/', [ClientController::class, 'index'])->name('index')->middleware(['auth']);
Route::get('/chitiet/{slug}', [ClientController::class, 'chitiet'])->name('chitiet');
Route::get('/listdanhsach', [ClientController::class, 'listdanhsach'])->name('listdanhsach');
Route::get('/lienhe', [ClientController::class, 'lienhe'])->name('lienhe');
Route::get('/listPostCate/{id}', [ClientController::class, 'listPostCate'])->name('listPostCate');


Route::post('/comment', [ClientController::class, 'storeComment'])->name('comment.store');




Route::get('login', [AuthenController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthenController::class, 'handleLogin']);


Route::get('register', [AuthenController::class, 'showFormRegister'])->name('register');
Route::post('register', [AuthenController::class, 'handleRegister']);

Route::get('forgotPassword', [AuthenController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('forgotPassword', [AuthenController::class, 'handlePassword']);


Route::post('logout', [AuthenController::class, 'logout'])->name('logout');

Route::get('/admin', [AdminController::class, 'dashboard'])
    ->name('admin.compoents.dashboard')
    ->middleware(['auth', IsMember::class]);

Route::get('/search', [ClientController::class, 'search'])->name('search');


