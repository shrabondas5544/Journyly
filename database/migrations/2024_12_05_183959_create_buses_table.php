<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('operator_name');
            $table->string('from_location');
            $table->string('to_location');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->date('journey_date');
            $table->decimal('original_price', 10, 2);
            $table->decimal('discounted_price', 10, 2);
            $table->integer('available_seats');
            $table->string('operator_logo')->nullable();
            $table->enum('bus_type', ['AC', 'Non AC']);
            $table->string('boarding_point');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buses');
    }
};
