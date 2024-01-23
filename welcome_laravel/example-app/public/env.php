<pre>
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Путь к автозагрузке Composer
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ .'/..');
$dotenv->load();

var_dump($_ENV);
?>
    </pre>
