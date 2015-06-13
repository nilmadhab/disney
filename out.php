<?php
$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 2; URL=$url1");

$startdate = date('Y-m-d'); 
//$startdate = '2015-06-20'; 
$enddate = date('Y-m-d',strtotime("+4 week"));
echo $startdate."<br>";
echo $enddate."<br>";

?>

