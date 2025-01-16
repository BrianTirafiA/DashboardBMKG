<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {  
            $table->id();  
            $table->string('name_device')->nullable();  
            $table->string('brand_device')->nullable();
            $table->string('type_device')->nullable();
            $table->year('year_device')->nullable();
            $table->string('os_device')->nullable(); 
            $table->string('processor_device')->nullable();   
            $table->unsignedInteger('ram_device')->nullable(); 
            $table->string('disk_device')->nullable();
            $table->timestamps();  
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices'); 
    }
};
