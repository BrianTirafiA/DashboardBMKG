<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class ItemLocation extends Model  
{  
    use HasFactory;  
  
    protected $table = 'item_locations'; // Nama tabel jika berbeda dari konvensi  
  
    protected $fillable = [  
        'nama_lokasi',  
        'alamat_lokasi',  
        'penanggung_jawab',  
        'latitude',  
        'longitude',  
    ];  
}  
