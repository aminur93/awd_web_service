<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use App\Service\Crud\CrudInterfaceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    private $CrudService;

    public function __construct(CrudInterfaceService $CrudService )
    {
        $this->CrudService = $CrudService;
    }

    public function index()
    {
        $countries = Country::latest()->get()->toArray();

        return $this->CrudService->getAllData($countries);
    }

    public function getData(Request $request)
    {
        $columns = ['id','name_en', 'name_bn','code_en','code_bn'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Country::select('id','name_en','name_bn','code_en','code_bn')->orderBy($columns[$column], $dir);

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

    public function store(CountryRequest $request)
    {
        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                //create country model
                $this->CrudService->store($request->validated());

                DB::commit();

                return response()->json([
                    'country' => $request->all(),
                    'message' => 'Country store successful'
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
        $country = Country::findOrFail($id);

        return $this->CrudService->edit($country);
    }

    public function update(CountryRequest $request, $id)
    {
        if($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{
                //update country model
                $this->CrudService->update($request->validated(), $id);

                DB::commit();

                return response()->json([
                    'country' => $request->all(),
                    'message' => 'Country updated successful'
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
        return $this->CrudService->destroy($id);
    }
}
