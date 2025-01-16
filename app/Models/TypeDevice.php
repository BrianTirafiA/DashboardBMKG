<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class TypeDevice extends Model  
{  
    use HasFactory;  
  
    protected $table = 'type_devices'; // Nama tabel jika berbeda dari konvensi  
  
    protected $fillable = [  
        'name_type',    
    ];  
}  
