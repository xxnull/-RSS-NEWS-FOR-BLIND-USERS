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

<body onload="load()">
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
    
   				

			</div>
        </div>
        
        <div class="col-md-7 infozone">
        
        	<div class="texto">
			<h1>Registro primer paso Información general</h1><br>


Si ya estas en este punto significa que estas listo para llenar toda la información por lo tanto debes tener preparado lo siguiente :
<ul class="registrolist">
<li>Una fotografía de la banda de 200 X 200 px.</li>
<li>Un video de presentación de la banda.</li>
<li>Un videoclip de una canción de la banda</li>
<li>Una canción mp3 de la banda</li>
<li>RUT del representante legal</li>
<li>Cedula escaneada</li>
<li>Aceptar el reglamento y las condiciones</li>
</ul>   
         

Adicional a esta información es necesario enviar otra información en formato fisico descrita en el link de <a href="requisitos_caliunderground.php">requisitos</a>


 <div class="msgred">
<?php if(isset($_GET['msg'])){
	
			echo $msg = $_GET['msg'];
		
	
	}?>            
    
    </div> 
            
            <form role="form" id="form" action="paso1.php" enctype="multipart/form-data" method="post" class="formregistro">
            
             <div class="form-group">
    <label for="nombrebanda">Nombre de la banda</label>
    <input type="text" class="form-control" name="nombrebanda" placeholder="Nombre de tu banda">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Teléfono</label>
    <input type="text" class="form-control" name="telefono" placeholder="Telefono">
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Email oficial</label>
    <input type="email" class="form-control" name="email" placeholder="Email">
  </div>
  
  <div class="form-group">
    <label for="representantelegal">Nombre del representante legal</label>
    <input type="text" class="form-control" name="representantelegal" placeholder="Representante legal">
  </div>
  
  <div class="form-group">
    <label for="numerocedula">Numero de identificación</label>
    <input type="text" class="form-control" name="numerocedula" placeholder="Numero de cedula">
  </div>
  
  <div class="form-group">
    <label for="perfilreverbnation">Perfil Reverbnation</label>
    <input type="text" class="form-control" name="perfilreverbnation" placeholder="Perfil Reverbnation">
  </div>
  
  <div class="form-group">
    <label for="generomusical">Genero Musical</label>
    <input type="text" class="form-control" name="generomusical" placeholder="Genero">
  </div>
  
  <div class="form-group">
    <label for="comuna">Comuna de Cali o municipio fuera de cali</label>
    <input type="text" class="form-control" name="comuna" placeholder="Comuna de Cali o municipio del Valle">
  </div>
  
  <div class="form-group">
    <label for="resena">Reseña corta ( 200 caracteres ) </label>
    <textarea class="form-control" name="resena" placeholder=""></textarea>
  </div>
  
  <div class="form-group">
    <label for="numeroMusicos">Numero de musicos</label>
    <input type="number" class="form-control" name="numeroMusicos" placeholder="Numero musicos">
  </div>
  
  
  
  
  <div class="form-group">
    <label for="numeroMusicos">Instrumentos que interpretan</label>
    <textarea class="form-control" rows="3" name="instrumentos"></textarea>
   
  </div>
  
  
  
  
 
  
  <div class="form-group">
    <label for="exampleInputFile">Fotografía</label>
    <input type="file" name="myFile">
    <p class="help-block">Fotografia de 200 X 200 pixeles</p>
  </div>

  <button type="submit" class="btn btn-default">Ir al segundo paso >></button>
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
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/holder.js"></script>
    
    

<script type="text/javascript" src="js/jquery.validate.js"></script>

<script>
function load()
{
alert("IMPORTANTE: Todo registro incompleto será automaticamente eliminado, tomese su tiempo para reunir primero todo lo necesario y asi no perder el esfuerzo.");
}
</script>


<script>
$(document).ready(function(){
    $("#form").validate({
	
	rules: {
    
      		'nombrebanda': {required:true, minlength: 4, maxlength:30},
           'telefono': {required:true, number: true, minlength:6, maxlength:11},
           'email': { required: true, email: true, minlength: 7, maxlength:25 },
		    'representantelegal': { required: true,  },
			'numerocedula': { required: true, number: true, minlength: 7, maxlength:11 },
			
			'perfilreverbnation': { required: true  },
			'generomusical': { required: true  },
			'numeroMusicos': { required: true, number:true, minlength:1, },
			'instrumentos': { required: true, minlength:1, },
			'myFile': { required: true },
     			
		            
  },
  
   messages: {
         'nombrebanda': 'Debe ingresar el nombre de la banda',
		 'telefono':  'Debe ingresar el número de telefono valido',
           'email':  'Debe ingresar un correo electrónico valido', 
           'representantelegal': 'Debe ingresar el nombre del representante legal',
		   'numerocedula': 'Debe colocar el numero de cedula del representante legal',
		   'perfilreverbnation': 'falta el perfil',
		   'generomusical': 'Que genero musical interpretan',
		   'numeroMusicos': 'Cuantos musicos tiene la banda',
		   'instrumentos': 'Que instrumentos interpretan',
		   'myFile': 'Falta el archivo',
          
       },
	
	
	});
  });
</script>


</body>
</html>

