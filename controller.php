<?php

	if(isset($_SERVER['PLATFORM'])){
		if($_SERVER['PLATFORM'] == 'pagoda'){
			define('DBINFO',  'mysql:/host=192.168.0.4;dbname=gopagoda;');
			define('DBUSER',  $_SERVER['DATABASE1_USER']);
			define('DBPASS',  $_SERVER['DATABASE1_PASS']);	
		}else{

		}

	}else{
		define('DBINFO',  'mysql:/host=localhost;dbname=lockoutfinal;');
		define('DBUSER',  'root');
		define('DBPASS',  '');	 
	}
	
?>