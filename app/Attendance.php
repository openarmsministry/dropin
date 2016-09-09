<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;

    public function session() {
        return $this->belongsTo(OpenarmsSession::class, 'openarms_session_id');
    }

    public function guest() {
        return $this->belongsTo(Guest::class);
    }

    public function clothingCheckouts() {
        return $this->hasMany(ClothingCheckout::class);
    }
}
