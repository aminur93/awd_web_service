<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LandPreprationRequest;
use App\Models\LandPrepration;
use App\Models\LandPreprationSeasion;
use App\Models\LandSeason;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LandPreprationController extends Controller
{
    public function landPreparationSeasonData($userId, $cropId){
        $userIdFromAuth = $userId;
        $cropIdFromAuth = $cropId;

        $landPreparationDatas = LandPrepration::leftjoin('land_season', 'land_preprations.id', '=', 'land_season.land_prepration_id')
        ->leftjoin('land_prepration_seasions', 'land_season.season_id', '=', 'land_prepration_seasions.id')
        ->where('land_preprations.user_id', $userIdFromAuth)
        ->where('land_preprations.crop_id', $cropIdFromAuth)
        ->select('land_preprations.id', 'land_prepration_seasions.name_en', 'land_prepration_seasions.name_bn')
        ->orderBy('land_preprations.id', 'DESC')->distinct('land_preprations.id')->get();

        $result = array();
        foreach($landPreparationDatas as $landPreparationData){
            $landPreparation['id'] = $landPreparationData->id;
            $landPreparation['name_en'] = $landPreparationData->name_en;
            $landPreparation['name_bn'] = $landPreparationData->name_bn;
            $landPreparation['land_preparation_id'] = $landPreparationData->id;

            $result[] = $landPreparation;
        }

        return response()->json(['land_preparation' => $result]);
    }

    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $crop_id = $request->crop_id;

        $land_prepration = LandPrepration::where('user_id', $request->user_id)->where('crop_id', $crop_id)->with(['crop','landseason.landpreprationseasion'])->get();

        return response()->json([
            'land_prepration' => $land_prepration,
        ]);
    }

    public function getData(Request $request)
    {

        $page = $request->input('page');
        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');


        $land_prepration = LandPrepration::with(['crop','landseason.landpreprationseasion'])->paginate(10);

        return response()->json([
            'data' => $land_prepration,
            'draw' => $request->input('draw')
        ]);
    }

    public function paginate($items, $perPage = 10, $page = 1, $baseUrl = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? 
                       $items : Collection::make($items);

        $lap = new LengthAwarePaginator($items->forPage($page, $perPage), 
                           $items->count(),
                           $perPage, $page, $options);

        if ($baseUrl) {
            $lap->setPath($baseUrl);
        }

        return $lap;
    }

    public function store(LandPreprationRequest $request)
    {

        if($request->isMethod('post'))
        {
          
            if (LandPrepration::where('id', $request->prepration_id)->where('user_id', $request->user_id)->where('crop_id', $request->crop_id)->exists()) {
                
                //update land prepration
                $land_prepration = LandPrepration::where('id', $request->prepration_id)->where('user_id',$request->user_id)->where('crop_id', $request->crop_id)->first();

                $land_prepration->update([
                    'user_id' => $request->user_id,
                    'crop_id' => $request->crop_id
                ]);
                
                foreach($request->input('seasion_id') as $s)
                {
                    DB::table('land_season')->where('id', $s['id'])
                    ->update([
                        'land_prepration_id' => $request->prepration_id,
                        'season_id' => $s['s_id'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
                    
                                    
                    
                DB::connection('mysql2')->table("users")->where('id', $request->user_id)->update(["is_setup" => 1]);
                
                return response()->json([
                    'message' => 'Land Prepration updated successful'
                ],Response::HTTP_OK);
                
            } else {
                //create land prepration
                $land_prepration = new LandPrepration();

                $land_prepration->user_id = $request->user_id;
                $land_prepration->crop_id = $request->crop_id;

                $land_prepration->save();

                $land_prepration_id = DB::getPdo()->lastInsertId();

                foreach($request->input('seasion_id') as $s)
                {
                    DB::table('land_season')->insert([
                        'land_prepration_id' => $land_prepration_id,
                        'season_id' => $s['s_id'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }

                DB::connection('mysql2')->table("users")->where('id', $request->user_id)->update(["is_setup" => 1]);

                return response()->json([
                    'land_prepration' => $land_prepration,
                    'message' => 'Land Prepration store successful'
                ],Response::HTTP_CREATED);
            }
                
                
        }
    }
}
