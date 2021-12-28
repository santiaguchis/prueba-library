<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Core;
use JWTAuth;
use Sentinel;
use Str;
use Arr;

class CoreController extends Controller
{
    private $user;
    private $role;
    private $permissions = [];
    private $message = [];
    private $data = [];
    private $status = true;
    private $token = false;
    private $route = '#';

    public function __construct( Request $request ) {
        try {
            $token = JWTAuth::getToken();

            if ( $token ):
                $user = JWTAuth::parseToken()->authenticate();
                $this->user = $user;
                $this->role = Sentinel::findById( $user->id )->roles()->get()->first();
            endif;
        } catch ( \Exception $e ) {
            return false;
        }
    }

    public function getUser(  )
	{
        $token = JWTAuth::getToken();
		$user = JWTAuth::parseToken()->authenticate();

        return $user;
    }
    private function getPermissions(  )
	{
        
        return ( $this->role ) ? $this->role->permissions : [];
    }
    public function checkRole( $role )
	{
		$user = Sentinel::findById( $this->user->id );
		return $user->inRole( $role );
    }

    public function addErrorMessage( $reason , $message )
    {
        $this->status = false;
        $this->setMessage( 'error' , $reason , $message );
    }

    public function addWarningMessage( $reason , $message )
    {
        $this->status = false;
        $this->setMessage( 'warning' , $reason , $message );
    }

    public function addSuccessMessage( $reason , $message )
    {
        $this->setMessage( 'success' , $reason , $message );
    }

    public function addInfoMessage( $reason , $message )
    {
        $this->setMessage( 'info' , $reason , $message );
    }


    public function setMessage( $type , $reason , $message ) {
        $this->message = [
            'type' => Str::slug( $type ),
            'title' => $reason,
            'description' => $message
        ];
    }

    public function addData( $key , $object ) {
        $this->data[$key] = $object;
    }
    public function setData( $data )
    {
        $this->data = $data;
    }
    public function result()
    {
        return response()->json([
            'message'       => $this->message ,
            'data'          => $this->data ,
            'permissions'   => $this->getPermissions(),
            'status'        => $this->status ,
            'route'         => $this->route
        ]);
    }

}
