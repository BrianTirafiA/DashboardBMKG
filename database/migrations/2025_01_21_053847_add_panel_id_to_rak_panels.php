<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPanelIdToRakPanels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rak_panels', function (Blueprint $table) {
            // Menambahkan foreign key panel_id
            $table->foreignId('panel_id')->nullable()->constrained('panels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rak_panels', function (Blueprint $table) {
            $table->dropForeign(['panel_id']); // Menghapus foreign key jika rollback
            $table->dropColumn('panel_id');
        });
    }
}
