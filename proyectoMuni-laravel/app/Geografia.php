<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Geografia extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
