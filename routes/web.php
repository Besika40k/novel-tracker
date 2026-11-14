<?php

use App\Http\Controllers\NovelController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/novels');

// Six named routes: novels.index, create, store, edit, update and destroy.
Route::resource('novels', NovelController::class)->except(['show']);
