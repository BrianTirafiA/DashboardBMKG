<?php  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateStockTable extends Migration  
{  
    /**  
     * Run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('stock', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');  
            $table->integer('available_stock');  
            $table->foreignId('location_id')->constrained('item_locations')->onDelete('cascade');  
            $table->timestamps();  
        });  
    }  
  
    /**  
     * Reverse the migrations.  
     *  
     * @return void  
     */  
    public function down()  
    {  
        Schema::dropIfExists('stock');  
    }  
}  
