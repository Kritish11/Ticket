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
            $table->string('name');
            $table->foreignId('standard_id')->constrained('bus_standards')->onDelete('cascade');  // Changed from bus_standard_id
            $table->string('number_plate')->unique();
            $table->integer('seats');
            $table->string('driver_name');
            $table->string('driver_license');
            $table->string('driver_bill_book');
            $table->json('images');
            $table->json('features');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buses');
    }
};
