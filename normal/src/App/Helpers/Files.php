<?php

namespace App\Helpers;

class Files
{
    private function __construct(){}

    public static function isFile(string $name) : bool
    {
        return isset($_FILES[$name]);
    }

    public static function save(string $name) :bool
    {

        if (self::isFile($name)) {
            $targetDirectory = Env::get('STORAGE_UPLOAD',
                "/home/keeper/PhpstormProjects/pv111/normal/src/public/storage/upload/");

            $targetFile = $targetDirectory . basename($_FILES[$name]["name"]);

            if (move_uploaded_file($_FILES[$name]["tmp_name"], $targetFile)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

}
