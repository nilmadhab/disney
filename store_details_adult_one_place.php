<?php

ini_set('display_errors', true);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('max_execution_time', 900); 
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


$current_adult = 4;

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
		$checkInDate = "2015-06-20";
		$checkOutDate = "2015-06-26";
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
		$actual_without_offer = "PHPSESSID=29jklreipu420ir0m5uef3ur72; geoip=YToxNzp7czo4OiJhcmVhY29kZSI7czoxOiIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToiY29udGluZW50IjtzOjI6ImFzIjtzOjEwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxMToiY291bnRyeWNvZGUiO3M6MzoiMzU2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXNjb24gaW5mb3dheSBwdnQuIGx0ZC4iO3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0cm9jb2RlIjtzOjE6IjAiO3M6Njoib2Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2OiI0MDAwMDEiO3M6Mzoic2ljIjtzOjc6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOjU6InN0YXRlIjtzOjExOiJtYWhhcmFzaHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ%3D%3D; rampExpressCheckout_A=%7B%22expressCheckout%22%3A%7B%22decision%22%3Atrue%2C%22version%22%3A1%2C%22percentage%22%3A%22100%22%7D%7D; ctoVisitor={%22visitorId%22:%221433948632573-3799130008555%22}; CART-wdw_jar=%7B%22cartId%22%3A%22159808635787-5269999-7675576-1043105%22%7D; wdpro_seen_cmps=/67267/; LANGUAGE_MESSAGE_DISPLAY=3; surveyThreshold_jar=%7B%22pageViewThreshold%22%3A5%7D; roomForm_jar=%7B%22checkInDate%22%3A%222015-06-20%22%2C%22checkOutDate%22%3A%222015-06-26%22%2C%22numberOfAdults%22%3A%22{$current_adult}%22%2C%22numberOfChildren%22%3A%220%22%2C%22accessible%22%3A%220%22%2C%22resort%22%3A%2280010400%3BentityType%3Dresort%22%2C%22roomTypeId%22%3Afalse%2C%22components%22%3A%22%22%2C%22cartId%22%3A%22%22%2C%22cartItemId%22%3A%22%22%7D;  55170107-VID=111490446794027; 55170107-SKEY=5861296815153242832; HumanClickSiteContainerID_55170107=STANDALONE; AFFILIATIONS_jar=%7B%22storedAffiliations%22%3A%5B%5D%7D; resortAvail_jar=%7B%22avail%22%3A%7B%22expirationDateTime%22%3A%222015-06-10T12%3A05%3A03-07%3A00%22%2C%22availabilityId%22%3A%22f992321a-1ec4-4018-ab3c-66701e69fe50%22%7D%7D; ctoSession={%22sessionId%22:%221433959512897-6964602086227%22%2C%22timestamp%22:1433959512899}; ctoBrowserSession=1433959512897; localeCookie_jar=%7B%22contentLocale%22%3A%22en_US%22%2C%22version%22%3A%221%22%2C%22precedence%22%3A0%7D; GEOLOCATION_jar=%7B%22wdw%22%3A%7B%22region%22%3A%22maharashtra%22%2C%22country%22%3A%22india%22%2C%22zipCode%22%3A%22400001%22%2C%22metro%22%3A%22no+metro%22%2C%22metroCode%22%3A%220%22%7D%7D; mbox=PC#1433948629440-761745.28_02#1441736355|session#1433957643313-548014#1433962215|mboxOverrideServer#mboxedge28.tt.omtrdc.net#1433962215; WDPROView={";
		echo $actual."<br />";
		/*echo $actual."<br/>";
		echo urldecode($actual);
		$actual = 'PHPSESSID=tg4r3mgjhdc2cl8pn8roehuf56;
		 geoip=YToxNzp7czo4OiJhcmVhY29kZSI7czoxOiIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToiY29udGluZW50IjtzOjI6ImFzIjtzOjEwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxMToiY291bnRyeWNvZGUiO3M6MzoiMzU2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXNjb24gaW5mb3dheSBwdnQuIGx0ZC4iO3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0cm9jb2RlIjtzOjE6IjAiO3M6Njoib2Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2OiI0MDAwMDEiO3M6Mzoic2ljIjtzOjc6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOjU6InN0YXRlIjtzOjExOiJtYWhhcmFzaHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ==; rampExpressCheckout_A={"expressCheckout":{"decision":true,"version":1,"percentage":"100"}}; ctoVisitor={"visitorId":"1434038130280-609547181520"}; ctoSession={"sessionId":"1434038130280-609547181520","timestamp":1434038130283}; ctoBrowserSession=1434038130280; roomForm_jar={"checkInDate":"2015-06-11","checkOutDate":"2015-06-17","numberOfAdults":"2","numberOfChildren":"0","accessible":"0","resort":"","roomTypeId":false,"components":"","cartId":"","cartItemId":""}; AFFILIATIONS_jar={"storedAffiliations":[]}; CART-wdw_jar={"cartId":"159898134899-6816212-1496570-5861480"}; resortAvail_jar={"avail":{"expirationDateTime":"2015-06-11T09:55:38-07:00","availabilityId":"558db196-28d9-439f-bd2c-6f0e5c45ffe8"}}; GEOLOCATION_jar={"wdw":{"region":"maharashtra","country":"india","zipCode":"400001","metro":"no metro","metroCode":"0"}}; LANGUAGE_MESSAGE_DISPLAY=2; surveyThreshold_jar={"pageViewThreshold":2}; boomr_rt=r=https://disneyworld.disney.go.com/&ul=1434038134260&hd=1434038142968; mbox=session#1434038128709-709984#1434040005|mboxOverrideServer#mboxedge28.tt.omtrdc.net#1434040005|PC#1434038128709-709984.28_47#1441814145; s_pers= s_gpv_pn=wdpro%2Fwdw%2Fus%2Fen%2Fcommerce%2Fresorts%2Fconsumer%2Flisting|1434039946749;; pep_oauth_token=Dmxdi1e9C6llEuwe-p3Q6Q; s_vi=[CS]v1|2ABCD7B9051930A3-600011080000ACB5[CE]; localeCookie_jar={"contentLocale":"en_US","version":"1","precedence":0}; WDPROView={"version":2,"preferred":{"device":"desktop","screenWidth":1366,"screenHeight":683,"screenDensity":1},"deviceInfo":{"device":"desktop","screenWidth":1366,"screenHeight":683,"screenDensity":1}}; ctoTimeStamp=1434038148370; ctoArPageName=na; s_sess= s_cc=true; s_wdpro_lid=; s_sq=; prevPageLoadTime=wdpro%2Fwdw%2Fus%2Fen%2Fcommerce%2Fresorts%2Fconsumer%2Flisting%7C15.2; s_ppv=-%2C16%2C11%2C1001;';


		 $actual = urlencode($actual);
		 echo $actual."<br />";
		echo urldecode($actual)."<br />";*/

		echo "<br>".urldecode($coockie);
		$url = "https://disneyworld.disney.go.com/resorts/".$row['short_url']."/rates-rooms/";
		echo "<br>".$url ;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		//curl_setopt($ch, CURLOPT_COOKIE, urldecode($coockie));
		curl_setopt($ch, CURLOPT_COOKIE, $actual_without_offer);
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

		$page = $page->getElementById("pageContainer");//->getElementById("cardList");



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

			$table_name = "occupancy_one";
			$sql1 = "INSERT INTO `$table_name`(
				 `resort_id`, `select_adult`,`resort_name`, `max_adult`, `price`, `details`, `room_title`,`status`)
			 VALUES ('$resort','$current_adult','$resort_name','$max_adult','$price','$details','$room_title','$status')";

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
	if($current_adult >= 9){
		break;
	}
	echo "";
	$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
 	echo "Process Time: {$time}";
 	echo "\n";
	//break;



}

}





