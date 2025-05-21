<?php

use App\Models\BusFeature;
use App\Models\BusStandard;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('bus_name');
            $table->foreignIdFor(BusStandard::class)->constrained()->onDelete('cascade');
            $table->string('bus_number')->unique();
            $table->string('driver_name');
            $table->string('driver_phone');
            $table->string('driver_license');
            $table->string('co_driver_name');
            $table->string('vehicle_bluebook');
            $table->json('vehicle_images');
            $table->integer('vehicle_seats');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buses');
    }
};
