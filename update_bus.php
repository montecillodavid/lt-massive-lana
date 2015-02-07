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
	$_SESSION['goto'] = 1;
	include_once('model.php');
	$comp_code = '';	
	$bus_name = '';	
	$bus_type = ''; 
	$bus_reg_no = '';	
	$bus_body_no = '';
	$bus_capacity = '';	
?>
<?php	
	if(isset($_POST['update']))
	{
		//save to db
		$comp_code = htmlentities($_POST['comp_code']);
		$bus_name = htmlentities($_POST['bus_name']);
		$bus_type = htmlentities($_POST['bus_type']);
		$bus_reg_no = htmlentities($_POST['bus_reg_no']);
		$bus_body_no = htmlentities($_POST['bus_body_no']);
		$bus_capacity = htmlentities($_POST['bus_capacity']);
		//die($_POST['bus_type']);
		updateBus($comp_code, $bus_name, $bus_type, $bus_reg_no, $bus_body_no, $bus_capacity,$id);
		header('location: maintainance.php');
		
	}	
	if(isset($_POST['cancel']))
	{
		header('location: maintainance.php');
		exit();
	}

//get id details
$row = getBusDetails($id);
if(count($row) < 1)
	die("Cannot find bus id: $id");
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
           /* font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;\*/
           font-family:verdana;
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
									<td><label>Company Code</label></td>
									<td><input  class="form-control input-sm" type="text" style="width:200px" maxlength="8" name="comp_code" value="<?php echo $comp_code ?>" /></td>
								</tr>
								<tr>
									<td><label>Bus Name</label></td>
									<td><input  class="form-control input-sm" type="text" style="width:200px" maxlength="30" name="bus_name" value="<?php echo $bus_name ?>" /></td>
								</tr>
								<tr>
									<td><label>Bus Type</label></td>
									<td><select name="bus_type" class="btn btn-default dropdown-toggle" style="width:200px">
										<?php
										$arr = array('Aircondition','Non Aircondition');

										foreach($arr as $val){
											if($val == $bus_type)
												echo '<option value="'.$val.'" selected>'.ucfirst($val).'</option>';
											else
												echo '<option value="'.$val.'" >'.ucfirst($val).'</option>';
										}
										?>

										
										<option value="Non Aircondition" />Non Aircondition</option>
									</select></td>
								</tr>
								<tr>
									<td><label>Bus Register No.</label></td>
									<td><input class="form-control input-sm" type="text" style="width:200px" maxlength="10" name="bus_reg_no" value="<?php echo $bus_reg_no ?>" /></td>
								</tr>
								<tr>
									<td><label>Bus Body No.</label></td>
									<td><input class="form-control input-sm" type="text" style="width:200px" maxlength="8" name="bus_body_no" value="<?php echo $bus_body_no ?>" /></td>
								</tr>
								<tr>
									<td><label>Bus Capacity</label></td>
									<td><input class="form-control input-sm" type="text" style="width:200px" maxlength="2" name="bus_capacity" value="<?php echo $bus_capacity ?>" /></td>
								</tr>
								<tr><td></td></tr>
								<tr><td></td></tr>
								<tr>
									<td></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary"  type="submit" name="update">Submit</button></td>
						      		<td><button class="btn btn-primary"  type="submit" name="cancel">Cancel</button></td>
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


