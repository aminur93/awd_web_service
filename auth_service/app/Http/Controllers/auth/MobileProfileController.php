<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class MobileProfileController extends Controller
{
    public function profile()
    {
        $user_id = JWTAuth::parseToken()->authenticate();

        $user = User::findOrFail($user_id->id);

        return response()->json([
            'user' => $user
        ],Response::HTTP_OK);
    }

    public function update(Request $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                $user_id = JWTAuth::parseToken()->authenticate();

                $user = User::findOrFail($user_id->id);

                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->dob = $request->dob;
                $user->gender = $request->gender;
                $user->department_id = $request->department_id;

                if($request->file('image'))
                {
                    $image = $request->file('image');
               
                    $data = file_get_contents($image);
    
                    $base64 = 'data:image/' . $image->getClientOriginalExtension() . ';base64,' . base64_encode($data);
    
                    $user->image = $base64;
                }


                $user->save();

                DB::commit();

                return response()->json([
                    'message' => 'Profile updated successful'
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
