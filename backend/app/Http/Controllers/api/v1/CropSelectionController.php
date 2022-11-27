<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CropSelectionRequest;
use App\Models\CropSelection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CropSelectionController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user_id;

        $crop_selection = CropSelection::select(
                    'crop_selections.id as id',
                    'crop_selections.user_id as user_id',
                    'crops.id as crop_id',
                    'crops.name_en as crop_name_en',
                    'crops.name_bn as crop_name_bn',
                    'crops.image as crop_image'
                )
                ->leftJoin("crops", function($join){
                    $join->on('crop_selections.crop_id','=','crops.id');
                })
                ->where('crop_selections.user_id', $user_id)
                ->orderBy('crop_selections.id','desc')
                ->get();

        return response()->json([
            'crop_selection' => $crop_selection
        ]);
    }

    public function getData(Request $request)
    {
        $columns = ['id','user_id','name_en', 'name_bn','image','image_path'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = CropSelection::select(
                        'crop_selections.id as id',
                        'crop_selections.user_id as user_id',
                        'crops.name_en as crop_name_en',
                        'crops.name_bn as name_bn',
                        'crops.image as crop_image'
                    )
                    ->leftJoin("crops", function($join){
                        $join->on('crop_selections.crop_id','=','crops.id');
                    })
                    ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('crop_name_en', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);


        return response()->json([
            'data' => $projects,
            'draw' => $request->input('draw'),
        ],Response::HTTP_OK);
    }

    public function store(CropSelectionRequest $request)
    {
        if($request->isMethod('post'))
        {
            if(CropSelection::where('id', $request->crop_selection_id)->where('user_id', $request->user_id)->exists())
            {
                //update crop secection
                $crop_selection = CropSelection::where('id', $request->crop_selection_id)->where('user_id', $request->user_id)->first();

                $crop_selection->update([
                    'user_id' => $request->user_id,
                    'crop_id' => $request->crop_id
                ]);

                return response()->json([
                    'crop_selection' => $crop_selection,
                    'message' => 'Crop selection updated successful'
                ],Response::HTTP_OK);

            }else{
                //create crop selection
                $crop_selection = new CropSelection();

                $crop_selection->user_id = $request->user_id;
                $crop_selection->crop_id = $request->crop_id;

                $crop_selection->save();

                return response()->json([
                    'crop_selection' => $crop_selection,
                    'message' => 'Crop selection store successful'
                ],Response::HTTP_CREATED);
            }
        }
    }
}
