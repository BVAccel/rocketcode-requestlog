<?php

namespace Rocketcode\RequestLog\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLogEvent extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    function log() {
    	return $this->belongsTo( 'Rocketcode\RequestLog', 'id', 'parent_id');
    }
}
