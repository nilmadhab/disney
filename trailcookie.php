<?php

ini_set('display_errors', true);
error_reporting(E_ALL ^ E_NOTICE);
$coockie = 's_sess=%20s_cc%3Dtrue%3B%20s_wdpro_lid%3D%3B%20s_sq%3D%3B%20prevPageLoadTime%3Dwdpro%252Fwdw%252Fus%252Fen%252Ftools%252Ffinder%252Fresorts%252Fanimalkingdomvillasjambohouse%252Froomrates%252Froomonly%257C9.5%3B%20s_ppv%3D-%252C18%252C18%252C657%3B; mbox=PC#1433658394516-878992.28_03#1441619388|session#1433843387792-212324#1433845248|mboxOverrideServer#mboxedge28.tt.omtrdc.net#1433845248';
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
