
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>



<?php

require_once ("includes/simple_html_dom.php");

ini_set('display_errors', true); 


function db_connect(){

	$con = mysqli_connect("localhost","root","25011994","disney");
	
	// Check connection
	if (mysqli_connect_errno())
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	else
		echo "Connection Successful<br>";
	
	return $con;
}

$conn = db_connect();

if(isset($_POST)){

	echo "<pre>";

	print_r($_POST);


	echo "</pre>";

}




$checkInDate = change_date($_POST['checkInDate']);
$checkOutDate = change_date($_POST['checkOutDate']);
$numberOfAdults = $_POST['numberOfAdults'];
$resort = $_POST['resort'];

function change_date($date){
	//$date = explode("/", $date);

	//return $date[2]."-".$date[0]."-".$date[1];
	return $date;
}

$resort = explode(";", $resort)[0];


$sql = "SELECT * FROM `acessible` WHERE `resort_id` = '$resort' and 
`select_adult` = '$numberOfAdults' and `check_in` = '$checkInDate' ";

echo $sql."<br />";

?>

<table class="table table-striped">
<tr>
<td> Resort Name </td>
<td> Price </td>
<td> Room title </td>
<td> Details </td>


</tr>
<?php 
if($result = mysqli_query($conn,$sql)){
	while($row = mysqli_fetch_array($result)){
		echo "<tr>";
		
			$resort_name = $row['resort_name'];

			$price = $row['price'];

			$details = $row['details'];

			$room_title = $row['room_title'];

			//echo $resort_name."-- > ".$price." --- > ".$details." -- > ".$room_title."<br />";

			echo "
			<td> {$resort_name} </td>
			<td> {$price}</td>
			<td> {$room_title}</td>

			<td> {$details} </td>
			";

			echo "</tr>";
		}
		
	
}else{
	 echo "Error updating record: " . mysql_error($conn);
}

?>
</table>


<?php


//echo $sql;





	

 $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
 echo "Process Time: {$time}";

?>

</body>
</html>