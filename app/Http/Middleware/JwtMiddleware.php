<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Http\Request;

class JwtMiddleware
{

    
    public function handle(Request $request, Closure $next, ...$roles)
    {
        try{
            $user = JWTAuth::parseToken()->authenticate();

        }catch(Exception $e){
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalid){
                return response()->json([
                    'success'=>false,
                    'message'=>'Token salah'
                ]);
            }
            else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json([
                    'success'=>false,
                    'message'=>'Token Expired'
                ]);
            }
            else{
                return response()->json([
                    'success'=>false,
                    'message'=>'Authorise token tidak ditemukan'
                ]);
            }
        }

        if($user && in_array($user->role, $roles)){
            return $next($request);
        }

        return response()->json([
            'success'=>false,
            'message'=>'you are unauthorize user'
        ]);
        
    }
}
