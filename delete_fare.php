<?php
	session_start();
	if(!($_SESSION['islogin']))
	{
		header('location: index.php');
		exit();
	}
	$_SESSION['goto']=4;
	include_once 'model.php';
	deleteCompany($_GET['id']);
	header('location:maintainance.php');
?>