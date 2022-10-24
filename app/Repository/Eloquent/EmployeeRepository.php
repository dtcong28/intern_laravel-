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

    public function findByTeamOrNameOrEmail(array $column,$dataSearch, $paginate = 1)
    {
        $query = $this->model->with('team')->sortable();

        $query->when(!empty($dataSearch['teamId']), function ($q) use ($dataSearch) {
            return $q->where('team_id', '=', $dataSearch['teamId']);
        });

        $query->when(!empty($dataSearch['searchName']), function ($q) use ($dataSearch) {
            return $q->where(DB::raw("CONCAT(first_name,' ',last_name)"), 'like', '%' . $dataSearch['searchName'] . '%');
        });

        $query->when(!empty($dataSearch['searchEmail']), function ($q) use ($dataSearch) {
            return $q->where('email', 'like', '%' . $dataSearch['searchEmail'] . '%');
        });

        if ($paginate == 1) {
            return $query->select($column)->paginate(config('constants.pagination.PER_PAGE'));
        }
        return $query->select($column)->get();
    }
}
