<?php

namespace App\Repository\Eloquent;

use App\Repository\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

//    public function paginate(array $input = [], $perPage = 5)
//    {
//        $query = $this->model->query();
//        return $query->paginate($perPage);
//    }

    public function save(array $inputs, array $conditions = ['id' => null])
    {
        $inputs = array_merge($inputs, [
            'ins_id' => 1,
            'upd_id' => NULL,
            'upd_datetime' => date('Y-m-d H:i:s'),
            'ins_datetime' => date('Y-m-d H:i:s')
        ]);
        return $this->model->updateOrCreate($conditions, $inputs);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function deleteById($id)
    {
        return $this->model->updateOrCreate(['id' => $id], ['del_flag' => 1]);
    }

    public function getAll(array $input = [])
    {
        return $this->model->all();
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
