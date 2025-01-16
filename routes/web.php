<?php

use App\Livewire\BukuComponent;
use App\Livewire\HomeComponent;
use App\Livewire\KategoriComponent;
use App\Livewire\LoginComponent;
use App\Livewire\PinjamComponent;
use App\Livewire\UserComponent;
use App\Livewire\MemberComponent;
use App\Livewire\KembaliComponent;
use App\Livewire\ActivityLog;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('dashboard',function() {
    return view('dashboard');
})-> middleware('auth')->name('dashboard');

Route::get('/',HomeComponent::class)->middleware('auth')->name('home');
Route::get('/user', UserComponent::class)->name('user')->middleware('auth');
Route::get('/member', MemberComponent::class)->name('member')->middleware('auth');
Route::get('/kategori', KategoriComponent::class)->name('kategori')->middleware('auth');
Route::get('buku', BukuComponent::class)->name('buku')->middleware('auth');
Route::get('/pinjam', PinjamComponent::class)->name('pinjam')->middleware('auth');
Route::get('/kembali', KembaliComponent::class)->name('kembali')->middleware('auth');
Route::get('/activity-log', ActivityLog::class)->name('activity-log');
Route::get('/login',LoginComponent::class)->name('login');
Route::get('/logout',[LoginComponent::class,'keluar'])->name('logout');
Route::post('/logout', function () {
    Auth::logout(); // Logout user
    request()->session()->invalidate(); // Hapus sesi
    request()->session()->regenerateToken(); // Regenerasi CSRF token
    return redirect('/login'); // Redirect ke halaman login
})->name('logout');