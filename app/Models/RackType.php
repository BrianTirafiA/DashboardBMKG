<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function attributes()
    {
        return $this->hasMany(RackAttribute::class);
    }
}
