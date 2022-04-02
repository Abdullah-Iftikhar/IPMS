<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructProperty extends Model
{
    use HasFactory;

    public function getExpensive() {
        return $this->hasMany(ConstructionMaterial::class, 'construct_property_id', 'id');
    }
}
