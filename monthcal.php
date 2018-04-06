<?php
$today = floor(((time() - strtotime('2015-01-04') - (5*60*60)) / (60*60*24))); // sets number for pulling file for today
$page = $_SERVER['QUERY_STRING'];  // this sets the page to the query string in URL

// if there isn't a query string then it sets the page number for today's page
if ($page == "") {
  $page = $today;
}

// this provides ordinal endings for numbers when listing the rank tables
/*function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}*/

$prePage = $page - 1;
$plusPage = $page + 1;
$previous = date('M d, Y', floor(time() + (($today - $page + 1)*(-24*60*60)) - (5*60*60)));
$next = date('M d, Y', floor(time() + (($today - $page - 1)*(-24*60*60)) - (5*60*60)));
$pageDate = date('M d, Y', floor(time() + (($today - $page)*(-24*60*60)) - (5*60*60)));
//echo "query string is $page <br>";
//echo "previous is $prePage <br>";
//echo "next is $plusPage <br>";
if ($page >= 309) {
echo "<a href=\"daily.php?", "$prePage\".>$previous</a> &nbsp";
}
echo "<a href=\"daily.php?", "$today\".>Today</a> &nbsp";
if ($page != $today) {
echo "<a href=\"daily.php?", "$plusPage\".>$next</a>";
}
echo "<br><br>";
echo "Scores for $pageDate <br>";


// $scoreFile = "trivia_scores/trivia_rank_d". $page .".ini";
$scoreFile = 'C:\mIRC_trivia\trivia_score\trivia_rank_d'. $page .".ini";
// echo "<!-- $scoreFile -->" ."<br>";


/*if (is_readable($scoreFile)) {
	$editDate = date("F d, Y H:i:s", (filemtime($scoreFile) - (5*60*60)));
	echo '<table border="1" style="width:80%"><tr><td>Position</td><td>Player</td><td>Score</td></tr>';
	$scoreFile = fopen($scoreFile , "r") or die ("Unable to open files!");
		while (!feof($scoreFile)) {
  		$i++;
  		$ranker = fgets($scoreFile);
  		$ranker = preg_replace('/\=/', '</td><td>',$ranker);
  			if ($ranker != "") {
    				echo "<tr><td>". ordinal($i) ."</td><td>". $ranker ."</td></tr>";
  			}
 		}
		echo "</table><p></p>";
		echo "Last Updated: $editDate EST<br>";
        fclose($scoreFile);
		
	}
else 	{
	echo "there are no scores for $pageDate. <br>";
	}*/
?>