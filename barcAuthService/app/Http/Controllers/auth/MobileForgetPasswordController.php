<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\UserOtpCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class MobileForgetPasswordController extends Controller
{
    public function mobileForgetPassword(Request $request)
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

    public function otpCheck(Request $request)
    {
        $otp_code = $request->otp_code;

        $user_otp_code = UserOtpCode::where('otp_code', $otp_code)->first();

        if($otp_code == $user_otp_code->otp_code)
        {
            $user_otp_code->delete();

            return response()->json([
                'message' => 'Otp verified successful'
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'error' => 'Otp invalid!!!'
            ],Response::HTTP_BAD_REQUEST);
        }
    }

    public function send($email)
    {
        $user = User::where('email', $email)->first();

        $otp_code = rand(1111, 9999);

        $url = "http://notify-app:8000/api/email/v1/otp_code_email";

        $response = Http::post($url, [
            'email' => $email,
            'otp_code' => $otp_code
        ]);

        $code = $this->saveOtpCode($user->id, $email, $otp_code);

        return response()->json($code, 200);;
    }

    public function saveOtpCode($user_id, $email, $otp_code)
    {
        $user_otp = new UserOtpCode();

        $user_otp->user_id = $user_id;
        $user_otp->email = $email;
        $user_otp->otp_code = intval($otp_code);

        $user_otp->save();
    }

    public function validateEmail($email)
    {
        return !!User::where('email', $email)->first();
    }

    public function faildResponse()
    {
        return response()->json([
            'error' => 'Email does not found on our records'
        ],Response::HTTP_BAD_REQUEST);
    }

    public function successResponse()
    {
        return response()->json([
            'message' => 'Otp code send successfully!! please check your email inbox'
        ],Response::HTTP_OK);
    }
}
