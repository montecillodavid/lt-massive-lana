<?php
	session_start();
	if(!($_SESSION['islogin']))
	{
		header('location: index.php');
		exit();
	}
	include_once 'model.php';
	$_SESSION['goto'] = 1;
	deleteBus($_GET['id']);
	header('location:maintainance.php');
?>