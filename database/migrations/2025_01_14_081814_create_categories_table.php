<?php  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateCategoriesTable extends Migration  
{  
    /**  
     * Run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('item_categories', function (Blueprint $table) {  
            $table->id(); // Menambahkan kolom id secara otomatis  
            $table->string('name_category'); // Kolom untuk nama  
            $table->string('description_category'); // Kolom untuk deskripsi  
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
        Schema::dropIfExists('item_categories');  
    }  
}  
