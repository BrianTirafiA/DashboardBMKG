<?php  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateItemsTable extends Migration  
{  
    /**  
     * Run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('item_details', function (Blueprint $table) {  
            $table->id();  
            $table->string('nama_items');  
            $table->string('description')->nullable();  
            $table->integer('total_stock');  
            $table->foreignId('category_id')->constrained('item_categories')->onDelete('cascade');  
            $table->foreignId('status_id')->constrained('item_statuses')->onDelete('cascade');  
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
        Schema::dropIfExists('item_details');  
    }  
}  
