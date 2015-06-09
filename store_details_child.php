<?php

ini_set('display_errors', true);
error_reporting(E_ALL ^ E_NOTICE);
function db_connect(){

	$con = mysqli_connect("localhost","root","25011994","disney");
	
	// Check connection
	if (mysqli_connect_errno())
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	else
		echo "Connection Successful<br>";
	
	return $con;
}
?>

<?php
require_once('includes/simple_html_dom.php');
$conn = db_connect();
$sql = "SELECT * FROM `resort_value` WHERE 1";
if($result = mysqli_query($conn,$sql))
{
	while($row = mysqli_fetch_array($result))
	{
		echo "resort type entry<br>";
		//echo explode('entityType=resort',$row['value'])[0]."---- >".$row['short_url']."<br>";
		$checkInDate = "2015-06-14";
		$checkOutDate = "2015-06-20";
		$numberOfAdults = "2";
		$numberOfChildren = "0";
		$accessible = "1";
		$resort = explode('entityType=resort',$row['value'])[0];
		$coockie = 'roomForm_jar={"checkInDate":"'.$checkInDate.'","checkOutDate":"'.$checkOutDate.'","numberOfAdults":"'.$numberOfAdults.'","numberOfChildren":"'.$numberOfChildren.'","accessible":"'.$accessible.'","resort":"'.$resort.';entityType=resort","roomTypeId":false,"components":"","cartId":"","cartItemId":""}; 
		expires=Wed, 08-Jun-2016 13:00:42 GMT; path=/';

		//echo "<br>".urldecode($coockie);
		$url = "https://disneyworld.disney.go.com/resorts/".$row['short_url']."/rates-rooms/";
		//echo "<br>".$url ;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_COOKIE, urldecode($coockie));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$page = curl_exec($ch);
		curl_close($ch);


		$page = str_get_html($page);

		$page = $page->getElementById("pageContainer")->getElementById("cardList");



		//echo $page;
		//echo $page;
		$links = $page->find(".roomType");


		foreach ($links as $value) 
		{
			echo " entry made ";
			//echo $value->find("h3",0)."<br />";

			//echo $value->find(".occupancy",0)."<br />";

			//echo $value->find(".integer",0)."<br />";

			//echo $value->find(".roomDetails",0)."<br />";

			$resort_name= $row['short_url'];
			$max_adult = $value->find(".occupancy",0)->plaintext;
			$price = $value->find(".integer",0)->plaintext;
			$details = $value->find(".roomDetails",0)->plaintext;
			$room_title = $value->find("h3",0)->plaintext;

			$sql1 = "INSERT INTO `occupancy_child_0`(
				 `resort_id`, `resort_name`, `max_adult`, `price`, `details`, `room_title`)
			 VALUES ('$resort','$resort_name','$max_adult','$price','$details','$room_title')";

			//echo $sql1."<br />";


			if( mysqli_query($conn,$sql1) ) {
				//echo "recoreds inserted sucessfully";
			}else{
				echo "insertion failed".mysqli_error($conn);
			}
			
		}
	}
}

// nil here
?>

	