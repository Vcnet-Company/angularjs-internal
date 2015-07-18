<?php
session_start();
require_once('Adapter.class.php');
require_once('functions.inc.php');

$go = $_POST['go'];
switch($go)
{
	case 'login':
		print loginUser($_POST['un'],$_POST['p']);
		break;
	case 'logout':
		print logOutUser();
		break;
	case 'getcustomers':
		print getCustomers($_POST);
		break;
	case 'addcall':
		print addCall($_POST);
		break;
	case 'getcalls':
		print getCalls();
		break;
	case 'addcustomer':
		print addcustomer($_POST);
		break;
}
?>