
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
    
      		'cancion_nombre': {required:true, minlength: 4, maxlength:30},
           'cancion_descripcion': {required:true, number: true, minlength:6, maxlength:500},
           'file': { required: true },
		    
     			
		            
  },
  
   messages: {
         'cancion_nombre': 'Debe ingresar el nombre de la banda',
		 'cancion_descripcion':  'Debe ingresar el número de telefono valido',
           'file':  'Debe ingresar un correo electrónico valido', 
           
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


$allowedExts = array("mp4","webm","ogg","m4v", "mpeg", "mov");
$temp = explode(".", $_FILES["file"]["name"]);
$temp = preg_replace("/[^A-Z0-9._-]/i", "_", $temp);
	
$extension = end($temp);



if ( ($_FILES["file"]["type"] == "video/mp4") 
	|| ($_FILES["file"]["type"] == "video/webm") 
	|| ($_FILES["file"]["type"] == "video/ogg")
	|| ($_FILES["file"]["type"] == "video/quicktime")
	

	&& (in_array($extension,$allowedExts)) )
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

    if (file_exists("videos/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . "<div id=registroerrores> Este Archivo ya existe.</div> ";
	  header("Location: paso2.php?msg=Este video ya existe vuelve a intentarlo");
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
			
			 $nombre_presentacion = $_POST['nombre_presentacion'];			
			 $descripcion_presentacion = $_POST['descripcion_presentacion'];
			
			 $uid = $_SESSION['uid']; 
			
			$update_video2 = new conexion();
			
			$res = $update_video2 -> query("UPDATE bandas SET nombre_presentacion='".$nombre_presentacion."', url_presentacion='".$video_url."', descripcion_presentacion='".$descripcion_presentacion."'  WHERE id='".$uid."' ");
			
			
			
			
			
			$affected_rows = $update_video2 ->affected_rows;
if($affected_rows == 0){ header("Location:  paso2.php?msg=El video no fue actualizado, intenta nuevamente.&u=$uid");}

			$temp = explode(".", $_FILES["file"]["name"]);
			$temp = preg_replace("/[^A-Z0-9._-]/i", "_", $temp);
		  
		  
      	$subio = move_uploaded_file($_FILES["file"]["tmp_name"], "videos/".$temp[0].".".$temp[1]);
      		if(isset($subio)){
			 "Stored in: " . "videos/".$temp[0].".".$temp[1];
			 
		
		
			
			} else {header("Location: paso1.php?msg=El video no subio correctamente vuelve a intentarlo");}
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
			<h1>Registro Tercer paso</h1><br>

            
           <form role="form" action="paso4.php" enctype="multipart/form-data" method="post">
           
         
           
            <div class="form-group">
    <label for="video_nombre">Nombre de la canción</label>
    <input type="text" class="form-control" name="cancion_nombre" placeholder="Nombre">
  </div>
  
  <div class="form-group">
    <label for="video_descripcion">Descripción de la canción</label>
     <textarea class="form-control" rows="3" name="cancion_descripcion"></textarea>
  </div>
             
  <div class="form-group">
    <label for="exampleInputFile">Cancion representativa</label>
    <input type="file" name="file">
    <p class="help-block">Unicamente archivo mp3</p>
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

