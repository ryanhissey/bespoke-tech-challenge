<?php

use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/admin/dashboard', AdminDashboardController::class)->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

Route::get('/admin/items', [ItemsController::class, 'index'])
    ->name('admin.items.index')
    ->middleware(['auth', 'verified', 'can:viewAny,App\Models\Item']);

Route::get('/admin/item/delete/{id}', [ItemsController::class, 'destroy'])
    ->name('admin.items.delete')
    ->middleware(['auth', 'verified', 'can:viewAny,App\Models\Item']);

Route::get('/admin/item/search', [ItemsController::class, 'search'])
    ->name('admin.items.search')
    ->middleware(['auth', 'verified', 'can:viewAny,App\Models\Item']);

Route::get('/admin/items/create', [ItemsController::class, 'create'])
    ->name('admin.items.create')
    ->middleware(['auth', 'verified', 'can:create,App\Models\Item']);

Route::post('/admin/items', [ItemsController::class, 'store'])
    ->middleware(['auth', 'verified', 'can:create,App\Models\Item']);

Route::get('/admin/items/{item}/edit', [ItemsController::class, 'edit'])
    ->name('admin.items.edit')
    ->middleware(['auth', 'verified', 'can:update,item']);

Route::patch('/admin/items/{item}', [ItemsController::class, 'update'])
    ->middleware(['auth', 'verified', 'can:update,item']);


require __DIR__.'/auth.php';
