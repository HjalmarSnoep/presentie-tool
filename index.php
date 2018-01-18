<!doctype html>
<html>
<head>
	<title>Presentie</title>
	<style>
	body{
		font-family: Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif
	}

input[type=number], [type=text], input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #AF4C50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

/* Change styles for span and cancel button on extra small screens */
form{
	width: 300px;
	margin: 0 auto 0 auto;
}

h1{
	text-align: center;
}
.waarschuwing{
	font-size: 9px;
	text-align: center;
	margin-bottom: 15px;
}
@media screen and (max-width: 300px) {
	form{
		width: 100%;
	}
}
.letop{
	position: fixed;
	bottom: 0px;
	left: 0px;
	width: 100%;
	background-color: #8af;
	color: #008;
	padding: 15px;
}
</style>
</head>
<body>

	<h1><?php
	require_once("get_uur.php");
	if($uur==0)
	{
		echo "SCHOOL IS UIT!";
	}else
		echo "Present melden voor ". $uurnaam . " ";
		$progress=($seconden_in_uur/3600);
		$to_time = new DateTime();
		$from_time = new DateTime();
		$from_time->setTime(8,30);
		$minutes_today=round(abs($to_time->getTimeStamp() - $from_time->getTimeStamp()) / 60,2);
		
		$x=round(180*$minutes_today/540+10);
		// calculate time-graph..
		$shift=$x-22;
		if($shift<0) $shift=0;
