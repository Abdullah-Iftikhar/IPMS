<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentProperty extends Model
{
    use HasFactory;

    public function getProperty() {
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

    public function getImages() {
        return $this->hasMany(RentPropertyImage::class, 'rent_property_id', 'id');
    }

    public function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getRentIteration() {
        return $this->hasMany(RentPropertyIteration::class, 'rent_property_id', 'id');
    }
}
