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
	
	$_SESSION['goto']=4;
	include_once('model.php');
	 $errName='';
   $errAddress='';
   $errEmail='';
   $errTelno='';
   $ff=0; 
    $messageF="";

    $comp_code = '';
    $comp_name = '';
    $comp_address = '';
    $comp_email = '';
    $comp_telno = '';
?>
<?php	
	if(isset($_POST['update']))
	{
		//save to db
		$comp_code=trim($_POST['comp_code']);
      $comp_name=trim($_POST['comp_name']);
      $comp_address=trim($_POST['comp_address']);
      $comp_email=trim($_POST['comp_email']);
      $comp_telno=trim($_POST['comp_telno']);
      

		updateCompany($comp_code, $comp_name, $comp_address, $comp_email, $comp_telno);
		header('location: maintainance.php');
		
	}	
	if(isset($_POST['cancel']))
	{
		header('location: maintainance.php');
		exit();
	}

//get id details
$row = getCompanyDetails($id);
if(count($row) < 1)
	die("Cannot find fare id: $id");
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
                                  <td><label>Company code</label></td>
                                  <td><input class="form-control input-sm" name="comp_code" value="<?php echo $comp_code;?>" type="text" placeholder="Price" style="width:100%" maxlength="10">
                                    </td>
                              </tr>
                              <tr>
                                <td><label>Comapny name</label></td>
                                <td><input class="form-control input-sm" name="comp_name" value="<?php echo $comp_name;?>" type="text" placeholder="Price" style="width:100%" >
                                    </td>
                              </tr>
                              <tr>
                                <td><label>Company address</label></td>
                                <td><input class="form-control input-sm" name="comp_address" value="<?php echo $comp_address;?>" type="text" placeholder="Initial" style="width:100%" >
                                    </td>
                              </tr>
                              <tr>
                                <td><label>Comapny email</label></td>
                                <td><input class="form-control input-sm" name="comp_email" value="<?php echo $comp_email;?>" type="text" placeholder="Unit" style="width:100%" >
                                    </td>
                              </tr>
                              <tr>
                                <td><label>Company telno</label></td>
                                <td><input class="form-control input-sm" name="comp_telno" value="<?php echo $comp_telno;?>" type="text" style="width:100%" >
                                    </td>
                              </tr>
                              <tr><td></td></tr>
								<tr><td></td></tr>
								<tr>
									<td></td>
								</tr>
								<tr>
									<td></td>
						      		<td><button class="btn btn-primary"  type="submit" name="update">Update</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary"  type="submit" name="cancel">Cancel</button></td>
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


