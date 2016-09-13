<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $dates = ['birth_date'];
    public function attendances() {
        return $this->hasMany(Attendance::class);
    }

    public function scopeNickname(Builder $query, $name) {
        return $query->where('nick_name', $name);
    }

    public function scopeNicknameCheckin(Builder $query, $name, $sessionId) {
        $session = OpenarmsSession::find($sessionId);
        $guestIds = $session->attendances->pluck('guest.id')->toArray();
        return $query->where('nick_name', $name)->whereNotIn('id', $guestIds);
    }

    public function updatePhoto($photo) {
        if (is_null($this->photo_path)) {
            $path = $this->saveNewPhoto($photo);
        } else {
            $path = \Storage::cloud()->put($this->photo_path, $photo);
        }

        return $path;
    }

    public function saveNewPhoto($photo) {
        return $photo->store('guest-photos', 's3');
    }
    public function getPhotoUrl() {
        if ( is_null($this->photo_path) and config('app.env') !== 'production' ) {
            return "http://s3.amazonaws.com/37assets/svn/765-default-avatar.png";
        }

        $s3 = \Storage::disk('s3');
        $client = $s3->getDriver()->getAdapter()->getClient();
        $expiry = "+10 minutes";

        $command = $client->getCommand('GetObject', [
            'Bucket' => \Config::get('filesystems.disks.s3.bucket'),
            'Key'    => $this->photo_path
        ]);

        $request = $client->createPresignedRequest($command, $expiry);

        return (string) $request->getUri();
    }
}
