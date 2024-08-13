<?php


session_start();
if(!isset($_SESSION[role==admin]))
{
  header("location:../login.php");
}


?>
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
  <?php include("../include/allheadercdn.php");?>
</head>
<body>
  
  <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#addproduct">Add product</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#manageuser">Manage User</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu2"></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="../logout.php">logout</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="addproduct">
    <?php include("addproduct.php");?>

  </div>
  <div class="tab-pane container fade" id="manageuser">
    <?php include("manageuser.php");?>
  </div>
  <div class="tab-pane container fade" id="">...</div>
</div>
    
  </div>
</nav>





<?php include("../include/allfooterlinks.php");?>
</body>
</html>