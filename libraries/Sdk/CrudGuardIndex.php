<?php

namespace Modules\Crud\Libraries\Sdk;

class CrudGuardIndex
{
    private static $guardRoute = [];
    static function set($route, $callback)
    {
        self::$guardRoute[$route] = $callback;
    }

    static function get()
    {
        return self::$guardRoute;
    }
}