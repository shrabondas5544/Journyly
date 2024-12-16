<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bus_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('bus_id')->constrained('buses')->onDelete('cascade');
            $table->string('user_name');
            $table->string('operator_name');
            $table->string('from_location');
            $table->string('to_location');
            $table->string('bus_type');
            $table->string('boarding_point');
            $table->date('departure_date');
            $table->date('booking_date');
            $table->integer('number_of_passengers');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('savings', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('payment_status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bus_bookings');
    }
};