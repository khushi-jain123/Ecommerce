
<?php

include("include/allheadercdn.php");
include("include/dbconnect.php");


$companyname = "clothingEcommerece";
$companyemail = "clothingecommerece.com";
$companymobile = "8767909774";

session_start();
$id  = $_SESSION["sid"];
$qry = "select fullname, contact, email from user where id = '$id'";
$result = mysqli_query($connect, $qry);

$data = mysqli_fetch_assoc($result);



 $deliveryname = $data["fullname"];
 $deliverymobile = $data["contact"];
$deliveryemail = $data["email"];


$oid = $_GET["oid"];

$qry2 = "select * from order_detail where oid = '$oid'";
$result2 = mysqli_query($connect, $qry2);
$data2 = mysqli_fetch_assoc($result2);

$pid = $data2["pid"];

$qry3 = "select productname, productprize from product where productid = '$pid'";
$result3 = mysqli_query($connect, $qry3);
$data3 = mysqli_fetch_assoc($result3);

?>


<link href="css/style.css" rel="stylesheet">
<style>
	.invoice {
		max-width: 1000px;
		margin:auto;
		border: 1px solid black;
		height: 70vh;
	}

	.invoice-content {
		padding:20px 30px;
		font-size: 16px;
	}
</style>


<div class="invoice">
	<div class="invoice-content">
		<div class="text-center">
		<h3> <?php echo $companyname ?> </h3>
		<p> Mob -<?php echo $companymobile ?>  | Email -<?php echo $companyemail ?> </p>
		</div>
		<hr>

		<h3> Customer Name - <?php echo $deliveryname ?> </h3>
		<p> Mob - <?php echo  $deliverymobile ?>  | Email - <?php echo $deliveryemail ?> </p>
		<p> Address - <?php echo $data2["address"]; ?> </p>

		<hr>

		<h4> Product Details </h4>
		<table class="table">
			<tr>
				<th> S. No. </th>
				<th> Product Name </th>
				<th> Product prize </th>
				<th> Quantity </th>
				<th> Total prize </th>
				<th> Date </th>
			</tr>
			<tr>
				<td> 1.  </td>
				<td> <?php echo $data3['productname']; ?> </td>
				<td> <?php echo $data3['productprize']; ?> </td>
				<td> <?php echo $data2['quantity']; ?> </td>
				<td> <?php echo $data2['totalprize']; ?> </td>
				<td> <?php echo $data2['uploaded_at']; ?> </td>
			</tr>
		</table>			
	</div>
</div>









<?php include("include/allfooterlinks.php"); ?>

<script>
	window.print();
</script>