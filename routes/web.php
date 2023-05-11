<?php


use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{
    ShowTweets
};


Route::get('/tweets', ShowTweets::class)->name('home');
Route::get('/', function () {
    return view('welcome');
});
