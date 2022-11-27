<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class ForgetPasswordController extends Controller
{
    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        if(!$this->validateEmail($request->email))
        {
            return $this->faildResponse();
        }

        $this->send($request->email);

        return $this->successResponse();
    }

    public function send($email)
    {
        $token = $this->createToken($email);

        $url = "http://notify-app:8000/api/email/v1/forget_password_email";

        $response = Http::post($url, [
            'email' => $email,
            'token' => $token
        ]);

        return $response;
    }

    public function createToken($email)
    {
        $old_token = DB::table('password_resets')->where('email', $email)->first();

        if($old_token)
        {
            return $old_token;
        }

        $token = Str::random(80);

        $this->saveToken($email, $token);

        return $token;
    }

    public function saveToken($email, $token)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }


    public function validateEmail($email)
    {
        return !!User::where('email', $email)->first();
    }

    public function faildResponse()
    {
        return response()->json([
            'error' => 'Email does not found on our records!!'
        ],Response::HTTP_BAD_REQUEST);
    }

    public function successResponse()
    {
        return response()->json([
            'message' => 'Reset password link send successful!! please check your email inbox'
        ],Response::HTTP_OK);
    }
}
