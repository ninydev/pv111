<?php

use App\Helpers\Session;

require_once '../vendor/autoload.php';

?>
    <a href="<?=$_SERVER['PHP_SELF']?>" > Home </a>
<?php

if (isset($_REQUEST['user_password'])) {
    Session::set('user_password', $_REQUEST['user_password']);
}

echo Session::get('user_password');

//// Запускаю сессии
//session_start();
//
//$_SESSION['user_password'] = 'QweAsdZxc!23';
//
//var_dump($_SESSION);

//phpinfo();
