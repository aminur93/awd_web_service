<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class MobileAuthController extends Controller
{
    public function mobileRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|min:6|max:16',
        ]);

        if($request->isMethod('post'))
        {
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->user_type = "mobile";
            $user->password = bcrypt($request->password);

            $user->save();

            $url = "http://notify-app:8000/api/email/v1/welcome_email";

            $response = Http::post($url, [
                'name' => $request->name,
                'email' =>  $request->email,
                'phone' =>  $request->phone,
            ]);

            return $response;
        }
    }

    public function mobileLogin(Request $request)
    {
        $loginField = request()->input('email');

        $credentials = null;

        $loginType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user = User::where('email', '=', $loginField)->orWhere('phone', '=', $loginField)->first();

        if(Hash::check($request->password, $user->password))
        {
            if($user->user_type == 'mobile')
            {
               
                DB::table('users')->where('email', '=', $loginField)->orWhere('phone', '=', $loginField)->update(['device_id' => $request->device_id]);
               
                request()->merge([$loginType => $loginField]);

                $credentials = request([$loginType, 'password']);
    
                if ($token = $this->guard()->attempt($credentials)) {
                    return $this->respondWithToken($token);
                }else{
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
            }else{
                return response()->json([
                    'message' => 'Invalid user!!'
                ],Response::HTTP_BAD_REQUEST);
            }
            
        }else{
            return response()->json([
                'message' => 'Password did not match on our records!'
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

         /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function mobileMe()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function mobileLogout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function mobileRefresh()
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
}
