<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostOfficeRequest;
use App\Models\PostOffice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PostOfficeController extends Controller
{
    public function index()
    {
        $post_office = PostOffice::select()
                        ->leftJoin('villages', function($join){
                            $join->on('post_offices.village_id','=','villages.id');
                        })
                        ->orderBy('post_offices.id','desc')
                        ->get();

        return response()->json(['post_office' => $post_office]);
    }

    public function getData(Request $request)
    {
        $columns = ['id','village_name', 'post_office_name'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = PostOffice::select('post_offices.id as id','villages.name_en as village_name','post_offices.post_code as post_office_name')
                        ->leftJoin('villages', function($join){
                            $join->on('post_offices.village_id','=','villages.id');
                        })
                        ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('post_code', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);


        return response()->json([
            'data' => $projects,
            'draw' => $request->input('draw'),
        ],Response::HTTP_OK);
    }

    public function store(PostOfficeRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create post office
                $post_office = new PostOffice();

                $post_office->village_id = $request->village_id;
                $post_office->post_code = $request->post_code;

                $post_office->save();

                DB::commit();

                return response()->json([
                    'post_office' => $post_office,
                    'message' => 'Post Office store successful'
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
        $post_office = PostOffice::where('id', $id)->first();

        return response()->json(['post_office' => $post_office]);
    }

    public function update(PostOfficeRequest $request, $id)
    {
        if($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{

                //create post office
                $post_office = PostOffice::findOrFail($id);

                $post_office->village_id = $request->village_id;
                $post_office->post_code = $request->post_code;

                $post_office->save();

                DB::commit();

                return response()->json([
                    'post_office' => $post_office,
                    'message' => 'Post Office update successful'
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
        $post_office = PostOffice::findOrFail($id);
        $post_office->delete();

        return response()->json(['message' => 'Post Office delete successful']);
    }
}
