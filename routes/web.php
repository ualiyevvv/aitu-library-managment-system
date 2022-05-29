<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
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

// Route::get('/', function () {
//     return view('index');
// });bookshow

Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('/books/{id}', [BookController::class, 'show'])->name('bookshow');


Route::group(['middleware' => 'guest'], function(){
    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register/store', [AuthController::class, 'store'])->name('register.store');
    
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login/store', [AuthController::class, 'login'])->name('login.store');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/addbook', [BookController::class, 'create'])->name('bookadd');
    Route::post('/storebook', [BookController::class, 'store'])->name('bookstore');
    Route::post('/borrow/{id}', [BookController::class, 'preborrow'])->name('bookpreborrow');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
});

Route::group(['prefix'=>'admin', 'middleware' => 'admin'], function(){
    Route::post('/verify/{id}', [AdminController::class, 'verifyUser'])->name('verify');
    Route::post('/bookverify/{id}', [AdminController::class, 'verifyBook'])->name('bookverify');
    Route::post('/borrowverify/{borrowid}', [AdminController::class, 'borrow'])->name('borrowverify');
    Route::post('/returnverify/{borrowid}', [AdminController::class, 'returnBook'])->name('returnverify');
    Route::post('/failrequest/{borrowid}', [AdminController::class, 'failBook'])->name('failrequest');
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});
