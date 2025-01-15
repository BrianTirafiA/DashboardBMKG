<?php  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateStatusesTable extends Migration  
{  
    /**  
     * Run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('item_statuses', function (Blueprint $table) {  
            $table->id(); // Menambahkan kolom id secara otomatis  
            $table->string('nama'); // Kolom untuk nama  
            $table->string('description'); // Kolom untuk deskripsi  
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
        Schema::dropIfExists('statuses');  
    }  
}  
