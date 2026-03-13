<?php

use App\Http\Controllers\AuthController;

// Rutas para Discord
Route::get('/auth/discord/redirect', [AuthController::class, 'redirectToDiscord']);
Route::get('/auth/discord/callback', [AuthController::class, 'handleDiscordCallback']);

// Rutas para Spotify
Route::get('/auth/spotify/redirect', [AuthController::class, 'redirectToSpotify']);
Route::get('/auth/spotify/callback', [AuthController::class, 'handleSpotifyCallback']);