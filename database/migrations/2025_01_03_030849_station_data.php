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
        Schema::create('stations', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->timestamp('tanggal');
            $table->decimal('long_station', 10, 6);
            $table->decimal('latt_station', 10, 6);
            $table->string('name_station');
            $table->string('nama_propinsi');
            $table->string('nama_kota');
            $table->string('tipe_station');
            $table->integer('rr_flag');
            $table->integer('pp_air_flag');
            $table->integer('rh_avg_flag');
            $table->integer('sr_avg_flag');
            $table->integer('sr_max_flag');
            $table->integer('nr_flag');
            $table->integer('wd_avg_flag');
            $table->integer('ws_avg_flag');
            $table->integer('ws_max_flag');
            $table->integer('wl_flag');
            $table->integer('tt_air_avg_flag');
            $table->integer('tt_air_min_flag');
            $table->integer('tt_air_max_flag');
            $table->integer('tt_sea_flag');
            $table->integer('ws_50cm_flag');
            $table->integer('wl_pan_flag');
            $table->integer('ev_pan_flag');
            $table->integer('tt_pan_flag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
