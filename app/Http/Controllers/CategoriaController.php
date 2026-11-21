<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::withCount("eventos")->paginate(10);
        return view("categorias.index", compact("categorias"));
    }

    public function create()
    {
        return view("categorias.create");
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            "nombre"      => "required|string|max:255",
            "descripcion" => "nullable|string",
        ]);

        $datos["slug"] = Str::slug($datos["nombre"]) . "-" . uniqid();

        Categoria::create($datos);

        return redirect()->route("categorias.index")
            ->with("exito", "Categoría creada correctamente.");
    }

    public function show(Categoria $categoria)
    {
        return view("categorias.show", compact("categoria"));
    }

    public function edit(Categoria $categoria)
    {
        return view("categorias.edit", compact("categoria"));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $datos = $request->validate([
            "nombre"      => "required|string|max:255",
            "descripcion" => "nullable|string",
        ]);

        $datos["slug"] = Str::slug($datos["nombre"]);

        $categoria->update($datos);

        return redirect()->route("categorias.index")
            ->with("exito", "Categoría actualizada correctamente.");
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route("categorias.index")
            ->with("exito", "Categoría eliminada correctamente.");
    }
}