<?php

use App\Livewire\BukuComponent;
use App\Livewire\HomeComponent;
use App\Livewire\KategoriComponent;
use App\Livewire\LoginComponent;
use App\Livewire\PinjamComponent;
use App\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeComponent::class)->middleware('auth')->name('home');

Route::get('/user', UserComponent::class)->name('user')->middleware('auth');

Route::get('/kategori', KategoriComponent::class)->name('kategori')->middleware('auth');

Route::get('/buku', BukuComponent::class)->name('buku')->middleware('auth');

Route::get('/pinjam', PinjamComponent::class)->name('pinjam')->middleware('auth');

Route::get('/login', LoginComponent::class)->name('login');

Route::get('/logout', [LoginComponent::class, 'keluar'])->name('logout');
