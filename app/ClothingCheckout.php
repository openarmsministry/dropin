<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClothingCheckout extends Model
{
    public $timestamps = false;

    public function attendance() {
        return $this->belongsTo(Attendance::class);
    }

    public function clothingTypes() {
        return $this->belongsToMany(ClothingType::class)->withPivot(['amount']);
    }
}