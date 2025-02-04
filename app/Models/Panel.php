<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    use HasFactory;

    // Tabel terkait
    protected $table = 'panels';

    // Kolom yang bisa diisi
    protected $fillable = ['pdu', 'rak', 'kapasitas', 'rak_panel_id'];

    /**
     * Definisikan hubungan dengan model RakPanel.
     * Setiap Panel terkait dengan satu RakPanel.
     */
    public function rakPanel()
    {
        return $this->belongsTo(RakPanel::class, 'rak_panel_id');
    }
}
