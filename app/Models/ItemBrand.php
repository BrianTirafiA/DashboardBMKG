<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;

class ItemBrand extends Model
{
    use HasFactory;  
  
    protected $table = 'item_brands'; // Nama tabel jika berbeda dari konvensi  
  
    protected $fillable = [  
        'name_brand',  
        'origin_brand',  
        'description_brand',  
    ]; 
}
