<?php

namespace App\Entities\Auth;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'roles';

    protected $fillable = [
        'slug', 'name', 'permissions'
    ];

    public function users() {
        return $this->belongsToMany( 'App\Entities\Auth\User' , 'role_users' , 'role_id' , 'user_id' );
    }

    public function setPermissionsAttribute( $value ) {
        $this->attributes['permissions'] = json_encode( $value );
    }

    public function getPermissionsAttribute( $value ) {
        return json_decode( $this->attributes['permissions'] );
    }
}
