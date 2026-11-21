<x-layout>
    <div class="max-w-4xl mx-auto bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
        <div class="bg-orange-500 px-8 py-6 text-white">
            <h1 class="text-2xl font-bold">Modificar evento</h1>
            <p class="text-orange-100 text-sm">{{ $evento->titulo }}</p>
        </div>

        <form action="{{ route("eventos.update", $evento) }}" method="POST" class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            @csrf
            @method("PUT")

            <div class="md:col-span-2 space-y-5">
                <h2 class="font-bold text-gray-900">Datos del evento</h2>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                    <input type="text" name="titulo" value="{{ old("titulo", $evento->titulo) }}" required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="descripcion" rows="4" required
                              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">{{ old("descripcion", $evento->descripcion) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha y hora</label>
                        <input type="datetime-local" name="fecha"
                               value="{{ old("fecha", $evento->fecha->format("Y-m-d\TH:i")) }}" required
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lugar</label>
                        <input type="text" name="lugar" value="{{ old("lugar", $evento->lugar) }}" required
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <div class="bg-gray-50 p-5 rounded-xl border border-gray-200 space-y-4">
                    <h3 class="text-xs font-bold uppercase text-gray-500">Configuración</h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                        <select name="categoria_id" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white">
                            @foreach($categorias as $cat)
                                <option value="{{ $cat->id }}" @selected(old("categoria_id", $evento->categoria_id) == $cat->id)>
                                    {{ $cat->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cupos</label>
                        <input type="number" name="cupo" value="{{ old("cupo", $evento->cupo) }}" required
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Precio (Bs.)</label>
                        <input type="number" step="0.01" name="precio" value="{{ old("precio", $evento->precio) }}" required
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                        <span class="text-xs text-gray-400">Usa 0 si el evento es gratuito.</span>
                    </div>

                    <label class="block border border-blue-200 bg-blue-50/50 rounded-lg p-3 cursor-pointer">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="publicado" value="1" @checked(old("publicado", $evento->publicado))>
                            <span class="text-sm font-semibold text-gray-800">Publicado</span>
                        </div>
                        <p class="text-xs text-gray-500 pl-5">Visible en la cartelera.</p>
                    </label>

                    <label class="block border border-amber-200 bg-amber-50/50 rounded-lg p-3 cursor-pointer">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="destacado" value="1" @checked(old("destacado", $evento->destacado))>
                            <span class="text-sm font-semibold text-gray-800">Destacado</span>
                        </div>
                        <p class="text-xs text-gray-500 pl-5">Se resalta con una insignia.</p>
                    </label>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route("eventos.index") }}"
                       class="flex-1 text-center rounded-lg border border-gray-300 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="flex-1 rounded-lg bg-blue-600 py-2.5 text-sm font-medium text-white hover:bg-blue-700">
                        Guardar cambios
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layout>