<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'user_id', 'period_id', 'key', 'isWinningEntry', 'ip'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
    	return $this->belongsTo('App\User')->withTrashed();
    }

    public function period()
    {
    	return $this->belongsTo('App\Period')->withTrashed();
    }
}
