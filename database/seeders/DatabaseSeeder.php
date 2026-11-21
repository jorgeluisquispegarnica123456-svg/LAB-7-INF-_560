<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Evento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = ["Deporte", "Cultura", "Programación", "Finanzas"];
        $catIds = [];

        foreach ($categorias as $nombre) {
            $cat = Categoria::create([
                "nombre" => $nombre,
                "slug" => Str::slug($nombre),
                "descripcion" => "Eventos relacionados con $nombre en la UATF.",
            ]);
            $catIds[] = $cat->id;
        }

        Evento::create([
            "categoria_id" => $catIds[0],
            "titulo" => "Maraton 10 k",
            "slug" => "maraton-10-k",
            "descripcion" => "Test",
            "fecha" => now()->addDays(7)->setTime(9, 25),
            "lugar" => "Carrera de Ingeniería Informática",
            "cupo" => 200,
            "precio" => 0,
            "publicado" => true,
            "destacado" => true,
        ]);

        for ($i = 2; $i <= 21; $i++) {
            $titulo = fake()->sentence(3);
            Evento::create([
                "categoria_id" => fake()->randomElement($catIds),
                "titulo" => rtrim($titulo, "."),
                "slug" => Str::slug($titulo) . "-" . $i,
                "descripcion" => fake()->paragraph(2),
                "fecha" => now()->addDays(rand(5, 60)),
                "lugar" => fake()->randomElement(["Coliseo Universitario", "Paraninfo Central", "Aula magna Informatica"]),
                "cupo" => rand(50, 350),
                "precio" => fake()->randomElement([0, 25, 50]),
                "publicado" => true,
                "destacado" => fake()->boolean(25),
            ]);
        }
    }
}