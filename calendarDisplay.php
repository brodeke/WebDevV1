<?php


// Variable Declarations
$date = $_POST['date'];

$Year =(int) $date[0].$date[1].$date[2].$date[3];
if($date[5] == '0')
	{$Month = (int) $date[6];}
else
	{$Month = (int) $date[5].$date[6];}

$YearEnd = $Year[0].$Year[1] ;
$YearBegin = $Year[2].$Year[3] ;
$Day = 1;
$MonthNamed = ['Null','January','February','March','April','May','June','July','August','September','October','November','December'];
$i = 0 ;
$weekdays = ['sun', 'mon' , 'tue' , 'wed' , 'thu' , 'fri' , 'sat'] ;
$wd = 0;





//Determines if this is a leap year
if ($Year % 4 == 0 && $Year % 100 == 0 && $Year %400 == 0)
{
	$Yearly = [31,29,31,30,31,30,31,31,30,31,30,31] ;
}
else
	$Yearly = [31,28,31,30,31,30,31,31,30,31,30,31] ;
	
	

//Zellers Congruence - Determines day of week when given a day, used to seed each month
if($Month == 1)
{$Month = 13;}
if($Month == 2)
{$Month = 14;}

$w = ($Day +((13*($Month + 1))/5) + $YearEnd + ($YearEnd/4) + ($YearBegin/4) - (2*$YearBegin)) % 7;

if($Month == 13)
{$Month = 1;}
if($Month == 14)
{$Month = 2;}



$today = floor(((time() - strtotime('2015-01-01') - (5*60*60)) / (60*60*24))); // sets number for pulling file for today
$page = $_SERVER['QUERY_STRING'];  // this sets the page to the query string in URL




//Creating the HTML Shell for the calendar

echo "
<!DOCTYPE html>
<html lang='en'>
	<head>
	<meta charset='UTF-8'>
	<title>pycal concept</title>
	<link rel='stylesheet' type='text/css' href='pycalcss.css'>
	
	<script type ='text/javascript'>
		function newCalendar(direction)
		{
			if(direction == 2)
	        	{	
	        		 form1.all('target').value= 'calendarDisplay.php';
  					 form1.all('value').value=" .$Year. "'-'" .($Month-1). "'-01';
  					 form1.submit();
  				}
	        if(direction == 1)
	        	{ 	
	        		form1.all('target').'calendarDisplay.php';
   					form1.all('value').value="  .$Year. "'-'" .($Month+1). "'-01';
   					form1.submit();
   				}
	
		}
	</script>

	
	</head>
	
	<body>
		<table align='center' border='2'cellpadding='0' cellspacing='0' class='month'>
		<tr>	<th colspan='7' class='month'>
					<a onclick='newCalendar('2')'>Last Month</a>
					".$MonthNamed[$Month]." ".$Year."
					<input type='button' name='b1' value='Next Month' onclick='newCalendar('1');'>
				</th>	
		</tr>
		<tr>
				<th class='sun'>Sun</th>
				<th class='mon'>Mon</th>
				<th class='tue'>Tue</th>
				<th class='wed'>Wed</th>
				<th class='thu'>Thu</th>
				<th class='fri'>Fri</th>
				<th class='sat'>Sat</th>
		</tr> ";
		
// HTML Shell is now created



echo "<tr>" ;

// $i is used to iterate through every day of the current month
// $w is the day of the week that the first day of the month lands on

//This loop takes all days in the first week that are not days of this month and makes them blank days
while($i < $w-1)
{
    echo "<td class='noday'>&nbsp</td>" ;
	$wd++ ;
	$i++ ;   
}


//This loop will acutally populate the calendar with the days of the month

$i = 1 ;
$Month-- ;
while ($i <= $Yearly[$Month])    
{
	echo "<td class=".$weekdays[$wd].">".$i."</td>" ;
	$wd++ ;
	if ($wd > 6)
	{
		echo "</tr>" ;
		if(7 < ($Yearly[$Month] - $i)) // checks to see if we need to start a new week or just finish off current week
			{echo "<tr>";}
		$wd = 0;
	}
	$i++ ;
}      


// This Portion Belows simply displays the options below the calendar which allow for event creation and display

echo "</table>

<table align='center' border='2' cellpadding='0' cellspacing='0'>

<tr><th>NEW EVENT:</th> 
<th>REQUEST EVENT:</th> 
<th>PICK A DAY:</th></tr>

<td>
<form action='insertMaster.php' method='post'>

	<br>
	Title:		 <input type='text' name='title'>
	<br>
	Body: <input type='text' name='description'>
	<br>
	Date:		 <input type='date' name='date'>
	<br>
	
	<input type='submit' value='Insert'>
</form>
</td>



<td>
<form action='display.php' method='POST'>
	
	<br> <br> <br>
	Pick the Date:	 <input type='date' name='date'> <br>
	
	<input type='submit' name='submit' value='Submit' >
	
</form>
</td>



<td>
<form action='calendarDisplay.php' method='POST'>
	
	<br> <br> <br>
	Pick the Date:	 <input type='date' name='date'> <br>
	<input type='submit' name='submit' value='Submit' >
	
</form>
</td>

</table> 




</body>
</html>"




/*<form action="display.php" method="POST">
        	<input type="text" name="year" value="2018">
			<input type="text" name="month" value="3">
			<input type="text" name="day" value="4">
        	<input type="submit" name="submit" value="4">	</form>

*/








?>