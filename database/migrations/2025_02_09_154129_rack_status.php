<?php

// database/migrations/2025_02_09_000000_create_statuses_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('rack_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('nama_status');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('statuses');
    }
};
