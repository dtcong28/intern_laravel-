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

    public function findByTeamOrNameOrEmail($team, $name, $email)
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
        return $query->paginate(config('constants.pagination.PER_PAGE'));
    }
}
