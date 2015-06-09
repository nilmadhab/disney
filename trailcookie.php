<?php

ini_set('display_errors', true);
error_reporting(E_ALL ^ E_NOTICE);
$coockie = 'roomForm_jar=%7B%22checkInDate%22%3A%222015-06-14%22%2C%22checkOutDate%22%3A%222015-06-20%22%2C%22numberOfAdults%22%3A%222%22%2C%22numberOfChildren%22%3A%220%22%2C%22accessible%22%3A%221%22%2C%22resort%22%3A%225%3BentityType%3Dresort%22%2C%22roomTypeId%22%3Afalse%2C%22components%22%3A%22%22%2C%22cartId%22%3A%22%22%2C%22cartItemId%22%3A%22%22%7D; expires=Thu, 09-Jun-2016 00:23:49 GMT; path=/';
echo "<br>".urldecode($coockie);
$url = "https://disneyworld.disney.go.com/resorts/animal-kingdom-villas-jambo/rates-rooms/";
echo "<br>".$url ;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_COOKIE, urldecode($coockie)) ;
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$page = curl_exec($ch);
curl_close($ch);

//$dom = str_get_html($page);
//$links = $dom->find('h3');
// foreach ($links as $key ) 
// {
// 	echo "<br>".$key->plaintext." ---> ".$key->getAttribute('href');
// }
print_r($page);

?>
