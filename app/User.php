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

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function bettings()
    {
        return $this->hasMany('App\Betting');
    }

    public function getRoundsAttribute()
    {
        $bettings = $this->bettings;
        $rounds = [];
        foreach ($bettings as $key => $value) {
            $rounds[] = $value->rounds;
        }
        return array_collapse($rounds);
    }

    public function hasRoles($roles)
    {
        $userRoles = $this->roles;
        return $roles->intersect($userRoles)->count();
    }

    public function isAdmin()
    {
        return $this->hasRole("Admin");
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', '=', $role)->firstOrFail();
        }
        return (bool) $this->roles()->find($role->id);
    }
}
