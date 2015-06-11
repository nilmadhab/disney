<?php

ini_set('display_errors', true);
error_reporting(E_ALL ^ E_NOTICE);
$coockie = 'roomForm_jar=%7B%22checkInDate%22%3A%222015-06-20%22%2C%22checkOutDate%22%3A%222015-06-26%22%2C%22numberOfAdults%22%3A%222%22%2C%22numberOfChildren%22%3A%220%22%2C%22accessible%22%3A%221%22%2C%22resort%22%3Afalse%2C%22roomTypeId%22%3Afalse%2C%22components%22%3A%22%22%2C%22cartId%22%3A%22%22%2C%22cartItemId%22%3A%22%22%7D; expires=Thu, 09-Jun-2016 23:11:46 GMT; path=/';
echo "<br>".urldecode($coockie);

$ch = curl_init();
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
$url = "https://disneyworld.disney.go.com/resorts/";
$post = "pep_csrf=9525a8d5c9ae799323fe5488647182e62e089a6f9735a7d8fa049e7ffde16707c5c9d7ebff3d06ce87e89e2dd444416fb82596bdd528e6e769e51be294873b44&checkInDate=06/14/2015&checkOutDate=06/20/2015&numberOfAdults=2&numberOfChildren=0";
curl_setopt($ch,CURLOPT_URL,$url) ;
//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
//curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, urlencode($coockie)) ;
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$page = curl_exec($ch);
curl_close($ch);

print_r($page);

?>

