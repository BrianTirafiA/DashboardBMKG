<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RakPanel extends Model
{
    use HasFactory;

    // Table associated with this model
    protected $table = 'rak_panels';

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'panel_id',
    ];

    /**
     * Define the relationship with Panel.
     * Each RakPanel belongs to a single Panel.
     */
    public function panel()
    {
        return $this->belongsTo(Panel::class);
    }
}
