<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LandPreprationSeasionRequest;
use App\Models\LandPreprationSeasion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LandPreprationSeasionController extends Controller
{
    public function index()
    {
        $land_seasion = LandPreprationSeasion::latest()->get();

        $season = [];

        foreach($land_seasion as $key => $ls)
        {
            $season[$ls->name_en][] = $ls;
        }

        return response()->json([
            'land_seasion' => $season
        ]);
    }

    public function getData(Request $request)
    {
        $columns = ['id','name_en', 'name_bn','cultural_operation','start_date','end_date'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = LandPreprationSeasion::select('id','name_en','name_bn','cultural_operation','start_date','end_date')->orderBy($columns[$column], $dir);

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

    public function store(LandPreprationSeasionRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create land prepration seasion
                $land_seasion = new LandPreprationSeasion();

                $land_seasion->crop_id = $request->crop_id;
                $land_seasion->name_en = $request->name_en;
                $land_seasion->name_bn = $request->name_bn;
                $land_seasion->cultural_operation = $request->cultural_operation;
                $land_seasion->start_date = $request->start_date;
                $land_seasion->end_date = $request->end_date;

                $land_seasion->save();

                DB::commit();

                return response()->json([
                    'land_seasion' => $land_seasion,
                    'message' => 'Land prepration seasion store successful'
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
        $land_seasion = LandPreprationSeasion::findOrFail($id);

        return response()->json(['land_seasion' => $land_seasion]);
    }

    public function update(LandPreprationSeasionRequest $request, $id)
    {
        if($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{

                //update land prepration seasion
                $land_seasion = LandPreprationSeasion::findOrFail($id);
                
                $land_seasion->crop_id = $request->crop_id;
                $land_seasion->name_en = $request->name_en;
                $land_seasion->name_bn = $request->name_bn;
                $land_seasion->cultural_operation = $request->cultural_operation;
                $land_seasion->start_date = $request->start_date;
                $land_seasion->end_date = $request->end_date;

                $land_seasion->save();

                DB::commit();

                return response()->json([
                    'land_seasion' => $land_seasion,
                    'message' => 'Land prepration seasion update successful'
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
        $land_seasion = LandPreprationSeasion::findOrFail($id);
        $land_seasion->delete();

        return response()->json(['message' => 'Land Prepration seasion delete successful']);
    }
}
