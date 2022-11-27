<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permission = Permission::latest()->get();

        return response()->json([
            'permission' => $permission,
            'success' => true,
            'error' => false,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function getData(Request $request)
    {
        $columns = ['id','name'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Permission::select('id','name')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);


        return response()->json([
            'data' => $projects,
            'draw' => $request->input('draw'),
        ],Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create permission
                $permission = new Permission();

                $permission->name = $request->name;

                $permission->save();

                DB::commit();

                return response()->json([
                    'message' => 'Permission store successful',
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
            $permission = Permission::where('id', $id)->first();

            return response()->json([
                'permission' => $permission,
                'success' => true,
                'error' => false,
                'status_code' => 200
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'permission' => null,
                'success' => false,
                'error' => true,
                'status_code' => 404
            ],Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request, $id)
    {
        if($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{

                //create permission
                $permission = Permission::findOrFail($id);

                $permission->name = $request->name;

                $permission->save();

                DB::commit();

                return response()->json([
                    'message' => 'Permission updated successful',
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
            $permission = Permission::where('id', $id)->first();
            $permission->delete();

            return response()->json([
                'message' => 'Permission destroy successful',
                'success' => true,
                'error' => false,
                'status_code' => 200
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'success' => false,
                'error' => true,
                'status_code' => 404
            ],Response::HTTP_NOT_FOUND);
        }
    }

    public function checkHasPermission()
    {
        //
    }
}
