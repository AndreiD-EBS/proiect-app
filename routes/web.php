<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Magazine\Index;
use App\Models\Article;
use App\Livewire\Articles\Show;
use App\Livewire\Articles\Edit;
use App\Livewire\Articles\Create;
use App\Livewire\Admin\UserManagement;


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

// Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');


Route::view('profile', 'profile')
    ->middleware(['auth', 'employee'])
    ->name('profile');

Route::redirect('/dashboard', '/');

Route::get('/', Index::class)->name('magazine.index');

Route::middleware(['auth', 'employee'])->get('/articles/create', Create::class)
    ->name('articles.create');

Route::get('/articles/{slug}', Show::class)->name('articles.show');

Route::get('/articles/{slug}/edit', Edit::class)
    ->middleware(['auth', 'employee'])
    ->name('articles.edit');

Route::get('/admin/users', UserManagement::class)
    ->middleware(['auth', 'admin'])
    ->name('admin.users');





require __DIR__.'/auth.php';
