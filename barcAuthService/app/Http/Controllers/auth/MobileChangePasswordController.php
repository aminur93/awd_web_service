<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MobileChangePasswordController extends Controller
{
    public function saveResetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        try{

            User::where('email', $request->email)->update(['password' => bcrypt($request->password)]);

            return response()->json([
                'message' => 'Password change successful'
            ],Response::HTTP_OK);

        }catch(Exception $e){
            DB::rollBack();

            $error = $e->getMessage();

            return response()->json([
                'error' => $error
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
