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
            $table->id(); // unsigned big integer, primary key, auto-increment  
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // unsigned big integer, foreign key referencing users table, on delete cascade  
            $table->integer('durasi_peminjaman'); // integer  
            $table->text('alasan_peminjaman'); // text  
            $table->string('berkas_pendukung')->nullable(); // string, nullable  
            $table->date('tanggal_pengajuan'); // date  
            $table->enum('approval_status', ['pending', 'approved', 'onprocess', 'rejected', 'outdated', 'returned'])->default('pending'); // enum, default: 'pending'  
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null'); // unsigned big integer, foreign key referencing users table, nullable, on delete set null  
            $table->date('approval_date')->nullable(); // date, nullable  
            $table->date('confirmation_date')->nullable(); // date, nullable  
            $table->date('returned_date')->nullable(); // date, nullable  
            $table->timestamps(); // created_at, updated_at  
            $table->text('note'); // text  
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
