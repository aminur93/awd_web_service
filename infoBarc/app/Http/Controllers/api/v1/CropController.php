<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CropRequest;
use App\Models\Crop;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CropController extends Controller
{
    public function index()
    {
        $crop = Crop::latest()->get();

        return response()->json(['crop' => $crop]);
    }

    public function getData(Request $request)
    {
        $columns = ['id','name_en', 'name_bn','image'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Crop::select('id','name_en','name_bn','image')
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

    public function store(CropRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create crop
                $crop = new Crop();

                $crop->name_en = $request->name_en;
                $crop->name_bn = $request->name_bn;

                if($request->file('image'))
                {
                    $image = $request->file('image');
               
                    $data = file_get_contents($image);
    
                    $base64 = 'data:image/' . $image->getClientOriginalExtension() . ';base64,' . base64_encode($data);
    
                    $crop->image = $base64;
                }

                $crop->save();

                DB::commit();

                return response()->json([
                    'crop' => $crop,
                    'message' => 'Crop store successful'
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
        $crop = Crop::findOrFail($id);

        return response()->json(['crop' => $crop]);
    }

    public function update(CropRequest $request, $id)
    {

        if($request->_method == 'PUT')    
        {
            DB::beginTransaction();

            try{
                //update crop
                $crop = Crop::findOrFail($id);

                $crop->name_en = $request->name_en;
                $crop->name_bn = $request->name_bn;

                if($request->file('image'))
                {
                    $image = $request->file('image');
               
                    $data = file_get_contents($image);
    
                    $base64 = 'data:image/' . $image->getClientOriginalExtension() . ';base64,' . base64_encode($data);
    
                    $crop->image = $base64;
                }else{
                    $crop->image = $crop->image;
                }

                $crop->save();

                DB::commit();

                return response()->json([
                    'crop' => $crop,
                    'message' => 'Crop update successful'
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
        $crop = Crop::findOrFail($id);

        $crop->delete();

        return response()->json(['message' => 'Crop delete successful']);
    }
}
