<?php

	$con = mysqli_connect('localhost','root','');
	
	//Check Connection
	if(!$con)
	{echo "Not Connected to Server";}
	//Check and Select the DB
	if(!mysqli_select_db($con,'testing'))
	{echo "Database not selected";}
	
	//Gather info HTML Form
	$Title = $_POST['title'];
	$Description = $_POST['description'];
	$Year = $_POST['year'];
	$Month = $_POST['month'];
	$Day = $_POST['day'];
	
	//Posting Info to DB
	mysqli_select_db($con,'testing');
	$sql = "INSERT INTO test (title,description,year,month,day) VALUES ('$Title','$Description','$Year','$Month','$Day')";
	
	//Checking for insertion
	if(!mysqli_query($con,$sql))
	{echo "Not Inserted";}
	
	else
	{echo "Inserted";}

	//Refreshing the html page
	header("refresh:2; url=index.html");
	
?>