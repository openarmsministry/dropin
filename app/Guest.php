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

    public function getPhotoPath() {
        if ( $this->photo_path == '/' and config('app.env') !== 'production' ) {
            return "https://randomuser.me/api/portraits/men/{$this->id}.jpg";
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
