<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rack_type_id')->constrained('rack_types')->onDelete('cascade');
            $table->string('name');
            $table->enum('data_type', ['string', 'integer', 'float', 'boolean', 'date','json']);
            $table->boolean('is_required')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attributes');
    }
}


