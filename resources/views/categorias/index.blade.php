<x-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Categorías</h1>
        <a href="{{ route("categorias.create") }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm text-white">
            Nueva Categoría
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b border-gray-200 text-gray-600">
                <tr>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Eventos</th>
                    <th class="px-4 py-3 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($categorias as $cat)
                    <tr>
                        <td class="px-4 py-3 font-medium">
                            <a href="{{ route("categorias.show", $cat) }}" class="hover:underline text-blue-600">
                                {{ $cat->nombre }}
                            </a>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $cat->slug }}</td>
                        <td class="px-4 py-3">{{ $cat->eventos_count }}</td>
                        <td class="px-4 py-3 text-right flex justify-end gap-3">
                            <a href="{{ route("categorias.edit", $cat) }}" class="text-amber-600 hover:underline">Editar</a>
                            <form action="{{ route("categorias.destroy", $cat) }}" method="POST"
                                  onsubmit="return confirm(\x27¿Eliminar esta categoría?\x27)">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>