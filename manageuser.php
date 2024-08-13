<?php
include("../include/dbconnect.php")


 $qry = "select * from user";
 $result = mysqli_query($connect, $qry);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		
	</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 mx-auto">
				<h1> Welcome to Manage User hii </h1>
				<table class="table table-bordered table-hover">
					<tr>
						<th> Sr. N. </th>
						<th> Name </th>
						<th> Email ID </th>
						<th> Password </th>
						<th> Contact </th>
						<th> Age </th>
						<th> Photo </th>
						<th> Action </th>
					</tr>




					<?php 
					$count = 1;
					while($data = mysqli_fetch_assoc($result))
					{
						$imagepath = "../user_name/".$data['photo'];
					?>
					<tr>
						<td> <?php echo $count++ ?> </td>	
						<td> <?php echo $data["fullname"]; ?> </td>
						<td> <?php echo $data["email"]; ?>  </td>	
						<td> <?php echo $data["password"]; ?>  </td>
						<td> <?php echo $data["contact"]; ?>  </td>
						<td> <?php echo $data["age"]; ?>  </td>	
						<td> <img src="<?php echo $imagepath; ?>" width="60"> </td>
						<td> <a href="deleteuser.php?id=<?php echo $data['id'] ?>" onclick="return confirm('Are you sure want to delete')"> <i class="bi bi-trash"></i> </a></td>
					</tr>
					<?php

					}

					?>

				</table> 
			</div>
		</div>
	</div>


</body>
</html>

