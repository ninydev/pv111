<?php

namespace App\Helpers;

use Dotenv\Dotenv;

class Env
{
    /**
     * Запретим создание экземпляра класса
     */
    private function __construct(){}

    private static $loaded = false;

    private static function load()
    {
        if (!self::$loaded) {
            $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
            $dotenv->load();
            self::$loaded = true;
        }
    }

    public static function get($key, $default = null)
    {
        self::load();
        return $_ENV[$key] ?? $default;
    }
}
