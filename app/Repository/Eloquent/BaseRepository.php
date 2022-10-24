<?php

namespace App\Repository\Eloquent;

use App\Repository\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function save(array $inputs, array $conditions = ['id' => null])
    {
        $inputs = array_merge($inputs, [
            'ins_id' => Auth::user()->id,
            'upd_id' => NULL,
            'upd_datetime' => date('Y-m-d H:i:s'),
            'ins_datetime' => date('Y-m-d H:i:s')
        ]);

        if($conditions['id'] != NULL) {
            $inputs['upd_id'] = Auth::user()->id;
        }

        return $this->model->updateOrCreate($conditions, $inputs);
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function deleteById($id)
    {
        $inputs = [
            'del_flag' => config('constants.action.DELETED'),
            'upd_datetime' => date('Y-m-d H:i:s'),
            'upd_id' => Auth::user()->id,
        ];
        return $this->model->updateOrCreate(['id' => $id], $inputs);
    }

    public function delete(array $conditions = [])
    {
        $inputs = [
            'del_flag' => config('constants.action.DELETED'),
            'upd_datetime' => date('Y-m-d H:i:s'),
            'upd_id' => Auth::user()->id,
        ];
        return $this->model->where($conditions)->update($inputs);
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
