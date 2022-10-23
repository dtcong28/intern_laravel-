<?php

namespace App\Repository;

interface BaseRepositoryInterface
{
    public function save(array $inputs, array $conditons = []);

    public function findById($id);

    public function deleteById($id);

    public function delete(array $conditons = []);

    public function getAll(array $input=[]);

    public function with($relations);
}
