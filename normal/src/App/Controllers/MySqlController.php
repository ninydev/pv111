<?php

namespace App\Controllers;

use Lib\DB\MySql;

class MySqlController
{
    public function index()
    {
//        $mysql = new \mysqli('mysql_db.main', 'user_pv111', 'password', 'pv111');
//        $rows = $mysql->query('SELECT * FROM `users`');
//        foreach ($rows as $r) {
//            echo "<hr><pre>";
//            var_dump($r);
//            echo "</pre>";
//        }

        $rows = MySql::query('SELECT * FROM `users`');
        foreach ($rows as $r) {
            echo "<hr><pre>";
            var_dump($r);
            echo "</pre>";
        }

    }

}
