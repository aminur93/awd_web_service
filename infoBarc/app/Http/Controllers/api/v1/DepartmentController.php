<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::latest()->get();

        return response()->json(['department' => $department]);
    }

    public function getData(Request $request)
    {
        $columns = ['id','name_en','name_bn'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Department::select('id','name_en','name_bn')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name_en', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);


        return response()->json([
            'data' => $projects,
            'draw' => $request->input('draw'),
        ],Response::HTTP_OK);
    }

    public function store(DepartmentRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                //create department
                $department = new Department();

                $department->name_en = $request->name_en;
                $department->name_bn = $request->name_bn;

                $department->save();

                DB::commit();

                return response()->json([
                    'department' => $department,
                    'message' => 'Department store successful'
                ],Response::HTTP_CREATED);

            }catch(Exception $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json($error);
            }
        }
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);

        return response()->json(['department' => $department]);
    }

    public function update(DepartmentRequest $request, $id)
    {
        if($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{
                //update department
                $department = Department::findOrFail($id);

                $department->name_en = $request->name_en;
                $department->name_bn = $request->name_bn;

                $department->save();

                DB::commit();

                return response()->json([
                    'department' => $department,
                    'message' => 'Department update successful'
                ],Response::HTTP_CREATED);

            }catch(Exception $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json($error);
            }
        }
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json(['message' => 'Department delete successful']);
    }
}
