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
        Schema::create('seat_layouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_type_id')->constrained('bus_types')->onDelete('cascade');
            $table->string('layout_name');
            $table->integer('rows')->default(4);
            $table->integer('columns')->default(4);
            $table->json('seats')->nullabel(); // store seat map data as JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_layouts');
    }
};
