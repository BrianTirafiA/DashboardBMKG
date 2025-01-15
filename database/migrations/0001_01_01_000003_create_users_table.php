<?php  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
return new class extends Migration  
{  
    /**  
     * Run the migrations.  
     */  
    public function up(): void  
    {  
        Schema::create('users', function (Blueprint $table) {  
            $table->id();  
            $table->string('name')->unique();  
            $table->string('email');  
            $table->timestamp('email_verified_at')->nullable();  
            $table->string('password');  
            $table->string('role')->default('pending')->after('password');  
            $table->rememberToken();  
            $table->timestamps();  
            $table->string('nip', 20)->nullable()->after('role');
            $table->string('fullname', 30)->nullable()->after('nip');
            $table->unsignedBigInteger('unit_kerja_id')->nullable()->after('fullname');
            $table->string('no_telepon', 20)->nullable()->after('unit_kerja_id');
  
            $table->foreign('unit_kerja_id')->references('id')->on('unitkerjas')->onDelete('set null');  
        });  
  
        Schema::create('password_reset_tokens', function (Blueprint $table) {  
            $table->string('email')->primary();  
            $table->string('token');  
            $table->timestamp('created_at')->nullable();  
        });  
  
        Schema::create('sessions', function (Blueprint $table) {  
            $table->string('id')->primary();  
            $table->foreignId('user_id')->nullable()->index();  
            $table->string('ip_address', 45)->nullable();  
            $table->text('user_agent')->nullable();  
            $table->longText('payload');  
            $table->integer('last_activity')->index();  
        });  
    }  
  
    /**  
     * Reverse the migrations.  
     */  
    public function down(): void  
    {  
        Schema::table('users', function (Blueprint $table) {  
            $table->dropForeign(['unit_kerja_id']);  
            $table->dropColumn(['nip', 'fullname', 'unit_kerja_id', 'no_telepon']);  
        });  
        Schema::dropIfExists('users');  
        Schema::dropIfExists('password_reset_tokens');  
        Schema::dropIfExists('sessions');  
    }  
};  
