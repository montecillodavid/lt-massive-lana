<?php
	extract($_GET);

	if(!isset($id) || $id == '')
		die("no id!");

	session_start();
	if(!($_SESSION['islogin']))
	{
		header('location: index.php');
		exit();
	}
	$_SESSION['goto']=2;
	include_once('model.php');
	$route_from = '';
	$route_to = '';	
?>
<?php	
	if(isset($_POST['update']))
	{
		//save to db
		$place_description = htmlentities($_POST['place_description']);
		updateRoute($place_description, $id);
		header('location: maintainance.php');
		
	}	
	if(isset($_POST['cancel']))
	{
		header('location: maintainance.php');
		exit();
	}

//get id details
$row = getRouteDetails($id);
if(count($row) < 1)
	die("Cannot find route id: $id");
extract($row[0]);

?>


<html>
<head>
	 <title>Admin Panel | Lockout</title>	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	 <style>
        body{
            /*font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;*/
            font-family: verdana;
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
		<div class="panel-heading">
        	<img src="img/LOGO1.png" alt="..." class="img-rounded center-block" id="inner-logo" style="width:150px;height:150px;">	
        </div>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="tab-content">
						<form method="post">
							<center><table>
								<tr>
									<td><label>Destination</label></td>
									<td><input  class="form-control input-sm" type="text" style="width:200px;" maxlength="30" name="place_description" value="<?php echo $place_description; ?>" /></td>
								</tr>
								<tr><td></td></tr>
								<tr><td></td></tr>
								<tr>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td align="right"><button class="btn btn-primary"  type="submit" name="update">Update</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary"  type="submit" name="cancel">Cancel</button></td>
					      		</tr>
					      	</table></center>
						</form>
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


