<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // --- LÓGICA DE DISCORD ---

    public function redirectToDiscord()
    {
        // Envia al usuario a la página de autorización de Discord
        return Socialite::driver('discord')->redirect();
    }

    public function handleDiscordCallback()
    {
        // Aquí recibes el Access Token y los datos del perfil (OIDC/OAuth)
        $discordUser = Socialite::driver('discord')->user();
        
        // Lógica para registrar o iniciar sesión al usuario en tu base de datos
        // $this->loginOrCreateUser($discordUser, 'discord');
        
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

    public function handleSpotifyCallback()
    {
        $spotifyUser = Socialite::driver('spotify')->user();
        
        // $this->loginOrCreateUser($spotifyUser, 'spotify');
        
        return redirect('/dashboard');
    }
}
