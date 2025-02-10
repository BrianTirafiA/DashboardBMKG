<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['rack_id', 'attribute_id', 'value','row_index'];

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public function attribute()
    {
        return $this->belongsTo(RackAttribute::class);
    }
}

