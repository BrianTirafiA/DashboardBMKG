<?php
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateLoanRequestsTable extends Migration  
{  
    /**  
     * Run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('loan_requests', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('stock_id')->constrained('item_stocks')->onDelete('cascade'); // Mengaitkan dengan tabel item_stocks  
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Mengaitkan dengan tabel users  
            $table->integer('durasi_peminjaman'); // Durasi dalam hari  
            $table->text('alasan_peminjaman');  
            $table->string('berkas_pendukung')->nullable(); // Nama file atau path untuk berkas pendukung  
            $table->date('tanggal_pengajuan');  
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');  
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null'); // Admin yang menyetujui  
            $table->date('approval_date')->nullable(); // Tanggal persetujuan  
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
        Schema::dropIfExists('loan_requests');  
    }  
}  
