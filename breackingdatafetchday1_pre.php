<?php
ini_set('display_errors', true);
ini_set('max_execution_time',0); 
error_reporting(E_ALL ^ E_NOTICE);
function db_connect(){

	$con = mysqli_connect("localhost","root","25011994","disney");
	
	// Check connection
	if (mysqli_connect_errno())
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	else
		echo "<br>Connection Successful";
	
	return $con;
}
?>

<?php
$conn = db_connect();

$maintable = '`day_1`';
$crontable = '`cron_day_1`';
$startdate = date('Y-m-d'); 
//$startdate = '2015-06-20'; 
$enddate = date('Y-m-d',strtotime("+1 week"));
//$enddate = '2015-06-26';

//cron preprocess
$drop = "DROP TABLE $maintable";
$rename = "RENAME TABLE `disney`.$crontable TO `disney`.$maintable";
$create = "CREATE TABLE IF NOT EXISTS $crontable (
  `id` int(11) NOT NULL,
  `noAdults` int(10) NOT NULL,
  `noChilds` int(10) NOT NULL,
  `accessibility` int(11) NOT NULL,
  `resort_id` int(11) NOT NULL,
  `resort_name` varchar(200) NOT NULL,
  `max_adult` varchar(200) NOT NULL,
  `price` varchar(1100) NOT NULL,
  `details` text NOT NULL,
  `room_title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1" ;
$alter1 = "ALTER TABLE $crontable
 		ADD PRIMARY KEY (`id`);";
$alter2 = "ALTER TABLE $crontable
		MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
if(!mysqli_query($conn,$drop))
	echo "Could not drop table "; 
if(!mysqli_query($conn,$rename))
	echo "Could not rename table "; 
if(!mysqli_query($conn,$create))
	echo "could not alter1 table ";
if(!mysqli_query($conn,$alter1))
	echo "could not alter2 table ";
if(!mysqli_query($conn,$alter2))
	echo "could not create table<br>";

echo "<br><strong>STARTING THE JOB</strong><br>" ;
echo "Date :".$startdate." to ".$enddate."<br>";
echo "Current timestamp ".date(DATE_COOKIE,time())."<br>" ;

?>
