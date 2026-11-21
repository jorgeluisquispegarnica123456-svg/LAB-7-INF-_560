<x-layout>
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl border border-gray-200">
        <h1 class="text-xl font-bold mb-4">Editar Categoría</h1>
        <form action="{{ route("categorias.update", $categoria) }}" method="POST">
            @include("categorias._form", ["textoBoton" => "Actualizar categoría"])
        </form>
    </div>
</x-layout>