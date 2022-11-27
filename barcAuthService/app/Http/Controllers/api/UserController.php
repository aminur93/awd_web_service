<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->where('id','!=',Auth::id())->get();

        return response()->json([
            'users' => $users,
            'success' => true,
            'error' => false,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function getData()
    {
        //
    }

    public function getRole()
    {
        $roles = Role::select('name')->get();

        $roles_array = [];

        foreach ($roles as $role)
        {
            $roles_array[] = $role->name;
        }

        return response()->json([
            'roles' => $roles_array,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function store(UserRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create user with roler and permission
                $user = new User();

                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);

                $user->save();

                $user->assignRole($request->role);

                DB::commit();

                return response()->json([
                    'message' => 'User store successful',
                    'success' => true,
                    'error' => false,
                    'status_code' => 201
                ],Response::HTTP_CREATED);

            }catch(Exception $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'success' => false,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function edit($id)
    {
        if($id)
        {
            $user = User::with('roles')->where('id', $id)->first();

            return response()->json([
                'user' => $user,
                'success' => true,
                'error' => false,
                'status_code' => 200
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'user' => null,
                'success' => false,
                'error' => true,
                'status_code' => 404
            ],Response::HTTP_NOT_FOUND);
        }
        
    }

    public function update(UserRequest $request, $id)
    {
        if ($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{

                //update user

                $input = $request->all();
                if(!empty($input['password'])){
                    $input['password'] = Hash::make($input['password']);
                }else{
                    $input = Arr::except($input,array('password'));    
                }


                $user = User::find($id);

                $user->update($input);

                DB::table('model_has_roles')->where('model_id',$id)->delete();


                $role = explode(',', $request->input('roles'));

                $user->assignRole($role);


                DB::commit();

                return response()->json([
                    'message' => 'User Updated Successfully',
                    'success' => true,
                    'error' => false,
                    'status_code' => 200
                ],Response::HTTP_OK);

            }catch (Exception $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'success' => false,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function destroy($id)
    {
        if($id)
        {
            DB::table('model_has_roles')->where('model_id',$id)->delete();

            $user = User::where('id',$id)->first();
            $user->delete();
    
            return \response()->json([
                'message' => 'User Deleted Successfully',
                'success' => true,
                'error' => false,
                'status_code' => 200
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'success' => false,
                'error' => true,
                'status_code' => 404
            ],Response::HTTP_NOT_FOUND);
        }
    }
}
