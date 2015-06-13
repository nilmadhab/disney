<?php
//k[@Xx!=<%Y54cc3a#
// To set cron >crontab -e or >sudo crontab -e
//To view the log sudo grep CRON /var/log/syslog
?>
<?php 
	require_once('includes/db_conn.php');
	$conn = db_connect();
	$id = rand(1,100);
	$username = "cron";
	$password = "cronpass";
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

