<?php
	$hours=array();
	$hours[0]=array();
	$hours[0]["naam"]="1ste uur";
	$hours[0]["min"]="7:30 am";
	$hours[0]["max"]="9:30 am";
	$hours[1]=array();
	$hours[1]["naam"]="2e uur";
	$hours[1]["min"]="9:30 am";
	$hours[1]["max"]="10:45 am";
	$hours[2]=array();
	$hours[2]["naam"]="3e uur";
	$hours[2]["min"]="10:45 am"; // je hebt de hele pause om je nog present te melden voor het vorig uur.
	$hours[2]["max"]="11:45 am";
	$hours[3]=array();
	$hours[3]["naam"]="4e uur";
	$hours[3]["min"]="11:45 am";
	$hours[3]["max"]="1:15 pm";
	$hours[4]=array();
	$hours[4]["naam"]="5e uur";
	$hours[4]["min"]="1:15 pm";
	$hours[4]["max"]="2:15 pm";
	$hours[5]=array();
	$hours[5]["naam"]="6e uur";
	$hours[5]["min"]="2:15 pm";
	$hours[5]["max"]="3:30 pm";
	$hours[6]=array();
	$hours[6]["naam"]="7e uur";
	$hours[6]["min"]="3:30 pm";
	$hours[6]["max"]="4:30 pm";
	$hours[7]=array();
	$hours[7]["naam"]="8e uur";
	$hours[7]["min"]="4:30 pm";
	$hours[7]["max"]="5:30 pm";
	$hours[8]=array();
	$hours[8]["naam"]="wat doe je hier nog?";
	$hours[8]["min"]="5:30 pm";
	$hours[8]["max"]="6:00 pm";
	$date1= date_create();
	$uur=0;
	$uurnaam="onbekend";
	for($i=0;$i<8;$i++)
	{
		$date2= DateTime::CreateFromFormat("H:i a",$hours[$i]["min"]);
		$date3= DateTime::CreateFromFormat("H:i a",$hours[$i]["max"]);
		if($date1>=$date2 && $date1<=$date3)
		{
			$uur=$i+1;
			$uurnaam=$hours[$i]["naam"];
			$seconden_in_uur=$date1->getTimeStamp()-$date2->getTimeStamp();
		}			
	}
?>