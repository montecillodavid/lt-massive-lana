<?php

	if(isset($_SERVER['PLATFORM'])){

		if($_SERVER['PLATFORM'] == 'pagoda'){
			define('DBINFO',  'mysql:host=' . $_SERVER['DATABASE1_HOST'] . ':' . $_SERVER['DATABASE1_PORT'] . ';' . 'dbname=' . $_SERVER['DATABASE1_NAME'] . ';' );
			define('DBUSER',  $_SERVER['DATABASE1_USER']);
			define('DBPASS',  $_SERVER['DATABASE1_PASS']);	
		}else{

			define('DBINFO',  'mysql:/host=localhost;dbname=lockoutfinal;');
			define('DBUSER',  'root');
			define('DBPASS',  '');	
		} 

	}else{

		define('DBINFO',  'mysql:/host=localhost;dbname=lockoutfinal;');
		define('DBUSER',  'root');
		define('DBPASS',  '');	 
	}
	
?>