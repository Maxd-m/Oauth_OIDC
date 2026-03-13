<?php

use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('login');
});

// Rutas para Discord
Route::get('/auth/discord/redirect', [AuthController::class, 'redirectToDiscord']);
Route::get('/auth/discord/callback', [AuthController::class, 'handleDiscordCallback']);

// Rutas para Spotify
Route::get('/auth/spotify/redirect', [AuthController::class, 'redirectToSpotify']);
Route::get('/auth/spotify/callback', [AuthController::class, 'handleSpotifyCallback']);

Route::get('/dashboard', function () {
    // Si no hay sesión, regresamos al login
    if (!session()->has('oauth_user')) {
        return redirect('/login');
    }
    return view('dashboard');
});

Route::get('/logout', [AuthController::class, 'logout']);