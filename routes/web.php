<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EstudianteController;

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
})->name('login1');

//Middleware for admin users
//INICIO RUTAS ACCESIBLES PARA ADMIN
Route::middleware('role:2')->group(function () {
    // Route definitions for the Book entity
    Route::get('/books/search', 'BookController@search')->name('books.search');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::put('/books/{book}/soft-delete', [BookController::class, 'softDelete'])->name('books.softDelete');

    //Home Controller
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Route definitions for the Order entity
    Route::get('/orders/search', 'OrderController@search')->name('orders.search');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::put('/orders/{order}/soft-delete', [OrderController::class, 'softDelete'])->name('orders.softDelete');

    // Route definitions for the User entity
    Route::get('/users/search', 'UserController@search')->name('users.search');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{user}/soft-delete', [UserController::class, 'softDelete'])->name('users.softDelete');

    // Route definitions for the OrderDetail entity
    Route::get('/ordersDetails/search', 'OrderDetailController@search')->name('ordersDetails.search');
    Route::get('/ordersDetails', [OrderDetailController::class, 'index'])->name('ordersDetails.index');
    Route::get('/ordersDetails/create', [OrderDetailController::class, 'create'])->name('ordersDetails.create');
    Route::post('/ordersDetails', [OrderDetailController::class, 'store'])->name('ordersDetails.store');
    Route::get('/ordersDetails/{orderdetail}', [OrderDetailController::class, 'show'])->name('ordersDetails.show');
    Route::get('/ordersDetails/{orderdetail}/edit', [OrderDetailController::class, 'edit'])->name('ordersDetails.edit');
    Route::put('/ordersDetails/{orderdetail}', [OrderDetailController::class, 'update'])->name('ordersDetails.update');
    Route::delete('/ordersDetails/{orderdetail}', [OrderDetailController::class, 'destroy'])->name('ordersDetails.destroy');
    Route::put('/ordersDetails/{orderdetail}/soft-delete', [OrderDetailController::class, 'softDelete'])->name('ordersDetails.softDelete');

    // Route definitions for the Roles entity
    Route::get('/roles/search', 'RoleController@search')->name('roles.search');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::put('/roles/{role}/soft-delete', [RoleController::class, 'softDelete'])->name('roles.softDelete');
});
//FIN RUTAS ACCESIBLES PARA ADMIN

//RUTAS PARA ADMIN Y ESTUDIANTE
Route::middleware('role:1,2')->group(function () {
    // Routes protected for roles with ID 1 or 2
    Route::get('/estudiante', [EstudianteController::class, 'index'])->name('estudiante.index');
    Route::get('/books/{book}/download-pdf', [BookController::class, 'downloadBlob'])->name('books.downloadBlob');
    Route::get('/books/{book}/voucher', [EstudianteController::class, 'alquilarIndex'])->name('voucher.index');
    Route::post('/books/alquilar', [EstudianteController::class, 'alquilarBook'])->name('books.alquilar');
    Route::get('/estudiante/resumen', [EstudianteController::class, 'rentSummary'])->name('estudiante.resumen');
    Route::get('/estudiante/{order}/download-pdf', [EstudianteController::class, 'downloadComprobante'])->name('estudiante.downloadComprobante');
});

//login
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [HomeController::class, 'index'])->name('admin');
    Route::get('/student', [EstudianteController::class, 'index'])->name('student');
});

//logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
