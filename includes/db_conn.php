<?php
ini_set('display_errors', true);
error_reporting(E_ALL ^ E_NOTICE);
function db_connect(){
	$con = mysqli_connect("localhost","root","25011994","disney");

	// Check connection
	if (mysqli_connect_errno())
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	else
		//echo "Connection Successful <br>";
	
	return $con;
}
?>

