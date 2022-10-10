<?php


namespace App\Repository\Eloquent;

use App\Models\Team;

class TeamRepository extends BaseRepository
{
    public function __construct(Team $model)
    {
        $this->model = $model;
    }
}
