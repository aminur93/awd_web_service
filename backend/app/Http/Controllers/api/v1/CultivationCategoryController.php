<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\CultivationCategory;
use App\Http\Requests\CultivationCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Exception;

class CultivationCategoryController extends Controller
{
    function index()
    {
        $cultivation = CultivationCategory::latest()->get();

        return response()->json([
            'cultivation' => $cultivation
        ],Response::HTTP_OK);
    }

    public function getData(Request $request)
    {
        $columns = ['id','name'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = CultivationCategory::select('id','name')
                        ->orderBy($columns[$column], $dir);

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

    public function store(CultivationCategoryRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create cultivationCategory model
                $cultivationCategory = new CultivationCategory();

                $cultivationCategory->name = $request->name;
                $cultivationCategory->save();

                DB::commit();

                return response()->json([
                    'cultivationCategory' => $cultivationCategory,
                    'message' => 'Cultivation category store successful'
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
        $cultivationCategory = CultivationCategory::findOrFail($id);

        return response()->json([
            'cultivationCategory' => $cultivationCategory
        ],Response::HTTP_OK);
    }

    public function update(CultivationCategoryRequest $request, $id)
    {
        if($request->isMethod('put'))
        {
            DB::beginTransaction();

            try{

                //update cultivationCategory model

                $cultivationCategory = CultivationCategory::findOrFail($id);

                $cultivationCategory->name = $request->name;
                $cultivationCategory->save();

                DB::commit();

                return response()->json([
                    'cultivationCategory' => $cultivationCategory,
                    'message' => 'Cultivation category updated successful'
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
        $country = CultivationCategory::findOrFail($id);
        $country->delete();

        return response()->json(['message' => 'Cultivation category destroy successful']);
    }
}
