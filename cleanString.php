<?php

function quitar_acento($s)
{
$s = preg_replace(“/[áàâãª]/”,”a”,$s);
$s = preg_replace(“/[ÁÀÂÃ]/”,”A”,$s);
$s = preg_replace(“/[ÍÌÎ]/”,”I”,$s);
$s = preg_replace(“/[íìî]/”,”i”,$s);
$s = preg_replace(“/[éèê]/”,”e”,$s);
$s = preg_replace(“/[ÉÈÊ]/”,”E”,$s);
$s = preg_replace(“/[óòôõº]/”,”o”,$s);
$s = preg_replace(“/[ÓÒÔÕ]/”,”O”,$s);
$s = preg_replace(“/[úùû]/”,”u”,$s);
$s = preg_replace(“/[ÚÙÛ]/”,”U”,$s);
$s = str_replace(“ç”,”c”,$s);
$s = str_replace(“Ç”,”C”,$s);
$s = str_replace(“ñ”,”n”,$s);
$s = str_replace(“Ñ”,”N”,$s);

return $s;
}

?>