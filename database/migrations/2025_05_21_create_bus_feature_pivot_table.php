<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Schema::create('bus_feature_pivot', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('bus_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('bus_feature_id')->constrained()->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    public function down()
    {
        // Schema::dropIfExists('bus_feature_pivot');
    }
};
