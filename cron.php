<?php
ini_set('display_errors', true);
error_reporting(E_ALL ^ E_NOTICE);
function db_connect(){
	$con = mysqli_connect("localhost","root","25011994","disney");

	// Check connection
	if (mysqli_connect_errno())
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	else
		echo "Connection Successful ";
	
	return $con;
}
?>

<?php 

	$conn = db_connect();
	$id = rand(1,100);
	$username = "fvfd";
	$password = "dfgd";
	$firstname = "dfvgdf";
	$lastname = "dfvdfv";
	$sql = "INSERT INTO `users`( `id`,`username`, `password`, `firstname`, `lastname`) VALUES ($id,'$username','$password','$firstname','$lastname')";
	echo $sql ;
	if (mysqli_query($conn,$sql)) {
    	echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

?>