// nil here

/*

$acessible_checked  = 'rampExpressCheckout_A={"expressCheckout":{"decision":tr
$ue,"version":1,"percentage":"100"}};
$ctoVisitor={"visitorId":"1433702606030-4291197971906"}; CART-
$wdw_jar={"cartId":"159562624524-8290054-4730197-2829914"}; roomForm_jar={"che
$ckInDate":"2015-06-20","checkOutDate":"2015-06-26","numberOfAdults":"1","numb
$erOfChildren":"0","accessible":"0","resort":"5;entityType=resort","roomTypeId
$":false,"components":"","cartId":"","cartItemId":"","kid1":"17","kid2":"17","
$kid3":"17"}; currentOffer_jar={"currentOffer":"room-only"};
$55170107-VID=111490445367393; PHPSESSID=k9r9nih7vjbkds21mmlt83o477; geoip=YTo
$xNzp7czo4OiJhcmVhY29kZSI7czoxOiIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToi
$Y29udGluZW50IjtzOjI6ImFzIjtzOjEwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxM
$ToiY291bnRyeWNvZGUiO3M6MzoiMzU2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3
$M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXN
$jb24gaW5mb3dheSBwdnQuIGx0ZC4iO3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0
$cm9jb2RlIjtzOjE6IjAiO3M6Njoib2Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2O
$iI0MDAwMDEiO3M6Mzoic2ljIjtzOjc6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOj
$U6InN0YXRlIjtzOjExOiJtYWhhcmFzaHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ==; ctoSessio
$n={"sessionId":"1434130724663-2318538452964","timestamp":1434130724668};
$ctoBrowserSession=1434130724663;
$localeCookie_jar={"contentLocale":"en_US","version":"1","precedence":0}; GEOL
$OCATION_jar={"wdw":{"region":"maharashtra","country":"india","zipCode":"40000
$1","metro":"no metro","metroCode":"0"}}; LANGUAGE_MESSAGE_DISPLAY=2;
$surveyThreshold_jar={"pageViewThreshold":2}; mbox=PC#1433701162690-868.28_07#
$1441907992|session#1434130720356-386220#1434133852|mboxOverrideServer#mboxedg
$e28.tt.omtrdc.net#1434133852; WDPROView={''

*/



