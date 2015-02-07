<?php
	session_start();
  error_reporting(0);
  if(!($_SESSION['islogin']))
  {
    header('location: index.php');
    exit();
  }
  include_once('model.php');

  $errUname='';
  $errPass='';
  $errCname='';
  $flag=0;
  $message="";
  $errPhone='';

  $activate = array('in active','','','','');

  if(!isset($_SESSION['goto']))
    $_SESSION['goto'] = 0;
  else $activate[0] = '';
  
   $errCompcode='';
    $errBusname='';
    $errRegno='';
    $errBodyno='';
    $errCapacity='';
    $flag=0;

    $messageB="";

    $errFrom='';
    $errTo='';
    $flag=0;

    $messageR="";

    $errDiscType='';
    $errDiscPerc='';
    $flag=0;
    $messageD="";

    $account_type='';
    $uf='';
    $username='';
    $password='';
    $conductor_name='';
    $conductor_contact_no='';
    $bus = '';
   if(isset($_POST['submitC'])){
    $_SESSION['goto'] = 0;

    $username=trim($_POST['username']);
    $password= (!empty($_POST['password']))? md5($_POST['password']) : '';
    $conductor_name=trim($_POST['conductor_name']);
    $conductor_contact_no=trim($_POST['conductor_contact_no']);
    $account_type = $_POST['account_type'];
    $bus = $_POST['bus'];

      if(checkAddUser($username)){
          $message='username already exists';
          $flag=1;
      }
        //trappings
        if (!preg_match("/\d{4}\d{3}\d{4}/", $conductor_contact_no)) {
          $errPhone ='invalid phone number';
          $flag=1;
        }
        if (empty($username)) {
          $errUname='username must not be empty';
          $flag=1;
        }
        
        if (empty($password)) {
          $errPass='password must not be empty';
          $flag=1;
        }
        if (empty($conductor_name)) {
           $errCname='name must not be empty';
           $flag=1;
        }


        if ($flag == 0) {
          ////ang pag add sa conductor
          addUser($username, $password, $conductor_name, $conductor_contact_no,$account_type,$bus);
          /*session_regenerate_id();
          $rowUser=getAdmin($username);
          $_SESSION['islogin']=true;
          $_SESSION['username']=$rowUser['admin_id'];
          header('location: maintainance.php');
          exit();*/
       }       
       $uf = $flag;
  }
   
   $comp_code='';
   $bus_name='';
   $bus_type='';
   $bus_reg_no='';
   $bus_body_no='';
   $bus_capacity='';
   $bus='';
   $bf='';
    if(isset($_POST['submitB'])){
    $_SESSION['goto'] = 1;
    $activate[0] = '';
    
    $comp_code=trim($_POST['comp_code']);
    $bus_name=trim($_POST['bus_name']);
    $bus_type=trim($_POST['bus_type']);
    $bus_reg_no=trim($_POST['bus_reg_no']);
    $bus_body_no=trim($_POST['bus_body_no']);
    $bus_capacity=trim($_POST['bus_capacity']);
    $bus = $_POST['bus'];
    if(checkAddBus($comp_code)){
      $messageB='company code already exists';
      $flag=1;
      }
        //trappings
        if (empty($comp_code)) {
          $errCompcode='Company code must not be empty';
          $flag=1;
        }
        
        if (empty($bus_name)) {
          $errBusname='Bus name must not be empty';
          $flag=1;
        }
        
        if (empty($bus_reg_no)) {
          $errRegno='Bus registry no. must not be empty';
          $flag=1;
        } 
        if (empty($bus_body_no)) {
          $errBodyno='Bus body no. must not be empty';
          $flag=1;
        } 
        if (empty($bus_capacity)) {
          $errCapacity='Bus capacity must not be empty';
          $flag=1;
        } 

        if ($flag == 0) {
            ////ang pag add sa bus
            addBus($comp_code,$bus_name, $bus_type, $bus_reg_no, $bus_body_no, $bus_capacity);
            /*session_regenerate_id();
            $rowUser=getAdmin($username);
            $_SESSION['islogin']=true;
            $_SESSION['username']=$rowUser['admin_id'];
            header('location: maintainance.php');
            exit();*/
        }
        $bf = $flag;
  }

  $place_description='';
  $rf='';
     if(isset($_POST['submitR'])){
      $_SESSION['goto'] = 2;
      $activate[0] = '';
      
      $place_description=trim($_POST['place_description']);

      if(checkAddRoute($place_description)){
        $messageR='route already exists';
        $flag=1;
       }
        //trappings
        if (empty($place_description)) {
          $errTo='Destination must not be empty';
          $flag=1;
        }
        
        if ($flag == 0) {
            ////ang pag add sa route
            addRoute($place_description);
            /*session_regenerate_id();
            $rowUser=getAdmin($username);
            $_SESSION['islogin']=true;
            $_SESSION['username']=$rowUser['admin_id'];
            header('location: maintainance.php');
            exit();*/
        }
        $rf = $flag;
    }

    $discount_type = '';
    $discount_percentage = '';
    $df = '';
     if(isset($_POST['submitD'])){
      $_SESSION['goto'] = 3;
      $activate[0] = '';
    
      $discount_type=trim($_POST['discount_type']);
      $discount_percentage=trim($_POST['discount_percentage']);

      if(checkAddDiscount($discount_type)){
        $messageD='discount type already exists';
        $flag=1;
     }
        //trappings
        if (empty($discount_type)) {
          $errDiscType='Discount type must not be empty';
          $flag=1;
        }
        
        if (empty($discount_percentage)) {
          $errDiscPerc='Discount percentage must not be empty';
          $flag=1;
        }
        
        if ($flag == 0) {
        ////ang pag add sa discount
        addDiscount($discount_type, $discount_percentage);
        /*session_regenerate_id();
        $rowUser=getAdmin($username);
        $_SESSION['islogin']=true;
        $_SESSION['username']=$rowUser['admin_id'];
        header('location: maintainance.php');
        exit();*/
        }
        $df = $flag;

    }

   
   $errName='';
   $errAddress='';
   $errEmail='';
   $errTel='';
   $ff=0; 
    $messageF="";

    $comp_code = '';
    $comp_name = '';
    $comp_address = '';
    $comp_email = '';
    $comp_telno = '';

    if(isset($_POST['submitF'])){
      $_SESSION['goto']=4;
      $activate[0] = '';
      $comp_code=trim($_POST['comp_code']);
      $comp_name=trim($_POST['comp_name']);
      $comp_address=trim($_POST['comp_address']);
      $comp_email=trim($_POST['comp_email']);
      $comp_telno=trim($_POST['comp_telno']);

      if(checkAddCompany($comp_code)){
        $messageF='Company code already exists';
      }
        //trappings
     
        if (empty($comp_name)) {
          $errName='Comapny name must not be empty';
          $flag=1;
        }
        
        if (empty($comp_address)) {
          $errAddress='Distance address must not be empty';
          $flag=1;
        } 
        if (empty($comp_email)) {
          $errEmail='Distance email must not be empty';
          $flag=1;
        } 
        if (empty($comp_telno)) {
          $errTel='Distance telephone number must not be empty';
          $flag=1;
        } 

        if ($flag == 0) {
          ////ang pag add sa fare
          addCompany($comp_code, $comp_name, $comp_address, $comp_email, $comp_telno);
         /* session_regenerate_id();
          $rowUser=getAdmin($username);
          $_SESSION['islogin']=true;
          $_SESSION['username']=$rowUser['admin_id'];
          header('location: maintainance.php');
          exit();*/
        }
        $ff = $flag;
  }

