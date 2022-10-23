<?php


namespace App\Repository\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function register($data)
    {
        return $this->model->create($data);
    }

    public function logout()
    {
        return Auth::logout();
    }

}
