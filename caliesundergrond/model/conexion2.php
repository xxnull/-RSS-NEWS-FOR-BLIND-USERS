<?php
class conexion2 extends mysqli {
    public function __construct() { 
	
		 $host = "localhost";
		 $user = "deepluna_cu2014";
		 $pass = "Cometa2012";
		 $db = "deepluna_cu2014";
		
        parent::__construct($host, $user, $pass, $db);
		
        if (mysqli_connect_error()) {
		
            die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
		
		
		
		
    }
}

?>