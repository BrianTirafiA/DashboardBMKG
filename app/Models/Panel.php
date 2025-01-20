<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    use HasFactory;

    // Table associated with this model
    protected $table = 'panels';

    // Mass assignable attributes
    protected $fillable = [
        'pdu',
        'rak',
        'kapasitas',
    ];

    /**
     * The 'rak' attribute is stored as JSON, so it needs to be cast.
     */
    protected $casts = [
        'rak' => 'array',
    ];

    /**
     * Define the relationship with RakPanel.
     * One Panel can have many RakPanels.
     */
    public function rakPanels()
    {
        return $this->hasMany(RakPanel::class);
    }
}
