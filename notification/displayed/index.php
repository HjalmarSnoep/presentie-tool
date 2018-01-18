<?php
$date=date("Y-m-d"); 
// 2017-09-01 = 1 september 2017, datum is achteruit, zodat windows hem netjes sorteert.
$logname=$date.".txt";
$ip=$_SERVER['REMOTE_ADDR']; 
$time=date("H:i:s"); // uur 0-24, minuten met voorloop 0 , seconden met voorloop 0 
// regel die de gebeurtenis beschrijft.
$log=$ip."|".$time."|".json_encode($_REQUEST).PHP_EOL; 
//PHP EOL = PHP end of line, dat teken kan per server verschillen
file_put_contents($logname, $log, FILE_APPEND);
?>