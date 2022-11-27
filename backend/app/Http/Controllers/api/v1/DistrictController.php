<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRequest;
use App\Models\District;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::latest()->get();

        return response()->json([
            'districts' => $districts
        ],Response::HTTP_OK);
    }

    public function getData(Request $request)
    {
        $columns = ['id','division_name', 'name_en','name_bn','code_en','code_bn'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = District::select('districts.id as id','divisions.name_en as division_name','districts.name_en as name_en','districts.name_bn as name_bn','districts.code_en as code_en','districts.code_bn as code_bn')
                        ->leftJoin('divisions', function($join){
                            $join->on('districts.division_id','=','divisions.id');
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

    public function store(DistrictRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create districts
                $district = new District();

                $district->division_id = $request->division_id;
                $district->name_en = $request->name_en;
                $district->name_bn = $request->name_bn;
                $district->code_en = $request->code_en;
                $district->code_bn = $request->code_bn;

                $district->save();

                DB::commit();

                return response()->json([
                    'district' => $district,
                    'message' => 'District store successful'
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
        $district = District::findOrFail($id);

        return response()->json([
            'district' => $district
        ],Response::HTTP_OK);
    }

    public function update(DistrictRequest $request, $id)
    {
        if($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{

                //update district

                $district = District::findOrFail($id);

                $district->division_id = $request->division_id;
                $district->name_en = $request->name_en;
                $district->name_bn = $request->name_bn;
                $district->code_en = $request->code_en;
                $district->code_bn = $request->code_bn;

                $district->save();

                DB::commit();

                return response()->json([
                    'district' => $district,
                    'message' => 'District update successful'
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
        $district = District::findOrFail($id);
        $district->delete();

        return response()->json(['message' => 'District destroy successful']);
    }
}
