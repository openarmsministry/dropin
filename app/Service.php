<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function attendances() {
        return $this->belongsToMany(Attendance::class);
    }

    public function getRequestedAttendances(OpenarmsSession $session) {
        $attendancesIds = $session->attendances->pluck('id');
        $attendances = $this->attendances()->whereIn('id', $attendancesIds)->get();
        return $attendances->sortBy('signin_timestamp')->values()->all();
    }
}
