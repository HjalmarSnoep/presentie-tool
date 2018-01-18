<?php

// PHP and js fingerprinting using
	// JS:
	// -partial font list, 
	// -canvas fingerprinting for browser, 
	// -user agent, 
	// -screensize, 
	// navigator appname, platform and appCodeName
	// getTimezoneOffset
	// ts
	// PHP
	// don't log property
	// user agent
	// REMOTE_ADDR
	// all headers -> not implemented broke on PHP 5.3.3
	// HTTP_X_FORWARDED_FOR
	// Client_IP
	// Cookie -> only to be used in heuristic recognition, not in fingerprinting.
	// LAN -> mac (not implemented)
	
	// KNOWN ISSUES:
	// -AT THIS POINT YOU CAN USE A SECOND DEVICE TO HELP A FRIEND (Tom Reus!)
			// this could be fixed by locking 1 device to 1 student or permit them to add a limited number of devices...
	// -AT THIS POINT YOU CAN USE another browser, to seemingly change devices.
	//  this last one is detectable in principle, but currently breaks the code. (Karahan!)
		// it might be possible to track the mac-adress to prevent this from being a problem.
		// we could take the user-agent out of the loop if this works.

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
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<script>
	  var OneSignal = window.OneSignal || [];
	  OneSignal.push(function() {
		OneSignal.init({
		  appId: "5c378d4c-a641-48eb-bab5-5adf65af70e9",
		});
	  });
	</script>
	<title>Presentie</title>
	<style>
	body{
		font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;
		margin: 0px;
		padding: 0px;
	}
	section{
		padding: 15px;
	}
	.timebar{
		width: 100%;
        height: 8px;
		position: fixed;
		background-color: #000;
		overflow: hidden;
		color: #fff;
		font-size: 8px;
		left: 0px;
		top: 0px;
	}
	.warning{
		padding: 15px;
		background-color: rgba(255,0,0,0.7);
		color: #fff;
		position: fixed;
		bottom: 0px;
	}
	header{
			width: 100%;
			padding: 10px;
			margin: 0px;
			background-color: #888;
			color: #fff;
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
	.quite_good{
		background-color: #c4e1b3;
		padding: 0px 15px;
		color: #263220;
	}
	.now{
		-webkit-box-shadow: inset 0px 0px 5px 0px rgba(50,100,255,0.8);
		-moz-box-shadow: inset 0px 0px 5px 0px rgba(50,100,255,0.8);
		box-shadow: inset 0px 0px 5px 0px rgba(50,100,255,0.8);	}
	.you{
		background-color: #88a !important;
		  box-shadow: inset 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		  
	}
	.you
	table{background-color: #eee; border: 0px;}
	tr:nth-child(even) {background: #fff;}
	th{background-color: 777; color: fff;}
	#legend{
		position: absolute;
		top:0px;
		right:0px;
		background: #ccc;
		width: 120px;
		height: 100px;
	}
	.example{
		display: inline-block;
		width: 120px;
		height: 20px;
	}
	.hoverable:hover{
		background-color: #000;
		color: #fff;
	}
	.hoverable{
		border: 1px solid #fff;
	}
	.active_sort{
	background-color: #ccc;
	border: 1px solid #000;
	}
</style>
</head>
<body>
	<div id="legend">
		LEGEND:<br>
		<?php
			if(!isset($_REQUEST["date"]))
			{
				echo '<div class="example now">now</div>';
			}
		?>
		<div class="example good">&#128065; confirmed</div>
		<div class="example quite_good">unconfirmed</div>
		<div class="example bad">not present</div>
	</div>
<?php
	
	$dnt="";
	if(isset($_SERVER['HTTP_DNT'])) $dnt=$_SERVER['HTTP_DNT'];
	$agent=$_SERVER['HTTP_USER_AGENT']; // get UserAgent
	
	$lok="";
	if(isset($_REQUEST["lok"])) $lok=substr(preg_replace("/[^a-zA-Z0-9., ]+/", "", $_REQUEST["lok"]) ,0,15);
	
	$unr="";
	if(isset($_REQUEST["unr"])) $unr=preg_replace("/[^a-zA-Z0-9]+/", "", $_REQUEST["unr"]);
	$scr="";
	if(isset($_REQUEST["scr"])) $scr=preg_replace("/[^a-zA-Z0-9]+/", "", $_REQUEST["scr"]);
	$avf="";
	if(isset($_REQUEST["avf"])) $avf=$_REQUEST["avf"];
	$ffp="";
	if(isset($_REQUEST["ffp"])) $ffp=$_REQUEST["ffp"];
	$nva="";
	if(isset($_REQUEST["nva"])) $nva=$_REQUEST["nva"];
	$nvc="";
	if(isset($_REQUEST["nvc"])) $nvc=$_REQUEST["nvc"];
	$nvp="";
	if(isset($_REQUEST["nvp"])) $nvp=$_REQUEST["nvp"];
	$ffp="";
	if(isset($_REQUEST["ffp"])) $ffp=$_REQUEST["ffp"];
	$tzo="";
	if(isset($_REQUEST["tzo"])) $tzo=$_REQUEST["tzo"];
	$nvu="";
	if(isset($_REQUEST["nvu"])) $nvu=$_REQUEST["nvu"];
	$cfp="";
	if(isset($_REQUEST["cfp"])) $nvu=$_REQUEST["cfp"];
	$ts=0;
	if(isset($_REQUEST["ts"])) $ts=((time())-intval($_REQUEST["ts"]));
	// get IP
	$rad=$_SERVER['REMOTE_ADDR'];
	$at_school=false;
	if($rad=="145.102.244.61")
	{
		$at_school=true;
		// NOT AT SCHOOL!
	}
	$xff="";
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $xff=$_SERVER['HTTP_X_FORWARDED_FOR'];
	$cli="";
	if(isset($_SERVER['HTTP_CLIENT_IP'])) $cli=$_SERVER['HTTP_CLIENT_IP'];
	// get string geoip_asnum_by_name ( string $hostname )
	// check if this user is known under a different name, to prevent second login.
	
	$fingerprint=""; // this is the cookie, so ignore for fingerprinting
	$fingerprint.=$scr."|"; // screensize
	$fingerprint.=$ffp."|"; // ffp =  available fonts.
	$fingerprint.=$cfp."|"; // cfp, canvas fingerprint
	$fingerprint.=$dnt."|"; // dont log from php.
	$fingerprint.=$nva."|"; // agent from javascript
	$fingerprint.=$nvc."|"; // client
	$fingerprint.=$nvp."|"; // platform
	$fingerprint.=$agent."|"; // user agent from php
//	$fingerprint.=$hr."|"; // all headers // includes cookies, so we cannot use that for hardware fingerprinting.
	$fingerprint.=$tzo."|"; // getTimezoneOffset
	$fingerprint.=$nvu."|"; // user agent from javascript
	$fingerprint.=$rad."|"; // REMOTE_ADDR from php (ip)
	$fingerprint.=$xff."|"; // HTTP_X_FORWARDED_FOR
	$fingerprint.=$cli; // client _ip if available
	$fingerprint=hash ('sha512',$fingerprint);
	
	function setStat($msg)
	{
		global $unr;	
		$filename="stats/stats_".date_create()->format("Y-m-d").".txt";
		$stat=date_create()->format("H:i:s a")."|".$unr."|".$msg."|".time()."\n"; // WHEN, WHAT and WHO
		file_put_contents ($filename,$stat,FILE_APPEND);
	}
	
	// check unr exists in leerlingen.txt.
	$filename="leerlingen/leerlingen.txt";
	$students=array();
	$student_valid=false;
	$student_naam="";
	$student_klas="";
	$student_bedrijf="";
	$pc_valid=false;
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
				 $pc_valid=true;
				//echo $student["nr"]."==".$unr."<br>";
				if($student["nr"]==$unr)
				{
					$student_valid=true;
					$student_naam=$student["naam"];
					$student_klas=$student["klas"];
					$student_bedrijf=$student["klas"];
					// make the file!
				}
				array_push($students,$student);
			}
		}
	}	
	
	
	require_once("get_uur.php");
	if($uur==0 && !isset($_REQUEST["date"]))
	{
		echo "Error: Je kunt nu niet present worden gezet.. ".date_create()->format("H:i:s a")." valt buiten schooluren.";
		exit();
	}
	if($student_valid==true && $pc_valid==true && $at_school)
	{
		// found a matching student with postal code
		echo "<h1>student: ".$unr." ".$student_naam." uit ".$student_klas." is nu present voor uur ".$uur." in lokaal ".$lok.".</h1>";

		// check fingerprint!
		/*$filename="data/". $fingerprint.".txt";
		// try to open fingerprint file:
		if(is_file($filename))
		{
			$stored_unr=file_get_contents($filename);
			//echo $stored_unr."==".$unr."<br>";
			if($stored_unr!=($unr.""))
			{
				echo "<hr>ERROR 2: <BR>WARNING: UNR mismatch ".$fingerprint."  -  ".$unr." neem contact op met Hjalmar..<hr>";
				setStat("different unr stored (".$stored_unr.")");
				exit();
			}
		}else{
			file_put_contents ($filename,$unr); // associate $unr with this fingerprint.
			setStat("create fingerprint (".$fingerprint.")");
		}*/

		$filename="data/".date_create()->format("Y-m-d")."_".$uur."_".$unr.".txt";
		file_put_contents ($filename,$lok."|1|0|".$seconden_in_uur); // put $unr present for this hour, maar niet gezien door leerkracht.!
		setStat("present at $lok"); // set present at lokaal!
		require_once("set_highscore.php");
		// dit zet een highscore, maar doet ook een notificatie..
		setHighscore($unr,$uur,$seconden_in_uur);
	}else{
		if($at_school==false)
		{
			if(! isset($_REQUEST["date"]) )
			{
				echo "<div class='warning' onClick='hideElement(this)'>";
				echo "Je lijkt niet op school te zijn? Je gebruikt niet de school WIFI.<br>";
				echo "Je opgegeven lokatie: (".$lok.") zou dus moeten zijn: de reden waarom je er niet bent, bijvoorbeeld: 'ziek', of de plek waar je WEL bent, bijvoorbeeld: 'stage'.";
				echo "</div>";
				setStat("not from school");
				$filename="data/".date_create()->format("Y-m-d")."_".$uur."_".$unr.".txt";
				file_put_contents ($filename,$lok."|0|0|".$seconden_in_uur); // put $unr present for this hour, maar niet gezien door leerkracht.!
				setStat("present at $lok"); // set present at lokaal!
			}
			// ik gaf aan: wel op stage of ziek ofzo..
			// mogen ze aangeven.
//			exit();
		}
//		echo "<h1 class='bad'>No Match for $unr </h1>";
//		setStat("no_match");
	}
	// print table
	$date=date_create()->format("Y-m-d");
	$sort="klas";
	if(isset($_REQUEST["sort"]))
	{	
		$sort=$_REQUEST["sort"];
	}
	if(isset($_REQUEST["date"]))
	{	
		if($_REQUEST["date"]!="today")
		{
			$fmt=preg_replace("/[^0-9-]+/", "",$_REQUEST["date"]);
			$date=$fmt;
		}
		echo "<header>";
		echo "<big>Presentie </big>";
		echo '<input id="d" type="date" onChange="refresh()" value="'.$date.'"></input>';
		echo "</header>";
		?>
			<script>
				function refresh()
				{
					location.href="present.php?date="+document.getElementById("d").value;
				}
			</script>
		<?php
	}else{
		echo "<header>";
		echo "<h2>Presentie ".$date."</h2>";
		echo "</header>";
		// we might want to update every once in a while!
	}
	echo "<section>";

	
	echo "<table>";
	echo "<tr>";
