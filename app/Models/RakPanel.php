<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RakPanel extends Model
{
    use HasFactory;

    // Tabel terkait
    protected $table = 'rak_panels';

    // Kolom yang bisa diisi
    protected $fillable = ['name'];

    /**
     * Definisikan hubungan dengan model Panel.
     * Setiap RakPanel dapat memiliki banyak Panel.
     */
    public function panels()
    {
        return $this->hasMany(Panel::class, 'rak_panel_id');
    }
}
