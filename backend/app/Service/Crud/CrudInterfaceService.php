<?php

namespace App\Service\Crud;

interface CrudInterfaceService{

    public function getAllData(array $data);

    public function store(array $data);

    public function edit($data);

    public function update(array $data, $id);

    public function destroy($id);
}