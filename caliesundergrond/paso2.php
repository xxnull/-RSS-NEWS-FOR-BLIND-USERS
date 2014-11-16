
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
    
      		'nombre_presentacion': {required:true, minlength: 4, maxlength:30},
           'descripcion_presentacion': {required:true, number: true, minlength:6, maxlength:500},
           'file': { required: true },
		       			
		            
  },
  
   messages: {
         'nombre_presentacion': 'Debe ingresar el nombre del video',
		 'descripcion_presentacion':  'Debe ingresar una descripción para esta presentación',
           'file':  'Debe ingresar un archivo valido', 
                     
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
			
			$video_nombre = $_POST['video_nombre'];
			
			$video_descripcion = $_POST['video_descripcion'];
			 $uid = $_SESSION ['uid']; 
			
			$update_video = new conexion();
			
			$res = $update_video -> query("UPDATE bandas SET video_nombre='".$video_nombre."', video_url='".$video_url."', video_descripcion='".$video_descripcion."'  WHERE id='".$uid."' ");
			
			
			
			$affected_rows = $update_video ->affected_rows;
			
			if($affected_rows==0){
						
						header("Location: paso1.php?msg=Los datos no han sido registrados, vuelve a intentarlo.");
						
						}else{
							
							echo "El archivo ha subido correctamente";
							
							}
							
							
							



			$temp = explode(".", $_FILES["file"]["name"]);
			$temp = preg_replace("/[^A-Z0-9._-]/i", "_", $temp);
		  
		  
      	$subio = move_uploaded_file($_FILES["file"]["tmp_name"], "videos/".$temp[0].".".$temp[1]);
      		if(isset($subio)){
			 "Stored in: " . "videos/".$temp[0].".".$temp[1];
			 
		
		
			
			} else {
				
				header("Location: paso1.php?msg=El video no subio correctamente vuelve a intentarlo");
				
				}
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
			<h1>Registro Tercer paso video de presentacion</h1><br>
            El video de presentación es un video original y creativo donde la banda nos contará por que su propuesta debe ser incluida en Caliunderground. Este video sera incluido en el documental y hará parte del proceso de selección de las bandas.

<div class="msgred">
<?php if(isset($_GET['msg'])){
	
			echo $msg = $_GET['msg'];
		
	
	}?>            
    
    </div>
            <form role="form" action="paso3.php" enctype="multipart/form-data" method="post">
           
          
           
            <div class="form-group">
    <label for="video_nombre">Nombre de la presentación</label>
    <input type="text" class="form-control" name="nombre_presentacion" placeholder="Nombre">
  </div>
  
  <div class="form-group">
    <label for="video_descripcion">Descripción de la presentación</label>
     <textarea class="form-control" rows="3" name="descripcion_presentacion"></textarea>
  </div>
             
  <div class="form-group">
    <label for="exampleInputFile">Video de presentación</label>
    <input type="file" name="file">
    <p class="help-block">Video clip de 720X480 Los formatos admitidos son los estandares para html5 MP4, WEBM, OGG. Recomendado el formato MP4</p>
  </div>

  <button type="submit" class="btn btn-default">Ir al siguiente paso >></button>
</form>
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

