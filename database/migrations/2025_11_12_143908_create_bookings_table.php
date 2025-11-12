<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->foreignId('user_id')    // Reference to the user who made the booking
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('bus_id')     // Reference to the bus the booking is for
                  ->constrained('buses')
                  ->onDelete('cascade');
            $table->foreignId('route_id')   // Reference to the route of the bus
                  ->constrained('routes')
                  ->onDelete('cascade');
            $table->string('seat_number')->nullable();  // Seat number
            $table->string('seat_type')->default('economy');  // Seat type
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])
                  ->default('pending');  // Booking status
            $table->timestamp('departure_time')->nullable();
            $table->timestamp('arrival_time')->nullable();
            $table->decimal('amount_paid', 10, 2)->default(0.00);  // Payment amount
            $table->string('payment_status')->default('unpaid');  // Payment status
            $table->string('booking_reference')->unique();  // Unique reference
            $table->timestamp('cancelled_at')->nullable();  // Cancelled time (if applicable)
            $table->timestamp('booking_time')->nullable();  // Time when the booking was created
            $table->timestamps();  // created_at and updated_at timestamps
            $table->softDeletes();  // Soft deletes (deleted_at)

            // Indexing for performance
            $table->index('status');
            $table->index('payment_status');
            $table->index('booking_reference');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
