<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación de Eventos UATF</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ route("eventos.index") }}" class="text-lg font-bold text-gray-900">
                Eventos App
            </a>
            <nav class="flex items-center gap-6 text-sm font-medium text-gray-600">
                <a href="{{ route("eventos.index") }}" class="hover:text-blue-600">Inicio</a>
                <a href="{{ route("eventos.index") }}" class="text-gray-900 font-semibold">Eventos</a>
                <a href="{{ route("categorias.index") }}" class="hover:text-blue-600">Categorías</a>
            </nav>
        </div>
    </header>

    <main class="max-w-6xl w-full mx-auto px-4 py-8 flex-1">
        @if (session("exito"))
            <div class="mb-6 rounded-lg bg-green-100 border border-green-300 px-4 py-3 text-green-800 font-medium">
                {{ session("exito") }}
            </div>
        @endif

        {{ $slot }}
    </main>
</body>
</html>