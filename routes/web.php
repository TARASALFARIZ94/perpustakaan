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

Route::get('/', HomeComponent::class)->middleware('auth')->name('home');

// Rute untuk Admin
Route::get('/user', UserComponent::class)->name('user')->middleware('auth', 'role:admin');
Route::get('/kategori', KategoriComponent::class)->name('kategori')->middleware('auth', 'role:admin');
Route::get('buku', BukuComponent::class)->name('buku')->middleware('auth', 'role:admin');
Route::get('/pinjam', PinjamComponent::class)->name('pinjam')->middleware('auth', 'role:admin');
Route::get('/kembali', KembaliComponent::class)->name('kembali')->middleware('auth', 'role:admin');
Route::get('/member', MemberComponent::class)->name('member')->middleware('auth', 'role:admin');

// Rute untuk Member
Route::get('/pinjam', PinjamComponent::class)->name('pinjam')->middleware('auth', 'role:member');
Route::get('/kembali', KembaliComponent::class)->name('kembali')->middleware('auth', 'role:member');

// Login dan Logout
Route::get('/login', LoginComponent::class)->name('login');
Route::get('/logout', [LoginComponent::class, 'keluar'])->name('logout');
