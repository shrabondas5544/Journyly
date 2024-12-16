<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('flight_id')->constrained()->onDelete('cascade');
            
            // User Information
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone')->nullable();

            // Flight Information
            $table->string('airline_name');
            $table->string('from_location');
            $table->string('to_location');
            $table->string('flight_class');
            $table->string('flight_number');
            
            // Time Slots
            $table->enum('departure_time_slot', [
                '12am_6am',
                '6am_12pm',
                '12pm_6pm',
                '6pm_12am'
            ]);
            $table->enum('arrival_time_slot', [
                '12am_6am',
                '6am_12pm',
                '12pm_6pm',
                '6pm_12am'
            ]);
            
            // Dates
            $table->date('booking_date');  // Today's date when booking is made
            $table->date('departure_date'); // Must be on or after booking_date
            $table->date('return_date')->nullable(); // Optional, must be after departure_date
            
            // Booking Details
            $table->integer('number_of_passengers');
            $table->integer('baggage_allowance');
            
            // Payment Information
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('savings', 10, 2);
            $table->decimal('total', 10, 2);
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');

            // Card Information (Consider encrypting these in production)
            $table->string('card_number')->nullable();
            $table->string('cvv')->nullable();
            $table->date('expiration_date')->nullable();
            
            $table->timestamps();

            // Add indexes for better query performance
            $table->index('booking_date');
            $table->index('departure_date');
            $table->index('return_date');
            $table->index('payment_status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('flight_bookings');
    }
};