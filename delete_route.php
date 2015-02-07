<?php
	session_start();
	if(!($_SESSION['islogin']))
	{
		header('location: index.php');
		exit();
	}
	$_SESSION['goto']=2;
	include_once 'model.php';
	deleteRoute($_GET['id']);
	header('location:maintainance.php');
?>