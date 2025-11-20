<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('trips', function (Blueprint $table) {
      $table->id();

      // foreign keys (optional – adjust depending on your system)
      $table->unsignedBigInteger('route_id')->nullable();
      $table->unsignedBigInteger('bus_id')->nullable();

      $table->string('trip_code')->unique()->nullable();
      $table->date('trip_date');
      $table->time('departure_time');
      $table->time('arrival_time')->nullable();

      $table->integer('available_seats')->default(0);
      $table->decimal('fare', 10, 2)->nullable();

      $table->boolean('is_active')->default(true);

      $table->timestamps();

      // relationships
      $table->foreign('route_id')->references('id')->on('routes')->onDelete('set null');
      $table->foreign('bus_id')->references('id')->on('buses')->onDelete('set null');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('trips');
  }
};
