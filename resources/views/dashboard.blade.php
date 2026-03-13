<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Práctica OAuth/OIDC</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    @php
        // Extraemos los datos de la sesión
        $user = session('oauth_user');
        $provider = session('oauth_provider');
        
        // Colores dinámicos dependiendo del proveedor
        $badgeColor = $provider === 'Discord' ? 'bg-[#5865F2]' : 'bg-[#1DB954]';
    @endphp

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md text-center relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full {{ $badgeColor }} text-white text-xs font-bold py-1 uppercase tracking-widest">
            Autenticado vía {{ $provider }}
        </div>

        <div class="mt-6 flex justify-center">
            @if($user->getAvatar())
                <img src="{{ $user->getAvatar() }}" alt="Avatar" class="w-24 h-24 rounded-full border-4 border-gray-100 shadow-sm object-cover">
            @else
                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-3xl font-bold border-4 border-gray-100 shadow-sm">
                    {{ substr($user->getName() ?? $user->getNickname() ?? 'U', 0, 1) }}
                </div>
            @endif
        </div>

        <div class="mt-4">
            <h2 class="text-2xl font-bold text-gray-800">{{ $user->getName() ?? $user->getNickname() }}</h2>
            <p class="text-gray-500 text-sm mt-1">{{ $user->getEmail() ?? 'Email no proporcionado' }}</p>
        </div>

        <div class="mt-6 bg-gray-50 rounded-lg p-4 text-left border border-gray-100">
            <p class="text-xs text-gray-400 uppercase font-semibold mb-2">Datos extraídos (Claims)</p>
            <div class="text-sm font-mono text-gray-700 break-all space-y-1">
                <p><span class="font-semibold text-gray-900">ID:</span> {{ $user->getId() }}</p>
                <p><span class="font-semibold text-gray-900">Nickname:</span> {{ $user->getNickname() ?? 'N/A' }}</p>
                <p><span class="font-semibold text-gray-900">Token:</span> {{ substr($user->token, 0, 15) }}...</p>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ url('/logout') }}" class="inline-block bg-red-50 hover:bg-red-100 text-red-600 font-semibold py-2 px-6 rounded-lg transition duration-300 border border-red-200">
                Cerrar Sesión
            </a>
        </div>
    </div>

</body>
</html>