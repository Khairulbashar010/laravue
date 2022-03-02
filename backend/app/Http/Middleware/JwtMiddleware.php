<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware as Middleware;


class JwtMiddleware extends Middleware
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
        if($request->path() == 'api/login') {
            return $next($request);
        }
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json([
                    'message' => 'Token is Invalid',
                    'success' => false,
                ]);
            } else if ($e instanceof TokenExpiredException) {
                JWTAuth::refresh(JWTAuth::getToken());
            } else {
                return response()->json([
                    'message' => 'Authorization Token not found',
                    'success' => false,
                ]);
            }
        }
        return $next($request);
    }
}