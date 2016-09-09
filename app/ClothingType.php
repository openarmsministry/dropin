<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClothingType extends Model
{
    public function clothingCheckouts() {
        return $this->belongsToMany(ClothingCheckout::class);
    }
}
