<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("categoria_id")->references("id")->on("categorias")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("user_id")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
            $table->string("nombre", 50);
            $table->string("email", 50)->unique();
            $table->string("telefono", 9);
            $table->string("direccion", 50);
            $table->string("website",50)->nullable();
            $table->text("descripcion")->nullable();
            $table->boolean("publicado")->default(0);
            $table->integer("orden")->default(1);
            $table->integer("visitas")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
