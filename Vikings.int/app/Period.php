<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'name', 'startDate', 'endDate'
    ];

    protected $dates = ['deleted_at'];
}
