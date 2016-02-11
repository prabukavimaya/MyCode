<?php
require_once 'config/dbconfig.php';

if($user->is_loggedin()=="")
{
 $user->redirect('index.php');
}

if(isset($_POST['btn-account']))
{
 $umail = $_POST['txt_uname_email'];
 $mobileno = $_POST['txt_mobile'];
 $user->updateAccountData($umail,$mobileno);
 $success_msg='Updated Successfully';
}
$myaccount_result=$user->getAccountData();


/* Author: Mayandi 
*Date Created: Feb-07-2016
*home.php
*/
	
	$title_bar="About Us";

	/************header***********/
	include "form/header.php";
	/************header***********/
?>

	<!------Content------------------>
	<?php include "form/myaccount_form.php"; ?>
	<!------Content------------------>


<?php
	/************footerr***********/
	include "form/footer.php";
	/************footerr***********/
?>