/*

$acessible_unchecked = 'rampExpressCheckout_A={"expressCheckout":{"decision":t
$rue,"version":1,"percentage":"100"}};
$ctoVisitor={"visitorId":"1433702606030-4291197971906"}; CART-
$wdw_jar={"cartId":"159562624524-8290054-4730197-2829914"};
$PHPSESSID=k9r9nih7vjbkds21mmlt83o477; geoip=YToxNzp7czo4OiJhcmVhY29kZSI7czoxO
$iIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToiY29udGluZW50IjtzOjI6ImFzIjtzOj
$EwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxMToiY291bnRyeWNvZGUiO3M6MzoiMzU
$2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6
$MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXNjb24gaW5mb3dheSBwdnQuIGx0ZC4iO
$3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0cm9jb2RlIjtzOjE6IjAiO3M6Njoib2
$Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2OiI0MDAwMDEiO3M6Mzoic2ljIjtzOjc
$6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOjU6InN0YXRlIjtzOjExOiJtYWhhcmFz
$aHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ==; ctoSession={"sessionId":"1434130724663-
$2318538452964","timestamp":1434130724668}; ctoBrowserSession=1434130724663; r
$oomForm_jar={"checkInDate":"2015-06-20","checkOutDate":"2015-06-26","numberOf
$Adults":"2","numberOfChildren":"0","accessible":"1","resort":"5;entityType=re
$sort","roomTypeId":false,"components":"","cartId":"","cartItemId":"","kid1":"
$17","kid2":"17","kid3":"17"}; LANGUAGE_MESSAGE_DISPLAY=3; mbox=PC#14337011626
$90-868.28_07#1441908018|session#1434130720356-386220#1434133878|mboxOverrideS
$erver#mboxedge28.tt.omtrdc.net#1434133878;
$pep_oauth_token=wQ1anv9xTtrIZ7_cOrH3CQ; wdpro_seen_cmps=/67681/;
$ctoTimeStamp=1434132019465; ctoArPageName=na; s_vi=[CS]v1|2ABA48660501092C-
$400001318003E4B7[CE]; 55170107-VID=111490445367393;
$55170107-SKEY=3813398367559469532;
$HumanClickSiteContainerID_55170107=STANDALONE;
$localeCookie_jar={"contentLocale":"en_US","version":"1","precedence":0};
$AFFILIATIONS_jar={"storedAffiliations":[]}; resortAvail_jar={"avail":{"expira
$tionDateTime":"2015-06-12T12:00:10-07:00","availabilityId":"b482e31b-
$cfe4-4be6-9811-f28ca12c33fa"}}; currentOffer_jar={"currentOffer":"summer-
$offer-broad-room"}; WDPROView={"version":2,"preferred":{"device":"desktop","s
$creenWidth":1366,"screenHeight":683,"screenDensity":1},"deviceInfo":{"device"
$:"desktop","screenWidth":1366,"screenHeight":683,"screenDensity":1}}; GEOLOCA
$TION_jar={"wdw":{"region":"maharashtra","country":"india","zipCode":"400001",
$"metro":"no metro","metroCode":"0"}};
$surveyThreshold_jar={"pageViewThreshold":4}; s_pers= s_gpv_pn=wdpro%2Fwdw%2Fu
$s%2Fen%2Fcommerce%2Fresorts%2Fconsumer%2Frooms%2Fanimalkingdomvillasjambohous
$e%2Fspecialoffer|1434134024863;; s_sess= s_cc=true; prevPageLoadTime=wdpro%2F
$wdw%2Fus%2Fen%2Fcommerce%2Fresorts%2Fconsumer%2Frooms%2Fanimalkingdomvillasja
$mbohouse%2Fspecialoffer%7C20.4; s_ppv=-%2C22%2C17%2C895; s_wdpro_lid=; s_sq=w
$dgwdprowdw%2Cwdgwdprosec%2Cwdgdsec%3D%2526pid%253Dwdpro%25252Fwdw%25252Fus%25
$252Fen%25252Fcommerce%25252Fresorts%25252Fconsumer%25252Frooms%25252Fanimalki
$ngdomvillasjambohouse%25252Fspecialoffer%2526pidt%253D1%2526oid%253DFind%2525
$20A%252520Room%25250A%2526oidt%253D3%2526ot%253DSUBMIT;;
$boomr_rt=r=https://disneyworld.disney.go.com/resorts/animal-kingdom-villas-
$jambo/rates-rooms/&ul=1434132225479&hd=1434132017143';

*/
?>

