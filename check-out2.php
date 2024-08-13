<?php
include("include/allheadercdn.php");
include("include/homeheader.php");
include("include/dbconnect.php");

if($_SERVER["REQUEST_METHOD"]=="POST")
{

	if(isset($_POST["totalquantity"]) && isset($_POST["totalprize"]) && isset($_POST["products"]))
	{

	$totalquantity = $_POST["totalquantity"];
	$totalprize = $_POST["totalprize"];
	$products = $_POST["products"];		//1,4
	$quantities = $_POST["quantities"];
	$prizes = $_POST["prizes"];	
			

?>
<link href="css/style.css" rel="stylesheet">
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h3> Checkout Summary </h3>
			<table class="table">
				<tr>
					<th> S. N. </th>
					<th> Product Image </th> 
					<th> Name </th> 
					<th> prize </th> 
					<th> Quantity </th>
					<th> Total </th> 
				</tr>

				<?php
				$count=1;
				for($i=0;$i<count($products);$i++)
				{
					$pid = $products[$i];	//1, 4, 8
					$quantity = $quantities[$i];	//3	, 4, 2
					$prize = $prizes[$i];	//40, 40000, 70000

					$total = $quantity * $prize;	//120, 160000, 140000

					$qry = "select productname, productcatogery, productimage from product where productid = '$pid'";		
					$result = mysqli_query($connect, $qry);
					$data = mysqli_fetch_assoc($result);

					$imgpath = "images/".$data['productcatogery']."/".$data['productimage'];

					?>
					<tr>
						<td> <?php echo $count++;  ?> </td>
						<td> <img src="<?php echo $imgpath ?>" width="60px" height="60px"> </td>
						<td> <?php echo $data["productname"] ?> </td>
						<td> <?php echo $prize ?> </td>
						<td> <?php echo $quantity ?> </td>
						<td> <?php echo $total ?> </td>


					</tr>


					<?php

				}
				?>
				
			</table>


			<form method="post" id="payment">
				<h3> Payment and Delivery Information </h3>
				<input type="hidden" class="form-control" name="totalquantity" value="<?php echo $totalquantity; ?>" readonly>
				<input type="hidden" class="form-control" name="totalprize" value="<?php echo $totalprize; ?>" readonly>
				<?php
				for($i=0;$i<count($products);$i++)	
				{ ?>
				<input type="hidden" class="form-control" name="quantities[]" value="<?php echo $quantities[$i]; ?>" readonly>
				<input type="hidden" class="form-control" name="products[]" value="<?php echo $products[$i]; ?>" readonly>
				<input type="hidden" class="form-control" name="prizes[]" value="<?php echo $prizes[$i]; ?>" readonly>
				<?php } ?>

				<input type = "text" name="cardnumber" class="form-control" placeholder="Card Number">
				<input type = "text" name="cvv" class="form-control" placeholder="CVV">
				<input type = "text" name="expiry" class="form-control" placeholder="Expiry Date - MM/YY">
				Address - <textarea name="address" class="form-control"> </textarea>
				

				<button class="btn btn-success" type="submit" name="placeorder"> Place Order </button>
			</form>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<h3> Order Summary </h3>
					<p> Total Items : <?php echo $totalquantity; ?> </p>
					<h4> Total prize : <?php echo $totalprize; ?> </h4>
				</div>
			</div>
		</div>
	</div>
</div>




<?php
}}
if(isset($_POST["placeorder"]))
{
	$uid = $_SESSION["sid"];
	$address = $_POST["address"];
	$cardnumber = $_POST["cardnumber"];
	$totalquantity = $_POST["totalquantity"];
	$totalprize = $_POST["totalprize"];
	$products = $_POST["products"];	//length - 3		4,8,3


	for($i=0;$i<count($products);$i++)
	{
		$pid = $products[$i];	
		$quantity = $quantities[$i];	//4, 3, 6	
		$prize = $prizes[$i];	
		$total = $quantity * $prize;

		$qry2 = "INSERT INTO `order_detail`(`oid`, `uid`, `pid`, `quantity`, `totalprize`, `debitcard`, `address`) VALUES (NULL,'$uid','$pid','$quantity','$total','$cardnumber','$address')";
		$result2 = mysqli_query($connect, $qry2);

		$qry3 = "delete from addtocart where uid = '$uid'";
		$result3 = mysqli_query($connect, $qry3);
			

	}
	?> <script> alert("Order Placed Successfully"); </script> <?php

}