$activate[$_SESSION['goto']] = 'in active';
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
    	  <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>     
    	</ul>
	</nav>

  <div class="container">
		<div class="row">
		  <div class="col-md-9 col-md-push-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="tab-content">

						<!--conductor side-->
						  <div class="tab-pane fade <?php echo $activate[0];?>" id="user">
						  <?php $row=userList(); ?>
						  	<div class="panel panel-default">
  								<div class="panel-heading"><b>User Profile</b></div><br/>
  									<table class="table table-bordered">
   										<tbody>
             								<thead>
             									<th>Name</th>
                  								<th>Contact No</th>
                  								<th>Username</th>
                                  <th>Account Type</th>
                                  <th>User Bus</th>
                  								<th></th>
                  								<th></th>
											</thead>
            							<tbody>
            			  <?php  foreach($row as $r) { ?>
              				<tr >         
               					<?php 
                 					echo '<td>'.$r['name'].'</td>';
                  					echo '<td>'.$r['contact'].'</td>';
                  					echo '<td>'.$r['username'].'</td>';
                            echo '<td>'.$r['account_type'].'</td>';
                            $rr = getBusDetails($r['bus_id']);
                            foreach ($rr as $value) {
                              echo '<td>'.$value['bus_name'].'</td>';
                            }
                            
                 				?>
                 				<td><a href="update_conductor.php?id=<?php echo $r['user_id'];?>">Update</a>
				 				        <td><a href="delete_conductor.php?id=<?php echo $r['user_id'];?>">Delete</a>
             				</tr>
            				<?php } ?>
         				 </tbody>
									</table>
                </div>
                <!-- Button trigger modal -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float:right" id="addu">Add User</button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel1" style='font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;'><b>User</b></h4>
                      </div>
                      <form method="POST">
                      <div class="modal-body">
                         <table style="margin:0 auto;width:60%;">
                            <tr> 
                                <td><label>Username</label></td>
                                <td><input class="form-control input-sm" name="username" type="text" value="<?php echo $username;?>" placeholder="Username" style="width:200px" maxlength="10">
                                    <div style="color:red;"><?php echo $errUname; ?></div></td>  
                            </tr>
                            <tr>
                                <td><label>Password</label></td>
                                <td><input class="form-control input-sm" name="password" type="password" value="<?php echo $password;?>" placeholder="Password" style="width:200px" maxlength="10">
                                    <div style="color:red;"><?php echo $errPass; ?></div></td>
                            </tr>
                            <tr>
                                <td><label>Name</label></td>
                                <td><input class="form-control input-sm" name="conductor_name" type="text" value="<?php echo $conductor_name;?>" placeholder="Full Name" style="width:200px" maxlength="40">
                                    <div style="color:red;"><?php echo $errCname; ?><div></td>
                            </tr>
                            <tr>
                            <td><label>Account Type</label></td>
                              <td><select name="account_type" value="<?php echo $account_type;?>" class="btn btn-default dropdown-toggle" style="width:200px">
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
                              <td><select name="bus" value="<?php echo $bus;?>" class="btn btn-default dropdown-toggle" style="width:200px">
                                  <?php
                                   foreach($row as $r) {
                                      echo '<option value="'.$r['bus_id'].'">'.$r['bus_name'].'</option>';
                                  }
                                    ?>
                                </select></td>
                            </tr>
                            </tr>
                            <tr>
                                <td><label>Mobile No</label></td>
                                <td><input class="form-control input-sm" name="conductor_contact_no" type="text" value="<?php echo $conductor_contact_no;?>" title="ddddddddddd" placeholder="00000000000" style="width:200px" maxlength="11">
                                    <div style="color:red;"><?php echo $errPhone; ?><div></td>
                            </tr>
                          </table>
                      </div>
                      <div class="modal-footer">
                          <input type="hidden" id="uf" value="<?php echo $uf;?>">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="sumbit" name="submitC" class="btn btn-primary">Add</button>
                      </div>
                      </form>
                        <?php if($message): ?>
                          <script>alert('<?php echo $message; ?>');</script>
                        <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
                          
						<!--bus side-->
						  <div class="tab-pane fade <?php echo $activate[1];?>" id="bus">
						  <?php $row=busList(); ?>
						  	<div class="panel panel-default">
  								<div class="panel-heading"><b>Bus Profile</b></div><br/>
  									<table class="table table-bordered">
   										<tbody>
             								<thead>
                  								<th>Company Code</th>
                  								<th>Bus Name</th>
                  								<th>Bus Type</th>
                  								<th>Bus Reg. No.</th>
                  								<th>Bus Body No.</th>
                  								<th>Bus Capacity</th>
                  								<th></th>
                  								<th></th>
											</thead>
            							<tbody>
            			  <?php  foreach($row as $r) { ?>
              				<tr >         
               					<?php 
                  					echo '<td>'.$r['comp_code'].'</td>';
                  					echo '<td>'.$r['bus_name'].'</td>';
                  					echo '<td>'.$r['bus_type'].'</td>';
                  					echo '<td>'.$r['bus_reg_no'].'</td>';
                  					echo '<td>'.$r['bus_body_no'].'</td>';
				          			echo '<td>'.$r['bus_capacity'].'</td>';
                 				?>
                 				<td><a href="update_bus.php?id=<?php echo $r['bus_id'];?>">Update</a>
				 				<td><a href="delete_bus.php?id=<?php echo $r['bus_id'];?>">Delete</a>
             				</tr>
            				<?php } ?>
         				 	</tbody>
							</table>
							</div>
              <!-- Button trigger modal -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal2" style="float:right" id="addbus">Add Bus</button>

                <!-- Modal -->
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel2" style='font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;'><b>Bus</b></h4>
                      </div>
                      <form method="POST">
                        <div class="modal-body">
                        <table style="margin: 0 auto;">
                            <tr>
                              <td><label>Company Code</label></td>
                              <td><input class="form-control input-sm" name="comp_code" value="<?php echo $comp_code; ?>" type="text" style="width:200px" maxlength="8">
                                  <div style="color:red;"><?php echo $errCompcode; ?></div></td> 
                            </tr>
                            <tr>
                              <td><label>Bus Name</label></td>
                              <td><input class="form-control input-sm" name="bus_name" value="<?php echo $bus_name; ?>" type="text" style="width:200px" maxlength="30">
                                  <div style="color:red;"><?php echo $errBusname; ?></div></td>
                            </tr>
                            <tr>
                              <td><label>Bus Type</label></td>
                              <td><select name="bus_type" class="btn btn-default dropdown-toggle" style="width:200px">
                                  <option value="Aircondition">Aircondition</option>
                                  <option value="Non Aircondition">Non Aircondition</option>
                                </select></td>
                            </tr>
                            <tr>
                              <td><label>Register Number</label></td>
                              <td><input class="form-control input-sm" name="bus_reg_no" value="<?php echo $bus_reg_no; ?>" type="text" style="width:200px" maxlength="10">
                               <div style="color:red;"><?php echo $errRegno; ?></div></td>
                            </tr>
                            <tr>
                              <td><label>Body Number</label></td>
                              <td><input class="form-control input-sm" name="bus_body_no" value="<?php echo $bus_body_no; ?>" type="text" style="width:200px" maxlength="8">
                                  <div style="color:red;"><?php echo $errBodyno; ?></div></td>
                            </tr>
                            <tr>
                              <td><label>Capacity</label></td>
                              <td><input class="form-control input-sm" name="bus_capacity" value="<?php echo $bus_capacity; ?>" type="text" style="width:200px" maxlength="2">
                                  <div style="color:red;"><?php echo $errCapacity; ?></div></td>
                            </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="<?php echo $bf; ?>" id="bf">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="submitB" class="btn btn-primary">Add Bus</button>
                        </div>
                    </form>
                        <?php if($messageB): ?>
                          <script>alert('<?php echo $messageB; ?>');</script>
                        <?php endif; ?>
                    </div>
                  </div>
                </div>
							</div>
							<!--Route side-->
						  <div class="tab-pane fade <?php echo $activate[2];?>" id="route">
						  	<?php $row=routeList(); ?>
						  	<div class="panel panel-default">
  								<div class="panel-heading"><b>Route Profile</b></div><br/>
  									<table class="table table-bordered">
   										<tbody>
             								<thead>
             									<th>Destination</th>
                  								<th></th>
                  								<th></th>
											</thead>
            							<tbody>
            			  <?php  foreach($row as $r) { ?>
              				<tr >         
               					<?php 
                  					 echo '<td>'.$r['place_description'].'</td>';
                 				?>
                 				<td><a href="update_route.php?id=<?php echo $r['place_id'];?>">Update</a>
				 				        <td><a href="delete_route.php?id=<?php echo $r['place_id'];?>">Delete</a>
             				</tr>
            				<?php } ?>
         				 	</tbody>
							</table>
							</div>
              <!-- Button trigger modal -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal3" style="float:right" id="adddest">Add Destination</button>

                <!-- Modal -->
                <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel3" style='font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;'><b>Bus Route</b></h4>
                      </div>
                        <form method="POST">
                      <div class="modal-body">
                        <table style="margin:0 auto;width:70%;">
                          <tr>
                            <td align="left"><label>Destination</label></td>
                            <td><input class="form-control input-sm" name="place_description" value="<?php echo $place_description;?>" type="text" placeholder="Destination" style="width:100%" maxlength="15">
                                <div style="color:red;"><?php echo $errTo; ?></div></td>
                          </tr>
                      </table>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" value="<?php echo $rf;?>" id="rf">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="submitR"class="btn btn-primary" >Add Destination</button>
                      </div>
                     </form>
                        <?php if($messageR): ?>
                          <script>alert('<?php echo $messageR; ?>');</script>
                        <?php endif; ?>
                    </div>
                  </div>
                </div>
							</div>
							<!--Discount side-->
						  <div class="tab-pane fade <?php echo $activate[3];?>" id="discount">
						  	<?php $row=discountList(); ?>
						  	<div class="panel panel-default">
  								<div class="panel-heading"><b>Discount Profile</b></div><br/>
  									<table class="table table-bordered">
   										<tbody>
             								<thead>
             									<th>Discount Type</th>
                  						<th>Discount Percentage</th>
                  						<th></th>
                  						<th></th>
											</thead>
            							<tbody>
            			  <?php  foreach($row as $r) { ?>
              				<tr >         
               					<?php 
                 					echo '<td>'.$r['discount_type'].'</td>';
                  					echo '<td>'.$r['discount_percentage'].'</td>';
                 				?>
                 				<td><a href="update_discount.php?id=<?php echo $r['discount_no'];?>">Update</a>
                      	<td><a href="delete_discount.php?id=<?php echo $r['discount_no'];?>">Delete</a>
             				</tr>
            				<?php } ?>
         				 	</tbody>
							</table>
							</div>
              <!-- Button trigger modal -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal4" style="float:right" id="adddisc">Add Discount</button>

                <!-- Modal -->
                <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel4" style='font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;'><b>Add Discount</b></h4>
                      </div>
                        <form method="POST">
                      <div class="modal-body">
                        <table style="width:100%">
                          <tr>
                            <td><label>Discount type</label></td>
                            <td><input class="form-control input-sm" id="disctype" value="<?php echo $discount_type;?>" name="discount_type" type="text" placeholder="Discount Type" style="width:100%" >
                                <div style="color:red;"><?php echo $errDiscType; ?></div></td>
                          </tr>
                          <tr>
                            <td><label>Discount Percentage</label></td>
                            <td><input class="form-control input-sm" value="<?php echo $discount_percentage;?>" id="discpercent" name="discount_percentage" type="text" style="width:50%" maxlength="5">
                                <div style="color:red;"><?php echo $errDiscPerc; ?></div></td>
                          </tr>
                        </table>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" id="df" value="<?php echo $df;?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="submitD"class="btn btn-primary">Add Discount</button>
                      </div>
                     </form>
                        <?php if($messageD): ?>
                          <script>alert('<?php echo $messageD; ?>');</script>
                        <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
						  <!--Fare Side-->
						  <div class="tab-pane fade <?php echo $activate[4];?>" id="maloy">
						  	<?php $row=companyList(); ?>
						  	<div class="panel panel-default">
  								<div class="panel-heading"><b>Company Profile</b></div><br/>
  									<table class="table table-bordered">
   										<tbody>
             								<thead>
             									<th>Company code</th>
                  								<th>Company name</th>
                  								<th>Company address</th>
                  								<th>Company email</th>
                  								<th>Company telno</th>
                  								<th></th>
                  								<th></th>
											</thead>
            							<tbody>
            			  <?php  foreach($row as $r) { ?>
              				<tr >         
               					<?php 
                 					echo '<td>'.$r['comp_code'].'</td>';
                  					echo '<td>'.$r['comp_name'].'</td>';
                  					echo '<td>'.$r['comp_address'].'</td>';
                  					echo '<td>'.$r['comp_email'].'</td>';
                  					echo '<td>'.$r['comp_telno'].'</td>';
                 				?>
                 				<td><a href="update_fare.php?id=<?php echo $r['comp_code'];?>">Update</a>
				 				<td><a href="delete_fare.php?id=<?php echo $r['comp_code'];?>">Delete</a>
             				</tr>
            				<?php } ?>
         				 	</tbody>
							</table>
							</div>
             <!-- Button trigger modal -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal5" style="float:right" id="addf">Add Company</button>

                <!-- Modal -->
                  <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel5" style='font-family: Garamond, Baskerville, "Baskerville Old Face", "Hoefler Text", "Times New Roman", serif;'><b>Add Bus Fare</b></h4>
                        </div>
                          <form method="POST">
                        <div class="modal-body">
                          <table style="margin:0 auto;">
                              <tr>
                                  <td><label>Company code</label></td>
                                  <td><input class="form-control input-sm" name="comp_code" value="<?php echo $comp_code;?>" type="text" placeholder="Company code" style="width:100%">
                                    </td>
                              </tr>
                              <tr>
                                <td><label>Company name</label></td>
                                <td><input class="form-control input-sm" name="comp_name" value="<?php echo $comp_name;?>" type="text" placeholder="Company name" style="width:100%">
                                    <div style="color:red;"><?php echo $errName; ?></div></td>
                              </tr>
                              <tr>
                                <td><label>Company address</label></td>
                                <td><input class="form-control input-sm" name="comp_address" value="<?php echo $comp_address;?>" type="text" placeholder="Company address" style="width:100%">
                                    <div style="color:red;"><?php echo $errAddress; ?></div></td>
                              </tr>
                              <tr>
                                <td><label>Comapny email</label></td>
                                <td><input class="form-control input-sm" name="comp_email" value="<?php echo $comp_email;?>" type="text" placeholder="Company email" style="width:100%">
                                    <div style="color:red;"><?php echo $errEmail; ?></div></td>
                              </tr>
                              <tr>
                                <td><label>Company telno</label></td>
                                <td><input class="form-control input-sm" name="comp_telno" value="<?php echo $comp_telno;?>" type="text" placeholder="1234567" style="width:100%">
                                    <div style="color:red;"><?php echo $errTel; ?></div></td>
                              </tr>
                           </table>
                        </div>
                        <div class="modal-footer">
                          <input type="hidden" id="ff" value="<?php echo $ff;?>">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" name="submitF"class="btn btn-primary">Add Company</button>
                        </div>
                       </form>
                          <?php if($messageF): ?>
                            <script>alert('<?php echo $messageF; ?>');</script>
                          <?php endif; ?>
                      </div>
                    </div>
                  </div>
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
      						  <a href="#user" data-toggle="tab"><li class="list-group-item active"><span class="glyphicon glyphicon-user"></span> User</li></a>
      						  <a href="#bus" data-toggle="tab"><li class="list-group-item"><img src="img/bus.png" alt="..." class="img-rounded" id="bus-logo">	Bus</li></a>
      						  <a href="#route" data-toggle="tab" id="route"><li class="list-group-item"><span class="glyphicon glyphicon-road"></span>  Place</li></a>
      						  <a href="#discount" data-toggle="tab"><li class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Discount</li></a>
      						  <a href="#maloy" data-toggle="tab"><li class="list-group-item"><span class="glyphicon glyphicon-usd"></span> Company</li></a>
      						</ul>
					       </div>
				  </div>
			  </div>
		  </div>
    </div><!--end of container-->
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.8.2.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
      $(function(){
        if($('#df').val() == 1){
          document.getElementById("adddisc").click();
        }

        if($('#bf').val() == 1){
          document.getElementById("addbus").click();
        }

        if($('#rf').val() == 1){
          document.getElementById("adddest").click();
        }
        
        if($('#uf').val() == 1){
          document.getElementById('addu').click();
        }

        if($('#ff').val() == 1){
          document.getElementById('addf').click();
        }
      });
    </script>

</body>
</html>