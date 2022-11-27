<?php

namespace App\Service\Crud;

use App\Models\Country;
use Illuminate\Http\Response;

class CrudService implements CrudInterfaceService{

    public function getAllData(array $data)
    {
        $result = $data;

        return response()->json([
            'countries' => $result
        ],Response::HTTP_OK);
    }

    public function store(array $data)
    {
       Country::create($data);
    }

    public function edit($data)
    {
        $result = $data;

        return response()->json([
            'country' => $result
        ],Response::HTTP_OK);
    }

    public function update(array $data, $id)
    {
        Country::where('id', $id)->update($data);
    }

    public function destroy($id)
    {
        Country::where('id', $id)->delete();

        return response()->json(['message' => 'Country destroy successful']);
    }
}