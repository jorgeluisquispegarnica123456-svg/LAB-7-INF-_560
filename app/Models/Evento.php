<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evento extends Model
{
    protected $fillable = [
        "categoria_id",
        "titulo",
        "slug",
        "descripcion",
        "fecha",
        "lugar",
        "cupo",
        "precio",
        "publicado",
        "destacado",
    ];

    protected $casts = [
        "fecha" => "datetime",
        "publicado" => "boolean",
        "destacado" => "boolean",
        "precio" => "decimal:2",
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}