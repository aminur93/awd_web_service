<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Language;
use Exception;

class LanguageController extends Controller{    
    
    public function index(Request $request)
    {
        $language = Language::where('user_id', $request->user_id)->first();

        return response()->json([
            'language' => $language
        ],Response::HTTP_OK);
    }

    public function store(LanguageRequest $request)
    {
        if($request->isMethod('post'))
        {
           
            if(Language::where('id', $request->language_id)->where('user_id', $request->user_id)->exists())
            {
                //update language model
                $language = Language::where('user_id', $request->user_id)->first();

                $language->update([
                    'user_id' => $request->user_id,
                    'name' => $request->name,
                ]);

                return response()->json([
                    'message' => 'Language updated successful'
                ],Response::HTTP_OK);
            }else{
                //create language model
                $language = new Language();

                $language->user_id = $request->user_id;
                $language->name = $request->name;
                $language->save();

                return response()->json([
                    'language' => $language,
                    'message' => 'Language store successful'
                ],Response::HTTP_CREATED);
            }

        }
    }
}
