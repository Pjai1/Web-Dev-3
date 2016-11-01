<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'name', 'startDate', 'endDate', 'winningKey'
    ];

    protected $dates = ['deleted_at'];

    public function entries() {
    	return $this->hasMany('App\Entry');
    }
}
