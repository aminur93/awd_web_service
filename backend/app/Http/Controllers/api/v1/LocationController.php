<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user_id;

        $location = Location::select(
                        'locations.id as id',
                        'locations.user_id as user_id',
                        'countries.name_en as country_name_en',
                        'divisions.name_en as division_name_en',
                        'districts.name_en as district_name_en',
                        'thanas.name_en as thana_name_en',
                        'villages.name_en as village_name_en',
                        'post_offices.post_code as post_code',
                        'pocs.poc_code as poc_code',
                        'unions.name_en as union_name_en',
                        'locations.created_at as created_at',
                        'locations.updated_at as updated_at',
                    )
                    ->leftJoin('countries', function($join){
                        $join->on('locations.country_id', '=','countries.id');
                    })
                    ->leftJoin('divisions', function($join){
                        $join->on('locations.division_id', '=','divisions.id');
                    })
                    ->leftJoin('districts', function($join){
                        $join->on('locations.district_id', '=','districts.id');
                    })
                    ->leftJoin('thanas', function($join){
                        $join->on('locations.thana_id', '=','thanas.id');
                    })
                    ->leftJoin('villages', function($join){
                        $join->on('locations.village_id', '=','villages.id');
                    })
                    ->leftJoin('post_offices', function($join){
                        $join->on('locations.post_office_id', '=','post_offices.id');
                    })
                    ->leftJoin('pocs', function($join){
                        $join->on('locations.poc_id', '=','pocs.id');
                    })
                    ->leftJoin('unions', function($join){
                        $join->on('locations.union_id', '=','unions.id');
                    })
                    ->where('locations.user_id', $user_id)
                    ->orderBy('locations.id','desc')
                    ->get();

        return response()->json(['location' => $location]);
    }

    public function getData(Request $request)
    {
        $columns = ['id','user_id', 'country_name_en','division_name_en','district_name_en','thana_name_en','village_name_en','post_code','poc_code','union_name_en'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Location::select(
                        'locations.id as id',
                        'locations.user_id as user_id',
                        'countries.name_en as country_name_en',
                        'divisions.name_en as division_name_en',
                        'districts.name_en as district_name_en',
                        'thanas.name_en as thana_name_en',
                        'villages.name_en as village_name_en',
                        'post_offices.post_code as post_code',
                        'pocs.poc_code as poc_code',
                        'unions.name_en as union_name_en',
                        'locations.created_at as created_at',
                        'locations.updated_at as updated_at',
                    )
                    ->leftJoin('countries', function($join){
                        $join->on('locations.country_id', '=','countries.id');
                    })
                    ->leftJoin('divisions', function($join){
                        $join->on('locations.division_id', '=','divisions.id');
                    })
                    ->leftJoin('districts', function($join){
                        $join->on('locations.district_id', '=','districts.id');
                    })
                    ->leftJoin('thanas', function($join){
                        $join->on('locations.thana_id', '=','thanas.id');
                    })
                    ->leftJoin('villages', function($join){
                        $join->on('locations.village_id', '=','villages.id');
                    })
                    ->leftJoin('post_offices', function($join){
                        $join->on('locations.post_office_id', '=','post_offices.id');
                    })
                    ->leftJoin('pocs', function($join){
                        $join->on('locations.poc_id', '=','pocs.id');
                    })
                    ->leftJoin('unions', function($join){
                        $join->on('locations.union_id', '=','unions.id');
                    })
                    ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('country_name_en', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);


        return response()->json([
            'data' => $projects,
            'draw' => $request->input('draw'),
        ],Response::HTTP_OK);
    }

    public function store(LocationRequest $request)
    {
        if($request->isMethod('post'))
        {

           if (Location::where('id', $request->location_id)->where('user_id', $request->user_id)->exists()) {

                //update location
                $location = Location::where('user_id', $request->user_id)->first();

                $location->update([
                    'user_id' => $request->user_id,
                    'country_id' => $request->country_id,
                    'division_id' => $request->division_id,
                    'district_id' => $request->district_id,
                    'thana_id' => $request->thana_id,
                    'village_id' => $request->village_id,
                    'post_office_id' => $request->post_office_id,
                    'poc_id' => $request->poc_id,
                    'union_id' => $request->union_id
                ]);


                return response()->json([
                    'location' => $location,
                    'message' => 'Location updated successful'
                ],Response::HTTP_OK);

           }else{
                //create location
                $location = new Location();

                $location->user_id = $request->user_id;
                $location->country_id = $request->country_id;
                $location->division_id = $request->division_id;
                $location->district_id = $request->district_id;
                $location->thana_id = $request->thana_id;
                $location->village_id = $request->village_id;
                $location->post_office_id = $request->post_office_id;
                $location->poc_id = $request->poc_id;
                $location->union_id = $request->union_id;

                $location->save();

                return response()->json([
                    'location' => $location,
                    'message' => 'Location store successful'
                ],Response::HTTP_CREATED);
           }
               
        }
    }
}
