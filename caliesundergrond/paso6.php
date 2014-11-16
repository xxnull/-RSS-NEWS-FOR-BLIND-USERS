<?php
session_start();

include ('model/conexion.php');
include('src/abeautifulsite/SimpleImage.php');
define("UPLOAD_DIR", "rutbandas/");

// show upload form
if ($_SERVER["REQUEST_METHOD"] == "GET") {
?>
vuelve a enviar la información
<?php
}

// process file upload
else if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["myFile"])) {
     $myFile = $_FILES["myFile"];
	
   
	
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<div id=registroerrores>Ha ocurrido un error intente mas tarde.</div>";
        exit;
    }
	


    // verify the file type
    $fileType = exif_imagetype($_FILES["myFile"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
   
    if (!in_array($fileType,$allowed)) {
        echo "<div id=registroerrores>Este tipo de archivo no es permitido.</div>";
        exit;
    }

    // ensure a safe filename
     $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);


    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
		
		
    }
	

	     
	
	
  // preserve file from temporary directory
   
      $archivo = $myFile['tmp_name'];
	
	  $newname = $parts["filename"] . "-" . $i . "." . $parts["extension"];
	 $_SESSION['newname2'] = $newname;
	
	
try {
    $img = new abeautifulsite\SimpleImage($archivo);
	$imgwidth =	$img->get_width();
	$imgheight = $img->get_height();
	if($imgwidth > $imgheight){
				$img->save('rutbandas/'.$newname);
		}else{
			
			$img->save('rutbandas/'.$newname);
			
			}
	
	
} catch(Exception $e) {
    echo 'Error: ' . $e->getMessage();
}	
	
	
	
	//$success = move_uploaded_file($myFile['tmp_name'], UPLOAD_DIR . $name);
    if (!$img) {
        echo "<div id=registroerrores>No es posible guardar el archivo, intente nuevamente.</div>";
        exit;
    } else{
				
				
				
		
		}
		
		

    // set proper permissions on the new file
   chmod(UPLOAD_DIR . $name, 0644);

    
	
	
	

} 



	 
	
	 $img_url = "<img src=im_bandas/".$newname.">";
	
	
	
	
			



?>


<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ROCK DE CALI">
    <meta name="author" content="CATALEJO WEB SOFTWARE">
    <link rel="shortcut icon" href="favicon.ico">
<title>CALI ES UNDERGROUND</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
</head>

<body>
<div class="container">

 
    
    <div class="row">
    
    	
    	<div class="col-md-6 menu">
        	
             <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
          	<?php include 'menu.php' ?>
          
          
          </ul>
          
          </div>


        </div>       
       
    </div>
    
    
    
    <div class="row">
    
    <div class="col-md-3">
    
    		<div class="menu2014">
    
   				<?php 
				
				
				$newname = $_SESSION['newname2'] ;
					
					$uid = $_SESSION['uid'];
					$db = new conexion();
					$resultado = $db->query("UPDATE bandas SET copiacedula ='".$newname."'  WHERE id='".$uid."' ");
					$affected_rows = $db ->affected_rows;
					//mysqli_close($db);
					if($affected_rows==0){
						
						echo "Error se ha presentado un fallo al subir el archivo";
						}else{
							
							echo "has terminado de subir toda la información";
							
							}
					
							
		
		
									
								
								
								
								
								
		
			
				?>

			</div>
        </div>
        
        <div class="col-md-7 infozone">
        
        	<div class="texto">
			
            

            <?php 
			if($registrada==0){
			
			?>
              
           
           

<?php } ?>

         
            </div>
            
            
            
            

    	
            	
                  
        </div>
        
        <div class="col-md-2">
        <div class="logos">
       
            </div>
           
             
            
            </div>
    </div>
    
   
</div>

 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="js/bootstrap.min.js"></script>
    <script src="js/holder.js"></script>


</body>
</html>

