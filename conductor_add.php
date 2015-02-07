<?php 
	include_once 'model.php';
	session_start();
	$message="";
	if(isset($_POST['submit'])){
		$username=trim($_POST['username']);
		$password=trim($_POST['password']);
		$conductor_name=trim($_POST['conductor_name']);
		$conductor_contact_no=trim($_POST['conductor_contact_no']);
		if(checkAddConductor($username)){
			$message='username already exists';
		}else{
			////ang pag add sa conductor
			addConductor($username, $password, $conductor_name, $conductor_contact_no);
			session_regenerate_id();
			$rowUser=getAdmin($username);
			$_SESSION['islogin']=true;
			$_SESSION['username']=$rowUser['admin_id'];
			header('location: maintenance.php');
			exit();
			}
	}
 ?>
<html>
<head>
	<title>ADD CONDUCTOR</title>
</head>
<body>
	<a href="maintenance.php">BACK</a><br/>
	<form method="POST">
		<h1>ADD CONDUCTOR</h1>
		<table>
			<tr>
				<td><label>Username</label></td>
				<td><input type="text" name="username"></td>	
			</tr>
			<tr>
				<td><label>Password</label></td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td><label>Conductor Name</label></td>
				<td><input type="text" name="conductor_name"></td>
			</tr>
			<tr>
				<td><label>Conductor Contact No</label></td>
				<td><input type="text" name="conductor_contact_no"></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<button type="submit" name="submit" class="btn">Submit</button>
				</td>
			</tr>
		</table>
	</form>
	<?php echo $message; ?>
</body>
</html>