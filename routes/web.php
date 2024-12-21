<?php

use App\Livewire\LoginComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

route::get('/login',LoginComponent::class)->name('login');