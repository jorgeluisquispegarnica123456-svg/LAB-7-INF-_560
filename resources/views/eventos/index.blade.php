<x-layout>
    <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">Cartelera de Eventos</h1>

    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <form method="GET" action="{{ route("eventos.index") }}" class="flex flex-wrap items-center gap-4">
            <select name="categoria" class="rounded-lg border-gray-300 text-sm py-1.5 px-3 bg-white border">
                <option value="">Todas</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" @selected(request("categoria") == $cat->id)>
                        {{ $cat->nombre }}
                    </option>
                @endforeach
            </select>

            <label class="flex items-center gap-1.5 text-sm text-gray-600">
                <input type="checkbox" name="destacados" value="1" @checked(request("destacados")) class="rounded">
                Sólo destacados
            </label>

            <label class="flex items-center gap-1.5 text-sm text-gray-600">
                <input type="checkbox" name="publicados" value="1" @checked(request("publicados")) class="rounded">
                Sólo publicados
            </label>

            <button type="submit" class="rounded-lg bg-blue-600 px-4 py-1.5 text-sm font-medium text-white hover:bg-blue-700">
                Filtrar
            </button>
        </form>

        <a href="{{ route("eventos.create") }}" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
            Crear Nuevo Evento
        </a>
    </div>

    <div class="mb-6">
        {{ $eventos->links() }}
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($eventos as $evento)
            <div class="bg-white rounded-2xl border {{ $evento->destacado ? "border-blue-400 ring-2 ring-blue-100" : "border-gray-200" }} overflow-hidden shadow-sm flex flex-col">
                <div class="relative h-44 bg-gray-100 flex items-center justify-center border-b border-gray-100">
                    @if($evento->destacado)
                        <span class="absolute top-3 left-3 bg-amber-400 text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                            ★ Destacado
                        </span>
                    @endif

                    <span class="absolute top-3 right-3 bg-slate-800 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $evento->precio == 0 ? "Gratis" : "Bs. " . number_format($evento->precio, 2) }}
                    </span>

                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>

                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs mb-2">
                            <span class="bg-emerald-50 text-emerald-700 font-medium px-2.5 py-0.5 rounded-full">
                                {{ $evento->categoria->nombre ?? "General" }}
                            </span>
                            <span class="bg-blue-50 text-blue-600 font-medium px-2.5 py-0.5 rounded-full">
                                {{ $evento->fecha->diffForHumans() }}
                            </span>
                        </div>

                        <h2 class="text-lg font-bold text-gray-900 mb-2">
                            <a href="{{ route("eventos.show", $evento) }}" class="hover:underline">
                                {{ $evento->titulo }}
                            </a>
                        </h2>

                        <div class="space-y-1 text-xs text-gray-500 mb-3">
                            <p>📅 {{ $evento->fecha->format("d \d\e M., H:i") }}</p>
                            <p>📍 {{ $evento->lugar }}</p>
                        </div>

                        <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                            {{ $evento->descripcion }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-emerald-600 mb-4">
                            🎟️ {{ $evento->cupo }} cupos disponibles
                        </p>

                        <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                            <a href="{{ route("eventos.show", $evento) }}"
                               class="flex-1 text-center text-xs font-medium text-blue-600 border border-blue-200 rounded-full py-1.5 hover:bg-blue-50">
                                Ver detalle
                            </a>
                            <a href="{{ route("eventos.edit", $evento) }}"
                               class="flex-1 text-center text-xs font-medium text-amber-600 border border-amber-200 rounded-full py-1.5 hover:bg-amber-50">
                                Editar
                            </a>
                            <form action="{{ route("eventos.destroy", $evento) }}" method="POST"
                                  onsubmit="return confirm(\x27¿Eliminar este evento?\x27)" class="flex-1">
                                @csrf
                                @method("DELETE")
                                <button type="submit"
                                        class="w-full text-center text-xs font-medium text-red-600 border border-red-200 rounded-full py-1.5 hover:bg-red-50">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>