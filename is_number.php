<?php

$myString = "asdddd";

echo $myString."<br />";


if (preg_match('/[0-9]+/', $myString))
{
    echo 'number is there <br />';
}else{
	echo "number nor there <br />";
}


$myString = "asd234dd";

echo $myString."<br />";
if (preg_match('/[0-9]+/', $myString))
{
    echo 'number is there <br />';
}else{
	echo "number nor there <br />";
}

$myString = "234";

echo $myString."<br />";
if (preg_match('/[0-9]+/', $myString))
{
    echo 'number is there <br />';
}else{
	echo "number nor there <br />";
}



?>