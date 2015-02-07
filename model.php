<?php	
	include_once('controller.php');
	
	////dri ang login
	function logCount($user,$pass)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER, DBPASS);	
			$sql="SELECT * FROM admin WHERE username=? AND password=?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($user,$pass));
			return $stmt->rowCount();
			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error: ", $ex->getMessage();
		}
	}
	////Admin na part
	function getAdminByUsername($username){
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM admin WHERE username=?";
		$stmt=$db->prepare($sql);
		$stmt->execute(array($username));
		$row=$stmt->fetch();
		$db=null;
		return $row;
	}
	function getAdmin($admin_id){
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM admin WHERE admin_id=?";
		$stmt=$db->prepare($sql);
		$stmt->execute(array($admin_id));
		$row=$stmt->fetch();
		$db=null;
		return $row;
	}
	////conductor na part
	function addConductor($username, $password, $conductor_name, $conductor_contact_no)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "INSERT INTO conductor(username, password, conductor_name, conductor_contact_no)
				    VALUES(?,?,?,?)";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($username, $password, $conductor_name, $conductor_contact_no));

			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	function checkAddConductor($username){
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM conductor WHERE username=?";
		$stmt=$db->prepare($sql);
		$stmt->execute(array($username));
		$row=$stmt->fetch();
		if($row){
			return true;
		}else{
			return false;
		}
	}

	function updateConductor($username, $password, $conductor_name, $conductor_contact_no, $conductor_id)
	{
		try
		{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql="UPDATE conductor
					SET username = ?,
						password = ?,
						conductor_name = ?,
						conductor_contact_no = ?
					WHERE conductor_id = ?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($username, $password, $conductor_name, $conductor_contact_no, $conductor_id));
			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error: ", $ex->getMessage();
		}
	}
	function getConductorDetails($id)
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM conductor WHERE conductor_id=$id";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}
	function conductorList()
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM conductor";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}
	function deleteConductor($conductor_id)
	{
		try{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "DELETE FROM conductor WHERE conductor_id=?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($conductor_id));
			$db = null;
		}catch(PDOException $ex){
			echo "DB Error: ", $ex->getMessage();	
		}
	}
	
	//user part
	function addUser($username, $password, $conductor_name, $conductor_contact_no,$acount_type,$bus)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "INSERT INTO mst_users(username, password, name, contact, account_type, bus_id)
				    VALUES(?,?,?,?,?,?)";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($username, $password, $conductor_name, $conductor_contact_no,$acount_type,$bus));

			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	function checkAddUser($username){
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM mst_users WHERE username=?";
		$stmt=$db->prepare($sql);
		$stmt->execute(array($username));
		$row=$stmt->fetch();
		if($row){
			return true;
		}else{
			return false;
		}
	}

	function updateUser($username, $password, $conductor_name, $conductor_contact_no, $account_type, $bus, $conductor_id)
	{
		$str = '';
		if(!empty($password))
			$str = 'password = ?,';
		else
			$str = '';

		try
		{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql="UPDATE mst_users
					SET username = ?,
						$str
						name = ?,
						contact = ?,
						account_type = ?,
						bus_id = ?
					WHERE user_id = ?";
			$stmt = $db->prepare($sql);

			if(!empty($str))
				$stmt->execute(array($username, $password, $conductor_name, $conductor_contact_no, $account_type, $bus, $conductor_id));
			else
				$stmt->execute(array($username, $conductor_name, $conductor_contact_no, $account_type, $bus, $conductor_id));

			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error: ", $ex->getMessage();
		}
	}
	function getUserDetails($id)
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM mst_users WHERE user_id=$id";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}
	function userList()
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM mst_users";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}
	function deleteUser($user_id)
	{
		try{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "DELETE FROM mst_users WHERE user_id=?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($user_id));
			$db = null;
		}catch(PDOException $ex){
			echo "DB Error: ", $ex->getMessage();	
		}
	}

	////Bus na part
	function addBus($comp_code,$bus_name, $bus_type, $bus_reg_no, $bus_body_no, $bus_capacity)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "INSERT INTO bus(comp_code,bus_name, bus_type, bus_reg_no, bus_body_no, bus_capacity)
				    VALUES(?,?,?,?,?,?)";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($comp_code,$bus_name, $bus_type, $bus_reg_no, $bus_body_no, $bus_capacity));

			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	////check sa bus
	function checkAddBus($comp_code){
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM bus WHERE comp_code=?";
		$stmt=$db->prepare($sql);
		$stmt->execute(array($comp_code));
		$row=$stmt->fetch();
		if($row){
			return true;
		}else{
			return false;
		}
	}
	function getBusProfile($bus_id){
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM bus WHERE bus_id=?";
		$stmt=$db->prepare($sql);
		$stmt->execute(array($bus_id));
		$row=$stmt->fetch();
		$db=null;
		return $row;		
	}
	////Update sa bus
	function updateBus($comp_code, $bus_name, $bus_type, $bus_reg_no, $bus_body_no, $bus_capacity, $bus_id)
	{
		try
		{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql="UPDATE bus
					SET comp_code = ?,
						bus_name = ?,
						bus_type = ?,
						bus_reg_no = ?,
						bus_body_no = ?,
						bus_capacity = ?
					WHERE bus_id = ?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($comp_code, $bus_name, $bus_type, $bus_reg_no, $bus_body_no, $bus_capacity, $bus_id));
			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error: ", $ex->getMessage();
		}
	}
	function busList()
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM bus";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}

	function getBusDetails($id)
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM bus WHERE bus_id=$id";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}

	function deleteBus($bus_id)
	{
		try{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "DELETE FROM bus WHERE bus_id=?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($bus_id));
			$db = null;
		}catch(PDOException $ex){
			echo "DB Error: ", $ex->getMessage();	
		}
	}
	
	////discount section
	function addDiscount($discount_type, $discount_percentage)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "INSERT INTO discount(discount_type, discount_percentage)
				    VALUES(?,?)";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($discount_type, $discount_percentage));

			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	function checkAddDiscount($discount_type){
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM discount WHERE discount_type=?";
		$stmt=$db->prepare($sql);
		$stmt->execute(array($discount_type));
		$row=$stmt->fetch();
		if($row){
			return true;
		}else{
			return false;
		}
	}

	function updateDiscount($discount_type, $discount_percentage, $discount_no)
	{
		try
		{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql="UPDATE discount
					SET discount_type = ?,
						discount_percentage = ?
					WHERE discount_no = ?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($discount_type, $discount_percentage, $discount_no));
			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error: ", $ex->getMessage();
		}
	}
	function getDiscountDetails($id)
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM discount WHERE discount_no=$id";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}
	function discountList()
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM discount";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}
	function deleteDiscount($discount_id)
	{
		try{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "DELETE FROM discount WHERE discount_no=?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($discount_id));
			$db = null;
		}catch(PDOException $ex){
			echo "DB Error: ", $ex->getMessage();	
		}
	}
	////route section
	function addRoute($place_description)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "INSERT INTO mst_places(place_description)
				    VALUES(?)";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($place_description));

			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	function checkAddRoute($place_description){
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM mst_places WHERE place_description=?";
		$stmt=$db->prepare($sql);
		$stmt->execute(array($place_description));
		$row=$stmt->fetch();
		if($row){
			return true;
		}else{
			return false;
		}
	}
	function updateRoute($place_description, $route_id)
	{
		try
		{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql="UPDATE mst_places
					SET place_description = ?
					WHERE place_id = ?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($place_description, $route_id));
			$db = null;

		}
		catch(PDOException $ex)
		{
			echo "DB Error: ", $ex->getMessage();
		}
	}
	function getRouteDetails($id)
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM mst_places WHERE place_id=$id";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}

	function routeList()
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM mst_places";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}
	function deleteRoute($route_id)
	{
		try{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "DELETE FROM mst_places WHERE place_id=?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($route_id));
			$db = null;
		}catch(PDOException $ex){
			echo "DB Error: ", $ex->getMessage();	
		}
	}
	function getPassengerMonthReport(){
		$db=new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM schedule WHERE MONTH(departure_date) = MONTH(current_date) ";
		$s=$db->prepare($sql);
		$s->execute();
		$count=$s->fetchAll();
		$db=null;
		return $count;
	}
	function getPassengerWeekReport(){
		$db=new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM schedule WHERE WEEK(departure_date) = WEEK(current_date) ";
		$s=$db->prepare($sql);
		$s->execute();
		$count=$s->fetchAll();
		$db=null;
		return $count;
	}

	///company
	function addCompany($company_code, $company_name, $company_address, $company_email, $company_telno)
	{
		try
		{
			$db = new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "INSERT INTO company(comp_code, comp_name, comp_address, comp_email, comp_telno)
				    VALUES(?,?,?,?,?)";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($company_code, $company_name, $company_address, $company_email, $company_telno));

			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error:", $ex->getMessage();
		}
	}
	function checkAddCompany($company_code){
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM company WHERE comp_code=?";
		$stmt=$db->prepare($sql);
		$stmt->execute(array($company_code));
		$row=$stmt->fetch();

		if($row){
			return true;
		}else{
			return false;
		}
	}

	function updateCompany($company_code, $company_name, $company_address, $company_email, $company_telno)
	{
		try
		{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql="UPDATE company
					SET comp_name = ?,
						comp_address = ?,
						comp_email = ?,
						comp_telno = ?
					WHERE comp_code = ?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($company_name, $company_address, $company_email, $company_telno, $company_code));
			$db = null;
		}
		catch(PDOException $ex)
		{
			echo "DB Error: ", $ex->getMessage();
		}
	}
	function getCompanyDetails($id)
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM company WHERE comp_code=$id";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}
	function companyList()
	{
		$db= new PDO(DBINFO, DBUSER, DBPASS);
		$sql="SELECT * FROM company";
		$stmt=$db->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetchAll();
		$db=null;
		return $row;
	}
	function deleteCompany($company_code)
	{
		try{
			$db= new PDO(DBINFO, DBUSER, DBPASS);
			$sql = "DELETE FROM company WHERE comp_code=?";
			$stmt = $db->prepare($sql);
			$stmt->execute(array($company_code));
			$db = null;
		}catch(PDOException $ex){
			echo "DB Error: ", $ex->getMessage();	
		}
	}
?>