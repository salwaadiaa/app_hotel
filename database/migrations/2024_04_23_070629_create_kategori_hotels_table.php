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
        Schema::create('kategori_hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gambar')->nullable();
            $table->string('size')->nullable();
            $table->integer('kapasitas')->nullable();
            $table->string('bed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_hotels');
    }
};
