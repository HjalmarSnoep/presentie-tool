<?php

// send new notification
function sendMessage($naam,$uur)
{
	$content = array(
			"en" => $naam. ' was de eerste in uur '.$uur.'! Geef jij ook even je lokaal op?'
		);
	
	$fields = array(
		'app_id' => "5c378d4c-a641-48eb-bab5-5adf65af70e9",
		'included_segments' => array('All'),
		'data' => array("first" => $naam),
		'contents' => $content
	);
	//array('All') -> naar alle subscribers
	
	$fields = json_encode($fields);
	
	//print("\nJSON sent:\n");
	//print($fields);
	

	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
											   'Authorization: Basic MGMwMWNkYWUtM2I1NC00NGQwLTgzNWQtZGFjZTgyNTZlNGNl'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	$response = curl_exec($ch);
	curl_close($ch);
	
	return $response;
}
	
function checkNotification($students,$uur,$naam)
{
	// check if there are ANY people who have put this hour present..
	// in other words: ARE YOU THE FIRST?
	$first=true;
	for($i=0;$i<count($students);$i++)
	{
		$filename="data/".date_create()->format("Y-m-d")."_".$uur."_".$students[$i]["nr"].".txt";
		if(is_file($filename))
		{
			$first=false;
		}
	}
	
	
	if($first)
	{
		// create notification!
		echo "<audio autoplay>"; // play  a sound?
		echo ' <source src="media/je_bent_de_eerste.mp3" type="audio/mpeg">'; // play  a sound?
		echo "</audio>"; // play  a sound?
		
		$response = sendMessage($naam,$uur);
		/*
			JSON sent: 
			{"app_id":"5c378d4c-a641-48eb-bab5-5adf65af70e9",
			 "included_segments":["highscores"],
			  "data":{"first":"Jeffrey Zschottche"},
			  "contents":{"en":"Jeffrey Zschottche was de eerste dit uur!  Geef jij ook even je lokaal op?"}
			 } 
			 JSON received: 
				{"id":"d3eb8995-baf2-4eee-b7e6-64d510a3412e","recipients":1}
		*/
		//$return["allresponses"] = $response;
		//$return = json_encode( $return);
		//  print("\n\nJSON received:\n");
		//	print($return);
		// print("\n");
	
	}	
	return;
}
?>