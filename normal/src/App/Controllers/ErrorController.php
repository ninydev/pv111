<?php

namespace App\Controllers;

class ErrorController
{

    public function error404()
    {
        echo "<h1>Error 404</h1>";
    }

    public function error($message)
    {
        echo "<h1>Error</h1>";
        echo "<div> $message </div>";
    }

}
