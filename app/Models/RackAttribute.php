<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackAttribute extends Model
{
    use HasFactory;

    protected $table = 'attributes'; // Sesuaikan dengan nama tabel di database

    protected $fillable = ['rack_type_id', 'name', 'data_type', 'is_required'];

    public function rackType()
    {
        return $this->belongsTo(RackType::class);
    }

    public function values()
    {
        return $this->hasMany(RackAttributeValue::class, 'attribute_id');
    }
}
