<?php

namespace App\Repository;

interface BaseRepositoryInterface
{
//    public function paginate(array $input = [], $perPage = 5);

    public function save(array $inputs, array $conditons = []);

    public function findById($id);

    public function deleteById($id);

    public function getAll(array $input=[]);

    public function with($relations);
}
