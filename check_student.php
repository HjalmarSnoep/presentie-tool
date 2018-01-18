<?php

	filter_var_array($_REQUEST, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH|FILTER_FLAG_STRIP_BACKTICK); // sanitize all in REQUEST as string!
?>
<!doctype html>
<html>
<head>
	<title>Presentie per leerling</title>
	<style>
	body{
		font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;
		margin: 0px;
		padding: 0px;
	}
	th,td{
		width: 120px;
	}
	section{
		padding: 15px;
	}
	.bad{
		background-color: #753935;
		padding: 0px 15px;
		color: #1d0e0d;
	}
	.good{
		background-color: #85c06f;
		padding: 0px 15px;
		color: #11240c;
	}
	.weekend{
		background-color: #85c06f;
	}
	
	
</style>
</head>
<body>
<section>
<?php
	$student_nr=0;
	if(isset($_REQUEST["student_nr"])) $student_nr=substr(preg_replace("/[^0-9., ]+/", "", $_REQUEST["student_nr"]) ,0,15);
	// read the students file.
	$filename="leerlingen/leerlingen.txt";
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
				if( isset($t[3]) && $t[3]!="" )$student["bedrijf"]=$t[3];
				if($student["nr"]==$student_nr)
				{
					break;
				}
			}
		}
	}	



	$date_from="";
	if(isset($_REQUEST["date_from"])) $date_from=preg_replace("/[^0-9-]+/", "",$_REQUEST["date_from"]);
	$date_to="";
	if(isset($_REQUEST["date_to"])) $date_to=preg_replace("/[^0-9-]+/", "",$_REQUEST["date_to"]);
	echo "<form>";
	echo "<table>";
	echo "<tr>";
	echo "<td>student: </td><td>";
	echo '<input id="d" name="student_nr" type="number" value="'.$student_nr.'"></input></td>';
	echo "</tr><tr>";
	echo "<td>date_from: </td><td>";
	echo '<input id="d" name="date_from" type="date" value="'.$date_from.'"></input></td>';
	echo "</tr><tr>";

	echo "<td>date_to: </td><td>";
	echo '<input id="d" name="date_to" type="date" value="'.$date_to.'"></input></td>';
	echo "</tr>";
	echo "</table>";
	echo "<input type='submit' value='Change'>";
	echo "</form><hr>";

	// verify the student, just to be sure.
	echo $student_naam=$student["naam"]. " - " .$student_klas=$student["klas"]. " - " .$student_bedrijf=$student["klas"];


	echo strftime('%a %d %B %Y ',strtotime($date_from)) ." &rarr; ";
	echo strftime('%a %d %B %Y ',strtotime($date_to)) ."<hr>";
	$date=$date_from;
	if(strtotime($date) > strtotime($date_to)) echo "invalid date-range..";
	$days=array();
	$counter=0;
	while (strtotime($date) <= strtotime($date_to)) 
	{
		$days[$counter]=array();
		$days[$counter]["date"]=$date;
		$days[$counter]["hours"]=array();
		// records id are formatted 2017-10-11_5_
		for($u=1;$u<=8;$u++)
		{
			$days[$counter]["hours"][$u]="";
			$record="data/".$date."_".$u."_".$student_nr.".txt";
			if(is_file($record))
			{
//				echo "we got on on ".$date." hour ".$u;
//				echo " lokaal ";
				$lok=file_get_contents($record);
//				echo $lok;
				$days[$counter]["hours"][$u]=$lok;
				//echo "<br>";
			}else
			{
				//echo "nothing on: ".$date." hour ".$u." (".$record.")<br>";
			}
		}
		$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		$counter++;
	}
	// nu heb ik ze allemaal, maak ik een nette tabel.
	echo "<table border='1'>";
	for($i=-1;$i<count($days);$i++)
	{			
		echo "<tr>";
		for($u=0;$u<=8;$u++)
		{
			if($i==-1)
			{
				if($u==0)
				{
					echo "<th> uur ";
					
					echo "</th>";
				}else{
					echo "<th>";
					echo $u; 
					echo "</th>";
				}				
			}else{
				$day=strftime('%a',strtotime($days[$i]["date"]));
				if($u==0)
				{
					if($day=="Sat" || $day=="Sun")
					{
						if($day=="Sun")
						{
							echo "<th>";
							echo "uur";
							echo "</th>";
						}
					}else{
						echo "<td>";
						echo $day."-".$days[$i]["date"]; 
						echo "</td>";
					}
				}else{
					if($day=="Sat" || $day=="Sun")
					{
						if($day=="Sun")
						{
							echo "<th>";
							echo $u; 
							echo "</th>";
						}
					}else
					{
						echo "<td >";
						echo $days[$i]["hours"][$u]; 
						echo "</td>";
					}
				}				
			}
		}
		echo "</tr>";
	}
	echo "</table>";
?>

<section>
</body>
</html>