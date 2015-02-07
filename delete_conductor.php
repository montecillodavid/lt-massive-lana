<?php
	session_start();
	if(!($_SESSION['islogin']))
	{
		header('location: index.php');
		exit();
	}
	$_SESSION['goto'] = 0;
	include_once 'model.php';
	deleteUser($_GET['id']);
	header('location:maintainance.php');
?>