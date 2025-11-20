<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\User;
use App\Models\Bus;
use App\Models\Route;

class BookingFactory extends Factory
{
  protected $model = Booking::class;

  public function definition(): array
  {
    $user = User::inRandomOrder()->first();
    $bus = Bus::inRandomOrder()->first();
    $route = Route::inRandomOrder()->first();

    // Ensure these exist
    if (!$user || !$bus || !$route) {
      throw new \Exception('Cannot create booking: missing User, Bus, or Route records.');
    }

    return [
      'user_id' => $user->id,
      'bus_id' => $bus->id,
      'route_id' => $route->id,
      'trip_id' => null,
      'seat_id' => null,
      'seat_number' => $this->faker->numberBetween(1, 50),
      'seat_type' => $this->faker->randomElement(['economy', 'business', 'vip']),
      'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled', 'completed']),
      'departure_time' => $this->faker->dateTimeBetween('+1 days', '+10 days'),
      'arrival_time' => $this->faker->dateTimeBetween('+11 days', '+20 days'),
      'amount_paid' => $this->faker->randomFloat(2, 100, 1000),
      'payment_status' => $this->faker->randomElement(['unpaid', 'paid', 'refunded']),
      'cancelled_at' => null,
    ];
  }
}

