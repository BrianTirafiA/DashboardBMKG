<?php

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreatePertanyaanTable extends Migration  
{  
    public function up()  
    {  
        Schema::create('pertanyaans', function (Blueprint $table) {  
            $table->id();  
            $table->string('question'); // Kolom untuk pertanyaan  
            $table->text('answer');     // Kolom untuk jawaban  
            $table->timestamps();  
        });  
    }  
  
    public function down()  
    {  
        Schema::dropIfExists('pertanyaans');  
    }  
}  

