<x-layout>
    <div class="max-w-4xl mx-auto bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
        <div class="relative h-64 bg-gradient-to-b from-gray-200 to-gray-700 p-6 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $evento->categoria->nombre ?? "General" }}
                    </span>
                    @if($evento->destacado)
                        <span class="bg-amber-400 text-white text-xs font-semibold px-3 py-1 rounded-full">
                            ★ Destacado
                        </span>
                    @endif
                </div>
                <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                    {{ $evento->fecha->diffForHumans() }}
                </span>
            </div>

            <div class="flex items-center justify-center">
                <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-white">{{ $evento->titulo }}</h1>
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2 space-y-4">
                <h2 class="text-lg font-bold text-gray-900">Acerca del evento</h2>
                <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $evento->descripcion }}</p>
                <div class="pt-6">
                    <a href="{{ route("eventos.index") }}" class="text-sm font-medium text-blue-600 hover:underline">
                        ← Volver a la cartelera
                    </a>
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500">Información</h3>

                    <div class="text-sm">
                        <p class="text-gray-400 text-xs">Fecha</p>
                        <p class="font-semibold text-gray-800">{{ $evento->fecha->translatedFormat("l, d \d\e F \d\e Y") }}</p>
                    </div>

                    <div class="text-sm">
                        <p class="text-gray-400 text-xs">Hora</p>
                        <p class="font-semibold text-gray-800">{{ $evento->fecha->format("H:i") }}</p>
                    </div>

                    <div class="text-sm">
                        <p class="text-gray-400 text-xs">Lugar</p>
                        <p class="font-semibold text-gray-800">{{ $evento->lugar }}</p>
                    </div>

                    <div class="text-sm">
                        <p class="text-gray-400 text-xs">Precio</p>
                        <p class="font-semibold text-gray-800">{{ $evento->precio == 0 ? "Gratis" : "Bs. " . number_format($evento->precio, 2) }}</p>
                    </div>

                    <div class="text-sm">
                        <p class="text-gray-400 text-xs">Cupos</p>
                        <p class="font-semibold text-emerald-600">{{ $evento->cupo }} disponibles</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route("eventos.edit", $evento) }}"
                       class="flex-1 text-center rounded-lg bg-orange-500 py-2.5 text-sm font-semibold text-white hover:bg-orange-600">
                        Editar
                    </a>
                    <form action="{{ route("eventos.destroy", $evento) }}" method="POST"
                          onsubmit="return confirm(\x27¿Eliminar este evento?\x27)" class="flex-1">
                        @csrf
                        @method("DELETE")
                        <button type="submit"
                                class="w-full rounded-lg bg-red-600 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>