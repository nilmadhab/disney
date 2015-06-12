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


	$data = '';

	foreach ($_POST as $key => $value) {

		$data .= $key."=".$value."&";
	}

	echo "</pre>";

	function change_date($date){
		$date = explode("/", $date);

		return $date[2]."-".$date[0]."-".$date[1];
	}


	$checkInDate = change_date($_POST['checkInDate']);
	$checkOutDate = change_date($_POST['checkOutDate']);
	$numberOfAdults = $_POST['numberOfAdults'];
	$resort = $_POST['resort'];

	$new = 'roomForm_jar={"checkInDate":"'.$checkInDate.'","checkOutDate":"'.$checkOutDate.'","numberOfAdults"
	:"'.$numberOfAdults.'","numberOfChildren":"0","accessible":"0","resort":"'.$resort.'","roomTypeId":false,"components":"","cartId":"","cartItemId":""}; expires=Tue, 07-Jun-2016 00:32:30 GMT; path=/  ';




//2015-06-07 --> yy-mm-dd // form mm--dd--yy
$nil = 'roomForm_jar={"checkInDate":"2015-06-07","checkOutDate":"2015-06-13","numberOfAdults":"5","numberOfChildren":"0","accessible":"0","resort":"","roomTypeId":false,"components":"","cartId":"","cartItemId":""}; expires=Tue, 07-Jun-2016 00:32:30 GMT; path=/  ';
$nil = 'roomForm_jar=%7B%22checkInDate%22%3A%222015-07-15%22%2C%22checkOutDate%22%3A%222015-07-21%22%2C%22numberOfAdults%22%3A%228%22%2C%22numberOfChildren%22%3A%220%22%2C%22accessible%22%3A%221%22%2C%22resort%22%3A%225%3BentityType%3Dresort%22%2C%22roomTypeId%22%3Afalse%2C%22components%22%3A%22%22%2C%22cartId%22%3A%22%22%2C%22cartItemId%22%3A%22%22%2C%22kid1%22%3A%2217%22%2C%22kid2%22%3A%2217%22%2C%22kid3%22%3A%2217%22%7D; expires=Thu, 09-Jun-2016 00:38:41 GMT; path=/';
$b = urldecode($new);
$b = $nil;

echo urldecode($nil);

$current = 'roomForm_jar={"checkInDate":"2015-06-07","checkOutDate":"2015-06-13","numberOfAdults" :"2","numberOfChildren":"0","accessible":"0","resort":"","roomTypeId":false,"components":"","cartId":"","cartItemId":""}; expires=Tue, 07-Jun-2016 00:32:30 GMT; path=/ ';
echo $new."<br />";
$c = curl_init('https://disneyworld.disney.go.com/resorts/animal-kingdom-villas-jambo/rates-rooms/');
curl_setopt($c, CURLOPT_VERBOSE, 1);
curl_setopt($c, CURLOPT_COOKIE, $new);


curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
$page = curl_exec($c);
//$page = curl_getinfo($page, CURLINFO_HTTP_CODE);
curl_close($c);


print_r($page);


$page = str_get_html($page);

$page = $page->getElementById("finderListView");




//echo $page;
$links = $page->find("ul",0)->find("li");


foreach ($links as $value) {
	//echo $value->find("h2",0)."<br />";
}

}

 $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
 echo "Process Time: {$time}";

?>