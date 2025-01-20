<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE OR REPLACE VIEW station_flag_summary AS
WITH aggregated_data AS (
    SELECT
        name_station,
		tipe_station,
		long_station,
		latt_station,
		nama_propinsi,
        DATE(tanggal) AS date_only,
        COUNT(*) AS total_records,

        -- Calculate counts for rr_flag (values 0-9)
        COUNT(CASE WHEN rr_flag = 0 THEN 1 END) AS rr_flag_0,
        COUNT(CASE WHEN rr_flag = 1 THEN 1 END) AS rr_flag_1,
        COUNT(CASE WHEN rr_flag = 2 THEN 1 END) AS rr_flag_2,
        COUNT(CASE WHEN rr_flag = 3 THEN 1 END) AS rr_flag_3,
        COUNT(CASE WHEN rr_flag = 4 THEN 1 END) AS rr_flag_4,
        COUNT(CASE WHEN rr_flag = 5 THEN 1 END) AS rr_flag_5,
        COUNT(CASE WHEN rr_flag = 6 THEN 1 END) AS rr_flag_6,
        COUNT(CASE WHEN rr_flag = 7 THEN 1 END) AS rr_flag_7,
        COUNT(CASE WHEN rr_flag = 8 THEN 1 END) AS rr_flag_8,
        COUNT(CASE WHEN rr_flag = 9 THEN 1 END) AS rr_flag_9,

        -- Calculate counts for pp_air_flag (values 0-9)
        COUNT(CASE WHEN pp_air_flag = 0 THEN 1 END) AS pp_air_flag_0,
        COUNT(CASE WHEN pp_air_flag = 1 THEN 1 END) AS pp_air_flag_1,
        COUNT(CASE WHEN pp_air_flag = 2 THEN 1 END) AS pp_air_flag_2,
        COUNT(CASE WHEN pp_air_flag = 3 THEN 1 END) AS pp_air_flag_3,
        COUNT(CASE WHEN pp_air_flag = 4 THEN 1 END) AS pp_air_flag_4,
        COUNT(CASE WHEN pp_air_flag = 5 THEN 1 END) AS pp_air_flag_5,
        COUNT(CASE WHEN pp_air_flag = 6 THEN 1 END) AS pp_air_flag_6,
        COUNT(CASE WHEN pp_air_flag = 7 THEN 1 END) AS pp_air_flag_7,
        COUNT(CASE WHEN pp_air_flag = 8 THEN 1 END) AS pp_air_flag_8,
        COUNT(CASE WHEN pp_air_flag = 9 THEN 1 END) AS pp_air_flag_9,

        -- Calculate counts for rh_avg_flag (values 0-9)
        COUNT(CASE WHEN rh_avg_flag = 0 THEN 1 END) AS rh_avg_flag_0,
        COUNT(CASE WHEN rh_avg_flag = 1 THEN 1 END) AS rh_avg_flag_1,
        COUNT(CASE WHEN rh_avg_flag = 2 THEN 1 END) AS rh_avg_flag_2,
        COUNT(CASE WHEN rh_avg_flag = 3 THEN 1 END) AS rh_avg_flag_3,
        COUNT(CASE WHEN rh_avg_flag = 4 THEN 1 END) AS rh_avg_flag_4,
        COUNT(CASE WHEN rh_avg_flag = 5 THEN 1 END) AS rh_avg_flag_5,
        COUNT(CASE WHEN rh_avg_flag = 6 THEN 1 END) AS rh_avg_flag_6,
        COUNT(CASE WHEN rh_avg_flag = 7 THEN 1 END) AS rh_avg_flag_7,
        COUNT(CASE WHEN rh_avg_flag = 8 THEN 1 END) AS rh_avg_flag_8,
        COUNT(CASE WHEN rh_avg_flag = 9 THEN 1 END) AS rh_avg_flag_9,

        -- Calculate counts for sr_avg_flag (values 0-9)
        COUNT(CASE WHEN sr_avg_flag = 0 THEN 1 END) AS sr_avg_flag_0,
        COUNT(CASE WHEN sr_avg_flag = 1 THEN 1 END) AS sr_avg_flag_1,
        COUNT(CASE WHEN sr_avg_flag = 2 THEN 1 END) AS sr_avg_flag_2,
        COUNT(CASE WHEN sr_avg_flag = 3 THEN 1 END) AS sr_avg_flag_3,
        COUNT(CASE WHEN sr_avg_flag = 4 THEN 1 END) AS sr_avg_flag_4,
        COUNT(CASE WHEN sr_avg_flag = 5 THEN 1 END) AS sr_avg_flag_5,
        COUNT(CASE WHEN sr_avg_flag = 6 THEN 1 END) AS sr_avg_flag_6,
        COUNT(CASE WHEN sr_avg_flag = 7 THEN 1 END) AS sr_avg_flag_7,
        COUNT(CASE WHEN sr_avg_flag = 8 THEN 1 END) AS sr_avg_flag_8,
        COUNT(CASE WHEN sr_avg_flag = 9 THEN 1 END) AS sr_avg_flag_9,

        -- Calculate counts for sr_max_flag (values 0-9)
        COUNT(CASE WHEN sr_max_flag = 0 THEN 1 END) AS sr_max_flag_0,
        COUNT(CASE WHEN sr_max_flag = 1 THEN 1 END) AS sr_max_flag_1,
        COUNT(CASE WHEN sr_max_flag = 2 THEN 1 END) AS sr_max_flag_2,
        COUNT(CASE WHEN sr_max_flag = 3 THEN 1 END) AS sr_max_flag_3,
        COUNT(CASE WHEN sr_max_flag = 4 THEN 1 END) AS sr_max_flag_4,
        COUNT(CASE WHEN sr_max_flag = 5 THEN 1 END) AS sr_max_flag_5,
        COUNT(CASE WHEN sr_max_flag = 6 THEN 1 END) AS sr_max_flag_6,
        COUNT(CASE WHEN sr_max_flag = 7 THEN 1 END) AS sr_max_flag_7,
        COUNT(CASE WHEN sr_max_flag = 8 THEN 1 END) AS sr_max_flag_8,
        COUNT(CASE WHEN sr_max_flag = 9 THEN 1 END) AS sr_max_flag_9,

        -- Calculate counts for nr_flag (values 0-9)
        COUNT(CASE WHEN nr_flag = 0 THEN 1 END) AS nr_flag_0,
        COUNT(CASE WHEN nr_flag = 1 THEN 1 END) AS nr_flag_1,
        COUNT(CASE WHEN nr_flag = 2 THEN 1 END) AS nr_flag_2,
        COUNT(CASE WHEN nr_flag = 3 THEN 1 END) AS nr_flag_3,
        COUNT(CASE WHEN nr_flag = 4 THEN 1 END) AS nr_flag_4,
        COUNT(CASE WHEN nr_flag = 5 THEN 1 END) AS nr_flag_5,
        COUNT(CASE WHEN nr_flag = 6 THEN 1 END) AS nr_flag_6,
        COUNT(CASE WHEN nr_flag = 7 THEN 1 END) AS nr_flag_7,
        COUNT(CASE WHEN nr_flag = 8 THEN 1 END) AS nr_flag_8,
        COUNT(CASE WHEN nr_flag = 9 THEN 1 END) AS nr_flag_9,

        -- Calculate counts for wd_avg_flag (values 0-9)
        COUNT(CASE WHEN wd_avg_flag = 0 THEN 1 END) AS wd_avg_flag_0,
        COUNT(CASE WHEN wd_avg_flag = 1 THEN 1 END) AS wd_avg_flag_1,
        COUNT(CASE WHEN wd_avg_flag = 2 THEN 1 END) AS wd_avg_flag_2,
        COUNT(CASE WHEN wd_avg_flag = 3 THEN 1 END) AS wd_avg_flag_3,
        COUNT(CASE WHEN wd_avg_flag = 4 THEN 1 END) AS wd_avg_flag_4,
        COUNT(CASE WHEN wd_avg_flag = 5 THEN 1 END) AS wd_avg_flag_5,
        COUNT(CASE WHEN wd_avg_flag = 6 THEN 1 END) AS wd_avg_flag_6,
        COUNT(CASE WHEN wd_avg_flag = 7 THEN 1 END) AS wd_avg_flag_7,
        COUNT(CASE WHEN wd_avg_flag = 8 THEN 1 END) AS wd_avg_flag_8,
        COUNT(CASE WHEN wd_avg_flag = 9 THEN 1 END) AS wd_avg_flag_9,

		-- Calculate counts for wd_avg_flag (values 0-9)
        COUNT(CASE WHEN ws_avg_flag = 0 THEN 1 END) AS ws_avg_flag_0,
        COUNT(CASE WHEN ws_avg_flag = 1 THEN 1 END) AS ws_avg_flag_1,
        COUNT(CASE WHEN ws_avg_flag = 2 THEN 1 END) AS ws_avg_flag_2,
        COUNT(CASE WHEN ws_avg_flag = 3 THEN 1 END) AS ws_avg_flag_3,
        COUNT(CASE WHEN ws_avg_flag = 4 THEN 1 END) AS ws_avg_flag_4,
        COUNT(CASE WHEN ws_avg_flag = 5 THEN 1 END) AS ws_avg_flag_5,
        COUNT(CASE WHEN ws_avg_flag = 6 THEN 1 END) AS ws_avg_flag_6,
        COUNT(CASE WHEN ws_avg_flag = 7 THEN 1 END) AS ws_avg_flag_7,
        COUNT(CASE WHEN ws_avg_flag = 8 THEN 1 END) AS ws_avg_flag_8,
        COUNT(CASE WHEN ws_avg_flag = 9 THEN 1 END) AS ws_avg_flag_9,

		-- Calculate counts for ws_max_flag (values 0-9)
        COUNT(CASE WHEN ws_max_flag = 0 THEN 1 END) AS ws_max_flag_0,
        COUNT(CASE WHEN ws_max_flag = 1 THEN 1 END) AS ws_max_flag_1,
        COUNT(CASE WHEN ws_max_flag = 2 THEN 1 END) AS ws_max_flag_2,
        COUNT(CASE WHEN ws_max_flag = 3 THEN 1 END) AS ws_max_flag_3,
        COUNT(CASE WHEN ws_max_flag = 4 THEN 1 END) AS ws_max_flag_4,
        COUNT(CASE WHEN ws_max_flag = 5 THEN 1 END) AS ws_max_flag_5,
        COUNT(CASE WHEN ws_max_flag = 6 THEN 1 END) AS ws_max_flag_6,
        COUNT(CASE WHEN ws_max_flag = 7 THEN 1 END) AS ws_max_flag_7,
        COUNT(CASE WHEN ws_max_flag = 8 THEN 1 END) AS ws_max_flag_8,
        COUNT(CASE WHEN ws_max_flag = 9 THEN 1 END) AS ws_max_flag_9,

		-- Calculate counts for wl_flag (values 0-9)
        COUNT(CASE WHEN wl_flag = 0 THEN 1 END) AS wl_flag_0,
        COUNT(CASE WHEN wl_flag = 1 THEN 1 END) AS wl_flag_1,
        COUNT(CASE WHEN wl_flag = 2 THEN 1 END) AS wl_flag_2,
        COUNT(CASE WHEN wl_flag = 3 THEN 1 END) AS wl_flag_3,
        COUNT(CASE WHEN wl_flag = 4 THEN 1 END) AS wl_flag_4,
        COUNT(CASE WHEN wl_flag = 5 THEN 1 END) AS wl_flag_5,
        COUNT(CASE WHEN wl_flag = 6 THEN 1 END) AS wl_flag_6,
        COUNT(CASE WHEN wl_flag = 7 THEN 1 END) AS wl_flag_7,
        COUNT(CASE WHEN wl_flag = 8 THEN 1 END) AS wl_flag_8,
        COUNT(CASE WHEN wl_flag = 9 THEN 1 END) AS wl_flag_9,

		-- Calculate counts for tt_air_avg_flag (values 0-9)
		COUNT(CASE WHEN tt_air_avg_flag = 0 THEN 1 END) AS tt_air_avg_flag_0,
        COUNT(CASE WHEN tt_air_avg_flag = 1 THEN 1 END) AS tt_air_avg_flag_1,
        COUNT(CASE WHEN tt_air_avg_flag = 2 THEN 1 END) AS tt_air_avg_flag_2,
        COUNT(CASE WHEN tt_air_avg_flag = 3 THEN 1 END) AS tt_air_avg_flag_3,
        COUNT(CASE WHEN tt_air_avg_flag = 4 THEN 1 END) AS tt_air_avg_flag_4,
        COUNT(CASE WHEN tt_air_avg_flag = 5 THEN 1 END) AS tt_air_avg_flag_5,
        COUNT(CASE WHEN tt_air_avg_flag = 6 THEN 1 END) AS tt_air_avg_flag_6,
        COUNT(CASE WHEN tt_air_avg_flag = 7 THEN 1 END) AS tt_air_avg_flag_7,
        COUNT(CASE WHEN tt_air_avg_flag = 8 THEN 1 END) AS tt_air_avg_flag_8,
        COUNT(CASE WHEN tt_air_avg_flag = 9 THEN 1 END) AS tt_air_avg_flag_9,

		-- Calculate counts for tt_air_min_flag (values 0-9)
        COUNT(CASE WHEN tt_air_min_flag = 0 THEN 1 END) AS tt_air_min_flag_0,
        COUNT(CASE WHEN tt_air_min_flag = 1 THEN 1 END) AS tt_air_min_flag_1,
        COUNT(CASE WHEN tt_air_min_flag = 2 THEN 1 END) AS tt_air_min_flag_2,
        COUNT(CASE WHEN tt_air_min_flag = 3 THEN 1 END) AS tt_air_min_flag_3,
        COUNT(CASE WHEN tt_air_min_flag = 4 THEN 1 END) AS tt_air_min_flag_4,
        COUNT(CASE WHEN tt_air_min_flag = 5 THEN 1 END) AS tt_air_min_flag_5,
        COUNT(CASE WHEN tt_air_min_flag = 6 THEN 1 END) AS tt_air_min_flag_6,
        COUNT(CASE WHEN tt_air_min_flag = 7 THEN 1 END) AS tt_air_min_flag_7,
        COUNT(CASE WHEN tt_air_min_flag = 8 THEN 1 END) AS tt_air_min_flag_8,
        COUNT(CASE WHEN tt_air_min_flag = 9 THEN 1 END) AS tt_air_min_flag_9,

		-- Calculate counts for tt_air_max_flag (values 0-9)
        COUNT(CASE WHEN tt_air_max_flag = 0 THEN 1 END) AS tt_air_max_flag_0,
        COUNT(CASE WHEN tt_air_max_flag = 1 THEN 1 END) AS tt_air_max_flag_1,
        COUNT(CASE WHEN tt_air_max_flag = 2 THEN 1 END) AS tt_air_max_flag_2,
        COUNT(CASE WHEN tt_air_max_flag = 3 THEN 1 END) AS tt_air_max_flag_3,
        COUNT(CASE WHEN tt_air_max_flag = 4 THEN 1 END) AS tt_air_max_flag_4,
        COUNT(CASE WHEN tt_air_max_flag = 5 THEN 1 END) AS tt_air_max_flag_5,
        COUNT(CASE WHEN tt_air_max_flag = 6 THEN 1 END) AS tt_air_max_flag_6,
        COUNT(CASE WHEN tt_air_max_flag = 7 THEN 1 END) AS tt_air_max_flag_7,
        COUNT(CASE WHEN tt_air_max_flag = 8 THEN 1 END) AS tt_air_max_flag_8,
        COUNT(CASE WHEN tt_air_max_flag = 9 THEN 1 END) AS tt_air_max_flag_9,

		-- Calculate counts for tt_sea_flag (values 0-9)
        COUNT(CASE WHEN tt_sea_flag = 0 THEN 1 END) AS tt_sea_flag_0,
        COUNT(CASE WHEN tt_sea_flag = 1 THEN 1 END) AS tt_sea_flag_1,
        COUNT(CASE WHEN tt_sea_flag = 2 THEN 1 END) AS tt_sea_flag_2,
        COUNT(CASE WHEN tt_sea_flag = 3 THEN 1 END) AS tt_sea_flag_3,
        COUNT(CASE WHEN tt_sea_flag = 4 THEN 1 END) AS tt_sea_flag_4,
        COUNT(CASE WHEN tt_sea_flag = 5 THEN 1 END) AS tt_sea_flag_5,
        COUNT(CASE WHEN tt_sea_flag = 6 THEN 1 END) AS tt_sea_flag_6,
        COUNT(CASE WHEN tt_sea_flag = 7 THEN 1 END) AS tt_sea_flag_7,
        COUNT(CASE WHEN tt_sea_flag = 8 THEN 1 END) AS tt_sea_flag_8,
        COUNT(CASE WHEN tt_sea_flag = 9 THEN 1 END) AS tt_sea_flag_9,

		-- Calculate counts for ws_50cm_flag (values 0-9)
        COUNT(CASE WHEN ws_50cm_flag = 0 THEN 1 END) AS ws_50cm_flag_0,
        COUNT(CASE WHEN ws_50cm_flag = 1 THEN 1 END) AS ws_50cm_flag_1,
        COUNT(CASE WHEN ws_50cm_flag = 2 THEN 1 END) AS ws_50cm_flag_2,
        COUNT(CASE WHEN ws_50cm_flag = 3 THEN 1 END) AS ws_50cm_flag_3,
        COUNT(CASE WHEN ws_50cm_flag = 4 THEN 1 END) AS ws_50cm_flag_4,
        COUNT(CASE WHEN ws_50cm_flag = 5 THEN 1 END) AS ws_50cm_flag_5,
        COUNT(CASE WHEN ws_50cm_flag = 6 THEN 1 END) AS ws_50cm_flag_6,
        COUNT(CASE WHEN ws_50cm_flag = 7 THEN 1 END) AS ws_50cm_flag_7,
        COUNT(CASE WHEN ws_50cm_flag = 8 THEN 1 END) AS ws_50cm_flag_8,
        COUNT(CASE WHEN ws_50cm_flag = 9 THEN 1 END) AS ws_50cm_flag_9,

		-- Calculate counts for wl_pan_flag (values 0-9)
        COUNT(CASE WHEN wl_pan_flag = 0 THEN 1 END) AS wl_pan_flag_0,
        COUNT(CASE WHEN wl_pan_flag = 1 THEN 1 END) AS wl_pan_flag_1,
        COUNT(CASE WHEN wl_pan_flag = 2 THEN 1 END) AS wl_pan_flag_2,
        COUNT(CASE WHEN wl_pan_flag = 3 THEN 1 END) AS wl_pan_flag_3,
        COUNT(CASE WHEN wl_pan_flag = 4 THEN 1 END) AS wl_pan_flag_4,
        COUNT(CASE WHEN wl_pan_flag = 5 THEN 1 END) AS wl_pan_flag_5,
        COUNT(CASE WHEN wl_pan_flag = 6 THEN 1 END) AS wl_pan_flag_6,
        COUNT(CASE WHEN wl_pan_flag = 7 THEN 1 END) AS wl_pan_flag_7,
        COUNT(CASE WHEN wl_pan_flag = 8 THEN 1 END) AS wl_pan_flag_8,
        COUNT(CASE WHEN wl_pan_flag = 9 THEN 1 END) AS wl_pan_flag_9,

		-- Calculate counts for ev_pan_flag (values 0-9)
        COUNT(CASE WHEN ev_pan_flag = 0 THEN 1 END) AS ev_pan_flag_0,
        COUNT(CASE WHEN ev_pan_flag = 1 THEN 1 END) AS ev_pan_flag_1,
        COUNT(CASE WHEN ev_pan_flag = 2 THEN 1 END) AS ev_pan_flag_2,
        COUNT(CASE WHEN ev_pan_flag = 3 THEN 1 END) AS ev_pan_flag_3,
        COUNT(CASE WHEN ev_pan_flag = 4 THEN 1 END) AS ev_pan_flag_4,
        COUNT(CASE WHEN ev_pan_flag = 5 THEN 1 END) AS ev_pan_flag_5,
        COUNT(CASE WHEN ev_pan_flag = 6 THEN 1 END) AS ev_pan_flag_6,
        COUNT(CASE WHEN ev_pan_flag = 7 THEN 1 END) AS ev_pan_flag_7,
        COUNT(CASE WHEN ev_pan_flag = 8 THEN 1 END) AS ev_pan_flag_8,
        COUNT(CASE WHEN ev_pan_flag = 9 THEN 1 END) AS ev_pan_flag_9,

		-- Calculate counts for tt_pan_flag (values 0-9)
        COUNT(CASE WHEN tt_pan_flag = 0 THEN 1 END) AS tt_pan_flag_0,
        COUNT(CASE WHEN tt_pan_flag = 1 THEN 1 END) AS tt_pan_flag_1,
        COUNT(CASE WHEN tt_pan_flag = 2 THEN 1 END) AS tt_pan_flag_2,
        COUNT(CASE WHEN tt_pan_flag = 3 THEN 1 END) AS tt_pan_flag_3,
        COUNT(CASE WHEN tt_pan_flag = 4 THEN 1 END) AS tt_pan_flag_4,
        COUNT(CASE WHEN tt_pan_flag = 5 THEN 1 END) AS tt_pan_flag_5,
        COUNT(CASE WHEN tt_pan_flag = 6 THEN 1 END) AS tt_pan_flag_6,
        COUNT(CASE WHEN tt_pan_flag = 7 THEN 1 END) AS tt_pan_flag_7,
        COUNT(CASE WHEN tt_pan_flag = 8 THEN 1 END) AS tt_pan_flag_8,
        COUNT(CASE WHEN tt_pan_flag = 9 THEN 1 END) AS tt_pan_flag_9,

		-- Calculate total counts of all flag values combined
        COUNT(CASE WHEN rr_flag IS NOT NULL THEN 1 END) +
        COUNT(CASE WHEN pp_air_flag IS NOT NULL THEN 1 END) +
		COUNT(CASE WHEN rh_avg_flag IS NOT NULL THEN 1 END) +
        COUNT(CASE WHEN sr_avg_flag IS NOT NULL THEN 1 END) +
		COUNT(CASE WHEN sr_max_flag IS NOT NULL THEN 1 END) +
        COUNT(CASE WHEN nr_flag IS NOT NULL THEN 1 END) +
		COUNT(CASE WHEN wd_avg_flag IS NOT NULL THEN 1 END) +
        COUNT(CASE WHEN ws_avg_flag IS NOT NULL THEN 1 END) +
		COUNT(CASE WHEN ws_max_flag IS NOT NULL THEN 1 END) +
		COUNT(CASE WHEN wl_flag IS NOT NULL THEN 1 END) +
        COUNT(CASE WHEN tt_air_avg_flag IS NOT NULL THEN 1 END) +
		COUNT(CASE WHEN tt_air_min_flag IS NOT NULL THEN 1 END) +
        COUNT(CASE WHEN tt_air_max_flag IS NOT NULL THEN 1 END) +
		COUNT(CASE WHEN tt_sea_flag IS NOT NULL THEN 1 END) +
        COUNT(CASE WHEN ws_50cm_flag IS NOT NULL THEN 1 END) +
		COUNT(CASE WHEN wl_pan_flag IS NOT NULL THEN 1 END) +
        COUNT(CASE WHEN ev_pan_flag IS NOT NULL THEN 1 END) +
		COUNT(CASE WHEN tt_pan_flag IS NOT NULL THEN 1 END) AS total_flag_values
	
	FROM stations
    GROUP BY DATE(tanggal), name_station, tipe_station, long_station, latt_station, nama_propinsi
),
percentages AS (
    SELECT
		date_only,
        name_station,
		tipe_station,
		long_station,
		latt_station,
		nama_propinsi,
		total_records,

        -- Calculate percentages for rr_flag (values 0-9)
        rr_flag_0::FLOAT / total_records * 100 AS rr_flag_0_percent,
        rr_flag_1::FLOAT / total_records * 100 AS rr_flag_1_percent,
        rr_flag_2::FLOAT / total_records * 100 AS rr_flag_2_percent,
        rr_flag_3::FLOAT / total_records * 100 AS rr_flag_3_percent,
        rr_flag_4::FLOAT / total_records * 100 AS rr_flag_4_percent,
        rr_flag_5::FLOAT / total_records * 100 AS rr_flag_5_percent,
        rr_flag_6::FLOAT / total_records * 100 AS rr_flag_6_percent,
        rr_flag_7::FLOAT / total_records * 100 AS rr_flag_7_percent,
        rr_flag_8::FLOAT / total_records * 100 AS rr_flag_8_percent,
        rr_flag_9::FLOAT / total_records * 100 AS rr_flag_9_percent,

        -- Calculate percentages for pp_air_flag (values 0-9)
        pp_air_flag_0::FLOAT / total_records * 100 AS pp_air_flag_0_percent,
        pp_air_flag_1::FLOAT / total_records * 100 AS pp_air_flag_1_percent,
        pp_air_flag_2::FLOAT / total_records * 100 AS pp_air_flag_2_percent,
        pp_air_flag_3::FLOAT / total_records * 100 AS pp_air_flag_3_percent,
        pp_air_flag_4::FLOAT / total_records * 100 AS pp_air_flag_4_percent,
        pp_air_flag_5::FLOAT / total_records * 100 AS pp_air_flag_5_percent,
        pp_air_flag_6::FLOAT / total_records * 100 AS pp_air_flag_6_percent,
        pp_air_flag_7::FLOAT / total_records * 100 AS pp_air_flag_7_percent,
        pp_air_flag_8::FLOAT / total_records * 100 AS pp_air_flag_8_percent,
        pp_air_flag_9::FLOAT / total_records * 100 AS pp_air_flag_9_percent,

        -- Calculate percentages for rh_avg_flag (values 0-9)
        rh_avg_flag_0::FLOAT / total_records * 100 AS rh_avg_flag_0_percent,
        rh_avg_flag_1::FLOAT / total_records * 100 AS rh_avg_flag_1_percent,
        rh_avg_flag_2::FLOAT / total_records * 100 AS rh_avg_flag_2_percent,
        rh_avg_flag_3::FLOAT / total_records * 100 AS rh_avg_flag_3_percent,
        rh_avg_flag_4::FLOAT / total_records * 100 AS rh_avg_flag_4_percent,
        rh_avg_flag_5::FLOAT / total_records * 100 AS rh_avg_flag_5_percent,
        rh_avg_flag_6::FLOAT / total_records * 100 AS rh_avg_flag_6_percent,
        rh_avg_flag_7::FLOAT / total_records * 100 AS rh_avg_flag_7_percent,
        rh_avg_flag_8::FLOAT / total_records * 100 AS rh_avg_flag_8_percent,
        rh_avg_flag_9::FLOAT / total_records * 100 AS rh_avg_flag_9_percent,

		-- Calculate percentages for sr_avg_flag (values 0-9)
        sr_avg_flag_0::FLOAT / total_records * 100 AS sr_avg_flag_0_percent,
        sr_avg_flag_1::FLOAT / total_records * 100 AS sr_avg_flag_1_percent,
        sr_avg_flag_2::FLOAT / total_records * 100 AS sr_avg_flag_2_percent,
        sr_avg_flag_3::FLOAT / total_records * 100 AS sr_avg_flag_3_percent,
        sr_avg_flag_4::FLOAT / total_records * 100 AS sr_avg_flag_4_percent,
        sr_avg_flag_5::FLOAT / total_records * 100 AS sr_avg_flag_5_percent,
        sr_avg_flag_6::FLOAT / total_records * 100 AS sr_avg_flag_6_percent,
        sr_avg_flag_7::FLOAT / total_records * 100 AS sr_avg_flag_7_percent,
        sr_avg_flag_8::FLOAT / total_records * 100 AS sr_avg_flag_8_percent,
        sr_avg_flag_9::FLOAT / total_records * 100 AS sr_avg_flag_9_percent,

		-- Calculate percentages for sr_max_flag (values 0-9)
        sr_max_flag_0::FLOAT / total_records * 100 AS sr_max_flag_0_percent,
        sr_max_flag_1::FLOAT / total_records * 100 AS sr_max_flag_1_percent,
        sr_max_flag_2::FLOAT / total_records * 100 AS sr_max_flag_2_percent,
        sr_max_flag_3::FLOAT / total_records * 100 AS sr_max_flag_3_percent,
        sr_max_flag_4::FLOAT / total_records * 100 AS sr_max_flag_4_percent,
        sr_max_flag_5::FLOAT / total_records * 100 AS sr_max_flag_5_percent,
        sr_max_flag_6::FLOAT / total_records * 100 AS sr_max_flag_6_percent,
        sr_max_flag_7::FLOAT / total_records * 100 AS sr_max_flag_7_percent,
        sr_max_flag_8::FLOAT / total_records * 100 AS sr_max_flag_8_percent,
        sr_max_flag_9::FLOAT / total_records * 100 AS sr_max_flag_9_percent,

		-- Calculate percentages for nr_flag (values 0-9)
        nr_flag_0::FLOAT / total_records * 100 AS nr_flag_0_percent,
        nr_flag_1::FLOAT / total_records * 100 AS nr_flag_1_percent,
        nr_flag_2::FLOAT / total_records * 100 AS nr_flag_2_percent,
        nr_flag_3::FLOAT / total_records * 100 AS nr_flag_3_percent,
        nr_flag_4::FLOAT / total_records * 100 AS nr_flag_4_percent,
        nr_flag_5::FLOAT / total_records * 100 AS nr_flag_5_percent,
        nr_flag_6::FLOAT / total_records * 100 AS nr_flag_6_percent,
        nr_flag_7::FLOAT / total_records * 100 AS nr_flag_7_percent,
        nr_flag_8::FLOAT / total_records * 100 AS nr_flag_8_percent,
        nr_flag_9::FLOAT / total_records * 100 AS nr_flag_9_percent,

		-- Calculate percentages for wd_avg_flag (values 0-9)
        wd_avg_flag_0::FLOAT / total_records * 100 AS wd_avg_flag_0_percent,
        wd_avg_flag_1::FLOAT / total_records * 100 AS wd_avg_flag_1_percent,
        wd_avg_flag_2::FLOAT / total_records * 100 AS wd_avg_flag_2_percent,
        wd_avg_flag_3::FLOAT / total_records * 100 AS wd_avg_flag_3_percent,
        wd_avg_flag_4::FLOAT / total_records * 100 AS wd_avg_flag_4_percent,
        wd_avg_flag_5::FLOAT / total_records * 100 AS wd_avg_flag_5_percent,
        wd_avg_flag_6::FLOAT / total_records * 100 AS wd_avg_flag_6_percent,
        wd_avg_flag_7::FLOAT / total_records * 100 AS wd_avg_flag_7_percent,
        wd_avg_flag_8::FLOAT / total_records * 100 AS wd_avg_flag_8_percent,
        wd_avg_flag_9::FLOAT / total_records * 100 AS wd_avg_flag_9_percent,

		-- Calculate percentages for ws_avg_flag (values 0-9)
        ws_avg_flag_0::FLOAT / total_records * 100 AS ws_avg_flag_0_percent,
        ws_avg_flag_1::FLOAT / total_records * 100 AS ws_avg_flag_1_percent,
        ws_avg_flag_2::FLOAT / total_records * 100 AS ws_avg_flag_2_percent,
        ws_avg_flag_3::FLOAT / total_records * 100 AS ws_avg_flag_3_percent,
        ws_avg_flag_4::FLOAT / total_records * 100 AS ws_avg_flag_4_percent,
        ws_avg_flag_5::FLOAT / total_records * 100 AS ws_avg_flag_5_percent,
        ws_avg_flag_6::FLOAT / total_records * 100 AS ws_avg_flag_6_percent,
        ws_avg_flag_7::FLOAT / total_records * 100 AS ws_avg_flag_7_percent,
        ws_avg_flag_8::FLOAT / total_records * 100 AS ws_avg_flag_8_percent,
        ws_avg_flag_9::FLOAT / total_records * 100 AS ws_avg_flag_9_percent,

		-- Calculate percentages for ws_max_flag (values 0-9)
        ws_max_flag_0::FLOAT / total_records * 100 AS ws_max_flag_0_percent,
        ws_max_flag_1::FLOAT / total_records * 100 AS ws_max_flag_1_percent,
        ws_max_flag_2::FLOAT / total_records * 100 AS ws_max_flag_2_percent,
        ws_max_flag_3::FLOAT / total_records * 100 AS ws_max_flag_3_percent,
        ws_max_flag_4::FLOAT / total_records * 100 AS ws_max_flag_4_percent,
        ws_max_flag_5::FLOAT / total_records * 100 AS ws_max_flag_5_percent,
        ws_max_flag_6::FLOAT / total_records * 100 AS ws_max_flag_6_percent,
        ws_max_flag_7::FLOAT / total_records * 100 AS ws_max_flag_7_percent,
        ws_max_flag_8::FLOAT / total_records * 100 AS ws_max_flag_8_percent,
        ws_max_flag_9::FLOAT / total_records * 100 AS ws_max_flag_9_percent,

		-- Calculate percentages for wl_flag (values 0-9)
        wl_flag_0::FLOAT / total_records * 100 AS wl_flag_0_percent,
        wl_flag_1::FLOAT / total_records * 100 AS wl_flag_1_percent,
        wl_flag_2::FLOAT / total_records * 100 AS wl_flag_2_percent,
        wl_flag_3::FLOAT / total_records * 100 AS wl_flag_3_percent,
        wl_flag_4::FLOAT / total_records * 100 AS wl_flag_4_percent,
        wl_flag_5::FLOAT / total_records * 100 AS wl_flag_5_percent,
        wl_flag_6::FLOAT / total_records * 100 AS wl_flag_6_percent,
        wl_flag_7::FLOAT / total_records * 100 AS wl_flag_7_percent,
        wl_flag_8::FLOAT / total_records * 100 AS wl_flag_8_percent,
        wl_flag_9::FLOAT / total_records * 100 AS wl_flag_9_percent,

		-- Calculate percentages for tt_air_avg_flag (values 0-9)
        tt_air_avg_flag_0::FLOAT / total_records * 100 AS tt_air_avg_flag_0_percent,
        tt_air_avg_flag_1::FLOAT / total_records * 100 AS tt_air_avg_flag_1_percent,
        tt_air_avg_flag_2::FLOAT / total_records * 100 AS tt_air_avg_flag_2_percent,
        tt_air_avg_flag_3::FLOAT / total_records * 100 AS tt_air_avg_flag_3_percent,
        tt_air_avg_flag_4::FLOAT / total_records * 100 AS tt_air_avg_flag_4_percent,
        tt_air_avg_flag_5::FLOAT / total_records * 100 AS tt_air_avg_flag_5_percent,
        tt_air_avg_flag_6::FLOAT / total_records * 100 AS tt_air_avg_flag_6_percent,
        tt_air_avg_flag_7::FLOAT / total_records * 100 AS tt_air_avg_flag_7_percent,
        tt_air_avg_flag_8::FLOAT / total_records * 100 AS tt_air_avg_flag_8_percent,
        tt_air_avg_flag_9::FLOAT / total_records * 100 AS tt_air_avg_flag_9_percent,

		-- Calculate percentages for tt_air_min_flag (values 0-9)
        tt_air_min_flag_0::FLOAT / total_records * 100 AS tt_air_min_flag_0_percent,
        tt_air_min_flag_1::FLOAT / total_records * 100 AS tt_air_min_flag_1_percent,
        tt_air_min_flag_2::FLOAT / total_records * 100 AS tt_air_min_flag_2_percent,
        tt_air_min_flag_3::FLOAT / total_records * 100 AS tt_air_min_flag_3_percent,
        tt_air_min_flag_4::FLOAT / total_records * 100 AS tt_air_min_flag_4_percent,
        tt_air_min_flag_5::FLOAT / total_records * 100 AS tt_air_min_flag_5_percent,
        tt_air_min_flag_6::FLOAT / total_records * 100 AS tt_air_min_flag_6_percent,
        tt_air_min_flag_7::FLOAT / total_records * 100 AS tt_air_min_flag_7_percent,
        tt_air_min_flag_8::FLOAT / total_records * 100 AS tt_air_min_flag_8_percent,
        tt_air_min_flag_9::FLOAT / total_records * 100 AS tt_air_min_flag_9_percent,

		-- Calculate percentages for tt_air_max_flag (values 0-9)
        tt_air_max_flag_0::FLOAT / total_records * 100 AS tt_air_max_flag_0_percent,
        tt_air_max_flag_1::FLOAT / total_records * 100 AS tt_air_max_flag_1_percent,
        tt_air_max_flag_2::FLOAT / total_records * 100 AS tt_air_max_flag_2_percent,
        tt_air_max_flag_3::FLOAT / total_records * 100 AS tt_air_max_flag_3_percent,
        tt_air_max_flag_4::FLOAT / total_records * 100 AS tt_air_max_flag_4_percent,
        tt_air_max_flag_5::FLOAT / total_records * 100 AS tt_air_max_flag_5_percent,
        tt_air_max_flag_6::FLOAT / total_records * 100 AS tt_air_max_flag_6_percent,
        tt_air_max_flag_7::FLOAT / total_records * 100 AS tt_air_max_flag_7_percent,
        tt_air_max_flag_8::FLOAT / total_records * 100 AS tt_air_max_flag_8_percent,
        tt_air_max_flag_9::FLOAT / total_records * 100 AS tt_air_max_flag_9_percent,

		-- Calculate percentages for tt_sea_flag (values 0-9)
        tt_sea_flag_0::FLOAT / total_records * 100 AS tt_sea_flag_0_percent,
        tt_sea_flag_1::FLOAT / total_records * 100 AS tt_sea_flag_1_percent,
        tt_sea_flag_2::FLOAT / total_records * 100 AS tt_sea_flag_2_percent,
        tt_sea_flag_3::FLOAT / total_records * 100 AS tt_sea_flag_3_percent,
        tt_sea_flag_4::FLOAT / total_records * 100 AS tt_sea_flag_4_percent,
        tt_sea_flag_5::FLOAT / total_records * 100 AS tt_sea_flag_5_percent,
        tt_sea_flag_6::FLOAT / total_records * 100 AS tt_sea_flag_6_percent,
        tt_sea_flag_7::FLOAT / total_records * 100 AS tt_sea_flag_7_percent,
        tt_sea_flag_8::FLOAT / total_records * 100 AS tt_sea_flag_8_percent,
        tt_sea_flag_9::FLOAT / total_records * 100 AS tt_sea_flag_9_percent,

		-- Calculate percentages for ws_50cm_flag (values 0-9)
        ws_50cm_flag_0::FLOAT / total_records * 100 AS ws_50cm_flag_0_percent,
        ws_50cm_flag_1::FLOAT / total_records * 100 AS ws_50cm_flag_1_percent,
        ws_50cm_flag_2::FLOAT / total_records * 100 AS ws_50cm_flag_2_percent,
        ws_50cm_flag_3::FLOAT / total_records * 100 AS ws_50cm_flag_3_percent,
        ws_50cm_flag_4::FLOAT / total_records * 100 AS ws_50cm_flag_4_percent,
        ws_50cm_flag_5::FLOAT / total_records * 100 AS ws_50cm_flag_5_percent,
        ws_50cm_flag_6::FLOAT / total_records * 100 AS ws_50cm_flag_6_percent,
        ws_50cm_flag_7::FLOAT / total_records * 100 AS ws_50cm_flag_7_percent,
        ws_50cm_flag_8::FLOAT / total_records * 100 AS ws_50cm_flag_8_percent,
        ws_50cm_flag_9::FLOAT / total_records * 100 AS ws_50cm_flag_9_percent,

		-- Calculate percentages for wl_pan_flag (values 0-9)
        wl_pan_flag_0::FLOAT / total_records * 100 AS wl_pan_flag_0_percent,
        wl_pan_flag_1::FLOAT / total_records * 100 AS wl_pan_flag_1_percent,
        wl_pan_flag_2::FLOAT / total_records * 100 AS wl_pan_flag_2_percent,
        wl_pan_flag_3::FLOAT / total_records * 100 AS wl_pan_flag_3_percent,
        wl_pan_flag_4::FLOAT / total_records * 100 AS wl_pan_flag_4_percent,
        wl_pan_flag_5::FLOAT / total_records * 100 AS wl_pan_flag_5_percent,
        wl_pan_flag_6::FLOAT / total_records * 100 AS wl_pan_flag_6_percent,
        wl_pan_flag_7::FLOAT / total_records * 100 AS wl_pan_flag_7_percent,
        wl_pan_flag_8::FLOAT / total_records * 100 AS wl_pan_flag_8_percent,
        wl_pan_flag_9::FLOAT / total_records * 100 AS wl_pan_flag_9_percent,

		-- Calculate percentages for ev_pan_flag (values 0-9)
        ev_pan_flag_0::FLOAT / total_records * 100 AS ev_pan_flag_0_percent,
        ev_pan_flag_1::FLOAT / total_records * 100 AS ev_pan_flag_1_percent,
        ev_pan_flag_2::FLOAT / total_records * 100 AS ev_pan_flag_2_percent,
        ev_pan_flag_3::FLOAT / total_records * 100 AS ev_pan_flag_3_percent,
        ev_pan_flag_4::FLOAT / total_records * 100 AS ev_pan_flag_4_percent,
        ev_pan_flag_5::FLOAT / total_records * 100 AS ev_pan_flag_5_percent,
        ev_pan_flag_6::FLOAT / total_records * 100 AS ev_pan_flag_6_percent,
        ev_pan_flag_7::FLOAT / total_records * 100 AS ev_pan_flag_7_percent,
        ev_pan_flag_8::FLOAT / total_records * 100 AS ev_pan_flag_8_percent,
        ev_pan_flag_9::FLOAT / total_records * 100 AS ev_pan_flag_9_percent,

		-- Calculate percentages for tt_pan_flag (values 0-9)
        tt_pan_flag_0::FLOAT / total_records * 100 AS tt_pan_flag_0_percent,
        tt_pan_flag_1::FLOAT / total_records * 100 AS tt_pan_flag_1_percent,
        tt_pan_flag_2::FLOAT / total_records * 100 AS tt_pan_flag_2_percent,
        tt_pan_flag_3::FLOAT / total_records * 100 AS tt_pan_flag_3_percent,
        tt_pan_flag_4::FLOAT / total_records * 100 AS tt_pan_flag_4_percent,
        tt_pan_flag_5::FLOAT / total_records * 100 AS tt_pan_flag_5_percent,
        tt_pan_flag_6::FLOAT / total_records * 100 AS tt_pan_flag_6_percent,
        tt_pan_flag_7::FLOAT / total_records * 100 AS tt_pan_flag_7_percent,
        tt_pan_flag_8::FLOAT / total_records * 100 AS tt_pan_flag_8_percent,
        tt_pan_flag_9::FLOAT / total_records * 100 AS tt_pan_flag_9_percent,

		-- Calculate overall percentage for each flag value across all flags
        (rr_flag_0 + pp_air_flag_0 + rh_avg_flag_0 + sr_avg_flag_0 + sr_max_flag_0 + nr_flag_0 + wd_avg_flag_0 + ws_avg_flag_0 + ws_max_flag_0 + wl_flag_0 + tt_air_avg_flag_0 + tt_air_min_flag_0 + tt_air_max_flag_0 + tt_sea_flag_0 + ws_50cm_flag_0 + wl_pan_flag_0 + ev_pan_flag_0 + tt_pan_flag_0)::FLOAT / total_flag_values * 100 AS overall_value_0_percent,
        (rr_flag_1 + pp_air_flag_1 + rh_avg_flag_1 + sr_avg_flag_1 + sr_max_flag_1 + nr_flag_1 + wd_avg_flag_1 + ws_avg_flag_1 + ws_max_flag_1 + wl_flag_1 + tt_air_avg_flag_1 + tt_air_min_flag_1 + tt_air_max_flag_1 + tt_sea_flag_1 + ws_50cm_flag_1 + wl_pan_flag_1 + ev_pan_flag_1 + tt_pan_flag_1)::FLOAT / total_flag_values * 100 AS overall_value_1_percent,
        (rr_flag_2 + pp_air_flag_2 + rh_avg_flag_2 + sr_avg_flag_2 + sr_max_flag_2 + nr_flag_2 + wd_avg_flag_2 + ws_avg_flag_2 + ws_max_flag_2 + wl_flag_2 + tt_air_avg_flag_2 + tt_air_min_flag_2 + tt_air_max_flag_2 + tt_sea_flag_2 + ws_50cm_flag_2 + wl_pan_flag_2 + ev_pan_flag_2 + tt_pan_flag_2)::FLOAT / total_flag_values * 100 AS overall_value_2_percent,
        (rr_flag_3 + pp_air_flag_3 + rh_avg_flag_3 + sr_avg_flag_3 + sr_max_flag_3 + nr_flag_3 + wd_avg_flag_3 + ws_avg_flag_3 + ws_max_flag_3 + wl_flag_3 + tt_air_avg_flag_3 + tt_air_min_flag_3 + tt_air_max_flag_3 + tt_sea_flag_3 + ws_50cm_flag_3 + wl_pan_flag_3 + ev_pan_flag_3 + tt_pan_flag_3)::FLOAT / total_flag_values * 100 AS overall_value_3_percent,
        (rr_flag_4 + pp_air_flag_4 + rh_avg_flag_4 + sr_avg_flag_4 + sr_max_flag_4 + nr_flag_4 + wd_avg_flag_4 + ws_avg_flag_4 + ws_max_flag_4 + wl_flag_4 + tt_air_avg_flag_4 + tt_air_min_flag_4 + tt_air_max_flag_4 + tt_sea_flag_4 + ws_50cm_flag_4 + wl_pan_flag_4 + ev_pan_flag_4 + tt_pan_flag_4)::FLOAT / total_flag_values * 100 AS overall_value_4_percent,
        (rr_flag_5 + pp_air_flag_5 + rh_avg_flag_5 + sr_avg_flag_5 + sr_max_flag_5 + nr_flag_5 + wd_avg_flag_5 + ws_avg_flag_5 + ws_max_flag_5 + wl_flag_5 + tt_air_avg_flag_5 + tt_air_min_flag_5 + tt_air_max_flag_5 + tt_sea_flag_5 + ws_50cm_flag_5 + wl_pan_flag_5 + ev_pan_flag_5 + tt_pan_flag_5)::FLOAT / total_flag_values * 100 AS overall_value_5_percent,
        (rr_flag_6 + pp_air_flag_6 + rh_avg_flag_6 + sr_avg_flag_6 + sr_max_flag_6 + nr_flag_6 + wd_avg_flag_6 + ws_avg_flag_6 + ws_max_flag_6 + wl_flag_6 + tt_air_avg_flag_6 + tt_air_min_flag_6 + tt_air_max_flag_6 + tt_sea_flag_6 + ws_50cm_flag_6 + wl_pan_flag_6 + ev_pan_flag_6 + tt_pan_flag_6)::FLOAT / total_flag_values * 100 AS overall_value_6_percent,
        (rr_flag_7 + pp_air_flag_7 + rh_avg_flag_7 + sr_avg_flag_7 + sr_max_flag_7 + nr_flag_7 + wd_avg_flag_7 + ws_avg_flag_7 + ws_max_flag_7 + wl_flag_7 + tt_air_avg_flag_7 + tt_air_min_flag_7 + tt_air_max_flag_7 + tt_sea_flag_7 + ws_50cm_flag_7 + wl_pan_flag_7 + ev_pan_flag_7 + tt_pan_flag_7)::FLOAT / total_flag_values * 100 AS overall_value_7_percent,
        (rr_flag_8 + pp_air_flag_8 + rh_avg_flag_8 + sr_avg_flag_8 + sr_max_flag_8 + nr_flag_8 + wd_avg_flag_8 + ws_avg_flag_8 + ws_max_flag_8 + wl_flag_8 + tt_air_avg_flag_8 + tt_air_min_flag_8 + tt_air_max_flag_8 + tt_sea_flag_8 + ws_50cm_flag_8 + wl_pan_flag_8 + ev_pan_flag_8 + tt_pan_flag_8)::FLOAT / total_flag_values * 100 AS overall_value_8_percent,
        (rr_flag_9 + pp_air_flag_9 + rh_avg_flag_9 + sr_avg_flag_9 + sr_max_flag_9 + nr_flag_9 + wd_avg_flag_9 + ws_avg_flag_9 + ws_max_flag_9 + wl_flag_9 + tt_air_avg_flag_9 + tt_air_min_flag_9 + tt_air_max_flag_9 + tt_sea_flag_9 + ws_50cm_flag_9 + wl_pan_flag_9 + ev_pan_flag_9 + tt_pan_flag_9)::FLOAT / total_flag_values * 100 AS overall_value_9_percent
        

    FROM aggregated_data
)
SELECT * FROM percentages;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS station_flag_summary;");
    }
};
