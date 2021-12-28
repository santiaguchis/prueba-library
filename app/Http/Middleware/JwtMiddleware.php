<?php

namespace App\Http\Middleware;

use Closure;

use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch ( Exception $e ) {
            if ( $e instanceof TokenInvalidException):
                return response()->json([
                    'error' => 'token_invalid',
                    'message' => 'El token suministrado es inválido'
                ] , 401 );
            elseif ( $e instanceof TokenExpiredException ):
                return response()->json([
                    'error' => 'token_expired',
                    'message' => 'El token ha expirado'
                ] , 401 );
            elseif ( $e instanceof TokenBlacklistedException ):
                return response()->json([
                    'error' => 'token_black_listed',
                    'message' => 'El token está en lista negra'
                ] , 403 );
            else:
                if ( JWTAuth::parser()->setRequest($request)->hasToken() ) {
                    return response()->json([
                        'error' => 'internal_server_error',
                        'message' => 'Error en servidor interno'
                    ] , 500 );
                } else {
                    return response()->json([
                        'error' => 'token_not_provided',
                        'message' => 'El token no ha sido proveído'
                    ] , 400 );
                }

            endif;
        }
        return $next($request);
    }
}
