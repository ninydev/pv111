<?php

require_once '../vendor/autoload.php';

use Lib\FormBuilder\Form;
use Lib\FormBuilder\FormMethodsEnum;
use Lib\FormBuilder\Inputs\Input;

$formLogin = new Form(FormMethodsEnum::POST);

$formLogin
    ->add(new Input('email', 'email'))
    ->add(new Input('password', 'password'))
    ->add(new Input('submit', 'submit'));

echo $formLogin;
