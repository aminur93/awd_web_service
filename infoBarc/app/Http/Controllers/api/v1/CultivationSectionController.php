<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\CultivationSection;
use App\Models\CultivationCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CultivationSectionRequest;
use App\Models\Crop;
use App\Models\CultivationTrainingIot;
use App\Models\LandPreprationSeasion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\LandPrepration;
use App\Models\LandSeason;
use App\Models\LandSize;

class CultivationSectionController extends Controller
{
    public function index(Request $request)
    {
        $user_id = $request->user_id;

        $crop_id = $request->crop_id;

        $result_irrigation = [];

        $result_fertilize = [];

        $result_pestiside = [];

        $land_prepration = LandPrepration::select(
                                'land_preprations.id as id',
                                'land_preprations.user_id as user_id',
                                'land_preprations.crop_id as crop_id',
                                'land_season.season_id as season_id'
                            )
                            ->where('user_id', $user_id)
                            ->orWhere('crop_id', $crop_id)
                            ->leftJoin('land_season', function($join){
                                $join->on('land_preprations.id','=','land_season.land_prepration_id');
                            })
                            ->get();

        $land_prepration_season = LandPreprationSeasion::latest()->get();


        //irrigation start
        $soil_mos = ["30","31","22","18","25","27","32","28","29","30"];

        $new_soil_mos = [
            ["soil_mos" => 30, "specific_gravity" => 1.39],
            ["soil_mos" => 31, "specific_gravity" => 1.42],
            ["soil_mos" => 22, "specific_gravity" => 1.43],
            ["soil_mos" => 18, "specific_gravity" => 1.45],
            ["soil_mos" => 25, "specific_gravity" => 1.44],
            ["soil_mos" => 27, "specific_gravity" => 1.47],
            ["soil_mos" => 32, "specific_gravity" => 1.48],
            ["soil_mos" => 28, "specific_gravity" => 1.49],
            ["soil_mos" => 29, "specific_gravity" => 1.50],
            ["soil_mos" => 30, "specific_gravity" => 1.52]
        ];

        $new_s = $new_soil_mos[array_rand($new_soil_mos)];

        $field_capacity = 28;

        /*first layer start*/
        $first_result = (28 - $new_s['soil_mos']) / 100;

        $first_total = $first_result * $new_s['specific_gravity'] * 10;

        $first_layer = $first_total;
        /*first layer start*/
        
        /*second layer start*/
        $second_result = (28 - $new_s['soil_mos']) / 100;

        $second_total = $second_result * $new_s['specific_gravity'] * 10;

        $second_layer = $second_total;
        /*second layer start*/

        /*second layer start*/
        $third_result = (28 - $new_s['soil_mos']) / 100;

        $third_total = $third_result * $new_s['specific_gravity'] * 10;

        $third_layer = $third_total;
        /*second layer start*/

        /*total water deficit start*/
        $total_water = $first_layer + $second_layer + $third_layer;
        /*total water deficit end*/

        /*water liter calculation start*/
        $land_size = LandSize::where('user_id', $user_id)->first();

        if($land_size->land_type == 'Bigha')
        {
            //1 bigha = 2508.38
            $water_total = $total_water * (2508.38 * $land_size->size);

            $water_grand_total = number_format((float)$water_total, 2, '.', '');

            $result['action'] = $water_grand_total;

            $w_a = explode('-', $water_total);

            if($w_a[0] == "")
            {
                $water_grand_total = 0;
                $result['action'] = "irrigation not required";
            }
        }elseif($land_size->land_type == 'Katha'){

             //1 katha = 67
             $water_total = $total_water * (67 * $land_size->size);

             $water_grand_total = number_format((float)$water_total, 2, '.', '');
 
             $result['action'] = $water_grand_total;
 
             $w_a = explode('-', $water_total);
 
             if($w_a[0] == "")
             {
                 $water_grand_total = 0;
                 $result['action'] = "irrigation not required";
             }
        }elseif ($land_size->land_type == 'Decimal') {
            //1  Decimal = 40.46
             $water_total = $total_water * (40.46 * $land_size->size);

             $water_grand_total = number_format((float)$water_total, 2, '.', '');
 
             $result['action'] = $water_grand_total;
 
             $w_a = explode('-', $water_total);
 
             if($w_a[0] == "")
             {
                 $water_grand_total = 0;
                 $result['action'] = "irrigation not required";
             }
        }elseif ($land_size->land_type == 'Hector') {
            //1  hector = 10000
            $water_total = $total_water * (10000 * $land_size->size);

            $water_grand_total = number_format((float)$water_total, 2, '.', '');

            $result['action'] = $water_grand_total;

            $w_a = explode('-', $water_total);

            if($w_a[0] == "")
            {
                $water_grand_total = 0;
                $result['action'] = "irrigation not required";
            }
        }else{
            //nothing
        }
        /*water liter calculation end*/

        $soil_tem = ["27","30","25","31","29","30","28","26","32","24"];

        $soil_m = $soil_mos[array_rand($soil_mos)];

        $soil_t = $soil_tem[array_rand($soil_tem)];

        foreach( $land_prepration as $lp)
        {
            $result_irrigation['id'] = $lp->id;
            $result_irrigation['user_id'] = $lp->user_id;
            $result_irrigation['crop_id'] = $lp->crop_id;

            foreach( $land_prepration_season as $lps)
            {
                if($lp->season_id == $lps->id)
                {
                    $result_irrigation['season_eng'] = $lps->name_en; 
                    $result_irrigation['season_bn'] = $lps->name_bn; 
                    
                    if($lps->cultural_operation == 'plough')
                    {
                        $result_irrigation['polugh']['start_date'] = $lps->start_date;
                        $result_irrigation['polugh']['end_date'] = $lps->end_date;
                    }

                    if($lps->cultural_operation == 'sowing')
                    {
                        $result_irrigation['sowing']['start_date'] = $lps->start_date;
                        $result_irrigation['sowing']['end_date'] = $lps->end_date;
                    }
                    
                }
            }
        }

        $result_irrigation['soil_moisture'] = $soil_m;
        $result_irrigation['soil_temperature'] = $soil_t;
        $result_irrigation['water_level'] = $water_grand_total;
        //irrigation end

        //fertilize start
        $nitrogen = ["40","52","20","18","33"];

        $potassium = ["150","100","60","80","120"];

        $phosphorus = ["32","14","5","46","58"];

        $n = $nitrogen[array_rand($nitrogen)];

        $p = $potassium[array_rand($potassium)];

        $ph = $phosphorus[array_rand($phosphorus)];

        foreach( $land_prepration as $lp)
        {
            $result_fertilize['id'] = $lp->id;
            $result_fertilize['user_id'] = $lp->user_id;
            $result_fertilize['crop_id'] = $lp->crop_id;

            foreach( $land_prepration_season as $lps)
            {
                if($lp->season_id == $lps->id)
                {
                    $result_fertilize['season_eng'] = $lps->name_en; 
                    $result_fertilize['season_bn'] = $lps->name_bn; 
                }
            }
        }

        $result_fertilize['standard'] = ["nitrogen", "potassium", "phosphorus"];

        $result_fertilize['standard_value'] = [
            ["nitrogen" => "25mg", "soil" => "100mg"], 
            ["potassium" => "70mg", "soil" => "100mg"],
            ["phosphorus" => "40mg", "soil" => "100mg"]
        ];
       
        $result_fertilize['current_value'] = ["nitrogen" => $n, "potassium" => $p, "phosphorus" => $ph];

        $result_fertilize['your_value'] = ["nitrogen" => 0, "potassium" => 0, "phosphorus" => 0];

        $new_standard = [
            ["nitrogen" => 25, "soil" => "100mg"], 
            ["potassium" => 70, "soil" => "100mg"],
            ["phosphorus" => 40, "soil" => "100mg"]
        ];

        $land_size = LandSize::where('user_id', $user_id)->first();

        /*nitrogen calculation start*/
        $n_result = $new_standard[0]["nitrogen"] - $n;

        $n_r = explode("-", $n_result);

        $n_grand_result = $n_result;

        $one_hactor = ($n_grand_result * 2000000000) / 100000000;

        $nitrogen_kg = '';

        if($land_size->land_type == 'Hector')
        {
            $nitrogen_result = $one_hactor * $land_size->size;

            $nitrogen_kg = number_format((float)$nitrogen_result, 2, '.', '');

        }elseif ($land_size->land_type == 'Decimal') {

            $nitrogen_result = ($one_hactor * 40.46) / 10000;

            $nitrogen_result_grand = $nitrogen_result * $land_size->size;

            $nitrogen_kg = number_format((float)$nitrogen_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Katha') {

            $nitrogen_result = ($one_hactor * 67) / 10000;

            $nitrogen_result_grand = $nitrogen_result * $land_size->size;

            $nitrogen_kg = number_format((float)$nitrogen_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Bigha') {

            $nitrogen_result = ($one_hactor * 2508.38) / 10000;

            $nitrogen_result_grand = $nitrogen_result * $land_size->size;

            $nitrogen_kg = number_format((float)$nitrogen_result_grand, 2, '.', '');

        }else{
            //
        }

        if($n_r[0] == "")
        {
            $nitrogen_kg = "Not need";
        }

        /*nitrogen calculation end*/

        /*potissum calculation start*/
        $k_result = $new_standard[1]['potassium'] - $p;

        $k_r = explode("-", $k_result);

        $k_grand_result = $k_result;

        $one_hactor = ($k_grand_result * 2000000000) / 100000000;

        $potassium_kg = '';

        if($land_size->land_type == 'Hector')
        {
            $potassium_result = $one_hactor * $land_size->size;

            $potassium_kg = number_format((float)$potassium_result, 2, '.', '');

        }elseif ($land_size->land_type == 'Decimal') {

            $potassium_result = ($one_hactor * 40.46) / 10000;

            $potassium_result_grand = $nitrogen_result * $land_size->size;

            $potassium_kg = number_format((float)$potassium_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Katha') {

            $potassium_result = ($one_hactor * 67) / 10000;

            $potassium_result_grand = $potassium_result * $land_size->size;

            $potassium_kg = number_format((float)$nitrogen_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Bigha') {

            $potassium_result = ($one_hactor * 2508.38) / 10000;

            $potassium_result_grand = $potassium_result * $land_size->size;

            $potassium_kg = number_format((float)$potassium_result_grand, 2, '.', '');

        }else{
            //
        }

        if($k_r[0] == "")
        {
            $potassium_kg = "Not need";
        }
        /*potissum calculation end*/

       
        /*posphorus calculation start*/
        $ph_result = $new_standard[2]['phosphorus'] - $ph;

        $ph_r = explode("-", $ph_result);

        $ph_grand_result = $ph_result;

        $one_hactor = ($ph_grand_result * 2000000000) / 100000000;

        $phosphorus_kg = '';

        if($land_size->land_type == 'Hector')
        {
            $phosphorus_result = $one_hactor * $land_size->size;

            $phosphorus_kg = number_format((float)$phosphorus_result, 2, '.', '');

        }elseif ($land_size->land_type == 'Decimal') {

            $phosphorus_result = ($one_hactor * 40.46) / 10000;

            $phosphorus_result_grand = $phosphorus_result * $land_size->size;

            $phosphorus_kg = number_format((float)$phosphorus_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Katha') {

            $phosphorus_result = ($one_hactor * 67) / 10000;

            $phosphorus_result_grand = $phosphorus_result * $land_size->size;

            $phosphorus_kg = number_format((float)$phosphorus_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Bigha') {

            $phosphorus_result = ($one_hactor * 2508.38) / 10000;

            $phosphorus_result_grand = $phosphorus_result * $land_size->size;

            $phosphorus_kg = number_format((float)$phosphorus_result_grand, 2, '.', '');

        }else{
            //
        }

        if($ph_r[0] == "")
        {
            $phosphorus_kg = "Not need";
        }
        /*posphorus calculation end*/

        $result_fertilize['action'] = ["nitrogen" => $nitrogen_kg, "potassium" => $potassium_kg, "phosphorus" => $phosphorus_kg];
        //fertilize end

        //pestiside start
        $pestiside_percentage = "50%";

        $remedy = ["You should add more water","Spray more detergent"];

        foreach( $land_prepration as $lp)
        {
            $result_pestiside['id'] = $lp->id;
            $result_pestiside['user_id'] = $lp->user_id;
            $result_pestiside['crop_id'] = $lp->crop_id;

            foreach( $land_prepration_season as $lps)
            {
                if($lp->season_id == $lps->id)
                {
                    $result_pestiside['season_eng'] = $lps->name_en; 
                    $result_pestiside['season_bn'] = $lps->name_bn; 
                }
            }
        }

        $result_pestiside['diseases'] = $pestiside_percentage;
        $result_pestiside['action'] = $remedy;
        //pestiside end

        return response()->json([
            'irrigation' => $result_irrigation,
            'fertilize' => $result_fertilize,
            'pestiside' => $result_pestiside
        ]);
    }

    public function irrigation(Request $request)
    {
        $result = [];

        $user_id = $request->user_id;

        $crop_id = $request->crop_id;

        $soil_mos = ["30","31","22","18","25","27","32","28","29","30"];

        $new_soil_mos = [
            ["soil_mos" => 30, "specific_gravity" => 1.39],
            ["soil_mos" => 31, "specific_gravity" => 1.42],
            ["soil_mos" => 22, "specific_gravity" => 1.43],
            ["soil_mos" => 18, "specific_gravity" => 1.45],
            ["soil_mos" => 25, "specific_gravity" => 1.44],
            ["soil_mos" => 27, "specific_gravity" => 1.47],
            ["soil_mos" => 32, "specific_gravity" => 1.48],
            ["soil_mos" => 28, "specific_gravity" => 1.49],
            ["soil_mos" => 29, "specific_gravity" => 1.50],
            ["soil_mos" => 30, "specific_gravity" => 1.52]
        ];

        $new_s = $new_soil_mos[array_rand($new_soil_mos)];

        $field_capacity = 28;

        /*first layer start*/
        $first_result = (28 - $new_s['soil_mos']) / 100;

        $first_total = $first_result * $new_s['specific_gravity'] * 10;

        $first_layer = $first_total;
        /*first layer start*/
        
        /*second layer start*/
        $second_result = (28 - $new_s['soil_mos']) / 100;

        $second_total = $second_result * $new_s['specific_gravity'] * 10;

        $second_layer = $second_total;
        /*second layer start*/

        /*second layer start*/
        $third_result = (28 - $new_s['soil_mos']) / 100;

        $third_total = $third_result * $new_s['specific_gravity'] * 10;

        $third_layer = $third_total;
        /*second layer start*/

        /*total water deficit start*/
        $total_water = $first_layer + $second_layer + $third_layer;
        /*total water deficit end*/

        /*water liter calculation start*/
        $land_size = LandSize::where('user_id', $user_id)->first();

        if($land_size->land_type == 'Bigha')
        {
            //1 bigha = 2508.38
            $water_total = $total_water * (2508.38 * $land_size->size);

            $water_grand_total = number_format((float)$water_total, 2, '.', '');

            $result['action'] = $water_grand_total;

            $w_a = explode('-', $water_total);

            if($w_a[0] == "")
            {
                $water_grand_total = 0;
                $result['action'] = "irrigation not required";
            }
        }elseif($land_size->land_type == 'Katha'){

             //1 katha = 67
             $water_total = $total_water * (67 * $land_size->size);

             $water_grand_total = number_format((float)$water_total, 2, '.', '');
 
             $result['action'] = $water_grand_total;
 
             $w_a = explode('-', $water_total);
 
             if($w_a[0] == "")
             {
                 $water_grand_total = 0;
                 $result['action'] = "irrigation not required";
             }
        }elseif ($land_size->land_type == 'Decimal') {
            //1  Decimal = 40.46
             $water_total = $total_water * (40.46 * $land_size->size);

             $water_grand_total = number_format((float)$water_total, 2, '.', '');
 
             $result['action'] = $water_grand_total;
 
             $w_a = explode('-', $water_total);
 
             if($w_a[0] == "")
             {
                 $water_grand_total = 0;
                 $result['action'] = "irrigation not required";
             }
        }elseif ($land_size->land_type == 'Hector') {
            //1  hector = 10000
            $water_total = $total_water * (10000 * $land_size->size);

            $water_grand_total = number_format((float)$water_total, 2, '.', '');

            $result['action'] = $water_grand_total;

            $w_a = explode('-', $water_total);

            if($w_a[0] == "")
            {
                $water_grand_total = 0;
                $result['action'] = "irrigation not required";
            }
        }else{
            //nothing
        }
        /*water liter calculation end*/

        $soil_tem = ["27","30","25","31","29","30","28","26","32","24"];

        $soil_m = $soil_mos[array_rand($soil_mos)];

        $soil_t = $soil_tem[array_rand($soil_tem)];

        $land_prepration = LandPrepration::select(
                                'land_preprations.id as id',
                                'land_preprations.user_id as user_id',
                                'land_preprations.crop_id as crop_id',
                                'land_season.season_id as season_id'
                            )
                            ->where('user_id', $user_id)
                            ->orWhere('crop_id', $crop_id)
                            ->leftJoin('land_season', function($join){
                                $join->on('land_preprations.id','=','land_season.land_prepration_id');
                            })
                            ->get();

        $land_prepration_season = LandPreprationSeasion::latest()->get();


        foreach( $land_prepration as $lp)
        {
            $result['id'] = $lp->id;
            $result['user_id'] = $lp->user_id;
            $result['crop_id'] = $lp->crop_id;

            foreach( $land_prepration_season as $lps)
            {
                if($lp->season_id == $lps->id)
                {
                    $result['season_eng'] = $lps->name_en; 
                    $result['season_bn'] = $lps->name_bn; 
                    
                    if($lps->cultural_operation == 'plough')
                    {
                        $result['polugh']['start_date'] = $lps->start_date;
                        $result['polugh']['end_date'] = $lps->end_date;
                    }

                    if($lps->cultural_operation == 'sowing')
                    {
                        $result['sowing']['start_date'] = $lps->start_date;
                        $result['sowing']['end_date'] = $lps->end_date;
                    }
                    
                }
            }
        }

        $result['soil_moisture'] = $soil_m;
        $result['soil_temperature'] = $soil_t;
        $result['water_level'] = $water_grand_total;

        return response()->json([
             'irregation' =>  $result
        ]);
    }

    public function fertilizer(Request $request)
    {
        $user_id = $request->user_id;

        $crop_id = $request->crop_id;

        $nitrogen = ["40","52","20","18","33"];

        $potassium = ["150","100","60","80","120"];

        $phosphorus = ["32","14","5","46","58"];

        $n = $nitrogen[array_rand($nitrogen)];

        $p = $potassium[array_rand($potassium)];

        $ph = $phosphorus[array_rand($phosphorus)];

        $result = [];

        $land_prepration = LandPrepration::select(
                                'land_preprations.id as id',
                                'land_preprations.user_id as user_id',
                                'land_preprations.crop_id as crop_id',
                                'land_season.season_id as season_id'
                            )
                            ->where('user_id', $user_id)
                            ->orWhere('crop_id', $crop_id)
                            ->leftJoin('land_season', function($join){
                                $join->on('land_preprations.id','=','land_season.land_prepration_id');
                            })
                            ->get();

        $land_prepration_season = LandPreprationSeasion::latest()->get();


        foreach( $land_prepration as $lp)
        {
            $result['id'] = $lp->id;
            $result['user_id'] = $lp->user_id;
            $result['crop_id'] = $lp->crop_id;

            foreach( $land_prepration_season as $lps)
            {
                if($lp->season_id == $lps->id)
                {
                    $result['season_eng'] = $lps->name_en; 
                    $result['season_bn'] = $lps->name_bn; 
                }
            }
        }

        $result['standard'] = ["nitrogen", "potassium", "phosphorus"];

        $result['standard_value'] = [
            ["nitrogen" => "25mg", "soil" => "100mg"], 
            ["potassium" => "70mg", "soil" => "100mg"],
            ["phosphorus" => "40mg", "soil" => "100mg"]
        ];
       
        $result['current_value'] = ["nitrogen" => $n, "potassium" => $p, "phosphorus" => $ph];

        $result['your_value'] = ["nitrogen" => 0, "potassium" => 0, "phosphorus" => 0];

        $new_standard = [
            ["nitrogen" => 25, "soil" => "100mg"], 
            ["potassium" => 70, "soil" => "100mg"],
            ["phosphorus" => 40, "soil" => "100mg"]
        ];

        $land_size = LandSize::where('user_id', $user_id)->first();

        /*nitrogen calculation start*/
        $n_result = $new_standard[0]["nitrogen"] - $n;

        $n_r = explode("-", $n_result);

        $n_grand_result = $n_result;

        $one_hactor = ($n_grand_result * 2000000000) / 100000000;

        $nitrogen_kg = '';

        if($land_size->land_type == 'Hector')
        {
            $nitrogen_result = $one_hactor * $land_size->size;

            $nitrogen_kg = number_format((float)$nitrogen_result, 2, '.', '');

        }elseif ($land_size->land_type == 'Decimal') {

            $nitrogen_result = ($one_hactor * 40.46) / 10000;

            $nitrogen_result_grand = $nitrogen_result * $land_size->size;

            $nitrogen_kg = number_format((float)$nitrogen_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Katha') {

            $nitrogen_result = ($one_hactor * 67) / 10000;

            $nitrogen_result_grand = $nitrogen_result * $land_size->size;

            $nitrogen_kg = number_format((float)$nitrogen_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Bigha') {

            $nitrogen_result = ($one_hactor * 2508.38) / 10000;

            $nitrogen_result_grand = $nitrogen_result * $land_size->size;

            $nitrogen_kg = number_format((float)$nitrogen_result_grand, 2, '.', '');

        }else{
            //
        }

        if($n_r[0] == "")
        {
            $nitrogen_kg = "Not need";
        }

        /*nitrogen calculation end*/

        /*potissum calculation start*/
        $k_result = $new_standard[1]['potassium'] - $p;

        $k_r = explode("-", $k_result);

        $k_grand_result = $k_result;

        $one_hactor = ($k_grand_result * 2000000000) / 100000000;

        $potassium_kg = '';

        if($land_size->land_type == 'Hector')
        {
            $potassium_result = $one_hactor * $land_size->size;

            $potassium_kg = number_format((float)$potassium_result, 2, '.', '');

        }elseif ($land_size->land_type == 'Decimal') {

            $potassium_result = ($one_hactor * 40.46) / 10000;

            $potassium_result_grand = $nitrogen_result * $land_size->size;

            $potassium_kg = number_format((float)$potassium_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Katha') {

            $potassium_result = ($one_hactor * 67) / 10000;

            $potassium_result_grand = $potassium_result * $land_size->size;

            $potassium_kg = number_format((float)$nitrogen_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Bigha') {

            $potassium_result = ($one_hactor * 2508.38) / 10000;

            $potassium_result_grand = $potassium_result * $land_size->size;

            $potassium_kg = number_format((float)$potassium_result_grand, 2, '.', '');

        }else{
            //
        }

        if($k_r[0] == "")
        {
            $potassium_kg = "Not need";
        }
        /*potissum calculation end*/

       
        /*posphorus calculation start*/
        $ph_result = $new_standard[2]['phosphorus'] - $ph;

        $ph_r = explode("-", $ph_result);

        $ph_grand_result = $ph_result;

        $one_hactor = ($ph_grand_result * 2000000000) / 100000000;

        $phosphorus_kg = '';

        if($land_size->land_type == 'Hector')
        {
            $phosphorus_result = $one_hactor * $land_size->size;

            $phosphorus_kg = number_format((float)$phosphorus_result, 2, '.', '');

        }elseif ($land_size->land_type == 'Decimal') {

            $phosphorus_result = ($one_hactor * 40.46) / 10000;

            $phosphorus_result_grand = $phosphorus_result * $land_size->size;

            $phosphorus_kg = number_format((float)$phosphorus_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Katha') {

            $phosphorus_result = ($one_hactor * 67) / 10000;

            $phosphorus_result_grand = $phosphorus_result * $land_size->size;

            $phosphorus_kg = number_format((float)$phosphorus_result_grand, 2, '.', '');

        }elseif ($land_size->land_type == 'Bigha') {

            $phosphorus_result = ($one_hactor * 2508.38) / 10000;

            $phosphorus_result_grand = $phosphorus_result * $land_size->size;

            $phosphorus_kg = number_format((float)$phosphorus_result_grand, 2, '.', '');

        }else{
            //
        }

        if($ph_r[0] == "")
        {
            $phosphorus_kg = "Not need";
        }
        /*posphorus calculation end*/

        $result['action'] = ["nitrogen" => $nitrogen_kg, "potassium" => $potassium_kg, "phosphorus" => $phosphorus_kg];

        return response()->json([
            'fertilizer' => $result
        ]);
    }

    public function pestisides(Request $request)
    {
        $user_id = $request->user_id;

        $crop_id = $request->crop_id;

        $pestiside_percentage = "50%";

        

        $result = [];

        $land_prepration = LandPrepration::select(
                                'land_preprations.id as id',
                                'land_preprations.user_id as user_id',
                                'land_preprations.crop_id as crop_id',
                                'land_season.season_id as season_id'
                            )
                            ->where('user_id', $user_id)
                            ->orWhere('crop_id', $crop_id)
                            ->leftJoin('land_season', function($join){
                                $join->on('land_preprations.id','=','land_season.land_prepration_id');
                            })
                            ->get();

        $land_prepration_season = LandPreprationSeasion::latest()->get();


        foreach( $land_prepration as $lp)
        {
            $result['id'] = $lp->id;
            $result['user_id'] = $lp->user_id;
            $result['crop_id'] = $lp->crop_id;

            foreach( $land_prepration_season as $lps)
            {
                if($lp->season_id == $lps->id)
                {
                    $result['season_eng'] = $lps->name_en; 
                    $result['season_bn'] = $lps->name_bn; 
                }
            }
        }

        $land_size = LandSize::where('user_id', $user_id)->first();

        $confider = '';
        $water_amount = '';

        if($land_size->land_type == 'Hector')
        {
            //1 hactor 10000
            $one_hactor = 40;

            $total_water = 40 * $land_size->size;

            $water_amount = number_format((float)$total_water, 2, '.', '');

            $total = (40 * 2) * $land_size->size;

            $confider = number_format((float)$total, 2, '.', '');
        }elseif ($land_size->land_type == 'Decimal') {
            //1 decimal 40.46
            $total = (80 * 40.46) / 10000;

            $total_water = (40 * 40.46) / 10000;

            $water_amount = number_format((float)$total_water, 2, '.', '');

            $confider = number_format((float)$total, 2, '.', '');
        }elseif ($land_size->land_type == 'Katha'){

            //1 katha = 67
            $total = (80 * 67) / 10000;

            $total_water = (40 * 67) / 10000;

            $water_amount = number_format((float)$total_water, 2, '.', '');

            $confider = number_format((float)$total, 2, '.', '');
        }elseif ($land_size->land_type == 'Bigha') {
            //1 bigha = 2508.38
            $total = (80 * 2508) / 10000;

            $total_water = (40 *  2508.38) / 10000;

            $water_amount = number_format((float)$total_water, 2, '.', '');

            $confider = number_format((float)$total, 2, '.', '');
        }else{
            //
        }

        $result['diseases'] = $pestiside_percentage;
        $result['action_eng'] = ["Spray ".$water_amount." liter water with ".$confider." ml confider"];
        $result['action_bn'] = [ $water_amount." লিটার জল সঙ্গে".$confider." মিলি কনফিডের স্প্রে করুন"];


        return response()->json([
            'pestisides' =>  $result
        ]);
    }

    public function process()
    {
        $process_english = [
            "Climate_land_and_soil" => "The optimum temperature for its better growth is 150-170 C. Higher yield may be obtained when soil becomes clay loam or silt. Optimum soil PH ranges from 5.5 to 6.5.",
            "Time_of_sowing" => "Mid August-September for winter and mid February-March for summer are the optimum times for seed sowing.",
            "Seedbed_preparation" => "Nursery bed is to be made 15-20 cm high with fine prepared soil. Usually the soil mixture for the bed should have one part soil, one part sand and one part compost. The standard size of the bed should be 1.0m x 3.0 m.",
            "Transplanting_method" => "Thirty to thirty five day old seedlings should be transplanted having 5-6 true leaves.",
            "Land_preparation" => "After final preparation of land, prepare 70-80 cm wide and 15 cm high bed. On the bed, one row should be made and transplant the seedlings on the rows at a spacing of 70-80 cm.",
            "Fertilizer_dose_and_application_method" => "The land is fertilized with cowdung, Urea, TSP and MP @ 10 ton, 375 kg, 150 kg and 250 kg/ha, respectively. The entire amount of cowdung, TSP and half of MP should be applied during land preparation. The remaining half of MP and entire amount of urea are tobe applied in three equal installments at 20, 40 and 60 days after transplanting.",
            "Irrigation" => "The field should be irrigated every 10-12 days during the winter followed by mulching to facilitate good aeration.",
            "Pest_management" => "Brinjal shoot and fruit borer (BSFB) is the most destructive insects of brinjal.",
            "Control_measures" => "Dursban / Pyriphos 20 EC @ at 5.0 ml / litre of water should be sprayed"
        ];

        $process_bangla = [
            "Climate_land_and_soil" => "এর ভাল বৃদ্ধির জন্য সর্বোত্তম তাপমাত্রা হল 150-170 সে। মাটি এঁটেল দোআঁশ বা পলিতে পরিণত হলে উচ্চ ফলন পাওয়া যেতে পারে। সর্বোত্তম মাটির PH রেঞ্জ 5.5 থেকে 6.5 পর্যন্ত।",
            "Time_of_sowing" => "শীতের জন্য আগস্ট-সেপ্টেম্বরের মাঝামাঝি এবং গ্রীষ্মের জন্য ফেব্রুয়ারি-মার্চের মাঝামাঝি হল বীজ বপনের সর্বোত্তম সময়।",
            "Seedbed_preparation" => "নার্সারি বেড 15-20 সেন্টিমিটার উঁচু সূক্ষ্ম প্রস্তুত মাটি দিয়ে তৈরি করতে হয়। সাধারণত বিছানার জন্য মাটির মিশ্রণে এক ভাগ মাটি, এক ভাগ বালি এবং এক ভাগ কম্পোস্ট থাকতে হবে। বিছানার আদর্শ আকার 1.0m x 3.0 m হওয়া উচিত।",
            "Transplanting_method" => "ত্রিশ থেকে পঁয়ত্রিশ দিন বয়সী চারা রোপণ করতে হবে যাতে 5-6টি সত্য পাতা থাকে।",
            "Land_preparation" => "জমি প্রস্তুত করার পর, 70-80 সেমি চওড়া এবং 15 সেমি উঁচু বেড প্রস্তুত করুন। বেডে এক সারি করে ৭০-৮০ সেন্টিমিটার ব্যবধানে সারিতে চারা রোপণ করতে হবে।",
            "Fertilizer_dose_and_application_method" => "জমিকে গোবর, ইউরিয়া, টিএসপি এবং এমপি @ 10 টন, 375 কেজি, 150 কেজি এবং 250 কেজি/হেক্টরে উর্বর করা হয়। জমি তৈরির সময় গোবর, টিএসপি এবং এমপির অর্ধেক পরিমাণ প্রয়োগ করতে হবে। অবশিষ্ট অর্ধেক এমপি এবং সম্পূর্ণ পরিমাণ ইউরিয়া রোপণের 20, 40 এবং 60 দিন পর তিনটি সমান কিস্তিতে প্রয়োগ করতে হবে।",
            "Irrigation" => "শীতকালে প্রতি 10-12 দিন পর পর জমিতে সেচ দিতে হবে ভাল বায়ু চলাচলের সুবিধার্থে মালচিং দ্বারা।",
            "Pest_management" => "বেগুনের সবচেয়ে ধ্বংসাত্মক পোকা হল বেগুনের অঙ্কুর এবং ফল ছিদ্রকারী (BSFB)।",
            "Control_measures" => "ডার্সবান/পাইরিফস ২০ ইসি @ ৫.০ মিলি/লিটার পানিতে মিশিয়ে স্প্রে করতে হবে।"
        ];

        return response()->json([
            'english' => $process_english,
            'bangla' => $process_bangla
        ]);
    }

    public function getData(Request $request)
    {
        $cultivation = CultivationSection::with(['cultivationCategory','crop', 'cultivationseason.cultivationpreprationseasion'])->paginate(1);

         return response()->json([
             'data' =>  $cultivation,
             'draw' => $request->input('draw')
         ]);
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function store(CultivationSectionRequest $request)
    {
        if($request->isMethod('post'))
        {
            

                if(CultivationSection::where('user_id', $request->user_id)->where('crop_id', $request->crop_id)->where('category_id', $request->category_id)->exists())
                {
                    //update data

                    $user = DB::connection('mysql2')->table('users')->where('id', $request->user_id)->first();

                    $crop = Crop::where('id', $request->crop_id)->first();

                    $land_size = LandSize::where('id', $request->land_id)->first();

                    $cultivation_category = CultivationCategory::where('id', $request->category_id)->first();

                    $cultivation =  CultivationSection::where('user_id', $request->user_id)
                    ->where('crop_id', $request->crop_id)
                    ->where('category_id', $request->category_id)
                    ->first();
    
                    $data[] = ["soil_mos" => $request->soil_moisture, "soil_tem" => $request->soil_temperature];

                    if($cultivation_category->name == $request->operation_type && $request->operation_type == 'irrigation')
                    {
                        $cultivation->update([
                            'details->soil_mos' => $request->soil_moisture,
                            'details->soil_tem' => $request->soil_temperature,
                            'details->water_level' => $request->water_level
 
                        ]);

                        $data = ["soil_mos" => $request->soil_moisture, "soil_tem" => $request->soil_temperature, "water_level" => $request->water_level];

                        //$string_data = json_decode(json_encode($data), true);
                        $iot = [
                            'user_name' => $user->name,
                            'crop_name' => $crop->name_en,
                            'land_size' => $land_size->size,
                            'category_name' => $request->operation_type,
                            'details' => $data,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];

                        CultivationTrainingIot::create($iot);
    
                    }elseif ($cultivation_category->name == $request->operation_type && $request->operation_type == 'fertilizer') {
                        $cultivation->update([
                            'details->nitrogen' => $request->nitrogen,
                            'details->potassium' => $request->potassium,
                            'details->phosphorus' => $request->phosphorus
                        ]);

                        $data = ["nitrogen" => $request->nitrogen, "potassium" => $request->potassium, "phosphorus" => $request->phosphorus];

                        $iot = [
                            'user_name' => $user->name,
                            'crop_name' => $crop->name_en,
                            'land_size' => $land_size->size,
                            'category_name' => $request->operation_type,
                            'details' => $data,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];

                        CultivationTrainingIot::create($iot);
                        
                    }elseif ($cultivation_category->name == $request->operation_type && $request->operation_type == 'pestiside') {
                        $cultivation->update([
                            'details->diseases' => $request->diseases,
                            'details->remedy' => $request->remedy
                        ]);

                        $data = ["diseases" => $request->diseases, "action" => $request->remedy];

                        $iot = [
                            'user_name' => $user->name,
                            'crop_name' => $crop->name_en,
                            'land_size' => $land_size->size,
                            'category_name' => $request->operation_type,
                            'details' => $data,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];

                        CultivationTrainingIot::create($iot);

                    }else{
                        $cultivation->update([]);
                    }
    
                   
                    return response()->json([
                        'cultivationSection' => $cultivation,
                        'message' => 'Cultivation section updated successful'
                    ],Response::HTTP_OK);
                }else{
                     //create CultivationSection model
                     $user = DB::connection('mysql2')->table('users')->where('id', $request->user_id)->first();

                     $crop = Crop::where('id', $request->crop_id)->first();

                     $land_size = LandSize::where('id', $request->land_id)->first();

                     $cultivationSection = new CultivationSection();

                     $cultivationSection->user_id = $request->user_id;
                     $cultivationSection->crop_id = $request->crop_id;
                     $cultivationSection->land_preparation_id = $request->land_preparation_id;
                     $cultivationSection->land_id = $request->land_id;
                     
                     $cultivationSection->category_id = $request->category_id;

                     $cultivation_category = CultivationCategory::where('id', $request->category_id)->first();

                     if($cultivation_category->name == $request->operation_type && $request->operation_type == 'irrigation')
                     {
                        $data = ["soil_mos" => $request->soil_moisture, "soil_tem" => $request->soil_temperature, "water_level" => $request->water_level];
 
                        $cultivationSection->details = $data;

                        $iot = [
                            'user_name' => $user->name,
                            'crop_name' => $crop->name_en,
                            'land_size' => $land_size->size,
                            'category_name' => $request->operation_type,
                            'details' => $data,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];

                        CultivationTrainingIot::create($iot);
    
                     }elseif ($cultivation_category->name == $request->operation_type && $request->operation_type == 'fertilizer') {

                        $data = ["nitrogen" => $request->nitrogen, "potassium" => $request->potassium, "phosphorus" => $request->phosphorus];
 
                        $cultivationSection->details = $data;

                        $iot = [
                            'user_name' => $user->name,
                            'crop_name' => $crop->name_en,
                            'land_size' => $land_size->size,
                            'category_name' => $request->operation_type,
                            'details' => $data,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];

                        CultivationTrainingIot::create($iot);

                     }elseif($cultivation_category->name == $request->operation_type && $request->operation_type == 'pestiside') {

                        $data = ["diseases" => $request->diseases, "remedy" => $request->remedy];

                        $cultivationSection->details = $data;

                        $iot = [
                            'user_name' => $user->name,
                            'crop_name' => $crop->name_en,
                            'land_size' => $land_size->size,
                            'category_name' => $request->operation_type,
                            'details' => $data,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];

                        CultivationTrainingIot::create($iot);

                     }else{
                        $cultivationSection->details = '';
                     }
 
                     
                     $cultivationSection->save();
 
                     $cultivationSection_id = DB::getPdo()->lastInsertId();
 
                     foreach($request->input('seasion_id') as $s)
                     {
                         DB::table('cultivation_season')->insert([
                             'cultivation_section_id' => $cultivationSection_id,
                             'seasion_id' => $s['id'],
                             'created_at' => Carbon::now(),
                             'updated_at' => Carbon::now(),
                         ]);
                     }
 
                     DB::commit();
 
                     return response()->json([
                         'cultivationSection' => $cultivationSection,
                         'message' => 'Cultivation section store successful'
                     ],Response::HTTP_CREATED);

                }
        }
    }
}
