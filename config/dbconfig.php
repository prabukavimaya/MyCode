<?php

session_start();

$DB_host = "localhost";
$DB_user = "prabukavi";
$DB_pass = "z1x2c3v4";
$DB_name = "prabukavi_db";



try
{
     $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}


include_once './class/class.user.php';
$user = new USER($DB_con);
