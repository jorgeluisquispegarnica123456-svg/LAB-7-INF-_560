<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create("eventos", function (Blueprint $table) {
            $table->id();
            $table->foreignId("categoria_id")->nullable()->constrained("categorias")->nullOnDelete();
            $table->string("titulo");
            $table->string("slug")->unique();
            $table->text("descripcion");
            $table->dateTime("fecha");
            $table->string("lugar");
            $table->integer("cupo")->default(50);
            $table->decimal("precio", 8, 2)->default(0);
            $table->boolean("publicado")->default(true);
            $table->boolean("destacado")->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("eventos");
    }
};