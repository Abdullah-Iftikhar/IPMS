<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    public function getBank() {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }

    public function getProperty() {
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

}
