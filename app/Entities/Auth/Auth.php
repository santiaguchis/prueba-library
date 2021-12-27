<?php

namespace App\Entities\Auth;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Users\EloquentUser as SentinelUser;

class Auth extends SentinelUser
{
    protected $fillable = [
        'email',
        'username',
        'password',
        'last_name',
        'first_name',
        'permissions',
    ];

    protected $loginNames = [ 'email' ,  'username' ];
}
