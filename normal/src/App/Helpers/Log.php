<?php

namespace App\Helpers;

class Log
{
    private function __construct(){}

    public static function error($tag, $message) {
     error_log(date('Y-m-d H:i:s') . "\t:\t" . $tag . "\t:\t" . $message);
    }

    public static function debug($tag, $message){
        $debugFile = Env::get('DEBUG_FILE',
            "/home/keeper/PhpstormProjects/pv111/normal/src/logs/debug.log");
        file_put_contents($debugFile,
            date('Y-m-d H:i:s') . "\t:\t" . $tag . "\t:\t" . $message . "\n",
            FILE_APPEND | LOCK_EX);
    }
}
