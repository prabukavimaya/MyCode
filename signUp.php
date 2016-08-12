<?php
require_once 'config/dbconfig.php';

if($user->is_loggedin()!="")
{
    $user->redirect('home.php');
}

include_once "form/sign-up_form.php";
