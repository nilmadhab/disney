<?php

ini_set('display_errors', true);
error_reporting(E_ALL ^ E_NOTICE);
ini_set('max_execution_time', 9000); 
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
$sql = "SELECT * FROM `resort_value`";

// tranculate table occupancy before insertinng new rows

// $sql = "truncate occupancy";

//  mysqli_query($conn,$sql)




/*$date_arr = [ ["2015-06-20","2015-06-26"],["2015-06-27","2015-07-03"],["2015-07-04","2015-07-10"],
["2015-07-11","2015-11-17"]];*/
$date_arr = [ ["2015-07-11","2015-07-17"], ["2015-07-18","2015-07-24"]];
foreach ($date_arr as $dates) {

	$current_adult = 1;

	$count = 0;

	$max_adult = 9;
	while($current_adult <= 9){

		if($result = mysqli_query($conn,$sql)){
	
		$display = 0;
		$no_insert = 1;
		while($row = mysqli_fetch_array($result)) {
		
			$count +=1;
			$display +=1;
			//echo explode('entityType=resort',$row['value'])[0]."---- >".$row['short_url']."<br>";
			$checkInDate = $dates[0];
			$checkOutDate = $dates[1];
			$numberOfAdults = "{$current_adult}";
			$numberOfChildren = "0";
			$accessible = "1";
			$resort = explode('entityType=resort',$row['value'])[0];
			
			//unchecked  ==  set 1
			// checked == set 0
			if($accessible == 0){
				$coockie = $acessible_checked;
			}else{
				$coockie = $acessible_unchecked;
			}
			
			/*$acessible_checked = "rampExpressCheckout_A=%7B%22expressCheckout%22%3A%7B%22decision%22%3Atrue%2C%22version%22%3A1%2C%22percentage%22%3A%22100%22%7D%7D; ctoVisitor={%22visitorId%22:%221433702606030-4291197971906%22}; CART-wdw_jar=%7B%22cartId%22%3A%22159562624524-8290054-4730197-2829914%22%7D; PHPSESSID=k9r9nih7vjbkds21mmlt83o477; geoip=YToxNzp7czo4OiJhcmVhY29kZSI7czoxOiIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToiY29udGluZW50IjtzOjI6ImFzIjtzOjEwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxMToiY291bnRyeWNvZGUiO3M6MzoiMzU2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXNjb24gaW5mb3dheSBwdnQuIGx0ZC4iO3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0cm9jb2RlIjtzOjE6IjAiO3M6Njoib2Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2OiI0MDAwMDEiO3M6Mzoic2ljIjtzOjc6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOjU6InN0YXRlIjtzOjExOiJtYWhhcmFzaHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ%3D%3D; LANGUAGE_MESSAGE_DISPLAY=3; surveyThreshold_jar=%7B%22pageViewThreshold%22%3A5%7D; roomForm_jar=%7B%22checkInDate%22%3A%222015-06-20%22%2C%22checkOutDate%22%3A%222015-06-26%22%2C%22numberOfAdults%22%3A%22{$numberOfAdults}%22%2C%22numberOfChildren%22%3A%220%22%2C%22accessible%22%3A%220%22%2C%22resort%22%3A%225%3BentityType%3Dresort%22%2C%22roomTypeId%22%3Afalse%2C%22components%22%3A%22%22%2C%22cartId%22%3A%22%22%2C%22cartItemId%22%3A%22%22%2C%22kid1%22%3A%2217%22%2C%22kid2%22%3A%2217%22%2C%22kid3%22%3A%2217%22%7D; ctoSession={%22sessionId%22:%221434132882934-5255283594597%22%2C%22timestamp%22:1434132882937}; ctoBrowserSession=1434132882934; AFFILIATIONS_jar=%7B%22storedAffiliations%22%3A%5B%5D%7D; resortAvail_jar=%7B%22avail%22%3A%7B%22expirationDateTime%22%3A%222015-06-12T12%3A32%3A42-07%3A00%22%2C%22availabilityId%22%3A%22b482e31b-cfe4-4be6-9811-f28ca12c33fa%22%7D%7D; currentOffer_jar=%7B%22currentOffer%22%3A%22summer-offer-broad-room%22%7D; GEOLOCATION_jar=%7B%22wdw%22%3A%7B%22region%22%3A%22maharashtra%22%2C%22country%22%3A%22india%22%2C%22zipCode%22%3A%22400001%22%2C%22metro%22%3A%22no+metro%22%2C%22metroCode%22%3A%220%22%7D%7D; mbox=PC#1433701162690-868.28_07#1441910284|session#1434130720356-386220#1434136144|mboxOverrideServer#mboxedge28.tt.omtrdc.net#1434136144; pep_oauth_token=9Ah3d5n-GLA7J3OMGr_ZZw; wdpro_seen_cmps=/67681/; ctoTimeStamp=1434134285689; ctoArPageName=na; WDPROView=%7B%22version%22%3A2%2C%22preferred%22%3A%7B%22device%22%3A%22desktop%22%2C%22screenWidth%22%3A1366%2C%22screenHeight%22%3A683%2C%22screenDensity%22%3A1%7D%2C%22deviceInfo%22%3A%7B%22device%22%3A%22desktop%22%2C%22screenWidth%22%3A1366%2C%22screenHeight%22%3A683%2C%22screenDensity%22%3A1%7D%7D; localeCookie_jar=%7B%22contentLocale%22%3A%22en_US%22%2C%22version%22%3A%221%22%2C%22precedence%22%3A0%7D; 55170107-VID=111490445367393; 55170107-SKEY=3813398367559469532; HumanClickSiteContainerID_55170107=STANDALONE; s_vi=[CS]v1|2ABA48660501092C-400001318003E4B7[CE]; s_pers=%20s_gpv_pn%3Dwdpro%252Fwdw%252Fus%252Fen%252Fcommerce%252Fresorts%252Fconsumer%252Frooms%252Fanimalkingdomvillasjambohouse%252Fspecialoffer%7C1434136186335%3B; s_sess=%20s_cc%3Dtrue%3B%20prevPageLoadTime%3Dwdpro%252Fwdw%252Fus%252Fen%252Fcommerce%252Fresorts%252Fconsumer%252Frooms%252Fanimalkingdomvillasjambohouse%252Fspecialoffer%257C6.9%3B%20s_ppv%3D-%252C62%252C19%252C2273%3B%20s_wdpro_lid%3D%3B%20s_sq%3Dwdgwdprowdw%252Cwdgwdprosec%252Cwdgdsec%253D%252526pid%25253Dwdpro%2525252Fwdw%2525252Fus%2525252Fen%2525252Fcommerce%2525252Fresorts%2525252Fconsumer%2525252Frooms%2525252Fanimalkingdomvillasjambohouse%2525252Fspecialoffer%252526pidt%25253D1%252526oid%25253DFind%25252520A%25252520Room%2525250A%252526oidt%25253D3%252526ot%25253DSUBMIT%3B; boomr_rt=r=https%3A%2F%2Fdisneyworld.disney.go.com%2Fresorts%2Fanimal-kingdom-villas-jambo%2Frates-rooms%2Fsummer-offer-broad-room%2F&ul=1434134386955&hd=1434134292667";
			$acessible_unchecked = "rampExpressCheckout_A=%7B%22expressCheckout%22%3A%7B%22decision%22%3Atrue%2C%22version%22%3A1%2C%22percentage%22%3A%22100%22%7D%7D; ctoVisitor={%22visitorId%22:%221433702606030-4291197971906%22}; CART-wdw_jar=%7B%22cartId%22%3A%22159562624524-8290054-4730197-2829914%22%7D; PHPSESSID=k9r9nih7vjbkds21mmlt83o477; geoip=YToxNzp7czo4OiJhcmVhY29kZSI7czoxOiIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToiY29udGluZW50IjtzOjI6ImFzIjtzOjEwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxMToiY291bnRyeWNvZGUiO3M6MzoiMzU2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXNjb24gaW5mb3dheSBwdnQuIGx0ZC4iO3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0cm9jb2RlIjtzOjE6IjAiO3M6Njoib2Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2OiI0MDAwMDEiO3M6Mzoic2ljIjtzOjc6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOjU6InN0YXRlIjtzOjExOiJtYWhhcmFzaHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ%3D%3D; LANGUAGE_MESSAGE_DISPLAY=3; surveyThreshold_jar=%7B%22pageViewThreshold%22%3A5%7D; ctoTimeStamp=1434132235516; ctoArPageName=na; roomForm_jar=%7B%22checkInDate%22%3A%222015-06-20%22%2C%22checkOutDate%22%3A%222015-06-26%22%2C%22numberOfAdults%22%3A%22{$numberOfAdults}%22%2C%22numberOfChildren%22%3A%220%22%2C%22accessible%22%3A%220%22%2C%22resort%22%3A%225%3BentityType%3Dresort%22%2C%22roomTypeId%22%3Afalse%2C%22components%22%3A%22%22%2C%22cartId%22%3A%22%22%2C%22cartItemId%22%3A%22%22%2C%22kid1%22%3A%2217%22%2C%22kid2%22%3A%2217%22%2C%22kid3%22%3A%2217%22%7D; AFFILIATIONS_jar=%7B%22storedAffiliations%22%3A%5B%5D%7D; resortAvail_jar=%7B%22avail%22%3A%7B%22expirationDateTime%22%3A%222015-06-12T12%3A03%3A47-07%3A00%22%2C%22availabilityId%22%3A%22b482e31b-cfe4-4be6-9811-f28ca12c33fa%22%7D%7D; currentOffer_jar=%7B%22currentOffer%22%3A%22summer-offer-broad-room%22%7D; GEOLOCATION_jar=%7B%22wdw%22%3A%7B%22region%22%3A%22maharashtra%22%2C%22country%22%3A%22india%22%2C%22zipCode%22%3A%22400001%22%2C%22metro%22%3A%22no+metro%22%2C%22metroCode%22%3A%220%22%7D%7D; mbox=PC#1433701162690-868.28_07#1441908881|session#1434130720356-386220#1434134741|mboxOverrideServer#mboxedge28.tt.omtrdc.net#1434134741; s_pers=%20s_gpv_pn%3Dwdpro%252Fwdw%252Fus%252Fen%252Fcommerce%252Fresorts%252Fconsumer%252Frooms%252Fanimalkingdomvillasjambohouse%252Fspecialoffer%7C1434134682619%3B; wdpro_seen_cmps=/67681/; s_vi=[CS]v1|2ABA48660501092C-400001318003E4B7[CE]; ctoSession={%22sessionId%22:%221434132882934-5255283594597%22%2C%22timestamp%22:1434132882937}; ctoBrowserSession=1434132882934; WDPROView=%7B%22version%22%3A2%2C%22preferred%22%3A%7B%22device%22%3A%22desktop%22%2C%22screenWidth%22%3A1366%2C%22screenHeight%22%3A683%2C%22screenDensity%22%3A1%7D%2C%22deviceInfo%22%3A%7B%22device%22%3A%22desktop%22%2C%22screenWidth%22%3A1366%2C%22screenHeight%22%3A683%2C%22screenDensity%22%3A1%7D%7D; localeCookie_jar=%7B%22contentLocale%22%3A%22en_US%22%2C%22version%22%3A%221%22%2C%22precedence%22%3A0%7D; 55170107-VID=111490445367393; 55170107-SKEY=3813398367559469532; HumanClickSiteContainerID_55170107=STANDALONE; s_sess=%20s_cc%3Dtrue%3B%20s_wdpro_lid%3D%3B%20s_sq%3D%3B%20prevPageLoadTime%3Dwdpro%252Fwdw%252Fus%252Fen%252Fcommerce%252Fresorts%252Fconsumer%252Frooms%252Fanimalkingdomvillasjambohouse%252Fspecialoffer%257C8.5%3B%20s_ppv%3D-%252C75%252C19%252C2697%3B; boomr_rt=r=https%3A%2F%2Fdisneyworld.disney.go.com%2Fresorts%2Fanimal-kingdom-villas-jambo%2Frates-rooms%2Fsummer-offer-broad-room%2F&ul=1434133145833&hd=1434132879811";
			echo "<br>".urldecode($acessible_checked);
			$decoded = 'rampExpressCheckout_A={"expressCheckout":{"decision":true,"version":1,"percentage":"100"}}; ctoVisitor={"visitorId":"1433702606030-4291197971906"}; CART-wdw_jar={"cartId":"159562624524-8290054-4730197-2829914"}; PHPSESSID=k9r9nih7vjbkds21mmlt83o477; geoip=YToxNzp7czo4OiJhcmVhY29kZSI7czoxOiIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToiY29udGluZW50IjtzOjI6ImFzIjtzOjEwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxMToiY291bnRyeWNvZGUiO3M6MzoiMzU2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXNjb24gaW5mb3dheSBwdnQuIGx0ZC4iO3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0cm9jb2RlIjtzOjE6IjAiO3M6Njoib2Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2OiI0MDAwMDEiO3M6Mzoic2ljIjtzOjc6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOjU6InN0YXRlIjtzOjExOiJtYWhhcmFzaHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ==; LANGUAGE_MESSAGE_DISPLAY=3; surveyThreshold_jar={"pageViewThreshold":5}; ctoTimeStamp=1434132235516; ctoArPageName=na; roomForm_jar={"checkInDate":"2015-06-20","checkOutDate":"2015-06-26","numberOfAdults":"2","numberOfChildren":"0","accessible":"0","resort":"5;entityType=resort","roomTypeId":false,"components":"","cartId":"","cartItemId":"","kid1":"17","kid2":"17","kid3":"17"}; AFFILIATIONS_jar={"storedAffiliations":[]}; resortAvail_jar={"avail":{"expirationDateTime":"2015-06-12T12:03:47-07:00","availabilityId":"b482e31b-cfe4-4be6-9811-f28ca12c33fa"}}; currentOffer_jar={"currentOffer":"summer-offer-broad-room"}; GEOLOCATION_jar={"wdw":{"region":"maharashtra","country":"india","zipCode":"400001","metro":"no metro","metroCode":"0"}}; mbox=PC#1433701162690-868.28_07#1441908881|session#1434130720356-386220#1434134741|mboxOverrideServer#mboxedge28.tt.omtrdc.net#1434134741; s_pers= s_gpv_pn=wdpro%2Fwdw%2Fus%2Fen%2Fcommerce%2Fresorts%2Fconsumer%2Frooms%2Fanimalkingdomvillasjambohouse%2Fspecialoffer|1434134682619;; wdpro_seen_cmps=/67681/; s_vi=[CS]v1|2ABA48660501092C-400001318003E4B7[CE]; ctoSession={"sessionId":"1434132882934-5255283594597","timestamp":1434132882937}; ctoBrowserSession=1434132882934; WDPROView={"version":2,"preferred":{"device":"desktop","screenWidth":1366,"screenHeight":683,"screenDensity":1},"deviceInfo":{"device":"desktop","screenWidth":1366,"screenHeight":683,"screenDensity":1}}; localeCookie_jar={"contentLocale":"en_US","version":"1","precedence":0}; 55170107-VID=111490445367393; 55170107-SKEY=3813398367559469532; HumanClickSiteContainerID_55170107=STANDALONE; s_sess= s_cc=true; s_wdpro_lid=; s_sq=; prevPageLoadTime=wdpro%2Fwdw%2Fus%2Fen%2Fcommerce%2Fresorts%2Fconsumer%2Frooms%2Fanimalkingdomvillasjambohouse%2Fspecialoffer%7C8.5; s_ppv=-%2C75%2C19%2C2697;; boomr_rt=r=https://disneyworld.disney.go.com/resorts/animal-kingdom-villas-jambo/rates-rooms/summer-offer-broad-room/&ul=1434133145833&hd=1434132879811
			https://disneyworld.disney.go.com/resorts/animal-kingdom-villas-jambo/rates-rooms/  ';*/
			$actual = "PHPSESSID=29jklreipu420ir0m5uef3ur72; geoip=YToxNzp7czo4OiJhcmVhY29kZSI7czoxOiIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToiY29udGluZW50IjtzOjI6ImFzIjtzOjEwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxMToiY291bnRyeWNvZGUiO3M6MzoiMzU2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXNjb24gaW5mb3dheSBwdnQuIGx0ZC4iO3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0cm9jb2RlIjtzOjE6IjAiO3M6Njoib2Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2OiI0MDAwMDEiO3M6Mzoic2ljIjtzOjc6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOjU6InN0YXRlIjtzOjExOiJtYWhhcmFzaHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ%3D%3D; rampExpressCheckout_A=%7B%22expressCheckout%22%3A%7B%22decision%22%3Atrue%2C%22version%22%3A1%2C%22percentage%22%3A%22100%22%7D%7D; ctoVisitor={%22visitorId%22:%221433948632573-3799130008555%22}; CART-wdw_jar=%7B%22cartId%22%3A%22159808635787-5269999-7675576-1043105%22%7D; wdpro_seen_cmps=/67267/; LANGUAGE_MESSAGE_DISPLAY=3; surveyThreshold_jar=%7B%22pageViewThreshold%22%3A5%7D; roomForm_jar=%7B%22checkInDate%22%3A%22{$checkInDate}%22%2C%22checkOutDate%22%3A%22{$checkOutDate}%22%2C%22numberOfAdults%22%3A%22{$current_adult}%22%2C%22numberOfChildren%22%3A%220%22%2C%22accessible%22%3A%220%22%2C%22resort%22%3A%2280010400%3BentityType%3Dresort%22%2C%22roomTypeId%22%3Afalse%2C%22components%22%3A%22%22%2C%22cartId%22%3A%22%22%2C%22cartItemId%22%3A%22%22%7D; currentOffer_jar=%7B%22currentOffer%22%3A%22room-only%22%7D; 55170107-VID=111490446794027; 55170107-SKEY=5861296815153242832; HumanClickSiteContainerID_55170107=STANDALONE; AFFILIATIONS_jar=%7B%22storedAffiliations%22%3A%5B%5D%7D; resortAvail_jar=%7B%22avail%22%3A%7B%22expirationDateTime%22%3A%222015-06-10T12%3A05%3A03-07%3A00%22%2C%22availabilityId%22%3A%22f992321a-1ec4-4018-ab3c-66701e69fe50%22%7D%7D; ctoSession={%22sessionId%22:%221433959512897-6964602086227%22%2C%22timestamp%22:1433959512899}; ctoBrowserSession=1433959512897; localeCookie_jar=%7B%22contentLocale%22%3A%22en_US%22%2C%22version%22%3A%221%22%2C%22precedence%22%3A0%7D; GEOLOCATION_jar=%7B%22wdw%22%3A%7B%22region%22%3A%22maharashtra%22%2C%22country%22%3A%22india%22%2C%22zipCode%22%3A%22400001%22%2C%22metro%22%3A%22no+metro%22%2C%22metroCode%22%3A%220%22%7D%7D; mbox=PC#1433948629440-761745.28_02#1441736355|session#1433957643313-548014#1433962215|mboxOverrideServer#mboxedge28.tt.omtrdc.net#1433962215; WDPROView={";
			$actual_without_offer = "PHPSESSID=29jklreipu420ir0m5uef3ur72; geoip=YToxNzp7czo4OiJhcmVhY29kZSI7czoxOiIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToiY29udGluZW50IjtzOjI6ImFzIjtzOjEwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxMToiY291bnRyeWNvZGUiO3M6MzoiMzU2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXNjb24gaW5mb3dheSBwdnQuIGx0ZC4iO3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0cm9jb2RlIjtzOjE6IjAiO3M6Njoib2Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2OiI0MDAwMDEiO3M6Mzoic2ljIjtzOjc6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOjU6InN0YXRlIjtzOjExOiJtYWhhcmFzaHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ%3D%3D; rampExpressCheckout_A=%7B%22expressCheckout%22%3A%7B%22decision%22%3Atrue%2C%22version%22%3A1%2C%22percentage%22%3A%22100%22%7D%7D; ctoVisitor={%22visitorId%22:%221433948632573-3799130008555%22}; CART-wdw_jar=%7B%22cartId%22%3A%22159808635787-5269999-7675576-1043105%22%7D; wdpro_seen_cmps=/67267/; LANGUAGE_MESSAGE_DISPLAY=3; surveyThreshold_jar=%7B%22pageViewThreshold%22%3A5%7D; roomForm_jar=%7B%22checkInDate%22%3A%22{$checkInDate}%22%2C%22checkOutDate%22%3A%22{$checkOutDate}%22%2C%22numberOfAdults%22%3A%22{$current_adult}%22%2C%22numberOfChildren%22%3A%220%22%2C%22accessible%22%3A%220%22%2C%22resort%22%3A%2280010400%3BentityType%3Dresort%22%2C%22roomTypeId%22%3Afalse%2C%22components%22%3A%22%22%2C%22cartId%22%3A%22%22%2C%22cartItemId%22%3A%22%22%7D;  55170107-VID=111490446794027; 55170107-SKEY=5861296815153242832; HumanClickSiteContainerID_55170107=STANDALONE; AFFILIATIONS_jar=%7B%22storedAffiliations%22%3A%5B%5D%7D; resortAvail_jar=%7B%22avail%22%3A%7B%22expirationDateTime%22%3A%222015-06-10T12%3A05%3A03-07%3A00%22%2C%22availabilityId%22%3A%22f992321a-1ec4-4018-ab3c-66701e69fe50%22%7D%7D; ctoSession={%22sessionId%22:%221433959512897-6964602086227%22%2C%22timestamp%22:1433959512899}; ctoBrowserSession=1433959512897; localeCookie_jar=%7B%22contentLocale%22%3A%22en_US%22%2C%22version%22%3A%221%22%2C%22precedence%22%3A0%7D; GEOLOCATION_jar=%7B%22wdw%22%3A%7B%22region%22%3A%22maharashtra%22%2C%22country%22%3A%22india%22%2C%22zipCode%22%3A%22400001%22%2C%22metro%22%3A%22no+metro%22%2C%22metroCode%22%3A%220%22%7D%7D; mbox=PC#1433948629440-761745.28_02#1441736355|session#1433957643313-548014#1433962215|mboxOverrideServer#mboxedge28.tt.omtrdc.net#1433962215; WDPROView={";
			$encode = urlencode($decoded);
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

				$table_name = "acessible";
				$date = date("Y-m-d");
				$sql1 = "INSERT INTO `$table_name`(
					 `resort_id`, `check_in`, `select_adult`, `is_accsible`, `resort_name`, `max_adult`, `price`, `details`, `room_title`,`status`,`cron_date`)
				 VALUES ('$resort','$checkInDate','$current_adult','$acessible','$resort_name','$max_adult','$price','$details','$room_title','$status','$date')";

				echo $sql1."<br />";


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
				
			} // for links as value




			///

			//break;
	}


	//increase current adult

	$current_adult +=1;
	echo "current adult is now".$current_adult."<br />";
	if($current_adult >= $max_adult){
		break;
	}
	echo "";
	$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
 	echo "Process Time: {$time}";
 	echo "\n";
	//break;



} // result of current adult

} // current adult

	
	
}// date 







// nil here
?>

