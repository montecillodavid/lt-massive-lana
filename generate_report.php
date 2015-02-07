<?php
	session_start();
  if(!($_SESSION['islogin']))
	{
		header('location: index.php');
		exit();
	}
  include_once('model.php');
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
		<a class="navbar-brand" href="homepage.php">eBusTicket - Admin Panel</a>
  </div>
		<ul class="nav navbar-nav navbar-right" id="indextopmenu">
		  <li><a href="login.php" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-off"></span> Logout</a></li>     
		</ul>
	</nav>

       <div class="container">
		<div class="row">
		    <div class="col-md-9 col-md-push-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="tab-content">
						  <div class="tab-pane fade in active" id="graph">
						  
						  	<?php 
			                  $countMonthPassenger=count(getPassengerMonthReport()); 
			                  echo $countMonthPassenger;
			                ?>
			                <?php 
			                  $countWeekPassenger=count(getPassengerWeekReport()); 
			                  echo $countWeekPassenger;
			                ?>
						  </div>
						  <div class="tab-pane fade" id="stat">
							
						  </div>
						  <div class="tab-pane fade" id="sales">
							
						  </div>
						</div>
					</div>
				</div>
		    </div>
			
			<div class="col-md-3 col-md-pull-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<img src="img/LOGO1.png" alt="..." class="img-rounded center-block" id="inner-logo">	
					</div>
					<div class="panel-body">
						<!-- Nav tabs -->
						<ul class="list-group nav nav-tabs">
						  <a href="#graph" data-toggle="tab"><li class="list-group-item active"><span class="glyphicon glyphicon-signal"></span> Graphical Report</li></a>
						  <a href="#stat" data-toggle="tab"><li class="list-group-item"><span class="glyphicon glyphicon-stats"></span> Statistical Report</li></a>
						  <a href="#sales" data-toggle="tab"><li class="list-group-item "><span class="glyphicon glyphicon-usd"></span> Sales Report</li></a>
						</ul>
					</div>
				</div>
			</div>
		</div>

    </div><!--end of container-->
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>