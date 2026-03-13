<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    // --- LÓGICA DE DISCORD ---

    public function redirectToDiscord()
    {
        // Envia al usuario a la página de autorización de Discord
        return Socialite::driver('discord')->redirect();
    }

    public function handleDiscordCallback(Request $request)
    {
        // Obtenemos los datos del usuario desde Discord
        $user = Socialite::driver('discord')->user();
        
        // Guardamos los datos en la sesión para mostrarlos en la vista
        $request->session()->put('oauth_user', $user);
        $request->session()->put('oauth_provider', 'Discord');
        
        return redirect('/dashboard');
    }

    // --- LÓGICA DE SPOTIFY ---

    public function redirectToSpotify()
    {
        // Spotify requiere ciertos "scopes" (permisos) para leer el email
        return Socialite::driver('spotify')
            ->scopes(['user-read-email', 'user-read-private'])
            ->redirect();
    }

    public function handleSpotifyCallback(Request $request)
    {
        // Obtenemos los datos del usuario desde Spotify
        $user = Socialite::driver('spotify')->user();
        
        $request->session()->put('oauth_user', $user);
        $request->session()->put('oauth_provider', 'Spotify');
        
        return redirect('/dashboard');
    }

    // Agregamos un método para cerrar sesión
    public function logout(Request $request)
    {
        $request->session()->forget(['oauth_user', 'oauth_provider']);
        return redirect('/login');
    }
}
