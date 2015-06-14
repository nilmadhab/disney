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
		//echo "<br>Connection Successful";
	
	return $con;
}
?>

<?php
require_once('includes/simple_html_dom.php');
$conn = db_connect();

//resort 1 to 5
$maintable = '`day_1`';
$crontable = '`cron_day_1`';
$startdate = date('Y-m-d'); 
//$startdate = '2015-06-20'; 
$enddate = date('Y-m-d',strtotime("+1 week"));
//$enddate = '2015-06-26';

//fetching data
$sql = "SELECT * FROM `resort_value`";
$processAdults = 10 ;  //set n+1 for n adults.
$processChilds = 7 ;  //set n for n childs

//echo "<br><strong>STARTING THE JOB</strong><br>" ;
//echo "Date :".$startdate." to ".$enddate."<br>";
//echo "Current timestamp ".date(DATE_COOKIE,time())."<br>" ;
if($result = mysqli_query($conn,$sql))
{
	$resortcount = 0 ;
	while($row = mysqli_fetch_array($result) )
	{
		$resortcount++ ;
		if($resortcount < 21 && $resortcount > 25)
			break;
		//echo "Resort ".$resortcount."<br>" ;
		//accessible iterations
		for($a = 0 ; $a < 2 ; $a++ )
		{
			//Adult iterations
			for($am = 1 ; $am < $processAdults ; $am++ )  
			{
				$adultflag = true;
				//child iterations
				for($cm = 0 ; $cm < $processChilds ; $cm++ )
				{
					$childflag = true ;
					echo "==> <strong>Job5: Resort ".$resortcount." Adults ".$am." Childs ".$cm." Accessible ".$a."</strong>"."  at ".date(DATE_COOKIE,time());  
					$checkInDate = $startdate;
					$checkOutDate = $enddate;
					$numberOfAdults = $am;
					$numberOfChildren = $cm;
					$accessible = $a;
					$resort = explode('entityType=resort',$row['value'])[0]; 
					//echo "resort ID ".$resort."<br>" ;

					$kid = 'kid1%22%3A%2217%22,';
					for($k = 2 ; $k < $numberOfChildren ; $k++ )
						$kid = $kid."%22kid{$k}%22%3A%2217%22," ;
					$kid = "{$kid}%22kid{$numberOfChildren}%22%3A%2217%22%7D";
					
					$coockie = "PHPSESSID=rplimnu519r1n6ujln8e5f89j1; rampExpressCheckout_A=%7B%22expressCheckout%22%3A%7B%22decision%22%3Atrue%2C%22version%22%3A1%2C%22percentage%22%3A%22100%22%7D%7D; ctoVisitor={%22visitorId%22:%221433658396393-4202544209547%22}; CART-wdw_jar=%7B%22cartId%22%3A%22159518484185-1992608-2601786-2527074%22%7D; LANGUAGE_MESSAGE_DISPLAY=3; surveyThreshold_jar=%7B%22pageViewThreshold%22%3A5%7D; geoip=YToxNzp7czo4OiJhcmVhY29kZSI7czoxOiIwIjtzOjc6ImNvdW50cnkiO3M6NToiaW5kaWEiO3M6OToiY29udGluZW50IjtzOjI6ImFzIjtzOjEwOiJjb25uZWN0aW9uIjtzOjk6ImJyb2FkYmFuZCI7czoxMToiY291bnRyeWNvZGUiO3M6MzoiMzU2IjtzOjE0OiJjb3VudHJ5aXNvY29kZSI7czozOiJpbmQiO3M6NjoiZG9tYWluIjtzOjE6Ij8iO3M6MzoiZHN0IjtzOjE6Im4iO3M6MzoiaXNwIjtzOjI0OiJzeXNjb24gaW5mb3dheSBwdnQuIGx0ZC4iO3M6NToibWV0cm8iO3M6ODoibm8gbWV0cm8iO3M6OToibWV0cm9jb2RlIjtzOjE6IjAiO3M6Njoib2Zmc2V0IjtzOjM6IjUzMCI7czo4OiJwb3N0Y29kZSI7czo2OiI0MDAwMDEiO3M6Mzoic2ljIjtzOjc6Im5vIHNpYyAiO3M6Nzoic2ljY29kZSI7czoxOiIwIjtzOjU6InN0YXRlIjtzOjExOiJtYWhhcmFzaHRyYSI7czozOiJ6aXAiO3M6MToiMCI7fQ%3D%3D; ctoSession={%22sessionId%22:%221434026951815-7737307799980%22%2C%22timestamp%22:1434026951817}; ctoBrowserSession=1434026951815; roomForm_jar=%7B%22checkInDate%22%3A%22{$checkInDate}%22%2C%22checkOutDate%22%3A%22{$checkOutDate}%22%2C%22numberOfAdults%22%3A%22{$numberOfAdults}%22%2C%22numberOfChildren%22%3A%22{$numberOfChildren}%22%2C%22accessible%22%3A%22{$accessible}%22%2C%22resort%22%3A%22{$resort}%3BentityType%3Dresort%22%2C%22roomTypeId%22%3Afalse%2C%22components%22%3A%22%22%2C%22cartId%22%3A%22%22%2C%22cartItemId%22%3A%22%22%2C%22{$kid}; AFFILIATIONS_jar=%7B%22storedAffiliations%22%3A%5B%5D%7D; resortAvail_jar=%7B%22avail%22%3A%7B%22expirationDateTime%22%3A%222015-06-11T06%3A50%3A42-07%3A00%22%2C%22availabilityId%22%3A%22537e9c8a-d796-4141-8685-191ffb5bd395%22%7D%7D; currentOffer_jar=%7B%22currentOffer%22%3A%22room-only%22%7D; GEOLOCATION_jar=%7B%22wdw%22%3A%7B%22region%22%3A%22maharashtra%22%2C%22country%22%3A%22india%22%2C%22zipCode%22%3A%22400001%22%2C%22metro%22%3A%22no+metro%22%2C%22metroCode%22%3A%220%22%7D%7D; boomr_rt=r=https%3A%2F%2Fdisneyworld.disney.go.com%2F&ul=1434026959395&hd=1434027042690; mbox=PC#1433658394516-878992.28_03#1441803044|session#1434026938138-979196#1434028904|mboxOverrideServer#mboxedge28.tt.omtrdc.net#1434028904|disable#browser%20timeout#1434030557; s_pers=%20s_gpv_pn%3Dwdpro%252Fwdw%252Fus%252Fen%252Fcommerce%252Fresorts%252Fconsumer%252Frooms%252Fanimalkingdomvillasjambohouse%252Froomonly%7C1434028844463%3B; s_vi=[CS]v1|2AB9F2100519357F-4000060C000D2C96[CE]; pep_oauth_token=_5Ws5CyAsTHAqJhe7CpgBQ; ctoTimeStamp=1434027046422; ctoArPageName=na; s_sess=%20s_cc%3Dtrue%3B%20s_wdpro_lid%3D%3B%20s_sq%3D%3B%20prevPageLoadTime%3Dwdpro%252Fwdw%252Fus%252Fen%252Fcommerce%252Fresorts%252Fconsumer%252Frooms%252Fanimalkingdomvillasjambohouse%252Froomonly%257C85.7%3B%20s_ppv%3D-%252C21%252C19%252C763%3B; WDPROView=%7B%22version%22%3A2%2C%22preferred%22%3A%7B%22device%22%3A%22desktop%22%2C%22screenWidth%22%3A1313%2C%22screenHeight%22%3A657%2C%22screenDensity%22%3A1%7D%2C%22deviceInfo%22%3A%7B%22device%22%3A%22desktop%22%2C%22screenWidth%22%3A1313%2C%22screenHeight%22%3A657%2C%22screenDensity%22%3A1%7D%7D; localeCookie_jar=%7B%22contentLocale%22%3A%22en_US%22%2C%22version%22%3A%221%22%2C%22precedence%22%3A0%7D; 55170107-VID=1217901207823256; 55170107-SKEY=559635794164449429; HumanClickSiteContainerID_55170107=STANDALONE" ;

					//echo "<br>".urldecode($coockie);
					$url = "https://disneyworld.disney.go.com/resorts/".$row['short_url']."/rates-rooms/";
					//echo "<br>".$url ;
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_VERBOSE, 0);
					curl_setopt($ch, CURLOPT_COOKIE, $coockie);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$page = curl_exec($ch);
					curl_close($ch);
					//echo $page ;

					$page = str_get_html($page);
					if(!$page)
					{
						echo "<strong>  skipped<br></strong>";  
						continue;
					}

					$page = $page->getElementById("pageContainer"); //->getElementById("cardList");
					$links = $page->find(".roomType");
					foreach ($links as $value) 
					{
						$insertflag = true;
						$resort_name= $row['short_url'];
						$max_adult = mysqli_real_escape_string($conn,$value->find(".occupancy",0)->plaintext);
						$price = mysqli_real_escape_string($conn,$value->find(".dualRoomPriceDetail",0)->plaintext);
						$details = mysqli_real_escape_string($conn,$value->find(".roomDetails",0)->plaintext);
						$room_title = mysqli_real_escape_string($conn,$value->find("h3",0)->plaintext);

						//if at least one of rooms is available set flag false
						if(preg_match('/[0-9]+/', $price))
						{
							//echo "price found" ;
							$childflag = false; 
							$insertflag = false ;
						}

						$sql1 = "INSERT INTO $crontable ( `noAdults`, `noChilds`, `accessibility`, `resort_id`, `resort_name`, `max_adult`, `price`, `details`, `room_title`)
						 VALUES ('$numberOfAdults','$numberOfChildren','$accessible','$resort','$resort_name','$max_adult','$price','$details','$room_title')";

						//echo $sql1."<br />";

						if(!$insertflag)
						{
							if( mysqli_query($conn,$sql1) ) 
							{
								//echo " entry made ";
							}else
							{
								echo "<br>insertion failed".mysqli_error($conn)."<br>";
								echo $sql1 ;
							}
						}			
					}
					echo "<br>";
					
					if($childflag && $cm == 0)
						$adultflag = false;
					//breaking from child if current child has no available entry
					if($childflag)
						break;
				}

				//breaking out of adult if no results for child 0
				if(!$adultflag)
					break;
			}
		}
	}
}
echo "<strong>JOB PART 5 OVER</strong> "."  at ".date(DATE_COOKIE,time())."<br>" ;
?>
