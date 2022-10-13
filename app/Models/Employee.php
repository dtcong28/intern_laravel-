<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\DelFlagScope;
use Kyslik\ColumnSortable\Sortable;

class Employee extends Model
{
    use HasFactory;
    use Sortable;

    public $timestamps = false;
    protected $appends = ['full_name'];

    public $sortable = ['id', 'team_id', 'full_name', 'email'];

    protected $fillable = [
        'id',
        'team_id',
        'first_name',
        'last_name',
        'email',
        'gender',
        'birthday',
        'address',
        'avatar',
        'salary',
        'position',
        'status',
        'type_of_work',
        'ins_id',
        'upd_id',
        'ins_datetime',
        'upd_datetime',
        'del_flag'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new DelFlagScope);
    }
}
