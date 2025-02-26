<?php  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateLoanRequestItemsTable extends Migration  
{  
    /**  
     * Run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('loan_request_items', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('loan_request_id')->constrained('loan_requests')->onDelete('cascade');  
            $table->foreignId('item_details_id')->constrained('item_details')->onDelete('cascade');  
            $table->integer('quantity');  
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
        Schema::dropIfExists('loan_request_items');  
    }  
}  
