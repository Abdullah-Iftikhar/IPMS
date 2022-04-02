<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public function getSoldDetail() {
        return $this->hasOne(SoldProperty::class, 'property_id', 'id');
    }

    public function getRentDetail() {
        return $this->hasOne(RentProperty::class, 'property_id', 'id');
    }

    public function getConstructionDetail() {
        return $this->hasOne(ConstructProperty::class, 'property_id', 'id');
    }
}
