<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThanaRequest;
use App\Models\Thana;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ThanaController extends Controller
{
    public function index()
    {
        $thana = Thana::latest()->get();

        return response()->json([
            'thana' => $thana
        ],Response::HTTP_OK);
    }

    public function getData(Request $request)
    {
        $columns = ['id','district_name', 'name_en','name_bn','code_en','code_bn'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Thana::select('thanas.id as id','districts.name_en as district_name','thanas.name_en as name_en','thanas.name_bn as name_bn','thanas.code_en as code_en','thanas.code_bn as code_bn')
                        ->leftJoin('districts', function($join){
                            $join->on('thanas.district_id','=','districts.id');
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

    public function store(ThanaRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create thana

                $thana = new Thana();

                $thana->district_id = $request->district_id;
                $thana->name_en = $request->name_en;
                $thana->name_bn = $request->name_bn;
                $thana->code_en = $request->code_en;
                $thana->code_bn = $request->code_bn;

                $thana->save();

                DB::commit();

                return response()->json([
                    'thana' => $thana,
                    'message' => 'Thana store successful'
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
        $thana = Thana::findOrFail($id);

        return response()->json([
            'thana' => $thana
        ],Response::HTTP_OK);
    }

    public function update(ThanaRequest $request, $id)
    {
        if ($request->_method == 'PUT') {
            
            DB::beginTransaction();

            try{

                //update thana

                $thana = Thana::findOrFail($id);

                $thana->district_id = $request->district_id;
                $thana->name_en = $request->name_en;
                $thana->name_bn = $request->name_bn;
                $thana->code_en = $request->code_en;
                $thana->code_bn = $request->code_bn;

                $thana->save();

                DB::commit();

                return response()->json([
                    'thana' => $thana,
                    'message' => 'Thana updated successful'
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
        $thana = Thana::findOrFail($id);
        $thana->delete();

        return response()->json(['message' => 'Thana destroy successful']);
    }
}
