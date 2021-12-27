<?php

namespace App\Entities\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Sentinel;

class User extends Authenticatable implements JWTSubject
{

    protected $table = 'users';

    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password', 'permissions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    protected $appends = [
        'name'
    ];

    public function roles() {
        return $this->belongsToMany( 'App\Entities\Auth\Role', 'role_users' , 'user_id' , 'role_id' );
    }

    public function getNameAttribute() {
        return $this->first_name.' '.$this->last_name;
    }

    public function getJWTIdentifier() {
		return $this->getKey();
	}

	public function getJWTCustomClaims() {
		return [];
	}
    public function books()
    {
        return $this->belongsToMany('App\Entities\Book', 'book_user', 'user_id', 'book_id');
    }
}
