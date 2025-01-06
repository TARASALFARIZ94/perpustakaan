<?php

use App\Livewire\BukuComponent;
use App\Livewire\HomeComponent;
use App\Livewire\KategoriComponent;
use App\Livewire\LoginComponent;
use App\Livewire\PinjamComponent;
use App\Livewire\UserComponent;
use App\Livewire\MemberComponent;
use App\Livewire\KembaliComponent;
use Illuminate\Support\Facades\Route;

// Rute Login
Route::get('/login', LoginComponent::class)->name('login')->middleware('guest');

// Middleware untuk pengguna yang sudah login
Route::middleware('auth')->group(function () {
    // Rute Dashboard Utama
    Route::get('/', HomeComponent::class)->name('home');

    // Rute Admin
    Route::middleware('isAdmin')->group(function () {
        Route::get('/user', UserComponent::class)->name('user');
        Route::get('/kategori', KategoriComponent::class)->name('kategori');
        Route::get('/buku', BukuComponent::class)->name('buku');
        Route::get('/pinjam', PinjamComponent::class)->name('pinjam');
        Route::get('/kembali', KembaliComponent::class)->name('kembali');
        Route::get('/member', MemberComponent::class)->name('member');
    });

    // Rute Member
    Route::middleware('isMember')->group(function () {
        Route::get('/pinjam', PinjamComponent::class)->name('pinjam');
        Route::get('/kembali', KembaliComponent::class)->name('kembali');
    });

    // Logout
    Route::get('/logout', [LoginComponent::class, 'keluar'])->name('logout');
});
