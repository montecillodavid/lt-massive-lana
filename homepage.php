<?php
  include_once 'model.php';
  session_start();
    if(!($_SESSION['islogin']))
  {
    header('location: index.php');
    exit();
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
            font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;
        } 
    </style>
  </head>
  <body>
  
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
		<a class="navbar-brand" href="homepage.php">eBusTicket - Homepage</a>
  </div>
		<ul class="nav navbar-nav navbar-right" id="indextopmenu">
		  <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>     
		</ul>
	</nav>

    <div class="container">
	<img src="img/LOGO1.png" alt="..." class="img-rounded center-block">
		<div class="row">
		   <div class="col-xs-6">
				<a href="maintainance.php"><button type="button" class="btn btn-primary btn-lg pull-right">Maintenance</button></a>
		   </div>
			<div class="col-xs-6">
				<a href="generate_report.php"><button type="button" class="btn btn-primary btn-lg">Generate Report</button></a>
			</div>
		</div>

    </div><!--end of container-->
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>