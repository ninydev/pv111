<?php

use App\Presenters\UserPresenter;

require_once '../vendor/autoload.php';

$u = new \App\Models\UserModel(
    'Oleksandr', 'Nykytin',
    'keeper@ninydev.com', 'QweAsdZxc!23');
$u->setCreatedAt();
$u->setUpdatedAt();

echo "<pre>";
var_dump($u);
echo json_encode($u);


var_dump( (new UserPresenter($u))->toArray() );


echo "</pre>";
