<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'userId', 'periodId', 'key', 'ip'
    ];

    protected $dates = ['deleted_at'];
}
