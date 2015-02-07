<?php
	session_start();
	$message=""; 
	$user=""; 
	$pass=""; 
	include_once('model.php'); 
	
	if(isset($_POST['login'])){ 
		$user = $_POST['username']; 
		$pass = md5($_POST['password']); 
		if($user != "" && $pass != ""){ 
			
			$result = logCount($user,$pass); 
			if($result >= 1){ 
				$_SESSION['islogin']=true; 
				header('Location: '.'homepage.php'); 
				$message="Success"; 
			}
			else{ 
				$message="Invalid Username or Password";
			} 
		} 
	}

	if(isset($_SESSION['islogin'])){
     header('location: homepage.php');
    }
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Admin Panel | Lockout</title>	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	 <style>
        body{
           /* font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;*/
           font-family: verdana;
        } 
    </style>
  </head>
  <body>
  
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
		<a class="navbar-brand" href="index.php">eBusTicket - Admin Panel</a>
  </div>   
	</nav>

    <div class="container">
	<img src="img/LOGO1.png" alt="..." class="img-rounded center-block">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title" style='font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;'><b>Admin Login</b></h3>
					</div>
					<div class="panel-body">
						<form method="post">
					<form role="form">
					  <div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" placeholder="Username">
					  </div>
					  <div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" placeholder="Password">
					  </div>
					  <button type="submit" name="login" class="btn btn-primary">Login</button>
					  <button type="submit" class="btn btn-default">Cancel</button>
					</form>
					<div style="color:red;"><?php echo $message; ?></div>	
					</form>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
    </div><!--end of container-->
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>