<?php

use App\Models\Autor;
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

        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Autor::class);
            $table->string('titulo');
            $table->float('precio');
            $table->longText('portada');
            $table->longText('descripcion');
            $table->integer('numPaginas');
            $table->string('calificacion');
            $table->date('fechaPublicacion');
            $table->string('genero');
            $table->string('idioma');
            $table->string('isbn')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
