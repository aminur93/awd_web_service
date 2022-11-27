<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginField = $request->input('email');

        $credentials = null;

        $loginType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user = User::where('email','=',$loginField)->orWhere('phone','=',$loginField)->first();

        if(Hash::check($request->password, $user->password))
        {
            if($user->user_type == 'web')
            {
                //proccced to the dashboard
                $request->merge([$loginType => $loginField]);
                $credentials = request([$loginType, 'password']);

                if ($token = $this->guard()->attempt($credentials)) {
                    return $this->respondWithToken($token);
                }else{
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
            }else{
                //generate error
                return response()->json([
                    'message' => 'Invalid user!!'
                ],Response::HTTP_BAD_REQUEST);
            }
        }else{
            return response()->json([
                'message' => 'Password did not match on our records!'
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'user' => auth('api')->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }

    public function isValidToken()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if($user != null)
        {
            return response()->json([
                'data' => true
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'data' => false
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    public function edituser($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'user' => $user
        ],Response::HTTP_OK);
    }
}
