<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacksTable extends Migration
{
    public function up()
    {
        Schema::create('racks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('rack_type_id')->constrained('rack_types')->onDelete('cascade'); // Foreign key
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('racks');
    }
}
