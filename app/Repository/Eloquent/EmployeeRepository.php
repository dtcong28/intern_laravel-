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

    public function findByTeamOrNameOrEmail(array $column,$team, $name, $email, $paginate = 1)
    {
        $query = $this->model->with('team')->sortable();

        if (!empty($team)) {
            $query = $query->where('team_id', '=', $team);
        }
        if (!empty($name)) {
            $query = $query->where(DB::raw("CONCAT(first_name,' ',last_name)"), 'like', '%' . $name . '%');
        }
        if (!empty($email)) {
            $query = $query->where('email', 'like', '%' . $email . '%');
        }

        if ($paginate == 1) {
            return $query->select($column)->paginate(config('constants.pagination.PER_PAGE'));
        }
        return $query->select($column)->get();
    }
}
