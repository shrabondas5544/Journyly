<?php
// database/migrations/xxxx_xx_xx_create_flights_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('airline_name');
            $table->string('from_location');
            $table->string('to_location');
            $table->enum('departure_time_slot', [
                '12am_6am',  // 12am - 6am
                '6am_12pm',  // 6am - 12pm
                '12pm_6pm',  // 12pm - 6pm
                '6pm_12am'   // 6pm - 12am
            ]);
            $table->enum('arrival_time_slot', [
                '12am_6am',  // 12am - 6am
                '6am_12pm',  // 6am - 12pm
                '12pm_6pm',  // 12pm - 6pm
                '6pm_12am'   // 6pm - 12am
            ]);
            $table->date('departure_date');
            $table->date('return_date')->nullable();
            $table->decimal('original_price', 10, 2);
            $table->decimal('discounted_price', 10, 2);
            $table->integer('available_seats');
            $table->string('airline_logo')->nullable();
            $table->enum('flight_class', ['Economy', 'Business', 'First']);
            $table->integer('baggage_allowance');
            $table->string('flight_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flights');
    }
};
