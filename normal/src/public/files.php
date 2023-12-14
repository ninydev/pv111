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


Files::save('avatar');

\App\Helpers\Log::debug('Files', 'Ok');
\App\Helpers\Log::error('test', 'test');
