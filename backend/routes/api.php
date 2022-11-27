<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\CountryController;
use App\Http\Controllers\api\v1\CropController;
use App\Http\Controllers\api\v1\CropSelectionController;
use App\Http\Controllers\api\v1\DepartmentController;
use App\Http\Controllers\api\v1\DivisionController;
use App\Http\Controllers\api\v1\DistrictController;
use App\Http\Controllers\api\v1\LandPreprationController;
use App\Http\Controllers\api\v1\LandPreprationSeasionController;
use App\Http\Controllers\api\v1\LandSizeController;
use App\Http\Controllers\api\v1\LocationController;
use App\Http\Controllers\api\v1\PocController;
use App\Http\Controllers\api\v1\PostOfficeController;
use App\Http\Controllers\api\v1\ThanaController;
use App\Http\Controllers\api\v1\UnionController;
use App\Http\Controllers\api\v1\VillageController;
use App\Http\Controllers\api\v1\LanguageController;
use App\Http\Controllers\api\v1\CultivationCategoryController;
use App\Http\Controllers\api\v1\CultivationSectionController;
use App\Http\Controllers\api\v1\WeatherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'info/v1', 'namespace' => 'api\v1'], function(){

    // land_preparation start
    Route::get('land_preparation/season_data/{userId}/{cropId}', [LandPreprationController::class, 'landPreparationSeasonData']);
    // land_preparation end

    //weather api route start
    Route::get('weather/{location}', [WeatherController::class, 'weatherForLocation']);
    //weather api route end

    //cultivation-section api route start
    Route::get('cultivation_section/road_map', [CultivationSectionController::class, 'index']);
    Route::get('cultivation_section/getData', [CultivationSectionController::class, 'getData']);
    Route::get('cultivation_section/irrigation', [CultivationSectionController::class, 'irrigation']);
    Route::get('cultivation_section/fertilizer', [CultivationSectionController::class, 'fertilizer']);
    Route::get('cultivation_section/pestisides', [CultivationSectionController::class, 'pestisides']);
    Route::get('cultivation_section/process', [CultivationSectionController::class, 'process']);
    Route::post('cultivation_section/store', [CultivationSectionController::class, 'store']);
    //cultivation-section api route end

    //cultivation-category api route start
    Route::get('cultivation', [CultivationCategoryController::class, 'index']);
    Route::get('cultivation/getData', [CultivationCategoryController::class, 'getData']);
    Route::post('cultivation/store', [CultivationCategoryController::class, 'store']);
    Route::get('cultivation/edit/{id}', [CultivationCategoryController::class, 'edit']);
    Route::put('cultivation/update/{id}', [CultivationCategoryController::class, 'update']);
    Route::delete('cultivation/destroy/{id}', [CultivationCategoryController::class, 'destroy']);
    //cultivation-category api route end

    //language api route start
    Route::post('language', [LanguageController::class, 'index']);
    Route::post('language/store', [LanguageController::class, 'store']);
    //language api route end

    //country api route start
    Route::get('country', [CountryController::class, 'index']);
    Route::get('country/getData', [CountryController::class, 'getData']);
    Route::post('country/store', [CountryController::class, 'store']);
    Route::get('country/edit/{id}', [CountryController::class, 'edit']);
    Route::put('country/update/{id}', [CountryController::class, 'update']);
    Route::delete('country/destroy/{id}', [CountryController::class, 'destroy']);
    //country api route end

    //division api route start
    Route::get('division', [DivisionController::class, 'index']);
    Route::get('division/getData', [DivisionController::class, 'getData']);
    Route::post('division/store', [DivisionController::class, 'store']);
    Route::get('division/edit/{id}', [DivisionController::class, 'edit']);
    Route::put('division/update/{id}', [DivisionController::class, 'update']);
    Route::delete('division/destroy/{id}', [DivisionController::class, 'destroy']);
    //division api route end

    //District api route start
    Route::get('district', [DistrictController::class, 'index']);
    Route::get('district/getData', [DistrictController::class, 'getData']);
    Route::post('district/store', [DistrictController::class, 'store']);
    Route::get('district/edit/{id}', [DistrictController::class, 'edit']);
    Route::put('district/update/{id}', [DistrictController::class, 'update']);
    Route::delete('district/destroy/{id}', [DistrictController::class, 'destroy']);
    //District api route end

    //Thana api route start
    Route::get('thana', [ThanaController::class, 'index']);
    Route::get('thana/getData', [ThanaController::class, 'getData']);
    Route::post('thana/store', [ThanaController::class, 'store']);
    Route::get('thana/edit/{id}', [ThanaController::class, 'edit']);
    Route::put('thana/update/{id}', [ThanaController::class, 'update']);
    Route::delete('thana/destroy/{id}', [ThanaController::class, 'destroy']);
    //Thana api route end

    //village route start
    Route::get('village', [VillageController::class, 'index']);
    Route::get('village/getData', [VillageController::class, 'getData']);
    Route::post('village/store', [VillageController::class, 'store']);
    Route::get('village/edit/{id}', [VillageController::class, 'edit']);
    Route::put('village/update/{id}', [VillageController::class, 'update']);
    Route::delete('village/destroy/{id}', [VillageController::class, 'destroy']);
    //village route end

    //union route start
    Route::get('union', [UnionController::class, 'index']);
    Route::get('union/getData', [UnionController::class, 'getData']);
    Route::post('union/store', [UnionController::class, 'store']);
    Route::get('union/edit/{id}', [UnionController::class, 'edit']);
    Route::put('union/update/{id}', [UnionController::class, 'update']);
    Route::delete('union/destroy/{id}', [UnionController::class, 'destroy']);
    //union route end

    //post office route start
    Route::get('post_office', [PostOfficeController::class, 'index']);
    Route::get('post_office/getData', [PostOfficeController::class, 'getData']);
    Route::post('post_office/store', [PostOfficeController::class, 'store']);
    Route::get('post_office/edit/{id}', [PostOfficeController::class, 'edit']);
    Route::put('post_office/update/{id}', [PostOfficeController::class, 'update']);
    Route::delete('post_office/destroy/{id}', [PostOfficeController::class, 'destroy']);
    //post office route end

    //poc route start
    Route::get('poc', [PocController::class, 'index']);
    Route::get('poc/getData', [PocController::class, 'getData']);
    Route::post('poc/store', [PocController::class, 'store']);
    Route::get('poc/edit/{id}', [PocController::class, 'edit']);
    Route::put('poc/update/{id}', [PocController::class, 'update']);
    Route::delete('poc/destroy/{id}', [PocController::class, 'destroy']);
    //poc route end

    //localtion route start
    Route::post('location', [LocationController::class, 'index']);
    Route::get('location/getData', [LocationController::class, 'getData']);
    Route::post('location/store', [LocationController::class, 'store']);
    //location route end

    //crop route start
    Route::get('crop', [CropController::class, 'index'])->name('crop-list');
    Route::get('crop/getData', [CropController::class, 'getData']);
    Route::post('crop/store', [CropController::class, 'store']);
    Route::get('crop/edit/{id}', [CropController::class, 'edit']);
    Route::put('crop/update/{id}', [CropController::class, 'update']);
    Route::delete('crop/destroy/{id}', [CropController::class, 'destroy']);
    //crop route end

    //department route start
    Route::get('department', [DepartmentController::class, 'index']);
    Route::get('department/getData', [DepartmentController::class, 'getData']);
    Route::post('department/store', [DepartmentController::class, 'store']);
    Route::get('department/edit/{id}', [DepartmentController::class, 'edit']);
    Route::put('department/update/{id}', [DepartmentController::class, 'update']);
    Route::delete('department/destroy/{id}', [DepartmentController::class, 'destroy']);
    //department route end

    //crop selection route start
    Route::get('crop_selection', [CropSelectionController::class, 'index']);
    Route::get('crop_selection/getData', [CropSelectionController::class, 'getData']);
    Route::post('crop_selection/store', [CropSelectionController::class, 'store']);
    //crop selection route end

    //land size route start
    Route::get('land_size',[LandSizeController::class, 'index']);
    Route::get('land_size/getData',[LandSizeController::class, 'getData']);
    Route::post('land_size/store',[LandSizeController::class, 'store']);
    //land size route end

    //land prepration seasion route start
    Route::get('land_prepration_seasion', [LandPreprationSeasionController::class, 'index']);
    Route::get('land_prepration_seasion/getData', [LandPreprationSeasionController::class, 'getData']);
    Route::post('land_prepration_seasion/store', [LandPreprationSeasionController::class, 'store']);
    Route::get('land_prepration_seasion/edit/{id}', [LandPreprationSeasionController::class, 'edit']);
    Route::put('land_prepration_seasion/update/{id}', [LandPreprationSeasionController::class, 'update']);
    Route::delete('land_prepration_seasion/destroy/{id}', [LandPreprationSeasionController::class, 'destroy']);
    //land prepration seasion route end

    //land prepration route start
    Route::get('land_prepration', [LandPreprationController::class, 'index']);
    Route::get('land_prepration/getData', [LandPreprationController::class, 'getData']);
    Route::post('land_prepration/store', [LandPreprationController::class, 'store']);
    //land prepration route end
});
