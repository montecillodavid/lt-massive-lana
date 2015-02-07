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
	
	$_SESSION['goto'] = 0;

	include_once('model.php');
	$username='';
	$password='';
	$conductor_name = '';
	$conductor_contact_no = '';	
	$account_type = '';
	$bus = '';
?>
<?php	
	if(isset($_POST['update']))
	{
		//save to db
		$username = htmlentities($_POST['username']);
		$password = (!empty($_POST['password']))? md5($_POST['password']) : '';
		$conductor_name = htmlentities($_POST['name']);
		$conductor_contact_no = htmlentities($_POST['contact']);
		$account_type = htmlentities($_POST['account_type']);
		$bus = $_POST['bus'];
		
		updateUser($username, $password, $conductor_name, $conductor_contact_no, $account_type, $bus, $id);
		header('location: maintainance.php');
		
	}	
	if(isset($_POST['cancel']))
	{
		header('location: maintainance.php');
		exit();
	}

//get id details
$row = getUserDetails($id);
if(count($row) < 1)
	die("Cannot find conductor id: $id");
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
           /* font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;*/
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
							<center><table style="width:50%;">
								<tr>
									<td><label>Username</label></td>
									<td><input  class="form-control input-sm" type="text" style="width:100%" maxlength="10" name="username" value="<?php echo $username ?>" /></td>
								</tr>
								<tr>
									<td><label>Password</label><br/>
									<td><input class="form-control input-sm" type="password" style="width:100%" maxlength="10" name="password" /></td>
								</tr>
								<tr>
									<td><label>Name</label></td>
									<td><input class="form-control input-sm" type="text" style="width:100%" maxlength="40" name="name" value="<?php echo $name ?>" /></td>
								</tr>
								<tr>
	                              <td><label>Account Type</label></td>
	                              <td><select name="account_type" class="btn btn-default dropdown-toggle" style="width:100%">
	                                  <?php
	                                  $arr = array('conductor','driver','admin');
	                                  foreach($arr as $val)
	                                  {
	                                  	  if($val == $account_type)
	                                  	  	echo '<option value="'.$val.'" selected>'.ucfirst($val).'</option>';
	                                  	  else
	                                  	  	echo '<option value="'.$val.'">'.ucfirst($val).'</option>';
	                                  }
	                                  ?>
	                                </select></td>
	                            </tr>
	                            <tr>
	                            <?php $row=busList(); ?>
	                            <td><label>Select Bus</label></td>
	                              <td><select name="bus" value="<?php echo $bus;?>" class="btn btn-default dropdown-toggle" style="width:100%">
	                                  <?php
	                                   foreach($row as $r) {
	                                   	 if($r['bus_id'] == $bus_id)
	                                  	  	echo '<option value="'.$r['bus_id'].'" selected>'.$r['bus_name'].'</option>';
	                                  	  else
	                                      echo '<option value="'.$r['bus_id'].'">'.$r['bus_name'].'</option>';
	                                  }
	                                    ?>
	                                </select></td>
	                            </tr>
								<tr>
									<td><label>Contact Number</label></td>
									<td><input class="form-control input-sm" type="text" style="width:100%" maxlength="11" name="contact" value="<?php echo $contact ?>" /></td>
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


