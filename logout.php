<?php
require_once 'config/dbconfig.php';

if($user->logout())
{
 $user->redirect('index.php');
}