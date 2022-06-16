<?php

use App\Http\Controllers\FilesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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
    return view('admin-panel/index');
})->name('admin-dashboard');

Route::group([
    'prefix' => '/admin-panel',
    'as' => '.',
    'middleware' => ['auth']
], function(){
    Route::resource('/posts', PostsController::class);
    Route::get('/download/{id}', [FilesController::class, 'download'])->name('fileDownload');
    Route::resource('/files', FilesController::class) ;
    Route::resource('/users', UsersController::class);
    Route::resource('/roles', RolesController::class);
});


require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
