<?php


use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{
    ShowTweets,
    User\UploadPhoto
};

Route::get('/upload',UploadPhoto::class)->name('upload.photo.user')->middleware('auth');
Route::get('/', ShowTweets::class)->name('tweets.home');
//->middleware('auth');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])
    ->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
