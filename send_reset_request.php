<?php

	// request to reset a users fingerprint can be sent once every 24 hours.
?>
<!doctype html>
<html>
<head>
	<title>Send Request Fingerprint Reset</title>
	<style>
	body{
		font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;
		margin: 0px;
		padding: 15px;
	}
</style>
</head>
<body>
<h1>Send Reset Request</h1>
<?php
	
	//print_r($_REQUEST);
	$unr="";
	if(isset($_REQUEST["unr"])) $unr=preg_replace("/[^a-zA-Z0-9]+/", "", $_REQUEST["unr"]);

	// get IP
	$rad=$_SERVER['REMOTE_ADDR'];
	if($rad!="145.102.244.61")
	{
		// NOT AT SCHOOL!
		echo "you are not at school..";
		exit();
	}
	function setStat($msg)
	{
		global $fingerprint,$unr,$uni,$cookie_unr,$nva,$nvc,$nvp,$psw,$scr,$ffp,$cfp,$dnt,$agent,$hr,$tzo,$nvu,$rad,$xff,$cli;	
		$filename="stats/stats_".date_create()->format("Y-m-d").".txt";
		$stat=date_create()->format("H:i:s a")."|".time()."|".$msg."|".$unr."|".$uni."|".$cookie_unr."|".$psw."|".$fingerprint."|".$ffp."|".$cfp."|".$dnt."|".$nva."|".$nvc."|".$nvp."|".base64_encode($agent)."|".$tzo."|".base64_encode($nvu)."|".$rad."|".$xff."|".$cli."\n"; // WHEN, WHAT and WHO
		file_put_contents ($filename,$stat,FILE_APPEND);
	}
	
	// check unr exists in leerlingen.txt.
	$filename="leerlingen/leerlingen.txt";
	$students=array();
	$student_valid=false;
	if(is_file($filename))
	{
		$leerlingen=file_get_contents($filename);
		$temp=explode(PHP_EOL,$leerlingen);
		for($i=0;$i<count($temp);$i++)
		{
			if(strlen($temp[$i])>5)
			{
				$t=explode("|",$temp[$i]);
				$student=array();
				$student["nr"]=$t[0];
				$student["klas"]=$t[1];
				$student["naam"]=$t[2];
					
 				if($student["nr"]==$unr)
				{
					$student_valid=true;
				}
				array_push($students,$student);
			}
		}
	}	
	if($student_valid)
	{
		// check the logged fingerprint for this student!
		$fingerprint_file="leerlingen/student".$unr.".txt";
		if(!is_file($fingerprint_file))
		{
			echo "NO fingerprint recorded for this student..";
		}else{
			// check when the fingerprint file was made!
			$allowed_time=filemtime($fingerprint_file)+24*60*60*1000;
			if(time()>$allowed_time)
			{
				echo "Sorry, je moet nog tot ".date("l jS \of F Y h:i:s A",$allowed_time)." wachten, voordat je je fingerprint kan resetten. <br>";
				echo "Meld je (met een goede reden) bij Hjalmar om het NU te laten doen.";
				exit();
			}else{
				// fingerprint is older than 24 uur.
				$ticket=uniqid();
				
				$msg="Iemand heeft een fingerprint reset aangevraagd. Als jij dit niet was, negeer deze mail dan.\n\n";
				$msg.="Klik op de volgende link om je fingerprint te resetten, doe dit OP SCHOOL en VANAF DE COMPUTER DIE JE VOORTAAN WILT GEBRUIKEN!\n\n";
				$msg.="http://snoh.hosts.ma-cloud.nl/presentie/reset_request.php?t=".$ticket;
				
				// use wordwrap() if lines are longer than 70 characters
				$msg = wordwrap($msg,70);
				
				$headers = "From: h.snoep@ma-web.com";
				$headers .= "\r\nReply-To: h.snoep@ma-web.com";
				$headers .= "\r\nX-Mailer: PHP/".phpversion();
				$gelukt=mail($unr."@ma-web.nl","Jouw presentie fingerprint reset-request",$msg,$headers,"-f your@email.here");
				
				if($gelukt)
				{
					echo "Fingerprint-reset-mail is verzonden, klik op de link in de mail";
					echo "<ul>";
					echo "<li>vanaf de computer die je wilt fingerprinten!</li>";
					echo "<li>vanaf school!</li>";
					echo "<li>binnen 24 uur</li>";
 					echo "</ul>";
					// user notified, now create the ticket!
					file_put_contents ("data/reset_request_".$ticket.".txt",$unr); // associate $unr with this ticket
				}else{
					echo "Mail verzenden NIET gelukt.. Wellicht is het anders beveiligd dan ik nu denk? Dit MOET je ff aan me melden.";
					// maak toch maar de ticket voor testen nu!
					file_put_contents ("data/reset_request_".$ticket.".txt",$unr); // associate $unr with this ticket
				}
			}					
		}
	}
	

?>
</body>
</html>