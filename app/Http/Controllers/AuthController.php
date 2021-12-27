<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\CoreController;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Entities\Auth\Role;
use App\Entities\Auth\User;
use Sentinel;
use Crypt;
use JWTAuth;
use DB;

class AuthController extends CoreController
{
    public function login( Request $request )
    {
        try {
            DB::beginTransaction();
            $take = [ 'email' , 'password' ];
            $input = $request->only( $take );

            $credentials = [ 'email' => $request->username , 'password' => $request->password ];
            try {
                if ( !$token = JWTAuth::attempt( $credentials ) ) :
                    $this->addWarningMessage( 'Credenciales inválidas' , 'Usuario o contraseña inválido' );
                    return $this->result();
                endif;
            } catch( JWTException $e ) {
                $this->addWarningMessage( 'Token inválido' , 'token no encontrado' );
                return $this->result();
            }

            try {
                $user = Sentinel::authenticateAndRemember( $credentials ) ;
                $role = Sentinel::findById( $user->id )->roles()->get();


                $this->addData( 'token' , $token );
                $this->addData( 'user' , $user );
                $this->addData( 'role' , $role );
                $this->addSuccessMessage( 'Login exitoso' , $user->first_name.' '.$user->last_name.' te has logueado exitosamente.' );
                DB::commit();
            }
            catch( ThrottlingException $e ) {
                $delay = $e->getDelay();
                $this->addWarningMessage( 'Bloqueado' , "Has sido bloqueado por $delay segundos" );
                return $this->result();
            }
            catch( \NotActivatedException $e ) {
                $this->addWarningMessage( 'Revise su cuenta' , 'Tu cuenta no está activa' );
                return $this->result();
            }
        }
        catch( \Exception $e ) {
            $this->addErrorMessage('Ha ocurrido un error',$e->getMessage());
            DB::rollback();
        }
        return $this->result();
    }

    public function logout() {
		try {
            JWTAuth::parseToken()->invalidate();
            $this->addSuccessMessage( 'Sesión cerrada' , 'Sesión cerrada' );
		} catch ( JWTException  $exception ) {
			$this->addErrorMessage( 'Ha ocurrido un error' , 'No se ha cerrado su sesión' );
        }
        return $this->result();
	}
    public function doRecovery( Request $request )
    {
        try {
            DB::beginTransaction();
            $take = [ 'username' , 'password' ];


        }
        catch( \Exception $e ) {
            $this->addErrorMessage('Ha ocurrido un error',$e->getMessage());
            DB::rollback();
        }
        return $this->result();
    }
	public function getLoggedUser()
    {
        try {
            $this->addData( 'user' , $this->user );
            $this->addData( 'role' , $this->role );
        } catch ( \Exception $e ) {
            $this->addErrorMessage( 'Ha ocurrido un error' , $e->getMessage() );
        }
        return $this->result();
    }

    public function refresh()
    {
        try {
            $new_token = JWTAuth::parseToken()->refresh();
            $user = JWTAuth::authenticate();
            $this->addSuccessMessage( 'Token actualizado' , 'Token actualizado' );
            $this->addData( 'user' , $user );
            $this->addData( 'token' , $new_token );
		} catch ( JWTException  $exception ) {
			$this->addErrorMessage( 'Ha ocurrido un error' , 'Ha ocurrido un error de JWT' );
        }
        return $this->result();
    }

    private function isValidEmail( $str ) {
        return ( false !== strpos( $str , '@' ) && false !== strpos( $str , '.' ) );
    }
}
