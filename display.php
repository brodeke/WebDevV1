<?php

echo "<link rel='stylesheet' type='text/css' href='pycalcss.css'>";


$con = mysqli_connect("localhost","root","");
mysqli_select_db($con,"calendardb");

$i = 0 ;

$date =  $_POST['date'];

$year = $date[0].$date[1].$date[2].$date[3];
$month = $date[5].$date[6];
$day = $date[8].$date[9];


$disp = mysqli_query($con,"select title, description, day, month, year from event where year='$year' AND month='$month' AND day='$day'");

//$result = mysqli_fetch_array($disp);

//echo "<br> EVENTS FOR:  ".$result['day']. "/".$result['month']. "/".$result['year']."<br>";

while($result = mysqli_fetch_array($disp))
{
	if($i==0)
	{
	echo "<br> EVENTS FOR:  ".$result['day']. "/".$result['month']. "/".$result['year']."<br>";
	$i++ ;
	}
	
	//echo $result['day']. "/".$result['month']. "/".$result['year'];
	echo "<br> Title: ".$result['title'];
	echo "<br> Description: ".$result['description']."<br>";


}
?>