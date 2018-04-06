<?php

	$con = mysqli_connect('localhost','root','');
	
	//Establish CSS link
	echo "<link rel='stylesheet' type='text/css' href='pycalcss.css'>";
	
	//Check Connection
	if(!$con)
	{echo "Not Connected to Server";}
	//Check and Select the DB
	if(!mysqli_select_db($con,'calendarDB'))
	{echo "Database not selected";}
	
	//Gather info HTML Form
	$Title = $_POST['title'];
	$Description = $_POST['description'];
	
	$date =  $_POST['date'];
	
	$Year = $date[0].$date[1].$date[2].$date[3];
	$Month = $date[5].$date[6];
	$Day = $date[8].$date[9];
	
	//Posting Info to DB
	mysqli_select_db($con,'calendarDB');
	$sql = "INSERT INTO event (title,description,year,month,day) VALUES ('$Title','$Description','$Year','$Month','$Day')";
	
	//Checking for insertion
	if(!mysqli_query($con,$sql))
	{echo "Not Inserted";}
	
	else
	{echo "Data Successfully Inserted! <br><br>     Please Standby...";}

	//Refreshing the html page
	header("refresh:2; url=mastercal.html");
	
?>