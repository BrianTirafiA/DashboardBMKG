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
            $table->id(); // ID otomatis  
            $table->string('nama_item'); // Nama item  
            $table->string('type_item'); // Tipe item  
            $table->string('description'); // Tipe item  
            $table->foreignId('brand_item_id')->constrained('item_brands')->onDelete('cascade'); // FK ke tabel item_brands  
            $table->date('tanggal_pengadaan')->nullable(); // Tanggal pengadaan  
            $table->string('nama_vendor')->nullable(); // Nama vendor  
            $table->integer('jumlah_item'); // Jumlah item  
            $table->foreignId('kategori_item_id')->constrained('item_categories')->onDelete('cascade'); // FK ke tabel item_categories  
            $table->foreignId('status_item_id')->constrained('item_statuses')->onDelete('cascade'); // FK ke tabel item_statuses  
            $table->foreignId('lokasi_item_id')->constrained('item_locations')->onDelete('cascade'); // FK ke tabel item_locations  
            $table->string('image1')->nullable(); // Kolom untuk gambar 1  
            $table->string('image2')->nullable(); // Kolom untuk gambar 2  
            $table->string('image3')->nullable(); // Kolom untuk gambar 3  
            $table->string('image4')->nullable(); // Kolom untuk gambar 4  
            $table->integer('borrowed_quantity'); // Jumlah item  
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
        Schema::dropIfExists('item_details'); // Menghapus tabel jika rollback  
    }  
}  
