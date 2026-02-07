<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;

 Route::get('/', function () {
    return view('welcome');
 });


Route::get('/', [JournalController::class, 'index'])->name('journal.index');
Route::get('/create', [JournalController::class, 'create'])->name('journal.create');
Route::post('/store', [JournalController::class, 'store'])->name('journal.store');
Route::get('/entry/{entry}', [JournalController::class, 'show'])->name('journal.show');
Route::delete('/entry/{entry}', [JournalController::class, 'destroy'])->name('journal.destroy');
Route::post('/take-photo', [JournalController::class, 'takePhoto'])->name('journal.photo');
Route::get('/test-native', function () {
    // Test notification
    Native\Mobile\Facades\PushNotifications::show('Test notification');
    
    // Test storage
    $path = Native\Mobile\Facades\SecureStorage::local();
    
    // Test device info
    $info = Native\Mobile\Facades\Device::getInfo();
    
    return view('test', compact('info'));
});