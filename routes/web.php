<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\PlotController;
use App\Http\Controllers\AnimalTransferController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/weights', [WeightController::class, 'selectRfid'])->name('weights.select');
Route::post('/weights/plot', [WeightController::class, 'plotWeight'])->name('weights.plot');
Route::get('/plot/image/{rfid}', [PlotController::class, 'generatePlot'])->name('plot.image');

Route::get('/animals/create', [AnimalController::class, 'create'])->name('animals.create');
Route::post('/animals/store', [AnimalController::class, 'store'])->name('animals.store');

Route::get('/animals/import', [AnimalController::class, 'showImportForm'])->name('animals.import.form');
Route::post('/animals/import', [AnimalController::class, 'importFromCsv'])->name('animals.import.csv');

Route::get('/animals/transfer/{id}', [AnimalTransferController::class, 'showTransferForm'])->name('animals.transfer.form');
Route::post('/animals/transfer/{id}', [AnimalTransferController::class, 'transfer'])->name('animals.transfer');

Route::get('/animals/remove-duplicates', [AnimalController::class, 'showDuplicates'])->name('animals.duplicates');
Route::post('/animals/remove-duplicates', [AnimalController::class, 'removeDuplicates'])->name('animals.duplicates.remove');

Route::get('/farms', [FarmController::class, 'index'])->name('farms.index');
Route::post('/farms/show', [FarmController::class, 'show'])->name('farms.show');

Route::middleware('auth')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/messages/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('/messages/sent', [MessageController::class, 'sent'])->name('messages.sent');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
