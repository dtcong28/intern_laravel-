<?php


namespace App\Repository\Eloquent;

use App\Models\Team;

class TeamRepository extends BaseRepository
{
    public function __construct(Team $model)
    {
        $this->model = $model;
    }

    public function findByName($name)
    {

        if (empty($name)) {
            return $this->model->sortable()->paginate(config('constants.pagination.PER_PAGE'));
        }
        return $this->model->sortable()->where('name', 'like', '%' . $name . '%')->paginate(config('constants.pagination.PER_PAGE'));
    }
}
