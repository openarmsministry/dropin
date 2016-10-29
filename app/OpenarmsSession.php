<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OpenarmsSession extends Model
{
    public $timestamps = false;

    protected $dates = [
        'start_timestamp',
        'end_timestamp',
    ];

    public function attendances() {
        return $this->hasMany(Attendance::class);
    }

    public function guests() {
        return $this->hasManyThrough(Guest::class, Attendance::class);
    }

    public function startedBy() {
        return $this->belongsTo(User::class, 'started_by_user_id');
    }

    public function endedBy() {
        return $this->belongsTo(User::class, 'ended_by_user_id');
    }

    public function start(User $user) {
        $this->start_timestamp = \Carbon\Carbon::now();
        $this->startedBy()->associate($user);
        $this->save();
    }

    public function end(User $user) {
        $this->end_timestamp = \Carbon\Carbon::now();
        $this->endedBy()->associate($user);
        $this->save();
    }

    public function scopeGetStarted(Builder $query) {
        return $query->where('end_timestamp', null);
    }

    public function getLocalStartString($format = 'n/d/Y', $tz = null) {
        if (is_null($tz)) {
            $tz = config('app.local_timezone');
        }
        $time = $this->start_timestamp;
        $time->tz = $tz;
        return $time->format($format);
    }

    public function getAttendanceCount()
    {
        return $this->attendances->count();
    }

    public function getClothesNeedCount()
    {
        return $this->attendances->filter(function ($attendance) {
            return $attendance->needsClothing();
        })->count();
    }

    public function getIdNeedCount()
    {
        return $this->attendances->filter(function ($attendance) {
            return $attendance->needsOamId();
        })->count();
    }

}
