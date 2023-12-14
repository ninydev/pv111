<?php

use App\Helpers\Files;
use Lib\FormBuilder\Form;
use Lib\FormBuilder\FormMethodsEnum;
use Lib\FormBuilder\Inputs\Input;

require_once '../vendor/autoload.php';


$form = new Form(FormMethodsEnum::POST);
$form
    ->add(new Input('file', 'avatar'))
    ->add(new Input('submit', 'send'));
echo $form;

echo "<pre>";
var_dump($_POST);
var_dump($_FILES['avatar']);
echo "</pre>";

Files::save('avatar');
