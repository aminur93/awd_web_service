<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{
    public function saveResetPassword(Request $request)
    {
        return $this->getPasswordResetTableRow($request)->count() > 0 ? $this->changePassword($request) : $this->tokenNotFoundresponse();
    }

    public function getPasswordResetTableRow($request)
    {
        return DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->resetToken]);
    }

    public function changePassword($request)
    {
        $user = User::where('user_type','=','web')->whereEmail($request->email)->first();

        DB::table('users')->where('email', $request->email)->update(['password' => bcrypt($request->password)]);

        $this->getPasswordResetTableRow($request)->delete();

        return response()->json([
            'message' => 'Password change successfully'
        ],Response::HTTP_OK);
    }

    public function tokenNotFoundresponse()
    {
        return response()->json([
            'error' => 'Email and Token is incorrect'
        ],Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function adminChangePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        DB::table('users')->where('email','=', $request->email)->update(['password' => bcrypt($request->password)]);
    }

    public function adminProfileUpdate(Request $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                $user = User::where('email','=', $request->email)->orWhere('user_type','=','web')->first();

                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;

                if ($request->file('image')) {
                    $image = $request->file('image');
        
                    $data = file_get_contents($image);
        
                    $base64 = 'data:image/' . $image->getClientOriginalExtension() . ';base64,' . base64_encode($data);

                    $user->image = $base64;
                }

                $user->save();

                DB::commit();

                return response()->json([
                    'message' => 'Profile update successful'
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
}
