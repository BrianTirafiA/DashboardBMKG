<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class Item extends Model  
{  
    use HasFactory;  
  
    protected $fillable = [  
        'nama_items',  
        'description',  
        'total_stock',  
        'category_id',  
        'status_id',  
        'location_id',  
    ];  
  
    public function stock()  
    {  
        return $this->hasMany(Stock::class);  
    }  
  
    public function category()  
    {  
        return $this->belongsTo(Category::class);  
    }  
  
    public function status()  
    {  
        return $this->belongsTo(Status::class);  
    }  
  
    public function location()  
    {  
        return $this->belongsTo(ItemLocation::class);  
    }  
}  
