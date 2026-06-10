<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\WorkspaceInvitationController;
use App\Http\Controllers\TaskController;

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


// Route::middleware(['auth'])->group(function () {

//     Route::resource('workspaces', WorkspaceController::class);

//     Route::post(
//         'workspaces/{workspace}/invite',
//         [WorkspaceInvitationController::class, 'store']
//     )->name('workspaces.invite');

// });

Route::middleware([
    'auth',
    'verified'
])->group(function () {

    Route::resource(
        'workspaces',
        WorkspaceController::class
    );

    Route::post(
        'workspaces/{workspace}/invite',
        [WorkspaceInvitationController::class,'store']
    )->name('workspaces.invite');

    Route::resource(
        'workspaces.tasks',
        TaskController::class
    );
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';