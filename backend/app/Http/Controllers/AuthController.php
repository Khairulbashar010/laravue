<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required',
        ]);
        if($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'success'=> false
            ]);
        }
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return [
                'message' => 'User doesn\'t exist',
                'success' => false
            ];
        }
        try {
            if ($token = JWTAuth::attempt($validator->validated())) {
                return $this->respondWithToken($token);
            }
            return response()->json([
                'success' => false,
                'message' => 'Login credentials are invalid.',
            ], 400);
        } catch (JWTException $e) {
                return response()->json([
                        'success' => false,
                        'message' => 'Could not create token.',
                    ], 500);
        }
    }

    public function me()
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Error occured'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
}