<?php
class conexion extends mysqli {
    public function __construct() { 
	
		 $host = "localhost";
		 $user = "deepluna_ccr";
		 $pass = "Cometa2012";
		 $db = "deepluna_cortocircuitorock";
		
        parent::__construct($host, $user, $pass, $db);
		
        if (mysqli_connect_error()) {
		
            die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
		
		
		
		
    }
}

?>