echo '<svg width="64" height="32" viewBox="'.$shift.' 0 64 32">';
echo '<defs>';
echo '	<linearGradient id="e1" x1="10" x2="0" y1="25.4" y2="25.4" gradientUnits="userSpaceOnUse"><stop stop-color="#444" offset="0"/><stop stop-color="#fff" offset="1"/></linearGradient>';
echo '	<linearGradient id="e2" x1="190" x2="200" y1="25.4" y2="25.4" gradientUnits="userSpaceOnUse"><stop stop-color="#444" offset="0"/><stop stop-color="#fff" offset="1"/></linearGradient>';
echo '	<g id="vrij">';
echo '		<path d="m150 32v-20.9l-5 7.65v13.2h5m-45 0v-20.7l-9.75 7.45v13.2h9.75m-50 0v-20.6l-5 7.4v13.2h5z" fill="#444"/>';
echo '		<path d="m0 32h10v-13.2h-10v13.2z" fill="url(#e1)"/><path d="m200 18.8h-10v13.2h10v-13.2z" fill="url(#e2)"/>';
echo '	</g>';
echo '	<g id="char"><path d="m170 10.9v0.8h0.8v-0.8h-0.8m0.8-3.35h-0.8v0.8h0.8v-0.8m-2.65-1.6h-0.6l-2.6 3.75v0.65h2.5v1.35h0.7v-1.35h0.75v-0.65h-0.75v-3.75m-0.7 1.15v2.6h-1.8l1.8-2.6m4.9 1.5q0.05-0.4 0.25-0.6t0.5-0.2 0.5 0.2 0.2 0.5q0 0.35-0.25 0.55-0.3 0.15-0.6 0.15-0.05 0-0.1 0l-0.05 0.45q0.2-0.05 0.35-0.05 0.4 0 0.6 0.25 0.25 0.25 0.25 0.6t-0.25 0.65q-0.25 0.25-0.65 0.25-0.3 0-0.5-0.2-0.25-0.2-0.3-0.65l-0.55 0.05q0.05 0.55 0.45 0.9 0.35 0.35 0.9 0.35 0.65 0 1.05-0.4t0.4-0.95q0-0.45-0.2-0.7-0.2-0.3-0.6-0.4 0.3-0.1 0.45-0.35 0.15-0.2 0.15-0.5t-0.15-0.55-0.45-0.4-0.65-0.15q-0.5 0-0.85 0.3-0.35 0.25-0.45 0.8l0.55 0.1m4.75-1.05q-0.25-0.15-0.6-0.15-0.45 0-0.8 0.25-0.3 0.25-0.45 0.7t-0.15 1.25q0 1.2 0.4 1.75 0.4 0.4 1 0.4 0.45 0 0.8-0.25 0.3-0.25 0.45-0.7t0.15-1.2q0-0.65-0.1-1.05-0.1-0.35-0.25-0.6-0.2-0.3-0.45-0.4m-1.2 0.6q0.25-0.35 0.6-0.35t0.6 0.35 0.25 1.45q0 1.05-0.25 1.4t-0.6 0.35-0.6-0.35-0.25-1.4q0-1.1 0.25-1.45m13.8 2.75v0.8h0.8v-0.8h-0.8m0.8-2.55v-0.8h-0.8v0.8h0.8m-4.85 0.75q0.15-0.25 0.45-0.4 0.25-0.2 0.6-0.2 0.55 0 0.9 0.35t0.35 0.95q0 0.65-0.35 1.05-0.35 0.35-0.9 0.35-0.4 0-0.7-0.25t-0.4-0.8l-0.7 0.05q0.05 0.7 0.55 1.15t1.25 0.45q1 0 1.55-0.7 0.45-0.55 0.45-1.35t-0.55-1.35q-0.5-0.5-1.25-0.5-0.55 0-1.1 0.35l0.3-1.55h2.3v-0.65h-2.85l-0.55 2.95 0.65 0.1m7.8-1.55q-0.3-0.15-0.65-0.15-0.5 0-0.85 0.3-0.35 0.25-0.45 0.8l0.55 0.1q0.05-0.4 0.25-0.6t0.5-0.2 0.5 0.2 0.2 0.5q0 0.35-0.25 0.55-0.3 0.15-0.6 0.15-0.05 0-0.1 0l-0.05 0.45q0.2-0.05 0.35-0.05 0.4 0 0.6 0.25 0.25 0.25 0.25 0.6t-0.25 0.65q-0.25 0.25-0.65 0.25-0.3 0-0.5-0.2-0.25-0.2-0.3-0.65l-0.55 0.05q0.05 0.55 0.45 0.9 0.35 0.35 0.9 0.35 0.65 0 1.05-0.4t0.4-0.95q0-0.45-0.2-0.7-0.2-0.3-0.6-0.4 0.3-0.1 0.45-0.35 0.15-0.2 0.15-0.5t-0.15-0.55-0.45-0.4m2.75-0.15q-0.45 0-0.8 0.25-0.3 0.25-0.45 0.7t-0.15 1.25q0 1.2 0.4 1.75 0.4 0.4 1 0.4 0.45 0 0.8-0.25 0.3-0.25 0.45-0.7t0.15-1.2q0-0.65-0.1-1.05-0.1-0.35-0.25-0.6-0.2-0.3-0.45-0.4-0.25-0.15-0.6-0.15m0 0.4q0.35 0 0.6 0.35t0.25 1.45q0 1.05-0.25 1.4t-0.6 0.35-0.6-0.35-0.25-1.4q0-1.1 0.25-1.45t0.6-0.35m-39.2-0.25q-0.25-0.15-0.6-0.15-0.45 0-0.8 0.25-0.3 0.25-0.45 0.7t-0.15 1.25q0 1.2 0.4 1.75 0.4 0.4 1 0.4 0.45 0 0.8-0.25 0.3-0.25 0.45-0.7t0.15-1.2q0-0.65-0.1-1.05-0.1-0.35-0.25-0.6-0.2-0.3-0.45-0.4m-1.2 0.6q0.25-0.35 0.6-0.35t0.6 0.35 0.25 1.45q0 1.05-0.25 1.4t-0.6 0.35-0.6-0.35-0.25-1.4q0-1.1 0.25-1.45m-47.4-0.75h-0.35q-0.15 0.25-0.45 0.55-0.35 0.3-0.8 0.5v0.55q0.25-0.1 0.55-0.3t0.5-0.35v3.35h0.55v-4.3m3.65 2.9q0 0.45-0.3 0.75-0.25 0.3-0.6 0.3t-0.55-0.2q-0.25-0.2-0.3-0.6l-0.55 0.05q0.05 0.5 0.4 0.85 0.4 0.3 1 0.3 0.7 0 1.1-0.5 0.35-0.4 0.35-1t-0.4-1-0.95-0.4q-0.4 0-0.8 0.25l0.25-1.15h1.7v-0.5h-2.15l-0.4 2.2 0.5 0.1q0.1-0.2 0.3-0.3 0.2-0.15 0.45-0.15 0.45 0 0.7 0.3 0.25 0.25 0.25 0.7m15.3-1.6q0.3-0.2 0.5-0.35v3.35h0.55v-4.3h-0.35q-0.15 0.25-0.45 0.55-0.35 0.3-0.8 0.5v0.55q0.25-0.1 0.55-0.3m-2.7 2.2v0.8h0.8v-0.8h-0.8m-1.85-3.4q0 0.4-0.35 0.85-0.3 0.45-1.25 1.25-0.6 0.5-0.9 0.85-0.35 0.4-0.5 0.75-0.05 0.25-0.05 0.5h3.8v-0.7h-2.85q0.15-0.15 0.3-0.35 0.2-0.2 0.85-0.75 0.75-0.6 1.05-1 0.35-0.35 0.5-0.7 0.1-0.3 0.1-0.65 0-0.7-0.45-1.15-0.5-0.45-1.3-0.45-0.85 0-1.3 0.45-0.5 0.4-0.55 1.2l0.7 0.1q0-0.55 0.3-0.85t0.8-0.3 0.8 0.25q0.3 0.3 0.3 0.7m1.85 0.85h0.8v-0.8h-0.8v0.8m7.6 2.9q0.35-0.4 0.35-1t-0.4-1-0.95-0.4q-0.4 0-0.8 0.25l0.25-1.15h1.7v-0.5h-2.15l-0.4 2.2 0.5 0.1q0.1-0.2 0.3-0.3 0.2-0.15 0.45-0.15 0.45 0 0.7 0.3 0.25 0.25 0.25 0.7t-0.3 0.75q-0.25 0.3-0.6 0.3t-0.55-0.2q-0.25-0.2-0.3-0.6l-0.55 0.05q0.05 0.5 0.4 0.85 0.4 0.3 1 0.3 0.7 0 1.1-0.5m17.6-0.35v0.8h0.8v-0.8h-0.8m0-2.55h0.8v-0.8h-0.8v0.8m-3.35 0l-0.1 0.65q0.3-0.1 0.5-0.1 0.5 0 0.8 0.35 0.35 0.3 0.35 0.75 0 0.55-0.35 0.9-0.35 0.3-0.85 0.3-0.4 0-0.7-0.25t-0.4-0.85l-0.7 0.1q0.05 0.7 0.55 1.15t1.25 0.45q0.85 0 1.4-0.5 0.55-0.55 0.55-1.3 0-0.55-0.3-0.9-0.3-0.4-0.8-0.5 0.4-0.2 0.6-0.5t0.2-0.65q0-0.4-0.2-0.75t-0.6-0.55-0.85-0.2q-0.7 0-1.15 0.4t-0.6 1.1l0.7 0.1q0.1-0.5 0.35-0.75 0.3-0.25 0.7-0.25t0.65 0.25q0.3 0.25 0.3 0.6 0 0.5-0.4 0.75-0.35 0.25-0.8 0.25-0.05 0-0.1-0.05m6.45-0.95q-0.5 0-0.85 0.3-0.35 0.25-0.45 0.8l0.55 0.1q0.05-0.4 0.25-0.6t0.5-0.2 0.5 0.2 0.2 0.5q0 0.35-0.25 0.55-0.3 0.15-0.6 0.15-0.05 0-0.1 0l-0.05 0.45q0.2-0.05 0.35-0.05 0.4 0 0.6 0.25 0.25 0.25 0.25 0.6t-0.25 0.65q-0.25 0.25-0.65 0.25-0.3 0-0.5-0.2-0.25-0.2-0.3-0.65l-0.55 0.05q0.05 0.55 0.45 0.9 0.35 0.35 0.9 0.35 0.65 0 1.05-0.4t0.4-0.95q0-0.45-0.2-0.7-0.2-0.3-0.6-0.4 0.3-0.1 0.45-0.35 0.15-0.2 0.15-0.5t-0.15-0.55-0.45-0.4-0.65-0.15m-105-1.45h-0.45q-0.2 0.35-0.65 0.75t-1.05 0.7v0.65q0.35-0.1 0.75-0.35t0.7-0.5v4.5h0.7v-5.75m10 4.7v1.05h0.5v-1.05h0.6v-0.45h-0.6v-2.8h-0.4l-1.95 2.8v0.45h1.85m0-0.45h-1.35l1.35-1.95v1.95m-3.45 0.7v0.8h0.8v-0.8h-0.8m0-2.55h0.8v-0.8h-0.8v0.8m-2.15-2.2q-0.35-0.2-0.8-0.2-0.65 0-1.05 0.35-0.4 0.3-0.6 0.95-0.2 0.6-0.2 1.65 0 1.6 0.55 2.3 0.45 0.6 1.3 0.6 0.65 0 1.05-0.35t0.6-0.95 0.2-1.6q0-0.9-0.1-1.4-0.15-0.5-0.35-0.85-0.25-0.35-0.6-0.5m-1.6 0.8q0.3-0.4 0.8-0.4t0.8 0.45q0.35 0.45 0.35 1.9 0 1.4-0.35 1.85-0.3 0.45-0.8 0.45t-0.8-0.45q-0.35-0.45-0.35-1.85 0-1.45 0.35-1.95m11.5 1v-0.5h-2.15l-0.4 2.2 0.5 0.1q0.1-0.2 0.3-0.3 0.2-0.15 0.45-0.15 0.45 0 0.7 0.3 0.25 0.25 0.25 0.7t-0.3 0.75q-0.25 0.3-0.6 0.3t-0.55-0.2q-0.25-0.2-0.3-0.6l-0.55 0.05q0.05 0.5 0.4 0.85 0.4 0.3 1 0.3 0.7 0 1.1-0.5 0.35-0.4 0.35-1t-0.4-1-0.95-0.4q-0.4 0-0.8 0.25l0.25-1.15h1.7m5.65-2h-0.45q-0.2 0.35-0.65 0.75t-1.05 0.7v0.65q0.35-0.1 0.75-0.35t0.7-0.5v4.5h0.7v-5.75m10 4.7v1.05h0.5v-1.05h0.6v-0.45h-0.6v-2.8h-0.4l-1.95 2.8v0.45h1.85m0-0.45h-1.35l1.35-1.95v1.95m-2.65 0.7h-0.8v0.8h0.8v-0.8m-0.8-2.55h0.8v-0.8h-0.8v0.8m-2.15-2.4h-0.45q-0.2 0.35-0.65 0.75t-1.05 0.7v0.65q0.35-0.1 0.75-0.35t0.7-0.5v4.5h0.7v-5.75m9.7 3.3q-0.4-0.4-0.95-0.4-0.4 0-0.8 0.25l0.25-1.15h1.7v-0.5h-2.15l-0.4 2.2 0.5 0.1q0.1-0.2 0.3-0.3 0.2-0.15 0.45-0.15 0.45 0 0.7 0.3 0.25 0.25 0.25 0.7t-0.3 0.75q-0.25 0.3-0.6 0.3t-0.55-0.2q-0.25-0.2-0.3-0.6l-0.55 0.05q0.05 0.5 0.4 0.85 0.4 0.3 1 0.3 0.7 0 1.1-0.5 0.35-0.4 0.35-1t-0.4-1m23.2 1.65h-0.8v0.8h0.8v-0.8m-0.8-2.55h0.8v-0.8h-0.8v0.8m-2.15-2.4h-0.45q-0.2 0.35-0.65 0.75t-1.05 0.7v0.65q0.35-0.1 0.75-0.35t0.7-0.5v4.5h0.7v-5.75m-67.2 1.7q-0.3 0.25-0.45 0.7t-0.15 1.25q0 1.2 0.4 1.75 0.4 0.4 1 0.4 0.45 0 0.8-0.25 0.3-0.25 0.45-0.7t0.15-1.2q0-0.65-0.1-1.05-0.1-0.35-0.25-0.6-0.2-0.3-0.45-0.4-0.25-0.15-0.6-0.15-0.45 0-0.8 0.25m0.8 0.15q0.35 0 0.6 0.35t0.25 1.45q0 1.05-0.25 1.4t-0.6 0.35-0.6-0.35-0.25-1.4q0-1.1 0.25-1.45t0.6-0.35m-2.3 1.2q0.15-0.2 0.15-0.5t-0.15-0.55-0.45-0.4-0.65-0.15q-0.5 0-0.85 0.3-0.35 0.25-0.45 0.8l0.55 0.1q0.05-0.4 0.25-0.6t0.5-0.2 0.5 0.2 0.2 0.5q0 0.35-0.25 0.55-0.3 0.15-0.6 0.15-0.05 0-0.1 0l-0.05 0.45q0.2-0.05 0.35-0.05 0.4 0 0.6 0.25 0.25 0.25 0.25 0.6t-0.25 0.65q-0.25 0.25-0.65 0.25-0.3 0-0.5-0.2-0.25-0.2-0.3-0.65l-0.55 0.05q0.05 0.55 0.45 0.9 0.35 0.35 0.9 0.35 0.65 0 1.05-0.4t0.4-0.95q0-0.45-0.2-0.7-0.2-0.3-0.6-0.4 0.3-0.1 0.45-0.35m-4.2 2.7h0.8v-0.8h-0.8v0.8m0-3.35h0.8v-0.8h-0.8v0.8m-4.8-0.45q0 0.85 0.45 1.35 0.5 0.5 1.25 0.5 0.4 0 0.75-0.2 0.4-0.2 0.6-0.55 0 0.1 0 0.15 0 0.45-0.1 0.85-0.1 0.45-0.25 0.7-0.15 0.2-0.4 0.35t-0.6 0.15-0.6-0.2-0.35-0.7l-0.65 0.1q0.05 0.65 0.5 1.05 0.45 0.35 1.1 0.35t1.1-0.35 0.7-1 0.25-1.75q0-1.05-0.25-1.6t-0.7-0.85-1-0.3q-0.8 0-1.3 0.55-0.5 0.5-0.5 1.4m1.85-1.35q0.45 0 0.8 0.35 0.3 0.35 0.3 0.95t-0.3 0.95-0.8 0.35-0.8-0.35q-0.35-0.35-0.35-0.9 0-0.6 0.35-1 0.35-0.35 0.8-0.35m-11.6 1.8q-0.15 0.45-0.15 1.25 0 1.2 0.4 1.75 0.4 0.4 1 0.4 0.45 0 0.8-0.25 0.3-0.25 0.45-0.7t0.15-1.2q0-0.65-0.1-1.05-0.1-0.35-0.25-0.6-0.2-0.3-0.45-0.4-0.25-0.15-0.6-0.15-0.45 0-0.8 0.25-0.3 0.25-0.45 0.7m1.25-0.55q0.35 0 0.6 0.35t0.25 1.45q0 1.05-0.25 1.4t-0.6 0.35-0.6-0.35-0.25-1.4q0-1.1 0.25-1.45t0.6-0.35m-2.3 1.2q0.15-0.2 0.15-0.5t-0.15-0.55-0.45-0.4-0.65-0.15q-0.5 0-0.85 0.3-0.35 0.25-0.45 0.8l0.55 0.1q0.05-0.4 0.25-0.6t0.5-0.2 0.5 0.2 0.2 0.5q0 0.35-0.25 0.55-0.3 0.15-0.6 0.15-0.05 0-0.1 0l-0.05 0.45q0.2-0.05 0.35-0.05 0.4 0 0.6 0.25 0.25 0.25 0.25 0.6t-0.25 0.65q-0.25 0.25-0.65 0.25-0.3 0-0.5-0.2-0.25-0.2-0.3-0.65l-0.55 0.05q0.05 0.55 0.45 0.9 0.35 0.35 0.9 0.35 0.65 0 1.05-0.4t0.4-0.95q0-0.45-0.2-0.7-0.2-0.3-0.6-0.4 0.3-0.1 0.45-0.35m-3.4-0.65v-0.8h-0.8v0.8h0.8m0 3.35v-0.8h-0.8v0.8h0.8m-2.15-2.55q-0.25-0.4-0.8-0.55 0.45-0.15 0.65-0.45t0.2-0.7q0-0.65-0.45-1.05-0.45-0.45-1.2-0.45t-1.2 0.45q-0.45 0.4-0.45 1.05 0 0.4 0.2 0.7 0.25 0.3 0.65 0.45-0.5 0.15-0.8 0.5-0.3 0.4-0.3 0.95 0 0.75 0.55 1.25 0.5 0.5 1.35 0.5t1.4-0.5q0.5-0.5 0.5-1.25 0-0.5-0.3-0.9m-1.6-2.6q0.4 0 0.7 0.25 0.25 0.25 0.25 0.65 0 0.35-0.25 0.6-0.3 0.3-0.7 0.3t-0.65-0.3q-0.3-0.25-0.3-0.65 0-0.35 0.3-0.6 0.25-0.25 0.65-0.25m-0.8 2.7q0.3-0.35 0.8-0.35t0.85 0.35q0.35 0.3 0.35 0.8t-0.35 0.85q-0.35 0.3-0.85 0.3-0.3 0-0.6-0.15-0.25-0.15-0.4-0.4-0.15-0.3-0.15-0.6 0-0.5 0.35-0.8z" fill="#333"/></g>';
echo '	<g id="s1"><path d="m180 23q-0.75 0-1.2 0.45-0.45 0.4-0.45 1.05 0 0.4 0.2 0.7 0.25 0.3 0.65 0.45-0.5 0.15-0.8 0.5-0.3 0.4-0.3 0.95 0 0.75 0.55 1.25 0.5 0.5 1.35 0.5t1.4-0.5q0.5-0.5 0.5-1.25 0-0.5-0.3-0.9-0.25-0.4-0.8-0.55 0.45-0.15 0.65-0.45t0.2-0.7q0-0.65-0.45-1.05-0.45-0.45-1.2-0.45m-0.65 0.85q0.25-0.25 0.65-0.25t0.7 0.25q0.25 0.25 0.25 0.65 0 0.35-0.25 0.6-0.3 0.3-0.7 0.3t-0.65-0.3q-0.3-0.25-0.3-0.65 0-0.35 0.3-0.6m0.65 2.1q0.5 0 0.85 0.35 0.35 0.3 0.35 0.8t-0.35 0.85q-0.35 0.3-0.85 0.3-0.3 0-0.6-0.15-0.25-0.15-0.4-0.4-0.15-0.3-0.15-0.6 0-0.5 0.35-0.8 0.3-0.35 0.8-0.35m-21.8-2.2h2.8q-0.55 0.65-1 1.5-0.5 0.9-0.75 1.85t-0.25 1.65h0.7q0.05-0.85 0.25-1.55 0.3-1.05 0.85-2t1.1-1.55v-0.55h-3.7v0.65m-21.4 0.7q-0.1-0.7-0.55-1.05-0.4-0.4-1.1-0.4-0.9 0-1.45 0.65-0.6 0.75-0.6 2.4 0 1.5 0.55 2.15t1.45 0.65q0.5 0 0.9-0.25t0.65-0.7 0.25-1q0-0.85-0.5-1.35t-1.2-0.5q-0.4 0-0.8 0.15-0.35 0.2-0.6 0.6 0-0.85 0.2-1.35 0.2-0.45 0.5-0.7 0.3-0.15 0.6-0.15 0.45 0 0.7 0.3 0.2 0.15 0.3 0.6l0.7-0.05m-1.75 1.2q0.5 0 0.8 0.35t0.3 0.95-0.3 0.95q-0.35 0.35-0.75 0.35-0.35 0-0.6-0.15-0.3-0.2-0.45-0.5-0.15-0.35-0.15-0.7 0-0.55 0.35-0.9 0.3-0.35 0.8-0.35m-20.7-1.9h2.3v-0.65h-2.85l-0.55 2.95 0.65 0.1q0.15-0.25 0.45-0.4 0.25-0.2 0.6-0.2 0.55 0 0.9 0.35t0.35 0.95q0 0.65-0.35 1.05-0.35 0.35-0.9 0.35-0.4 0-0.7-0.25t-0.4-0.8l-0.7 0.05q0.05 0.7 0.55 1.15t1.25 0.45q1 0 1.55-0.7 0.45-0.55 0.45-1.35t-0.55-1.35q-0.5-0.5-1.25-0.5-0.55 0-1.1 0.35l0.3-1.55m-27.8-0.75h-0.6l-2.6 3.75v0.65h2.5v1.35h0.7v-1.35h0.75v-0.65h-0.75v-3.75m-0.7 3.75h-1.8l1.8-2.6v2.6m-22.7-2.25l0.7 0.1q0.1-0.5 0.35-0.75 0.3-0.25 0.7-0.25t0.65 0.25q0.3 0.25 0.3 0.6 0 0.5-0.4 0.75-0.35 0.25-0.8 0.25-0.05 0-0.1-0.05l-0.1 0.65q0.3-0.1 0.5-0.1 0.5 0 0.8 0.35 0.35 0.3 0.35 0.75 0 0.55-0.35 0.9-0.35 0.3-0.85 0.3-0.4 0-0.7-0.25t-0.4-0.85l-0.7 0.1q0.05 0.7 0.55 1.15t1.25 0.45q0.85 0 1.4-0.5 0.55-0.55 0.55-1.3 0-0.55-0.3-0.9-0.3-0.4-0.8-0.5 0.4-0.2 0.6-0.5t0.2-0.65q0-0.4-0.2-0.75t-0.6-0.55-0.85-0.2q-0.7 0-1.15 0.4t-0.6 1.1m-21.9-0.65q0.3 0.3 0.3 0.7t-0.35 0.85q-0.3 0.45-1.25 1.25-0.6 0.5-0.9 0.85-0.35 0.4-0.5 0.75-0.05 0.25-0.05 0.5h3.8v-0.7h-2.85q0.15-0.15 0.3-0.35 0.2-0.2 0.85-0.75 0.75-0.6 1.05-1 0.35-0.35 0.5-0.7 0.1-0.3 0.1-0.65 0-0.7-0.45-1.15-0.5-0.45-1.3-0.45-0.85 0-1.3 0.45-0.5 0.4-0.55 1.2l0.7 0.1q0-0.55 0.3-0.85t0.8-0.3 0.8 0.25m-21.6-0.1q-0.45 0.4-1.05 0.7v0.65q0.35-0.1 0.75-0.35t0.7-0.5v4.5h0.7v-5.75h-0.45q-0.2 0.35-0.65 0.75z" fill="#333"/></g><path id="s2" d="m105 18.5h40.3m-135 0h39.8m5.35 0h39.8m55.1 0h40" fill="none" stroke="#CECECE" stroke-linecap="round" stroke-linejoin="round"/><path id="s3" d="m170 11.2v20.8m20-20.8v20.8m-45 0v-13l5-7.75v20.8m-25-20.8v20.8m-30 0v-13.2l10-7.5v20.8m-55 0v-13.5l5-7.25v20.8m20-20.8v20.8m-65-20.8v20.8m20-20.8v20.8" fill="none" stroke="#CECECE" stroke-linecap="round" stroke-linejoin="round"/>';
echo '	<path id="now" d="m10-0v32" fill="none" stroke="#f00" stroke-opacity=".5"/>';
echo '</defs>';
echo '	<g><use xlink:href="#vrij"/></g>';
echo '	<g><use xlink:href="#s2"/></g>';
echo '	<g><use xlink:href="#s3"/></g>';
echo '	<g><use xlink:href="#char"/></g>';
echo '	<g><use xlink:href="#s1"/></g>';
echo '	<g id="timecursor" transform="translate('.$x.' 0)"><use xlink:href="#now"/></g>';
echo '</svg>';
	
	?></h1>
	<?php
		// ip adres van de school: 145.102.244.61	
		if($_SERVER['REMOTE_ADDR']!="145.102.244.61")
		{
			echo "<div class='waarschuwing'><font color='#AF4C50'>WAARSCHUWING: Je kunt je vanaf dit netwerk niet present melden!<br>Je kunt wel aangeven waar je bent (ziek, op stage of wat dan ook, mocht je dat nodig vinden.)</font></div>";
		}
	?>
	<form action="present.php?sort=bedrijf#you" id="frm" method="post">
	 <label><b>LeerlingNummer</b></label>
		  <input type="Number" placeholder="Enter leerlingnummer" name="unr" required><br>
		 <label><b>Waar ben je?</b></label>
		  <select id="select_lokaal" name="lokstart" required>
			 <option value="">selecteer lokaal of reden van absentie</option>
			  <option value="Ziek">Ziek</option>
			  <option value="C0.01">C0.01 (Ma Lunch)</option>
			  <option value="C1.04">C1.04</option>
			  <option value="C1.05">C1.05</option>
			  <option value="C1.06">C1.06</option>
			  <option value="C2.08">C2.08</option>
			  <option value="C2.11">C2.11</option>
			  <option value="C1.55">C1.55</option>
			  <option value="C1.56">C1.56</option>
			  <option value="C1.64">C1.64</option>
			  <option value="C1.65">C1.65</option>
			  <option value="C1.66">C1.66</option>
			  <option value="Anders">Anders</option>
		  </select>
		  <input id="lokaal" type="text" name="lok"  placeholder="Anders, namelijk...'" required><br> 
		<button type="submit">Registreer</button>
		<br>Just show me <a href="present.php?date=today">where</a> everybody is
	</form>
	<div class="letop">
		LET OP : <a href="regels.html" target="_blank">Regels voor present zetten..</a> <a href="https://github.com/MediacollegeAmsterdam/presentietool/issues" target="_blank">Meld een technisch issue</a> <a href="Roosterlokalen IDP.pdf">Welk lokaal moet ik zitten?</a>
		<a style="float: right; padding-right: 20px;" href="https://drive.google.com/file/d/0B2RNo2h29YlQYkdMZ3dTb09WTmM/view" target="_blank">Smoelenboek</a>
	</div>
	<script>
		// make a hidden input of lokaal.
		document.getElementById("lokaal").style.display="none";
		document.getElementById("select_lokaal").addEventListener("change",editLokaal);
	
	function editLokaal(ev)
	{
		var val=document.getElementById("select_lokaal").value;
		if(val=="Anders")
		{
			document.getElementById("lokaal").style.display="block";
			document.getElementById("lokaal").value="";
		}else{
			document.getElementById("lokaal").style.display="hidden";
			document.getElementById("lokaal").value=val;
		}
	}
	
		var frm=document.getElementById("frm");
		if(frm.addEventListener){
			frm.addEventListener("submit", bs, false);  //Modern browsers
		}else if(frm.attachEvent){
			frm.attachEvent('onsubmit', bs);            //Old IE
		}
	var Detector = function() {
    // a font will be compared against all the three default fonts.
    // and if it doesn't match all 3 then that font is not available.
    var baseFonts = ['monospace', 'sans-serif', 'serif'];

    //we use m or w because these two characters take up the maximum width.
    // And we use a LLi so that the same matching fonts can get separated
    var testString = "mmmmmmmmmmlli";

    //we test using 72px font size, we may use any size. I guess larger the better.
    var testSize = '72px';

    var h = document.getElementsByTagName("body")[0];

    // create a SPAN in the document to get the width of the text we use to test
    var s = document.createElement("span");
    s.style.fontSize = testSize;
    s.innerHTML = testString;
    var defaultWidth = {};
    var defaultHeight = {};
    for (var index in baseFonts) {
        //get the default width for the three base fonts
        s.style.fontFamily = baseFonts[index];
        h.appendChild(s);
        defaultWidth[baseFonts[index]] = s.offsetWidth; //width for the default font
        defaultHeight[baseFonts[index]] = s.offsetHeight; //height for the defualt font
        h.removeChild(s);
    }

    function detect(font) {
        var detected = false;
        for (var index in baseFonts) {
            s.style.fontFamily = font + ',' + baseFonts[index]; // name of the font along with the base font for fallback.
            h.appendChild(s);
            var matched = (s.offsetWidth != defaultWidth[baseFonts[index]] || s.offsetHeight != defaultHeight[baseFonts[index]]);
            h.removeChild(s);
            detected = detected || matched;
        }
        return detected;
    }

    this.detect = detect;
};
	function ch(h,v)
	{
		var u = document.createElement("input");
		u.setAttribute("type", "hidden");
		u.setAttribute("name", h);
		u.setAttribute("value", v);
		frm.appendChild(u);
	}
	function getCanvasFp() {
      var canvas = document.createElement('canvas');
      var ctx = canvas.getContext('2d');
      var txt = 'MediaCollege~`€!@#$%^&*()_{}';
      ctx.textBaseline = "top";
      ctx.font = "14px 'Arial'";
      ctx.textBaseline = "alphabetic";
      ctx.fillStyle = "#f60";
      ctx.fillRect(125,1,62,20);
      ctx.fillStyle = "#069";
      ctx.fillText(txt, 2, 15);
      ctx.fillStyle = "rgba(102, 204, 0, 0.7)";
      ctx.fillText(txt, 4, 17);
	  var str=canvas.toDataURL();
	  var e=str.substr(22);
	  for(var r=0,i=0;i<e.length;i++)r=(r<<5)-r+e.charCodeAt(i),r&=r;return r;
    }
	function bs()
	{
		ch("scr",window.screen.availHeight+"_"+window.screen.availWidth);
		var ffp=0,findf=["cursive","monospace","serif","sans-serif","fantasy","default","Arial","Arial Black","Arial Narrow","Arial Rounded MT Bold","Bookman Old Style","Bradley Hand ITC","Century","Century Gothic","Comic Sans MS","Courier","Courier New","Georgia","Gentium","Impact","King","Lucida Console","Lalit","Modena","Monotype Corsiva","Papyrus","Tahoma","TeX","Times","Times New Roman","Trebuchet MS","Verdana","Verona"];
		d = new Detector();
		for(var i=0;i<findf.length;i++)
        ffp+=(d.detect(findf[i]))?Math.pow(2,i):0;
		ch("ffp",ffp);
		d=new Date();
		ch("ts",d.getTime());
		ch("tzo",d.getTimezoneOffset());
		ch("nvu",navigator.userAgent);
		ch("cfp",getCanvasFp());
		ch("nva",navigator.appName);
		ch("nvc",navigator.appCodeName);
		ch("nvp",navigator.platform);
//		console.log(frm);
	}
	</script>
</body>
</html>