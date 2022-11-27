<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LandSizeRequest;
use App\Models\LandSize;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LandSizeController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user_id;

        $land_size = LandSize::where('user_id', $user_id)->latest()->get();

        return response()->json([
            'land_size' => $land_size
        ]);
    }

    public function getData(Request $request)
    {
        $columns = ['id','user_id', 'size','land_type'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = LandSize::select('id','user_id','size','land_type')->orderBy($columns[$column], $dir);

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

    public function store(LandSizeRequest $request)
    {
        if($request->isMethod('post'))
        {
            if (LandSize::where('id', $request->land_size_id)->where('user_id', $request->user_id)->exists()) {
                
                //update land size
                $land_size = LandSize::where('id', $request->land_size_id)->where('user_id', $request->user_id)->first();

                $land_size->update([
                    'user_id' => $request->user_id,
                    'size' => $request->size,
                    'land_type' => $request->land_type
                ]);

                return response()->json([
                    'land_size' => $land_size,
                    'message' => 'Land size updated successful'
                ],Response::HTTP_OK);

            } else {
                 //create land size
                $land_size = new LandSize();

                $land_size->user_id = $request->user_id;
                $land_size->size = $request->size;
                $land_size->land_type = $request->land_type;

                $land_size->save();

                return response()->json([
                    'land_size' => $land_size,
                    'message' => 'Land size store successful'
                ],Response::HTTP_CREATED);
            }
            
        }
    }
}
