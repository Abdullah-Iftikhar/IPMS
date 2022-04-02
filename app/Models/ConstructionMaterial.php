<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionMaterial extends Model
{
    use HasFactory;

    public function getMaterial() {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }
}
