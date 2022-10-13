<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\DelFlagScope;
use Kyslik\ColumnSortable\Sortable;

class Team extends Model
{
    use HasFactory;
    use Sortable;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'ins_id',
        'ins_datetime',
        'upd_datetime',
        'del_flag'
    ];

    public $sortable = ['id', 'name'];

    public function employees() {
        return $this->hasMany(Employee::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new DelFlagScope);
    }
}
