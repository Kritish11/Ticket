<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('graphics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->boolean('status')->default(1);  // 1 for active, 0 for inactive
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('graphics');
    }
};
