<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MensajeJjvv extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
}
