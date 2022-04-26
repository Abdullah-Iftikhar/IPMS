<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldProperty extends Model
{
    use HasFactory;

    public function getProperty() {
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

    public function getImages() {
        return $this->hasMany(SoldPropertyImage::class, 'sold_property_id', 'id');
    }

    public function getUser() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getSoldIteration() {
        return $this->hasMany(SoldPropertyIteration::class, 'sold_property_id', 'id')->orderBy('created_at', 'desc');
    }
}
