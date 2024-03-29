<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Events\DocumentStored;

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

//Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware(['auth', 'verified'])->name('login');

//Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/entity', [EntityController::class, 'index'])->name('entity');
    Route::get('/document', [DocumentController::class, 'index'])->name('document');
    Route::get('/file', [FileController::class, 'index'])->name('file');
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::get('/roles', [RolesController::class, 'index'])->name('roles');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/changepass', [UserController::class, 'changePassword']);
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::get('/settings/backupdb', [SettingsController::class, 'backupBD'])->name('backup-db');
    Route::get('/settings/backupfiles', [SettingsController::class, 'backupFiles'])->name('backup-files');
    
    Route::get('/entity/new', [EntityController::class, 'create'])->name('new-entity');
    Route::post('/entity/store', [EntityController::class, 'store'])->name('store-entity');
    Route::get('/entity/profile', [EntityController::class, 'profile'])->name('entity-profile');
    Route::post('/entityToggleStatus', [EntityController::class, 'toggleStatus']);

    Route::get('/document/new', [DocumentController::class, 'create'])->name('create-document');
    Route::get('/document/update', [DocumentController::class, 'create'])->name('update-document');
    Route::post('/document/store', [DocumentController::class, 'store'])->name('store-document');
    Route::post('/documentToggleStatus', [DocumentController::class, 'toggleStatus']);
    Route::get('/document/view', [DocumentController::class, 'view'])->name('document-view');

    Route::get('/file/upload', [FileController::class, 'create'])->name('upload-file');
    Route::post('/file/store', [FileController::class, 'store'])->name('store-file');
    Route::post('/fileToggleStatus', [FileController::class, 'toggleStatus']);
    Route::post('/file/getFiles', [FileController::class, 'getFiles'])->name('filelist');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/address/towns/{code}', [AddressController::class, 'towns']);
Route::post('/address/barangays/{code}', [AddressController::class, 'barangays']);

Route::post('/reports/displayReports', [ReportsController::class, 'displayReports']);

Route::post('/categoryRetrieve', [CategoryController::class, 'retrieve']);
Route::post('/categoryCreate', [CategoryController::class, 'create']);
Route::post('/categoryStore', [CategoryController::class, 'store']);
Route::post('/categoryToggleStatus', [CategoryController::class, 'toggleStatus']);

Route::post('/permissionRetrieve', [PermissionController::class, 'retrieve']);
Route::post('/permissionCreate', [PermissionController::class, 'create']);
Route::post('/permissionStore', [PermissionController::class, 'store']);
Route::post('/permissionToggleStatus', [PermissionController::class, 'toggleStatus']);

Route::post('/roleRetrieve', [RolesController::class, 'retrieve']);
Route::post('/roleCreate', [RolesController::class, 'create']);
Route::post('/roleStore', [RolesController::class, 'store']);
Route::post('/roleToggleStatus', [RolesController::class, 'toggleStatus']);

Route::post('/userRetrieve', [UserController::class, 'retrieve']);
Route::post('/userCreate', [UserController::class, 'create']);
Route::post('/userStore', [UserController::class, 'store']);
Route::post('/userToggleStatus', [UserController::class, 'toggleStatus']);
Route::post('/userResetPass/{action}', [UserController::class, 'resetPassword']);
Route::post('/user/change/password', [UserController::class, 'changePassword']);

require __DIR__.'/auth.php';
