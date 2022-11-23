<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\id;

class User extends Model
{
    use SoftDeletes, id;

    protected $fillable = [
        'id',
        'name',
        'email',
    ];


    protected $dates = [
        'deleted_at'
    ];
}
