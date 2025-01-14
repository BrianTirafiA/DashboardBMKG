<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class Status extends Model  
{  
    use HasFactory;  
  
    protected $table = 'item_statuses'; // Nama tabel jika berbeda dari konvensi  
  
    protected $fillable = [  
        'nama',  
        'description',  
    ];  
}  
