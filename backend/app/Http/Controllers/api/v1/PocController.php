<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PocRequest;
use App\Models\Poc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PocController extends Controller
{
    public function index()
    {
        $poc = Poc::select()
                ->leftJoin('post_offices', function($join){
                    $join->on('pocs.post_office_id','=','post_offices.id');
                })
                ->orderBy('pocs.id', 'desc')
                ->get();

        return response()->json(['poc' => $poc]);
    }

    public function getData(Request $request)
    {
        $columns = ['id','post_office_name', 'poc_code'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Poc::select('pocs.id as id','post_offices.post_code as post_office_name','pocs.poc_code as poc_code')
                        ->leftJoin('post_offices', function($join){
                            $join->on('pocs.post_office_id','=','post_offices.id');
                        })
                        ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('poc_code', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);


        return response()->json([
            'data' => $projects,
            'draw' => $request->input('draw'),
        ],Response::HTTP_OK);
    }

    public function store(PocRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create poc

                $poc = new Poc();

                $poc->post_office_id = $request->post_office_id;
                $poc->poc_code = $request->poc_code;

                $poc->save();

                DB::commit();

                return response()->json([
                    'poc' => $poc,
                    'message' => 'Poc store successful'
                ], Response::HTTP_CREATED);

            }catch(Exception $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json($error);
            }
        }
    }

    public function edit($id)
    {
        $poc = Poc::where('id', $id)->first();

        return response()->json([
            'poc' => $poc
        ]);
    }

    public function update(PocRequest $request, $id)
    {
        if($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{

                //update poc

                $poc = Poc::findOrFail($id);

                $poc->post_office_id = $request->post_office_id;
                $poc->poc_code = $request->poc_code;

                $poc->save();

                DB::commit();

                return response()->json([
                    'poc' => $poc,
                    'message' => 'Poc update successful'
                ]);

            }catch(Exception $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json($error);
            }
        }
    }

    public function destroy($id)
    {
        $poc = Poc::findOrFail($id);
        $poc->delete();

        return response()->json(['message' => 'Poc delete successful']);
    }
}
