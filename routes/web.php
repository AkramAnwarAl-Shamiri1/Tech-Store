<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// أولًا: routes المصادقة (تسجيل دخول، تسجيل، إعادة تعيين كلمة المرور)
require __DIR__.'/auth.php'; // يحتوي على /login و /register و /password/reset

// Dashboard محمي بالمصادقة والتحقق من البريد الإلكتروني
Route::get('/dashboard', function () {
    return view('dashboard'); // resources/views/dashboard.blade.php
})->middleware(['auth', 'verified'])->name('dashboard');

// صفحات profile محمية بالمصادقة
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Catch-all لـ Vue SPA (آخر شيء دائمًا) مع استثناء routes المصادقة
Route::get('/{any}', function () {
    return view('app'); // Vue SPA
})->where('any', '^(?!api|login|register|forgot-password|reset-password|dashboard|profile).*$');
