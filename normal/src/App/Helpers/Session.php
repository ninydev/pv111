<?php

namespace App\Helpers;

class Session
{
    private function __construct(){}

    private static $started = false;

    private static function start()
    {
        if (!self::$started) {
            session_start();
            self::$started = true;
        }
    }

    public static function get($key, $default = null)
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }
}
