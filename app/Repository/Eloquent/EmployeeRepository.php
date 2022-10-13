<?php


namespace App\Repository\Eloquent;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeRepository extends BaseRepository
{
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    public function findByTeamOrNameOrEmail($team,$name,$email)
    {
        if(!empty($team) && empty($name) && empty($email)) {

            return $this->model->sortable()->where('team_id', '=', $team)->paginate(config('constants.pagination.PER_PAGE'));

        }elseif (empty($team) && !empty($name) && empty($email)) {

            return $this->model->sortable()->Where(DB::raw("CONCAT(first_name,' ',last_name)"), 'like', '%'.$name.'%')->paginate(config('constants.pagination.PER_PAGE'));

        }elseif (empty($team) && empty($name) && !empty($email)) {

            return $this->model->sortable()->where('email', 'like', '%'.$email.'%')->paginate(config('constants.pagination.PER_PAGE'));

        }elseif (!empty($team) && !empty($name) && !empty($email)) {

            return $this->model->sortable()->where('team_id', '=', $team)
                                           ->where(DB::raw("CONCAT(first_name,' ',last_name)"), 'like', '%'.$name.'%')
                                           ->where('email', 'like', '%'.$email.'%')
                                           ->paginate(config('constants.pagination.PER_PAGE'));
        }else {

            return $this->model->sortable()->paginate(config('constants.pagination.PER_PAGE'));
        }

    }
}
