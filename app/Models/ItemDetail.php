<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi  
    protected $table = 'item_details';

    // Tentukan kolom yang dapat diisi massal  
    protected $fillable = [
        'nama_item',
        'type_item',
        'description',
        'brand_item_id',
        'tanggal_pengadaan',
        'nama_vendor',
        'jumlah_item',
        'kategori_item_id',
        'status_item_id',
        'lokasi_item_id',
        'borrowed_quantity',
    ];

    // Relasi dengan model lain 

    // Model ItemDetail.php  
    public function brand()
    {
        return $this->belongsTo(ItemBrand::class, 'brand_item_id');
    }

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'kategori_item_id');
    }

    public function status()
    {
        return $this->belongsTo(ItemStatus::class, 'status_item_id');
    }

    public function location()
    {
        return $this->belongsTo(ItemLocation::class, 'lokasi_item_id');
    }

    public function loanRequestItems()
    {
        return $this->hasMany(LoanRequestItem::class, 'item_details_id');
    }


}
