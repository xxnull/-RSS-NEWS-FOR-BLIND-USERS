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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-29478862-1', 'caliesunderground.com');
  ga('send', 'pageview');

</script>



<!-- required -->

<!-- soundManager.useFlashBlock: related CSS -->
<link rel="stylesheet" type="text/css" href="flashblock/flashblock.css" />

<!-- required -->
<link rel="stylesheet" type="text/css" href="360player.css" />
<link rel="stylesheet" type="text/css" href="360player-visualization.css" />

<!-- special IE-only canvas fix -->
<!--[if IE]><script type="text/javascript" src="js/excanvas.js"></script><![endif]-->

<!-- Apache-licensed animation library -->
<script type="text/javascript" src="js/berniecode-animator.js"></script>

<!-- the core stuff -->
<script type="text/javascript" src="js/soundmanager2.js"></script>
<script type="text/javascript" src="js/360player.js"></script>

<script type="text/javascript">
soundManager.setup({
  // path to directory containing SM2 SWF
  url: 'swf/'
});





threeSixtyPlayer.config.scaleFont = (navigator.userAgent.match(/msie/i)?false:true);
threeSixtyPlayer.config.showHMSTime = true;

// enable some spectrum stuffs

threeSixtyPlayer.config.useWaveformData = true;
threeSixtyPlayer.config.useEQData = true;
threeSixtyPlayer.config.loadRingColor = '#d33131';
threeSixtyPlayer.config.playRingColor = '#7e0b0b';


// enable this in SM2 as well, as needed

if (threeSixtyPlayer.config.useWaveformData) {
  soundManager.flash9Options.useWaveformData = true;
}
if (threeSixtyPlayer.config.useEQData) {
  soundManager.flash9Options.useEQData = true;
}
if (threeSixtyPlayer.config.usePeakData) {
  soundManager.flash9Options.usePeakData = true;
}

if (threeSixtyPlayer.config.useWaveformData || threeSixtyPlayer.flash9Options.useEQData || threeSixtyPlayer.flash9Options.usePeakData) {
  // even if HTML5 supports MP3, prefer flash so the visualization features can be used.
  soundManager.preferFlash = true;
}

// favicon is expensive CPU-wise, but can be used.
if (window.location.href.match(/hifi/i)) {
  threeSixtyPlayer.config.useFavIcon = true;
}

if (window.location.href.match(/html5/i)) {
  // for testing IE 9, etc.
  soundManager.useHTML5Audio = true;
}
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
    
    
    
    
    
    
   
        
       
        
        	            
            <?php 
			
			$db = new conexion();
			$result = $db->query("SELECT * FROM bandas WHERE   video_url != ''  and url_presentacion != ''  and cancion_url != ''");
			while($row = $result->fetch_assoc()){
			
			$_SESSION ['uid']  = $row['id'];
			 $nombrebanda  = $row['nombrebanda'];
			 $url_presentacion  = $row['url_presentacion'];
			$cancion_nombre  = $row['cancion_nombre'];
			$cancion_url  = $row['cancion_url'];
			$img_url  = $row['img_url'];
			$video_nombre  = $row['video_nombre'];
			$video_url  = $row['video_url'];
			$resena  = $row['resena'];
			
			echo "<div class='row bandas'>";
			
						
			
			
						echo "<div class=textoimg>";
						
						
						
								echo "<div class=bandasimg>";
			
								echo "<h1>".$nombrebanda."</h1>";
				
								echo "<img src=im_bandas/".$img_url ." >";
								echo "<div class='resenatext'>$nombrebanda $resena</div>";
			
								echo "</div>";
						
						
						
						
								echo "<div class=bandainfo>
								
								$cancion_nombre
								<div class='ui360 ui360-vis'>
											<a href=mp3/$cancion_url></a>
										</div>
								
								
									<video width='240' height=''  controls>
										  <source src='videos/$video_url' type='video/mp4'>
										  <source src='videos/$video_url' type='video/ogg'>
										  <source src='videos/$video_url' type='video/webm'>
										Your browser does not support the video tag.
										</video>
										
										
										
								
								
								 </div>";
						
						
						
						
												
								echo "<div class=bandavideoclip>";
												
													echo "
														
											<video width='560' height='' controls>
										  <source src='videos/$url_presentacion' type='video/mp4'>
										  <source src='videos/$url_presentacion' type='video/ogg'>
										  <source src='videos/$url_presentacion' type='video/webm'>
										Your browser does not support the video tag.
										</video>
										
										";
								echo "</div>";
					echo "</div>";
			
			
			echo "</div>";
			
			
			
			
			
			
			
			
			
			} // END WHILE
			
			?>
            
            
           
            
           

  
            	
      
        
        <div class="col-md-2">
        <div class="logos">
      
   
            </div>
           
             
            
            </div>
    </div>
    
   
</div>

  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/holder.js"></script>

</body>
</html>

