<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Weather;

Route::get('/', Weather::class)->name('weather');

