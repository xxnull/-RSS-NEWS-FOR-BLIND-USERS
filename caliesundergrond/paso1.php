<?php
session_start();

include ('model/conexion.php');
include('src/abeautifulsite/SimpleImage.php');
define("UPLOAD_DIR", "im_bandas/");

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
	
	
	
try {
    $img = new abeautifulsite\SimpleImage($archivo);
	$imgwidth =	$img->get_width();
	$imgheight = $img->get_height();
	if($imgwidth > $imgheight){
				$img->resize(200,200)->save('im_bandas/'.$newname);
		}else{
			
			$img->resize(200,200)->save('im_bandas/'.$newname);
			
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

<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>

<script>
$(document).ready(function(){
    $("#form").validate({
	
	rules: {    
    
      		'video_nombre': {required:true, minlength: 4, maxlength:30},
           'video_descripcion': {required:true, number: true, minlength:6, maxlength:500},
           'file': { required: true  },
		    
     			
		            
  },
  
   messages: {
         'video_nombre': 'Debe ingresar el nombre del video',
		 'video_descripcion':  'Debe ingresar una descripción para el video',
           'file':  'Debe ingresar un archivo electrónico valido', 
           
          
       },
	
	
	});
  });
</script>
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
				
					echo $img_url;
		
					 echo $nombrebanda = $_POST['nombrebanda'];
					 $email = $_POST['email'];
					$representantelegal = $_POST['representantelegal'];
					 $numerocedula = $_POST['numerocedula'];
					 $perfilreverbnation = $_POST['perfilreverbnation'];
					 $generomusical = $_POST['generomusical'];
					 $numeroMusicos = $_POST['numeroMusicos'];
					$instrumentos = $_POST['instrumentos'];
						$comuna = $_POST['comuna'];
						$resena = $_POST['resena'];
					
					
					
					
					
					
					define('TIMEZONE', 'America/Bogota');
			date_default_timezone_set(TIMEZONE);
			$fecha = new DateTime();
			$unix_timestamp =  $fecha->getTimestamp();
			//$newdate = date('F d, Y H:i', $my_unix_timestamp);
					
					
					
					
					$db = new conexion();
								$resultado = $db->query("SELECT * FROM bandas WHERE (numerocedula = '$numerocedula')");
								 $affected_rows = $db ->affected_rows;
					//mysqli_close($db);
					$registrada = $affected_rows;
					
							if($affected_rows !=0){
									
										echo "La banda ya esta registrada en nuestro sistema";
										
									
									}else{
										
										
										$nombrebanda = $db->real_escape_string($nombrebanda);
								$email = $db->real_escape_string($email);
								$representantelegal = $db->real_escape_string($representantelegal);
								$numerocedula = $db->real_escape_string($numerocedula);
								$perfilreverbnation = $db->real_escape_string($perfilreverbnation);
								$generomusical = $db->real_escape_string($generomusical);
								$numeroMusicos = $db->real_escape_string($numeroMusicos);
								$instrumentos = $db->real_escape_string($instrumentos);
								$comuna = $db->real_escape_string($comuna);
								$resena = $db->real_escape_string($resena);
									
									mysqli_close($db);
										$db = new conexion();
									
		$db->query("INSERT INTO bandas(nombrebanda, email, representantelegal, numerocedula, perfilreverbnation, generomusical, numeroMusicos, instrumentos, unix_timestamp, img_url, comuna, resena) VALUES ('$nombrebanda','$email','$representantelegal','$numerocedula','$perfilreverbnation','$generomusical','$numeroMusicos','$instrumentos','$unix_timestamp','$newname', '$comuna', '$resena')"); 
		
		$affected_rows = $db->affected_rows;
		
		if($affected_rows == 0){
			
			 header("Location: registro.php?msg=Los datos no han sido registrados, vuelve a intentarlo.");
			}
		
		
		mysqli_close($db);
		
		$db = new conexion();
		$result = $db->query("SELECT * FROM bandas WHERE id ORDER BY id DESC LIMIT 1");
		
		while($row = $result->fetch_assoc()){
			
			$_SESSION ['uid']  = $row['id'];
			
			}
		
		
										
										}
								
								
								
								
								
								
		
			
				?>

			</div>
        </div>
        
        <div class="col-md-7 infozone">
        
        	<div class="texto">
			 
            
            
            <div class="msgred">
<?php if(isset($_GET['msg'])){
	
			echo $msg = $_GET['msg'];
		
	
	}?>            
    
    </div>
            

            <?php 
			if($registrada==0){
			
			?>
            
            <h1>Registro segundo paso Videoclip de la banda</h1><br>
            Este videoclip es un trabajo original de la banda donde expresan de una forma conceptual el desarrollo de su música.
            
            <h2>Recomendamos utilizar este programa para convertir los videos al formato compatible con html5
            mp4 o webm <a href="http://www.any-video-converter.com/download-avc-free.php">ANY VIDEO CONVERTER</a></h2>
            
           <form role="form" action="paso2.php" enctype="multipart/form-data" method="post">
           
           
           
            <div class="form-group">
    <label for="video_nombre">Nombre del video</label>
    <input type="text" class="form-control" name="video_nombre" placeholder="Nombre">
  </div>
  
  <div class="form-group">
    <label for="video_descripcion">Descripción del video</label>
     <textarea class="form-control" rows="3" name="video_descripcion"></textarea>
  </div>
             
  <div class="form-group">
    <label for="exampleInputFile">Videoclip</label>
    <input type="file" name="file">
    <p class="help-block">Video clip de 720X480 Los formatos admitidos son los estandares para html5 MP4, WEBM, OGG. Recomendado el formato MP4 peso maximo 100 megas </p>
  </div>

  <button type="submit" class="btn btn-default">Ir al siguiente paso >></button>
</form>
           

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

