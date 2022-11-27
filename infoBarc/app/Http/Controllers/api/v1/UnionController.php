<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnionRequest;
use App\Models\Union;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UnionController extends Controller
{
    public function index()
    {
        $union = Union::select('unions.*','villages.name_en as village_name_en','villages.name_bn as village_name_bn')
                    ->leftJoin('villages', function($join){
                        $join->on('unions.village_id','=','villages.id');
                    })
                    ->orderBy('unions.id','desc')
                    ->get();

        return response()->json(['union' => $union]);
    }

    public function getData(Request $request)
    {
        $columns = ['id','village_name_en','name_en', 'name_bn'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Union::select('unions.id as id','villages.name_en as village_name_en','unions.name_en as name_en','unions.name_bn as name_bn')
                        ->leftJoin('villages', function($join){
                            $join->on('unions.village_id','=','villages.id');
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

    public function store(UnionRequest $request)
    {
        if ($request->isMethod('post')) {
            
            DB::beginTransaction();

            try{
                //create union
                $union = new Union();

                $union->village_id = $request->village_id;
                $union->name_en = $request->name_en;
                $union->name_bn = $request->name_bn;

                $union->save();

                DB::commit();

                return response()->json([
                    'union' => $union,
                    'message' => 'Union store successful'
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
        $union = Union::where('id',$id)->first();

        return response()->json([
            'union' => $union
        ],Response::HTTP_OK);
    }

    public function update(UnionRequest $request, $id)
    {
        if ($request->_method == 'PUT') {
            
            DB::beginTransaction();

            try{
                //create union
                $union = Union::findOrFail($id);

                $union->village_id = $request->village_id;
                $union->name_en = $request->name_en;
                $union->name_bn = $request->name_bn;

                $union->save();

                DB::commit();

                return response()->json([
                    'union' => $union,
                    'message' => 'Union updated successful'
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
        $union = Union::findOrFail($id);
        $union->delete();

        return response()->json([
            'message' => 'Union deleted successful'
        ]);
    }
}
