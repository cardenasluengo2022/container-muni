<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RedsocialMunicipio extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
