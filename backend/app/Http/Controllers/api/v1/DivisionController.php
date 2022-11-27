<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DivisionRequest;
use App\Models\Division;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::latest()->get();

        return response()->json([
            'divisions' => $divisions
        ],Response::HTTP_OK);
    }

    public function getData(Request $request)
    {
        $columns = ['id','country_name', 'name_en','name_bn','code_en','code_bn'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Division::select(
                            'divisions.id as id',
                            'countries.name_en as country_name_en',
                            'countries.name_bn as country_name_bn',
                            'divisions.name_en as division_name_en',
                            'divisions.name_bn as division_name_bn',
                            'divisions.code_en as division_code_en',
                            'divisions.code_bn as division_code_bn'
                            )
                        ->leftJoin('countries', function($join){
                            $join->on('divisions.country_id','=','countries.id');
                        })
                        ->orderBy($columns[$column], $dir);

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

    public function store(DivisionRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //division create

                $division = new Division();

                $division->country_id = $request->country_id;
                $division->name_en = $request->name_en;
                $division->name_bn = $request->name_bn;
                $division->code_en = $request->code_en;
                $division->code_bn = $request->code_bn;

                $division->save();

                DB::commit();

                return response()->json([
                    'division' => $division,
                    'message' => 'Division store successful'
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
        $division = Division::findOrFail($id);

        return response()->json($division);
    }

    public function update(DivisionRequest $request, $id)
    {
        if($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{

                //division update

                $division = Division::findOrFail($id);

                $division->country_id = $request->country_id;
                $division->name_en = $request->name_en;
                $division->name_bn = $request->name_bn;
                $division->code_en = $request->code_en;
                $division->code_bn = $request->code_bn;

                $division->save();

                DB::commit();

                return response()->json([
                    'division' => $division,
                    'message' => 'Division update successful'
                ],Response::HTTP_OK);

            }catch(Exception $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json($error);
            }
        }
    }

    public function destroy($id)
    {
        $division = Division::findOrFail($id);
        $division->delete();

        return response()->json(['message' => 'Division destroy successful']);
    }
}
