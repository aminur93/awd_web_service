<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\VillageRequest;
use App\Models\Village;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class VillageController extends Controller
{
    public function index()
    {
        $village = Village::select('villages.*','thanas.name_en as thana_name_en','thanas.name_bn as thana_name_bn')
                    ->leftJoin('thanas', function($join){
                        $join->on('villages.thana_id','=','thanas.id');
                    })
                    ->orderBy('villages.id','desc')
                    ->get();

        return response()->json([
            'villages' => $village
        ],Response::HTTP_OK);
    }

    public function getData(Request $request)
    {
        $columns = ['id','thana_name', 'name_en','name_bn','code_en','code_bn'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Village::select('villages.id as id','thanas.name_en as thana_name','villages.name_en as name_en','villages.name_bn as name_bn','villages.code_en as code_en','villages.code_bn as code_bn')
                        ->leftJoin('thanas', function($join){
                            $join->on('villages.thana_id','=','thanas.id');
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

    public function store(VillageRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                //create village
                $village = new Village();

                $village->thana_id = $request->thana_id;
                $village->name_en = $request->name_en;
                $village->name_bn = $request->name_bn;
                $village->code_en = $request->code_en;
                $village->code_bn = $request->code_bn;

                $village->save();

                DB::commit();

                return response()->json([
                    'village' => $village,
                    'message' => 'Village store successful'
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
        $village = Village::findOrFail($id);

        return response()->json(['village' => $village], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        if($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{
                //update village
                $village = Village::findOrFail($id);

                $village->thana_id = $request->thana_id;
                $village->name_en = $request->name_en;
                $village->name_bn = $request->name_bn;
                $village->code_en = $request->code_en;
                $village->code_bn = $request->code_bn;

                $village->save();

                DB::commit();

                return response()->json([
                    'village' => $village,
                    'message' => 'Village update successful'
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
        $village = Village::findOrFail($id);
        $village->delete();

        return response()->json(['message' => 'Village delete successful']);
    }
}
