
<?php 
session_start();
include ('model/conexion.php');

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
    
      		
			'myFile': { required: true },
     			
		            
  },
  
   messages: {
        
		   'myFile': 'Falta el archivo',
          
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

if( isset($_FILES['file'])){
	
$type =	$_FILES["file"]["type"];


$allowedExts = array("mp3");
$temp = explode(".", $_FILES["file"]["name"]);
$temp = preg_replace("/[^A-Z0-9._-]/i", "_", $temp);
	
$extension = end($temp);



if ( ($_FILES["file"]["type"] == "audio/mp3") && (in_array($extension,$allowedExts)) )
{

if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
     "Upload: " . $_FILES["file"]["name"] . "<br>";
    "Type: " . $_FILES["file"]["type"] . "<br>";
     "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
     "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("mp3/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . "<div id=registroerrores> Este Archivo ya existe.</div> ";
      }
    else
      {
		  	$temp = explode(".", $_FILES["file"]["name"]);
			$temp = preg_replace("/[^A-Z0-9._-]/i", "_", $temp);
			
			define('TIMEZONE', 'America/Bogota');
date_default_timezone_set(TIMEZONE);

$fecha = new DateTime();
$video_date =  $fecha->getTimestamp();
$video_date;
//$newdate = date('F d, Y H:i', $my_unix_timestamp);
 	  		
			
			
			$file_name = $temp[0];
			$file_ext = $temp[1];
			$video_size = ($_FILES["file"]["size"] / 1024);
			$video_url =  $file_name.".".$file_ext;
			
			$type =	$_FILES["file"]["type"];
			
			$cancion_nombre = $_POST['cancion_nombre'];			
			$cancion_descripcion = $_POST['cancion_descripcion'];
			
			 $uid = $_SESSION ['uid']; 
			
			$update_video3 = new conexion();
			
			$res = $update_video3 -> query("UPDATE bandas SET cancion_nombre='".$cancion_nombre."',  cancion_descripcion='".$cancion_descripcion."',cancion_url='".$video_url."' WHERE id='".$uid."' ");
			
			
			
			$affected_rows = $update_video3 ->affected_rows;
			if($affected_rows==0){
						
						echo "Error se ha presentado un fallo al subir el archivo";
						}else{
							
							echo "El archivo ha subido correctamente";
							
							}


			$temp = explode(".", $_FILES["file"]["name"]);
			$temp = preg_replace("/[^A-Z0-9._-]/i", "_", $temp);
		  
		  
      	$subio = move_uploaded_file($_FILES["file"]["tmp_name"], "mp3/".$temp[0].".".$temp[1]);
      		if(isset($subio)){
			 "Stored in: " . "mp3/".$temp[0].".".$temp[1];
			 
		
		
			
			} else {echo "<div id=registroerrores>El archivo no subio correctamente vuelve a intentarlo</div>";}
      }
    }
  }
else
  {
  echo "<div id=registroerrores> Este archivo no es valido, el sistema unicamente acepta videos mp4, ogg y webm </div>";
  }


}else{  }






?>
   				

			</div>
        </div>
        
        <div class="col-md-7 infozone">
        
        	<div class="texto">
			<h1> RUT REPRESENTANTE LEGAL</h1><br>

            
           <form role="form" action="paso5.php" enctype="multipart/form-data" method="post">
           
         
      
  
 
             
  <div class="form-group">
    <label for="exampleInputFile">RUT del representante legal</label>
    <input type="file" name="myFile">
    <p class="help-block">Unicamente archivo jpg</p>
  </div>

  <button type="submit" class="btn btn-default">Ir al siguiente paso >></button>
</form>
           

         
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

