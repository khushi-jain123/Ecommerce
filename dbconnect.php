<?php

$connect = mysqli_connect("localhost","root","","sample");

if($connect)
{
	/*echo "Connected";*/
}
else{
	echo "Not Connected";
}
?>