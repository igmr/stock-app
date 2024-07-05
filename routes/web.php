<?php

use App\Http\Controllers\Web\AuthenticationController;
use App\Http\Controllers\Web\BrandController;
use App\Http\Controllers\Web\CartridgeController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\MaintenanceController;
use App\Http\Controllers\Web\PrinterController;
use App\Http\Controllers\Web\StockController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',      [AuthenticationController::class, 'create'])->name('auth.login.index');
Route::post('/auth', [AuthenticationController::class, 'store'])->name('auth.login.store');


Route::middleware('auth')->prefix('app')->group(function () {
    Route::get('/',      [DashboardController::class, 'index'])->name('app.dashboard');
    Route::post('/logout', [AuthenticationController::class, 'destroy'])->name('auth.login.destroy');
    Route::prefix('brand')->group(function () {
        Route::get('/',             [BrandController::class, 'index'])->name('app.brand.index');
        Route::get('/datatable',    [BrandController::class, 'datatable'])->name('app.brand.datatable');
        Route::get('/select2',      [BrandController::class, 'select2'])->name('app.brand.select2');
        Route::get('/create',       [BrandController::class, 'create'])->name('app.brand.create');
        Route::post('/',            [BrandController::class, 'store'])->name('app.brand.store');
        Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('app.brand.edit');
        Route::put('/{brand}',      [BrandController::class, 'update'])->name('app.brand.update');
        Route::delete('/{brand}',   [BrandController::class, 'destroy'])->name('app.brand.destroy');
    });
    Route::prefix('printer')->group(function () {
        Route::get('/',               [PrinterController::class, 'index'])->name('app.printer.index');
        Route::get('/datatable',      [PrinterController::class, 'datatable'])->name('app.printer.datatable');
        Route::get('/create',         [PrinterController::class, 'create'])->name('app.printer.create');
        Route::post('/',              [PrinterController::class, 'store'])->name('app.printer.store');
        Route::get('/{printer}/edit', [PrinterController::class, 'edit'])->name('app.printer.edit');
        Route::put('/{printer}',      [PrinterController::class, 'update'])->name('app.printer.update');
        Route::delete('/{printer}',   [PrinterController::class, 'destroy'])->name('app.printer.destroy');
    });
    Route::prefix('cartridge')->group(function () {
        Route::get('/',                 [CartridgeController::class, 'index'])->name('app.cartridge.index');
        Route::get('/datatable',        [CartridgeController::class, 'datatable'])->name('app.cartridge.datatable');
        Route::get('/create',           [CartridgeController::class, 'create'])->name('app.cartridge.create');
        Route::post('/',                [CartridgeController::class, 'store'])->name('app.cartridge.store');
        Route::get('/{cartridge}/edit', [CartridgeController::class, 'edit'])->name('app.cartridge.edit');
        Route::put('/{cartridge}',      [CartridgeController::class, 'update'])->name('app.cartridge.update');
        Route::delete('/{cartridge}',   [CartridgeController::class, 'destroy'])->name('app.cartridge.destroy');
    });
    Route::prefix('stock')->group(function () {
        Route::get('/',             [StockController::class, 'index'])->name('app.stock.index');
        Route::get('/datatable',    [StockController::class, 'datatable'])->name('app.stock.datatable');
        Route::get('/create',       [StockController::class, 'create'])->name('app.stock.create');
        Route::post('/',            [StockController::class, 'store'])->name('app.stock.store');
        Route::get('/{stock}/edit', [StockController::class, 'edit'])->name('app.stock.edit');
        Route::put('/{stock}',      [StockController::class, 'update'])->name('app.stock.update');
        Route::delete('/{stock}',   [StockController::class, 'destroy'])->name('app.stock.destroy');
    });
    Route::prefix('maintenance')->group(function () {
        Route::get('/',                      [MaintenanceController::class, 'index'])->name('app.maintenance.index');
        Route::get('/datatable',             [MaintenanceController::class, 'datatable'])->name('app.maintenance.datatable');
        Route::get('/{maintenance}/info',    [MaintenanceController::class, 'show'])->name('app.maintenance.show');
        Route::get('/create',                [MaintenanceController::class, 'create'])->name('app.maintenance.create');
        Route::post('/',                     [MaintenanceController::class, 'store'])->name('app.maintenance.store');
        Route::delete('/{maintenance}',      [MaintenanceController::class, 'destroy'])->name('app.maintenance.destroy');
        Route::get('/{maintenance}/follow',  [MaintenanceController::class, 'follow'])->name('app.maintenance.follow');
        Route::put('/{maintenance}/follow',  [MaintenanceController::class, 'follow_action'])->name('app.maintenance.follow_action');
        Route::get('/{maintenance}/delivery',[MaintenanceController::class, 'delivery'])->name('app.maintenance.delivery');
        Route::put('/{maintenance}/delivery',[MaintenanceController::class, 'delivery_action'])->name('app.maintenance.delivery_action');
        Route::get('/{maintenance}/cancel',  [MaintenanceController::class, 'cancel'])->name('app.maintenance.cancel');
        Route::put('/{maintenance}/cancel',  [MaintenanceController::class, 'cancel_action'])->name('app.maintenance.cancel_action');

        Route::get('/{maintenance}/file',    [MaintenanceController::class, 'file'])->name('app.maintenance.file');
        Route::put('/{maintenance}/upload',  [MaintenanceController::class, 'upload'])->name('app.maintenance.upload');
    });

    Route::prefix('user')->group(function () {
        Route::get('/',                       [UserController::class, 'index'])->name('app.user.index');
        Route::get('/datatable',              [UserController::class, 'datatable'])->name('app.user.datatable');
        Route::get('/create',                 [UserController::class, 'create'])->name('app.user.create');
        Route::post('/',                      [UserController::class, 'store'])->name('app.user.store');
        Route::get('/{user}/edit',            [UserController::class, 'edit'])->name('app.user.edit');
        Route::put('/{user}',                 [UserController::class, 'update'])->name('app.user.update');
        Route::delete('/{user}',              [UserController::class, 'destroy'])->name('app.user.destroy');
        Route::get('/{user}/change-password', [UserController::class, 'change_password'])->name('app.user.change_password');
        Route::put('/{user}/change-password', [UserController::class, 'change_password_action'])->name('app.user.change_password_action');
    });
});
