<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentComplaintController;
use App\Models\StudentCompl;

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
    return view('welcome');
});

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});



Route::group(['prefix'=> 'student'], function(){
	Route::get('/all-complaints', [StudentComplaintController::class, 'AllComplaints'])->name('show.all.complaints');
	Route::get('/add-complaints', [StudentComplaintController::class, 'ShowAddComplaintPage'])->name('show.add.complaint.page');
	Route::post('/store-complaints', [StudentComplaintController::class, 'StoreComplaint'])->name('store.complaint');
	Route::post('/store-complaints/{id}', [StudentComplaintController::class, 'UpdateComplaint'])->name('update.complaint');
    Route::get('/delete-complaints/{id}', [StudentComplaintController::class, 'DeleteComplaint'])->name('delete.complaint');


    Route::get('/open-tickets', [StudentComplaintController::class, 'open_tickets']);

});




Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
