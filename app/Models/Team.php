<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\DelFlagScope;

class Team extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'ins_id',
        'ins_datetime',
        'upd_datetime',
        'del_flag'
    ];

    public function employees() {
        return $this->hasMany(Employee::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new DelFlagScope);
    }
}
