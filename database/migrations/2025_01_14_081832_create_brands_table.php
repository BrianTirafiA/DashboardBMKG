<?php  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateBrandsTable extends Migration  
{  
    /**  
     * Run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('item_brands', function (Blueprint $table) {  
            $table->id(); // ID otomatis  
            $table->string('name_brand'); // Nama brand  
            $table->string('origin_brand')->nullable(); // Asal brand  
            $table->text('description_brand')->nullable(); // Informasi penting tentang brand  
            $table->timestamps(); // Kolom created_at dan updated_at  
        });  
    }  
  
    /**  
     * Reverse the migrations.  
     *  
     * @return void  
     */  
    public function down()  
    {  
        Schema::dropIfExists('brands');  
    }  
}  
