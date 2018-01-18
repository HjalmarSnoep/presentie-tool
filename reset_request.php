<!doctype html>
<html>
<head>
	<title>Request Fingerprint Reset</title>
	<style>
	body{
		font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;
		margin: 0px;
		padding: 15px;
	}
</style>
</head>
<body>
<h1>Reset Request</h1>
<?php
	
	//print_r($_REQUEST);
	$t="";
	if(isset($_REQUEST["t"])) $t=preg_replace("/[^a-zA-Z0-9]+/", "", $_REQUEST["t"]);

	// check if the ticket exists
	$ticket="data/reset_request_".$t.".txt";
	if(is_file($ticket))
	{
		// check if it's recent
		$ts=time()-filemtime($ticket);
		echo "found your ticket, aged ".$ts." milliseconds.<br>";
		if($ts<(24*60*60*1000))
		{
			// get IP
			$rad=$_SERVER['REMOTE_ADDR'];
			if($rad!="145.102.244.61")
			{
				echo "you are not at school";
				unlink($ticket); // whatEVER happens, after we find it it is deleted!	
				exit();
			}else{
				// we are at school, it seems to be a valid ticket.
				$unr=file_get_contents($ticket);
				// erase the fingerprint and tell the user.
				$fingerprint_file="leerlingen/student".$unr.".txt";
				if(!is_file($fingerprint_file))
				{
					echo "fingerprint seems allready reset?";
				}else{
					unlink($fingerprint_file);
					echo "fingerprint has been reset..";
				}
				unlink($ticket); // whatEVER happens, after we find it it is deleted!
				exit();
			}
				
		}else{
			echo "Sorry, this ticket it TOO old.. Try again..";
			unlink($ticket); // whatEVER happens, after we find it it is deleted!
			exit();
		}
	}else
	{
		echo "ticket not found!".$ticket;
		exit();
	}
	exit();
?>
</body>
</html>