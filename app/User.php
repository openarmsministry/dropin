<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function sessionsStarted() {
        return $this->hasMany(OpenarmsSession::class, 'started_by_user_id');
    }

    public function sessionsEnded() {
        return $this->hasMany(OpenarmsSession::class, 'ended_by_user_id');
    }

    public function hasRole($role) {
        return $this->roles->contains('name', $role);
    }
}
