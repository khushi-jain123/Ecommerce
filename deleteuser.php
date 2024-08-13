<?php

$id = $_GET["id"];

include("../include/dbconnect.php");

$qry = "DELETE FROM `user` WHERE id = '$id'";

$result = mysqli_query($connect, $qry);

$row = mysqli_affected_rows($connect);		

if($row>0)
{
	?> <script> alert("Record Deleted <?php echo $id ?>") </script> <?php
	header("location:admindashboard.php#manageuser");
}
else
{
	?> <script> alert("Something went wrong") </script> <?php

}

?>