
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Rock news reader</title>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="estilo.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<script src="js/jquery.min.js" type="text/javascript"></script>


</head>

<body>



<div class="container">
		<div class="row">
			<div class="col-md-8">
				
				<div class="bigtitle">
					RN4BP   <i class="fa fa-volume-up"></i> 
				</div>
				<div class="mediumtext">
					NOTICIAS PARA INVIDENTES
				</div>

				<div class="smalltext">
					Ayuda a tus parientes o amigos con discacidad visual a conocer las noticias
					del diario de circulación mas importante del Valle del cauca. 

				</div>



				<div class="verysmalltext">

					<i class="fa fa-chevron-circle-right"></i> Pruebalo con solo hacer click en la tecla tabulador.


				</div>






				

				<div class="features">

					<h2>Caracteristicas</h2>
					<ul>
							<li>Lectura de noticias para invidentes</li>
							<li>Servicio gratuito</li>
							<li>Disponible solo para laptop y desktop</li>
					</ul>
				</div>

					<div class="features">

					<h2>Mejoras futuras</h2>
					<ul>
							<li>Selección de noticias basado en geolocalización</li>
							<li>Multiples idiomas</li>
							<li>Versión para moviles</li>
							<li>Lectura de tildes</li>
					</ul>
				</div>

			</div>
			<div class="col-md-4 news">

				<?php
	include_once "class.AbsRssReader20.php";
	include_once 'PHP_Text2Speech.class.php';
	include_once 'cleanString.php';
	$xml = new AbsRssReader20();
	$xml->Load('http://feeds.feedburner.com/ElPaiscomco?format=xml');
//	$xml->Load('http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/front_page/rss.xml');
	
	$chItems = $xml->GetItems();







	if (is_array($chItems) and count($chItems)>0)
	{
		
		$num = count($chItems);
		$j=1;
		$k=0;
		$m=0;
		$h=0;
		$t=0;
			for($i=0; $i<$num; $i++){
				$items = "item_".$i;


			$n4_title = $chItems[$items]['title'];
			$n4_desc = $chItems[$items]['description'];
			 
			
  				 
				 $res = "<ul id=texter>";
				$res .= "
			<li tabindex=$j onfocus=playaudio".$k."() onblur=stopaudio() ><h1>".$n4_title."</h1></li> 
				
			
    		<li tabindex=$j onfocus=playaudio".($k=$k+1)."() onblur=stopaudio()>".$n4_desc."</li>
					";
					$res .= "</ul>";
					
					$t2s = new PHP_Text2Speech;
					
					$res.= "
					<script language=javascript>
					
						function playaudio".$m."(){
							
							var snd = new Audio(' ". $t2s->speak($n4_title)." '); 
							window.silencio = snd;
							snd.play();
																					
							} ". ($m++)."
							
							
							
							
							function playaudio".$m."(){
							
							var snd = new Audio(' ". $t2s->speak($n4_desc)." '); 							
							window.silencio = snd;
							snd.play();
							
							} 
							
							function stopaudio(){
								
									var silen = window.silencio;
									silen.pause();
								}
							
								
							
							
                     </script>";
					$m++;
					$k++;
			
			print_r($res);
						
	





		};		
			
		
	}
?>




			</div>
		</div>
	</div>
</body>
</html>