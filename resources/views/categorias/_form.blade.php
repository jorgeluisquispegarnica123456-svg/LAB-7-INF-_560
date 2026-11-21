@csrf
@if(isset($categoria))
    @method("PUT")
@endif

<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
        <input type="text" name="nombre" value="{{ old("nombre", $categoria->nombre ?? "") }}" required
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
        <textarea name="descripcion" rows="3"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">{{ old("descripcion", $categoria->descripcion ?? "") }}</textarea>
    </div>

    <div class="flex gap-3 pt-2">
        <a href="{{ route("categorias.index") }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700">
            Cancelar
        </a>
        <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
            {{ $textoBoton }}
        </button>
    </div>
</div>