<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        $query = Evento::with("categoria")->latest();

        if ($request->filled("categoria")) {
            $query->where("categoria_id", $request->categoria);
        }
        if ($request->boolean("destacados")) {
            $query->where("destacado", true);
        }
        if ($request->boolean("publicados")) {
            $query->where("publicado", true);
        }

        $eventos = $query->paginate(3)->withQueryString();
        $categorias = Categoria::all();

        return view("eventos.index", compact("eventos", "categorias"));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view("eventos.create", compact("categorias"));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            "categoria_id" => "nullable|exists:categorias,id",
            "titulo"       => "required|string|max:255",
            "descripcion"  => "required|string",
            "fecha"        => "required|date",
            "lugar"        => "required|string|max:255",
            "cupo"         => "required|integer|min:1",
            "precio"       => "required|numeric|min:0",
        ]);

        $datos["slug"]      = Str::slug($datos["titulo"]) . "-" . uniqid();
        $datos["publicado"] = $request->boolean("publicado");
        $datos["destacado"] = $request->boolean("destacado");

        Evento::create($datos);

        return redirect()->route("eventos.index")
            ->with("exito", "Evento creado correctamente.");
    }

    public function show(Evento $evento)
    {
        return view("eventos.show", compact("evento"));
    }

    public function edit(Evento $evento)
    {
        $categorias = Categoria::all();
        return view("eventos.edit", compact("evento", "categorias"));
    }

    public function update(Request $request, Evento $evento)
    {
        $datos = $request->validate([
            "categoria_id" => "nullable|exists:categorias,id",
            "titulo"       => "required|string|max:255",
            "descripcion"  => "required|string",
            "fecha"        => "required|date",
            "lugar"        => "required|string|max:255",
            "cupo"         => "required|integer|min:1",
            "precio"       => "required|numeric|min:0",
        ]);

        $datos["slug"]      = Str::slug($datos["titulo"]);
        $datos["publicado"] = $request->boolean("publicado");
        $datos["destacado"] = $request->boolean("destacado");

        $evento->update($datos);

        return redirect()->route("eventos.index")
            ->with("exito", "Evento actualizado correctamente.");
    }

    public function destroy(Evento $evento)
    {
        $evento->delete();

        return redirect()->route("eventos.index")
            ->with("exito", "Evento eliminado correctamente.");
    }
}