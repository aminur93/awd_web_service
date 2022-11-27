<?php

namespace App\Http\Controllers;

use App\Mail\OtpCodeMail;
use App\Mail\ResetPasswordMail;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function welcomeEmail(Request $request)
    {
        $email = $request->email;
        
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        );

        Mail::to($email)->queue(new WelcomeMail($data));
    }

    public function forgetPassword(Request $request)
    {
        $email = $request->email;
        $token = $request->token;

        Mail::to($email)->queue(new ResetPasswordMail($token));
    }

    public function otpCode(Request $request)
    {
        $email = $request->email;
        $otp_code = $request->otp_code;

        Mail::to($email)->queue(new OtpCodeMail($otp_code));
    }

    public function pushNotification(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = [];
        $FcmToken[] = $request->device_id;

        $SERVER_API_KEY = 'AAAAom1T8lg:APA91bFdHL0xZai3ZZiw260I-7Jyhuz1mwQr4PyRod1VS7HNhap6ULsgrq8KjWrwPpUWer0kDRoO-KiEFUY4exlRrXNdweU6jO69HSNf-SlhRa3obWoI8j-tzwBXdYHF4sSW3Dw7Egy5';
  
        $data = [
            //"to" => "/topics/topicExample",
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => "Irrigation",
                "body" => "new data is here",  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        
        // FCM response
        return response()->json([
            'result' => $result,
            'data' => $data['notification']
        ]); 
    }
}
