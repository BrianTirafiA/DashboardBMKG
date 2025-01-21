<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class LoanRequestItem extends Model  
{  
    use HasFactory;  
  
    protected $table = 'loan_request_items';  
  
    protected $fillable = [  
        'loan_request_id',  
        'item_details_id',  
        'quantity',  
    ];  

    public function loanRequest()  
    {  
        return $this->belongsTo(LoanRequest::class);  
    }  

      // Relasi ke ItemDetail  
      public function itemDetail()  
      {  
          return $this->belongsTo(ItemDetail::class, 'item_details_id');  
      }  
}  
