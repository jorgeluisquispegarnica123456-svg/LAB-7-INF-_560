<x-layout>
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl border border-gray-200 space-y-3">
        <h1 class="text-2xl font-bold">{{ $categoria->nombre }}</h1>
        <p class="text-xs text-gray-400">Slug: {{ $categoria->slug }}</p>
        <p class="text-gray-700">{{ $categoria->descripcion ?? "Sin descripción" }}</p>
        <a href="{{ route("categorias.index") }}" class="inline-block text-sm text-blue-600 pt-2">← Volver</a>
    </div>
</x-layout>