<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [PageController::class, 'index'])->name('home');


Route::middleware(['auth', 'verified'])
        ->name('admin.')
        ->prefix('admin')
        ->group(function(){
            //qui mettiamo tutte le rotte della CRUD
            Route::get('/',[DashboardController::class, 'index'])->name('home');
            Route::get('projects/project-category', [ProjectController::class, 'categories_project'])->name('categories_project');
            Route::resource('projects', ProjectController::class);
            Route::get('projects/orderby/{column}/{direction}', [ProjectController::class, 'orderby'])->name('projects.orderby');
            Route::resource('categories', CategoryController::class)->except('show', 'create', 'edit');
        });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
