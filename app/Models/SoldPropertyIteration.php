<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldPropertyIteration extends Model
{
    use HasFactory;

    public function getEntity() {
        return $this->hasOne(PropertyIteration::class, 'id', 'type');
    }
}
