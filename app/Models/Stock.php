<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class Stock extends Model  
{  
    use HasFactory;  
    protected $table = 'item_stock';
    protected $fillable = [  
        'item_id',  
        'available_stock',  
        'location_id',  
    ];  
  
    public function item()  
    {  
        return $this->belongsTo(Item::class);  
    }  
  
    public function location()  
    {  
        return $this->belongsTo(ItemLocation::class);  
    }  
}  
