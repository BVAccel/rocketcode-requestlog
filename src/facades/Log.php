<?php
/**
 * Created by PhpStorm.
 * User: tonysantucci
 * Date: 5/26/17
 * Time: 9:05 AM.
 */

namespace Rocketcode\RequestLog\Facades;

class Log
{
    protected static function getFacadeAccessor()
    {
        return 'Rocketcode\RequestLog';
    }
}
