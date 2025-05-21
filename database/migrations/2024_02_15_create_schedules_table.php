<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('bus_routes')->onDelete('cascade');
            $table->foreignId('bus_id')->constrained('buses')->onDelete('cascade');
            $table->date('departure_date');
            $table->time('departure_time');
            $table->integer('duration'); // in hours
            $table->decimal('price', 10, 2);
            $table->string('boarding_point');
            $table->json('food_break')->nullable();
            $table->enum('status', ['upcoming', 'delayed', 'cancelled'])->default('upcoming');
            $table->integer('delay_minutes')->default(0);
            $table->text('status_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
