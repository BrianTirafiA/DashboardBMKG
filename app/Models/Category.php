<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class Category extends Model  
{  
    use HasFactory;  
  
    protected $table = 'item_categories'; // Nama tabel jika berbeda dari konvensi  
  
    protected $fillable = [  
        'nama',  
        'description',  
    ];  
}  
