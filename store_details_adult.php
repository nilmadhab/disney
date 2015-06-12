<?php

ini_set('display_errors', true);
error_reporting(E_ALL ^ E_NOTICE);

register_shutdown_function('shutdownFunction');

function shutDownFunction() { 
    $error = error_get_last();
    if ($error['type'] == 1) {
        //do your stuff     
    } 
}


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

// tranculate table occupancy before insertinng new rows

// $sql = "truncate occupancy";

//  mysqli_query($conn,$sql)


$current_adult = 7;

$count = 0;


while($current_adult <= 9){

	if($result = mysqli_query($conn,$sql))
{
	$display = 0;
	$no_insert = 1;
	while($row = mysqli_fetch_array($result))
	{
		$count +=1;
		$display +=1;
		//echo explode('entityType=resort',$row['value'])[0]."---- >".$row['short_url']."<br>";
		$checkInDate = "2015-06-14";
		$checkOutDate = "2015-06-20";
		$numberOfAdults = "{$current_adult}";
		$numberOfChildren = "0";
		$accessible = "1";
		$resort = explode('entityType=resort',$row['value'])[0];
		$coockie = 'roomForm_jar={"checkInDate":"'.$checkInDate.'","checkOutDate":"'.$checkOutDate.'","numberOfAdults":"'.$numberOfAdults.'","numberOfChildren":"'.$numberOfChildren.'","accessible":"'.$accessible.'",
		"resort":"'."80010400;entityType=resort".';entityType=resort","roomTypeId":false,"components":"","cartId":"","cartItemId":""}; 
		expires=Wed, 08-Jun-2016 13:00:42 GMT; path=/';

		echo $coockie."<br />";
		//Wed, 08-Jun-2016 13:00:42 GMT
		$actual = "PHPSESSID=29jklreipu420ir0m5uef3ur72; geoip=YToxNzp7czo4OiJhcmVhY29kZSI7czoxOiIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToiY29udGluZW50IjtzOjI6ImFzIjtzOjEwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxMToiY291bnRyeWNvZGUiO3M6MzoiMzU2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXNjb24gaW5mb3dheSBwdnQuIGx0ZC4iO3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0cm9jb2RlIjtzOjE6IjAiO3M6Njoib2Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2OiI0MDAwMDEiO3M6Mzoic2ljIjtzOjc6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOjU6InN0YXRlIjtzOjExOiJtYWhhcmFzaHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ%3D%3D; rampExpressCheckout_A=%7B%22expressCheckout%22%3A%7B%22decision%22%3Atrue%2C%22version%22%3A1%2C%22percentage%22%3A%22100%22%7D%7D; ctoVisitor={%22visitorId%22:%221433948632573-3799130008555%22}; CART-wdw_jar=%7B%22cartId%22%3A%22159808635787-5269999-7675576-1043105%22%7D; wdpro_seen_cmps=/67267/; LANGUAGE_MESSAGE_DISPLAY=3; surveyThreshold_jar=%7B%22pageViewThreshold%22%3A5%7D; roomForm_jar=%7B%22checkInDate%22%3A%222015-06-20%22%2C%22checkOutDate%22%3A%222015-06-26%22%2C%22numberOfAdults%22%3A%22{$current_adult}%22%2C%22numberOfChildren%22%3A%220%22%2C%22accessible%22%3A%220%22%2C%22resort%22%3A%2280010400%3BentityType%3Dresort%22%2C%22roomTypeId%22%3Afalse%2C%22components%22%3A%22%22%2C%22cartId%22%3A%22%22%2C%22cartItemId%22%3A%22%22%7D; currentOffer_jar=%7B%22currentOffer%22%3A%22room-only%22%7D; 55170107-VID=111490446794027; 55170107-SKEY=5861296815153242832; HumanClickSiteContainerID_55170107=STANDALONE; AFFILIATIONS_jar=%7B%22storedAffiliations%22%3A%5B%5D%7D; resortAvail_jar=%7B%22avail%22%3A%7B%22expirationDateTime%22%3A%222015-06-10T12%3A05%3A03-07%3A00%22%2C%22availabilityId%22%3A%22f992321a-1ec4-4018-ab3c-66701e69fe50%22%7D%7D; ctoSession={%22sessionId%22:%221433959512897-6964602086227%22%2C%22timestamp%22:1433959512899}; ctoBrowserSession=1433959512897; localeCookie_jar=%7B%22contentLocale%22%3A%22en_US%22%2C%22version%22%3A%221%22%2C%22precedence%22%3A0%7D; GEOLOCATION_jar=%7B%22wdw%22%3A%7B%22region%22%3A%22maharashtra%22%2C%22country%22%3A%22india%22%2C%22zipCode%22%3A%22400001%22%2C%22metro%22%3A%22no+metro%22%2C%22metroCode%22%3A%220%22%7D%7D; mbox=PC#1433948629440-761745.28_02#1441736355|session#1433957643313-548014#1433962215|mboxOverrideServer#mboxedge28.tt.omtrdc.net#1433962215; WDPROView={";
		echo $actual."<br />";
		/*echo $actual."<br/>";
		echo urldecode($actual);
		$actual = 'PHPSESSID=29jklreipu420ir0m5uef3ur72; 
		geoip=YToxNzp7czo4OiJhcmVhY29kZSI7czoxOiIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToiY29udGluZW50IjtzOjI6ImFzIjtzOjEwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxMToiY291bnRyeWNvZGUiO3M6MzoiMzU2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXNjb24gaW5mb3dheSBwdnQuIGx0ZC4iO3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0cm9jb2RlIjtzOjE6IjAiO3M6Njoib2Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2OiI0MDAwMDEiO3M6Mzoic2ljIjtzOjc6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOjU6InN0YXRlIjtzOjExOiJtYWhhcmFzaHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ==; 
		rampExpressCheckout_A={"expressCheckout":{"decision":true,"version":1,"percentage":"100"}};
		 ctoVisitor={"visitorId":"1433948632573-3799130008555"}; 
		 CART-wdw_jar={"cartId":"159808635787-5269999-7675576-1043105"}; 
		 wdpro_seen_cmps=/67267/; LANGUAGE_MESSAGE_DISPLAY=3; 
		 surveyThreshold_jar={"pageViewThreshold":5}; 
		 roomForm_jar={"checkInDate":"2015-06-20","checkOutDate":"2015-06-26",
		 "numberOfAdults":"2","numberOfChildren":"0","accessible":"0","resort":"80010400;
		 entityType=resort","roomTypeId":false,"components":"","cartId":"","cartItemId":""}; 
		 currentOffer_jar={"currentOffer":"room-only"}; 55170107-VID=111490446794027; 55170107-SKEY=5861296815153242832; HumanClickSiteContainerID_55170107=STANDALONE; AFFILIATIONS_jar={"storedAffiliations":[]}; resortAvail_jar={"avail":{"expirationDateTime":"2015-06-10T12:05:03-07:00","availabilityId":"f992321a-1ec4-4018-ab3c-66701e69fe50"}}; ctoSession={"sessionId":"1433959512897-6964602086227","timestamp":1433959512899}; ctoBrowserSession=1433959512897; localeCookie_jar={"contentLocale":"en_US","version":"1","precedence":0}; GEOLOCATION_jar={"wdw":{"region":"maharashtra","country":"india","zipCode":"400001","metro":"no metro","metroCode":"0"}}; mbox=PC#1433948629440-761745.28_02#1441736355|session#1433957643313-548014#1433962215|mboxOverrideServer#mboxedge28.tt.omtrdc.net#1433962215; WDPROView={';


		 $actual = urlencode($actual);
		 echo $actual."<br />";
		echo urldecode($actual)."<br />";*/

		echo "<br>".urldecode($coockie);
		$url = "https://disneyworld.disney.go.com/resorts/".$row['short_url']."/rates-rooms/";
		echo "<br>".$url ;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		//curl_setopt($ch, CURLOPT_COOKIE, urldecode($coockie));
		curl_setopt($ch, CURLOPT_COOKIE, $actual);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$page = curl_exec($ch);
		curl_close($ch);

		//$dom = str_get_html($page);
		//$links = $dom->find('h3');
		// foreach ($links as $key ) 
		// {
		// 	echo "<br>".$key->plaintext." ---> ".$key->getAttribute('href');
		// }
		if($display <= 3){
			print_r($page);
		}
		

		if($count >= 3){
			//break;
		}

		$page = str_get_html($page);

		if(trim($page) == ''){
			continue;
		}

		$page = $page->getElementById("pageContainer")->getElementById("cardList");



		//echo $page;
		//echo $page;
		$links = $page->find(".roomType");

		
		foreach ($links as $value) {
			//echo $value->find("h3",0)."<br />";

			//echo $value->find(".occupancy",0)."<br />";

			//echo $value->find(".integer",0)."<br />";

			//echo $value->find(".roomDetails",0)."<br />";

			$resort_name= $row['short_url'];
			$max_adult = mysqli_real_escape_string($conn,  (string)$value->find(".occupancy",0)->plaintext);
			$price = mysqli_real_escape_string($conn,  (string)$value->find(".dualRoomPriceDetail",0)->plaintext);
			$details = mysqli_real_escape_string($conn,  (string)$value->find(".roomDetails",0)->plaintext);
			$room_title = mysqli_real_escape_string($conn,  (string)$value->find("h3",0)->plaintext);

			$max_adult = trim($max_adult);
			$price = trim($price);
			$details = trim($details);

			$room_title = trim($room_title);

			if(preg_match("/Standard/", $price)){
				$status = "1";
			}else{
				$status = "0";
			}
			
			//change table name according to current adult

			$table_name = "occupancy_adult".$current_adult;
			$sql1 = "INSERT INTO `$table_name`(
				 `resort_id`, `resort_name`, `max_adult`, `price`, `details`, `room_title`,`status`)
			 VALUES ('$resort','$resort_name','$max_adult','$price','$details','$room_title','$status')";

			//echo $sql1."<br />";


			if( mysqli_query($conn,$sql1) ) {
				echo "recoreds inserted sucessfully".$no_insert;//."<br />";
				echo "\n";
				$no_insert +=1;
			}else{
				echo $sql1."<br />";
				echo "\n";
				echo "insertion failed".mysqli_error($conn);
				echo "\n";
			}
			
		}




		///

		//break;
	}


	//increase current adult

	$current_adult +=1;
	echo "current adult is now".$current_adult."<br />";
	echo "";
	$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
 	echo "Process Time: {$time}";
 	echo "\n";
	//break;



}

}





// nil here
?>

