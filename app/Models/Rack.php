<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rack extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'rack_type_id'];

    public function attributes()
    {
        return $this->hasMany(RackAttributeValue::class);
    }

    public function rackType()
    {
        return $this->belongsTo(RackType::class);
    }

    // App\Models\Rack.php
    public function values()
    {
        return $this->hasMany(RackAttributeValue::class);
    }

    public function rackAttributeValues()
    {
        return $this->hasMany(RackAttributeValue::class, 'rack_id'); // Sesuaikan jika ada nama kolom lain
    }

}

