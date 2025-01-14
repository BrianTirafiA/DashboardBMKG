<?php  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateItemLocationsTable extends Migration  
{  
    /**  
     * Run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('item_locations', function (Blueprint $table) {  
            $table->id(); // Menambahkan kolom id secara otomatis  
            $table->string('nama_lokasi'); // Kolom untuk nama lokasi  
            $table->string('alamat_lokasi'); // Kolom untuk alamat lokasi  
            $table->string('penanggung_jawab'); // Kolom untuk penanggung jawab  
            $table->float('latitude'); // Kolom untuk latitude  
            $table->float('longitude'); // Kolom untuk longitude  
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at  
        });  
    }  
  
    /**  
     * Reverse the migrations.  
     *  
     * @return void  
     */  
    public function down()  
    {  
        Schema::dropIfExists('item_locations');  
    }  
}  
