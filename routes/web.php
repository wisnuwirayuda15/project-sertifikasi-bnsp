<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
  return view('welcome');
})->middleware('guest');

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'not_admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'not_admin'])->group(function () {
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');

  Route::get('/cetak', [ProfileController::class, 'cetak'])->name('cetak');
  Route::get('/edit/data-diri', [ProfileController::class, 'editData'])->name('data.edit');
  Route::patch('/update/data-diri', [ProfileController::class, 'updateData'])->name('data.update');
});

Route::middleware(['is_admin'])->group(function () {
  Route::get('/admin', function () {
    $users = User::where('is_admin', false)->get();
    return view('admin', compact('users'));
  })->name('admin');
  Route::patch('user/verify/{user}', [ProfileController::class, 'verify'])->name('verify');
  Route::patch('user/update/{user}', [ProfileController::class, 'updateUser'])->name('user.update');
  Route::delete('user/delete/{user}', [ProfileController::class, 'destroyUser'])->name('user.destroy');
  Route::get('/user/edit/{user}', [ProfileController::class, 'editUser'])->name('user.edit');
});

require __DIR__ . '/auth.php';
