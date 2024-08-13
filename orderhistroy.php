<?php

include("include/dbconnect.php");

$id = $_SESSION["sid"];	//10

$qry = "select * from order_detail where uid = '$id'";

 

$result = mysqli_query($connect, $qry);




?>
<table class="table">
	<tr>
		<th> Sr. No. </th>
		<th> Product Image </th>
		<th> Product </th>
		<th> prize </th>
		<th> Quantity </th>
		<th> Total prize </th>
		<th> Purchase Date </th>
		<th> Action </th>
	</tr>
	<?php
	$count=1;
	while($data = mysqli_fetch_assoc($result))
	{
		$pid = $data["pid"];
		$qry2 = "select productname, productprize, productcatogery, productimage from product where productid = '$pid'";
		$result2 = mysqli_query($connect, $qry2);
		$data2 = mysqli_fetch_assoc($result2);

		$imgpath = "images/".$data2['productcatogery']."/".$data2['productimage'];
	?>
	<tr>
		<td> <?php echo $count++ ?> </td>
		<td> <img src="<?php echo $imgpath ?>" width="60px" height="60px"> </td>
		<td> <?php echo $data2["productname"]  ?></td>
		<td> <?php echo $data2["productprize"]  ?></td>
		<td> <?php echo $data["quantity"]  ?></td>
		<td> <?php echo $data["totalprize"]  ?></td>
		<td> <?php echo $data["uploaded_at"]  ?></td>
		<td> <a href="printinvoice.php?oid=<?php echo $data['oid'] ?>" class="btn btn-success"> Print </a> </td>
	</tr>
	<?php
	}
	?>





	
</table>