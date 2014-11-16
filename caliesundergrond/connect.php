
<?php
session_start();
	
	$appId = '762876100407913';
	$secret = '67edf208dba1910521b4a0310d484aac';
	include('model/conexion.php');
			
	 require_once('../php-sdk/src/facebook.php');
	 
  $config = array(
    'appId' => $appId,
    'secret' => $secret,
  );

  $facebook = new Facebook($config);
  $user = $facebook->getUser();

 if($user) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {
        		
		// user name
		$user_profile = $facebook->api('/me','GET');
       
		
		// get access token
		// Get the current access token
		$access_token = $facebook->getAccessToken();
	
		$secret = $facebook->getApiSecret();
		$appId = $facebook->getAppId();
		
		
		$response = $facebook->api(
  				'me/og.posts',
				  'GET'
			);
			
			//echo $response[0];
		
		
        // Give the user a logout link 
        //echo '<br /><a href="' . $facebook->getLogoutUrl() . '">logout</a>';
      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $loginUrl = $facebook->getLoginUrl(array('scope' =>'email','redirect_uri'=>'http://www.caliesunderground.com/connect.php'));
     
	die('<script> top.location.href="'.$loginUrl.'";</script>');
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, so print a link for the user to login
      // To post to a user's wall, we need publish_stream permission
      // We'll use the current URL as the redirect_uri, so we don't
      // need to specify it here.
      $loginUrl = $facebook->getLoginUrl(array('scope' =>'email','redirect_uri'=>'http://www.caliesunderground.com/connect.php'));
     
	die('<script> top.location.href="'.$loginUrl.'";</script>');
    }
	
			// Los datos de usuario que entrega facebook
			$user_profile = $facebook->api('/me','GET');
			
			 $nombre = $user_profile['name'];
		     $fid = $user_profile['id'];
			 $email = $user_profile['email'];
			 $link = $user_profile['link'];
			  $sexo = $user_profile['gender'];
			  $estado = $user_profile['relationship_status'];
			  $locacion = $user_profile['location'];
						
			// Variables de session
			
			echo  $_SESSION['nombre'] = $nombre;
			 echo $_SESSION['fid'] = $fid;
			 echo $_SESSION['email'] = $email;
			 echo $_SESSION['link'] = $link;
			 echo $_SESSION['sexo'] = $sexo;
			 echo $_SESSION['estado'] = $estado;
			  echo $_SESSION['locacion'] = $locacion;
			
			
			
			
			
			
			echo $fid;
			echo $nombre;
			echo $email;
			
			
			$send = new conexion();
			// verifico si el usuario ya esta en la bd existe
			// usuario que viene de facebook $fid frente a usuario que esta en la bd fid
			$userconfirmed = $send ->query("SELECT * FROM usuarios WHERE (`email` LIKE '%".$email."%') ");
			$affected_rows = $send->affected_rows;
			echo $affected_rows;	
			
			
			// si el usuario no existe en la bd
				if( $affected_rows == 0 ){
				// Insert a la BD
				
				define('TIMEZONE', 'America/Bogota');
				date_default_timezone_set(TIMEZONE);
				$fecha = new DateTime();
				$unix_timestamp =  $fecha->getTimestamp();
				
				$susuario = 0;
				$aceptado = 1;
				$verificado = 1;
				
				
				$send->query("INSERT INTO usuarios ( fid, nombre, email, link, susuario, aceptado, verificado,timestamp, sexo, estado, locacion) VALUES ( '$fid', '$nombre', '$email','$link','$susuario','$aceptado','$verificado', '$unix_timestamp','$sexo','$estado', '$locacion' )");
				
				
				//var_dump($send);
				
				header("Location: inicio.php");
	
					}else{					
						
						header("Location: inicio.php");
						
					}  
			
			?>
        
        	
     	
        
        	
 