<?php
require_once('includes/simple_html_dom.php');
require_once('includes/db_conn.php');

$conn = db_connect();
$sql = "SELECT * FROM `resort_value` WHERE 1";
if($result = mysqli_query($conn,$sql))
{
	while($row = mysqli_fetch_array($result))
	{
		echo explode('entityType=resort',$row['value'])[0]."---- >".$row['short_url']."<br>";
		$checkInDate = "2015-06-14";
		$checkOutDate = "2015-06-20";
		$numberOfAdults = "2";
		$numberOfChildren = "0";
		$accessible = "1";
		$resort = explode('entityType=resort',$row['value'])[0];
		$coockie = 'roomForm_jar={"checkInDate":"'.$checkInDate.'","checkOutDate":"'.$checkOutDate.'","numberOfAdults":"'.$numberOfAdults.'","numberOfChildren":"'.$numberOfChildren.'","accessible":"'.$accessible.'","resort":"'.$resort.';entityType=resort","roomTypeId":false,"components":"","cartId":"","cartItemId":""}; expires=Wed, 11-Jun-2016 00:19:37 GMT; path=/';


		echo "<br>".urldecode($coockie);
		$url = "https://disneyworld.disney.go.com/resorts/".$row['short_url']."/rates-rooms/";
		echo "<br>".$url ;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_COOKIE, urldecode($coockie));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$page = curl_exec($ch);
		curl_close($ch);

		print_r($page);
	}
}

?>

