<?php

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateLoansTable extends Migration  
{  
    /**  
     * Run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('loans', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('loan_request_id')->constrained()->onDelete('cascade'); // Mengaitkan dengan tabel loan_requests  
            $table->date('tanggal_kembali')->nullable(); // Tanggal pengembalian  
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');  
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null'); // Admin yang menyetujui pengembalian  
            $table->date('approval_return_date')->nullable(); // Tanggal persetujuan pengembalian  
            $table->timestamps(); // created_at dan updated_at  
        });  
    }  
  
    /**  
     * Reverse the migrations.  
     *  
     * @return void  
     */  
    public function down()  
    {  
        Schema::dropIfExists('loans');  
    }  
}  
