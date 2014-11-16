
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Rock news reader</title>
<link rel="stylesheet" type="text/css" href="caliunderground-estilo.css">
<script src="js/jquery.min.js" type="text/javascript"></script>


</head>

<body>
<?php
	include_once "class.AbsRssReader20.php";
	include_once 'PHP_Text2Speech.class.php';
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
				
  				 
				 $res = "<ul id=texter>";
				$res .= "
			<li tabindex=$j onfocus=playaudio".$k."() onblur=stopaudio() ><h1>".$chItems[$items]['title']."</h1></li> 
					".($j=$j+1)."
			
    		<li tabindex=$j onfocus=playaudio".($k=$k+1)."() onblur=stopaudio()>".$chItems[$items]['description']."</li>
					";
					$res .= "</ul>";
					
					$t2s = new PHP_Text2Speech;
					
					$res.= "
					<script language=javascript>
					
						function playaudio".$m."(){
							
							var snd = new Audio(' ". $t2s->speak($chItems[$items]['title'])." '); 
							window.silencio = snd;
							snd.play();
																					
							} ". ($m++)."
							
							
							
							
							function playaudio".$m."(){
							
							var snd = new Audio(' ". $t2s->speak($chItems[$items]['description'])." '); 							
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
</body>
</html>