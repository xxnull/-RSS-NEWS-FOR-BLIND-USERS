 <?php 
session_start();
			$appId = '762876100407913';
	$secret = '67edf208dba1910521b4a0310d484aac';
			
	 require_once('../php-sdk/src/facebook.php');

  $config = array(
    'appId' => $appId,
    'secret' => $secret,
  );

  $facebook = new Facebook($config);
  $user = $facebook->getUser();

 
  if ($user) {
		
		 $loginUrl = $facebook->getLoginUrl(array('scope' =>'email','redirect_uri'=>'http://www.caliesunderground.com/connect.php'));
      die('<script> top.location.href="'.$loginUrl.'";</script>');	
     
    } else {
        $loginUrl = $facebook->getLoginUrl(array('scope' =>'email','redirect_uri'=>'http://www.caliesunderground.com/connect.php'));
      die('<script> top.location.href="'.$loginUrl.'";</script>');
    }
		
 

		 	
		 ?>