//			echo "<th>Nr</th>";
			$class="";
			$arrows="";
			if($sort=="klas")
			{
				$class=" active_sort ";
				$arrows=" &uarr;&darr;";
			}
			echo "<th class='hoverable $class' id='SortKlas'>Klas $arrows</th>";
			$class="";
			$arrows="";
			if($sort=="naam")
			{
				$class=" active_sort ";
				$arrows=" &uarr;&darr;";
			}
			echo "<th class='hoverable $class' id='SortNaam'>Naam $arrows</th>";
			$class="";
			$arrows="";
			if($sort=="bedrijf")
			{
				$class=" active_sort ";
				$arrows=" &uarr;&darr;";
			}
			echo "<th class='hoverable $class' id='SortBedrijf'>Bedrijf $arrows</th>";
			for($u=0;$u<8;$u++)
			{
				if($uur==($u+1))
					echo "<th class='now'>".str_replace(" ","<br>",$hours[$u]["naam"])."</th>";
				else
					echo "<th>".str_replace(" ","<br>",$hours[$u]["naam"])."</th>";
			}
			echo "<th>NU</th>";
		echo "</tr>";
		

	// sort the students
	switch($sort)
	{
		case "klas":
			usort($students, function($a,$b) {
				if($a["klas"] === $b["klas"]) return 0;
				return ($a["klas"] < $b["klas"]) ? -1 : 1;
			});
		break;
		case "bedrijf":
			usort($students, function($a,$b) {
				if($a["bedrijf"] === $b["bedrijf"]) return 0;
				return ($a["bedrijf"] < $b["bedrijf"]) ? -1 : 1;
			});
		break;
		case "achternaam":
			// this is how you get them from Magister.
		break;
	}
	$teach="true";
	for($i=0;$i<count($students);$i++)
	{
		$student=$students[$i];
		if($student["nr"]==$unr)
		{	
			$teach="false";
			echo "<tr class='you' id='you'>";
		}
		else  echo "<tr>";
			
//			echo "<td>".$student["nr"]."</td>";
			echo "<td>".substr($student["klas"],0,15)."</td>";
			echo "<td>".$student["naam"]."</td>";
			echo "<td>".$student["bedrijf"]."</td>";
			$lokaal="---";
			$student_has_been_present=false;
			for($u=0;$u<8;$u++)
			{
				$filename="data/".$date."_".($u+1)."_".$student["nr"].".txt";
				$student_aanwezig=false;
				$lokaal_from_file=false;
				if(is_file($filename))
				{
					$da=file_get_contents($filename);
					$ar=explode("|",$da);
					$lokaal_from_file=true;
					$lokaal=$ar[0]; // er wordt ALTIJD een locatie meegegeven met een melding!
					$student_aanwezig=false;
					if(isset($ar[1]))
					{
						if($ar[1])
						{
							$student_has_been_present=true;
							$student_aanwezig=true; // student mag zich ook AFWEZIG melden, door niet vanaf school te melden.
						}else
						{
							$student_has_been_present=false;
							$student_aanwezig=false; // student mag zich ook AFWEZIG melden, door niet vanaf school te melden.
						}
					} 
					if(isset($ar[2]) && $ar[2]) $gezien_door_leraar=true;
				}
				$nowclass="";
				if($uur==($u+1))
					$nowclass=" now";
				if($student_aanwezig)
				{
					echo "<td class='good$nowclass'>&#128065;".substr($lokaal,0,8)."</td>";
				}else{
					if($student_has_been_present)
					{
						if($student_aanwezig==false)
						{
							if($lokaal_from_file)
								echo "<td class='bad$nowclass'>".substr($lokaal,0,8)."</td>";					
							else
								echo "<td class='quite_good$nowclass'>".substr($lokaal,0,8)."?</td>";
						}else{
						}
					}else{
						echo "<td class='bad$nowclass'>".substr($lokaal,0,8)."</td>";						
					}
				}
			}
			echo "<td>".substr($lokaal,0,15)."</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "</section>";
?>
<audio id="snd">
	<source src="bell.mp3"></source>
</audio>
<script>
document.getElementById("SortKlas").addEventListener("click",changeSort, false);
document.getElementById("SortBedrijf").addEventListener("click",changeSort, false);
document.getElementById("SortNaam").addEventListener("click",changeSort, false);

var iamateacher=<?php echo $teach;?>;
var past=<?php
if(isset($_REQUEST["date"])) echo "true"; else echo "false";
?>;
	
var refresh_time=60000;
var load_time=(new Date()).getTime();
if(past==false)
	setInterval(loop,1000,true); // every second.

if(iamateacher && past==false)
{
	setInterval(refreshWindow,refresh_time,true); // every minute.
	var timebar=document.createElement("div");
	timebar.className="timebar";
	document.body.appendChild(timebar);
}	

function hideElement(el)
{
	el.style.display="none";
}

var snd=document.getElementById("snd");
function reminder()
{
	console.log("reminder");
	// remind user to do presence..
	snd.play();
	setTimeout(askquestion,100);	
}
function askquestion()
{
	if(confirm("Wil je een nieuw lokaal opgeven?"))
	{
		location.href="index.php";
	}
}
function refreshWindow()
{
	saveScroll();
	location.reload(true);
}
function loop()
{
	var perc=(new Date()).getTime()-load_time;
	if(iamateacher)
	{
		perc=perc/refresh_time;
		perc=(1-perc)*100;
		timebar.style.width=perc+'%';
		var stuff_to_say=[];
		stuff_to_say.push("Je bent in teacher modus");
		stuff_to_say.push("De lijst wordt iedere minuut");
		stuff_to_say.push("bijgewerkt");
	}
		var times=["8:35","9:35","10:55","11:55","13:20","14:20","15:35","16:35","21:35"];
		// get time and check for 0 minutes.
		var hours=(new Date()).getHours();
		var min=(new Date()).getMinutes();
		var sec=(new Date()).getSeconds();
	if(iamateacher)
	{
		// teachers get the blinking bar..
		if(sec%2==0)
		{
			timebar.style.backgroundColor="rgba(255,255,255,0.5)";
			timebar.innerHTML=stuff_to_say[Math.floor((sec/4))%stuff_to_say.length];
		}else
		{
			timebar.style.backgroundColor="rgba(0,0,0,0.5)";
		}
	}else{
		// teachers don't get reminders
		var ti=hours+":"+min+":"+sec;
		for(all in times)
		{
			if(ti==(times[all]+":0"))
			{
				reminder();
			}
		}
	}
}
function saveScroll()
{
	var nr=window.scrollTop;
	var parts=location.search.split("&");
	var found=false;
	var id="";
	for(var i=0;i<parts.length;i++)
	{
		var deel=parts[i].split("=");
		if(deel[0]=="scroll")
		{
			deel[1]=id;
			parts[i]=deel.join("=");
			found=true;
		}
	}
	var url=parts.join("&");
	if(found!=true)
	{
		url+="&scroll="+id;
	}
	location.search=url
}

function setSortTo(id)
{
	var parts=location.search.split("&");
	var found=false;
	for(var i=0;i<parts.length;i++)
	{
		var deel=parts[i].split("=");
		if(deel[0]=="sort")
		{
			deel[1]=id;
			parts[i]=deel.join("=");
			found=true;
		}
	}
	var url=parts.join("&");
	if(found!=true)
	{
		url+="&sort="+id;
	}
	location.search=url
	console.log(url);
}
function changeSort(ev)
{
	switch(ev.currentTarget.id)
	{
		case "SortKlas":
			setSortTo("klas");
		break;
		case "SortBedrijf":
			setSortTo("bedrijf");
		break;
		case "SortNaam":
			setSortTo("naam");
		break;
		
	}
	
}

</script>
</body>
</html>