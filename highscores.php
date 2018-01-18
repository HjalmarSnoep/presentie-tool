<?php

	date_default_timezone_set('Europe/Oslo');

	filter_var_array($_REQUEST, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH|FILTER_FLAG_STRIP_BACKTICK); // sanitize all in REQUEST as string!
	if(!isset($_COOKIE["uniq"]))
	{
		$uni=uniqid();
		setcookie("uniq",$uni, time() + (10 * 365 * 24 * 60 * 60), "/"); // ten years!
	}else{
		$uni=$_COOKIE["uniq"];
	}
	$cookie_unr="";
	if(!isset($_COOKIE["unr"]))
	{
		if(isset($_REQUEST["unr"]))
		{
			// only set cookie if not yet present
			setcookie("unr", $_REQUEST["unr"],time() + (86400 * 30*14), "/"); // two weeks!
		}
	}else
	{
		// we have a cookie 
		$cookie_unr=$_COOKIE["unr"];
	}	
?>
<!doctype html>
<html>
<head>
	<title>Presentie - highscores</title>
	<style>
	body{
		font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;
		margin: 0px;
		padding: 0px;
	}
	table{
		width: 100%;
	}
	section{
		padding: 15px;
	}
	th{
		background-color: #000;
		padding: 0px 15px;
		color: #888;
	}
	td{
		background-color: #eee;
		padding: 0px 15px;
		color: #000;
	}
	header{
			width: calc( 100% - 20px);
			padding: 10px;
			margin: 0px;
			background-color: #888;
			color: #fff;
	}
	background-color: #ccc;
	border: 1px solid #000;
	}
</style>
</head>
<body>
<header><big>Presentie Highscores</big></header>
<?php
// get leerlingen!
	$filename="leerlingen/leerlingen.txt";
	$students=array();
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
				$student["bedrijf"]="---";
				if( isset($t[3]) && $t[3]!="" ) $student["bedrijf"]=$t[3];
				array_push($students,$student);
			}
		}
	}	
	
// we check all scores for all possible hours for all students.
// and add this to the list..

	// else we need to set a highscore!
	$date=date_create()->format("Y-m-d");
	$filename="highscore/".$date.".txt";
	
	// Now we add up all highscores for the date and create a day score and add up the seconden in uur for this kid to get it..
	for($i=0;$i<count($students);$i++)
	{
		$score=0;
		$students[$i]["score"]=0;
		for($u=0;$u<8;$u++)
		{
			$filename="data/".$date."_".($u+1)."_".$students[$i]["nr"].".txt";
			if(is_file($filename))
			{
				$da=file_get_contents($filename);
				$ar=explode("|",$da);
				if(isset($ar[1]) && $ar[1]=="1")
				{
					if(isset($ar[2]) && $ar[2]!=0) $score+=intval($ar[2]);
				}
			}
			// $score bekend!
			$students[$i]["score"]=$score;
		}
	}
//	echo "<pre>";
//	var_dump($students);
// sort them..
	usort($students, function($a,$b) {
				if($a["score"] === $b["score"]) return 0;
				return ($a["score"] > $b["score"]) ? -1 : 1;
			});
	//show highscores
	echo "<table>";
	echo "<tr>";
		echo "<th>rank</th>";
		echo "<th>klas</th>";
		echo "<th>naam</th>";
		echo "<th>bedrijf</th>";
		echo "<th>score</th>";
	echo "</tr>";
	for($i=0;$i<count($students);$i++)
	{
		$student=$students[$i];
		echo '<tr>';
		echo "<td>".($i+1)."</td>";
		echo "<td>".substr($student["klas"],0,15)."</td>";
		echo "<td>".$student["naam"]."</td>";
		echo "<td>".$student["bedrijf"]."</td>";
		echo "<td>".$student["score"]."</td>";
		echo '</tr>';
	}	
	echo "</table>";
	
?>
</body>
</html>