<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;
    protected $dates = ['signin_timestamp'];

    public function session() {
        return $this->belongsTo(OpenarmsSession::class, 'openarms_session_id');
    }

    public function guest() {
        return $this->belongsTo(Guest::class);
    }

    public function services() {
        return $this->belongsToMany(Service::class);
    }

    public function clothingCheckouts() {
        return $this->hasMany(ClothingCheckout::class);
    }

    public function needsClothing() {
        return $this->services->contains('short_name', 'Clothing');
    }

    public function needsOamId() {
        return $this->services->contains('short_name', 'OAM ID');
    }
}
