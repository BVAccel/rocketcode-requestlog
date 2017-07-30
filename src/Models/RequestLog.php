<?php

namespace Rocketcode\RequestLog\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function response()
    {
        return $this->hasOne(RequestLogEvent::class, 'parent_id', 'response_id');
    }

    public function request()
    {
        return $this->hasOne(RequestLogEvent::class, 'parent_id', 'request_id');
    }

    protected static function boot()
    {
        parent::boot();

        // Let's make sure to keep the events table clean.
        static::deleting(function ($log) {
            $log->request()->delete();
            $log->response()->delete();
        });

        // Time to purge the old records.  Items are only inserted after the response has
        // been sent , so not too concerned about atomic speed.
        static::saving(function ($log) {
            RequestLog::where('created_at',
                '<',
                Carbon::now()->subDays(config('rocketcode-requestlog.keepFor', 90))
            )->delete();
        });
    }
}
