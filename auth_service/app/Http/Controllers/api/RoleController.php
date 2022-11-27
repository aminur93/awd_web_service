<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $role = Role::latest()->get();

        $permission_list = DB::table('permissions')
                        ->select(
                            'permissions.id as id',
                            'permissions.name as permission_name',
                            'role_has_permissions.role_id as role_id'
                        )
                        ->join('role_has_permissions','permissions.id','=','role_has_permissions.permission_id')
                        ->get();

        $role_permission = [];

        foreach ($role as $key => $r)
        {
            $role_permission[$key]['role_name'] = $r->name;
            $role_permission[$key]['id'] = $r->id;

            foreach ($permission_list as $pl)
            {
                if ($r->id === $pl->role_id)
                {
                    $role_permission[$key]['permission_name'][] = $pl->permission_name;
                }
            }
        }

        return response()->json([
        'success' => true,
        'roles' => $role_permission,
        'status_code' => 200
        ], Response::HTTP_OK);
    }

    public function getData()
    {
        //
    }

    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create role
                $role = new Role();

                $role->name = $request->name;

                $role->save();

                $role->syncPermissions($request->input('permission'));

                DB::commit();

                return response()->json([
                    'message' => 'Role store successful',
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
        $role = Role::findOrFail($id);

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $rp_array = [];
        foreach ($rolePermissions as $rp)
        {
            $rp_array[] = $rp;
        }

        return \response()->json([
            'success' => true,
            'role' => $role,
            'role_permission' => $rp_array,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        if($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{

                //create role
                $role = Role::findOrFail($id);

                $role->name = $request->name;

                $role->save();

                $role->syncPermissions($request->input('permission'));

                DB::commit();

                return response()->json([
                    'message' => 'Role updated successful',
                    'success' => true,
                    'error' => false,
                    'status_code' => 200
                ],Response::HTTP_OK);

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

    public function destroy($id)
    {
        if($id)
        {
            DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)->delete();

            $role = Role::findOrFail($id);
            $role->delete();

            return \response()->json([
                'success' => true,
                'error' => false,
                'message' => 'Role deleted successful',
                'status_code' => 200
            ],Response::HTTP_OK);
        }else{

            return \response()->json([
                'success' => false,
                'error' => true,
                'status_code' => 404
            ],Response::HTTP_NOT_FOUND);
        }
    }
}
