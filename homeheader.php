<ul class="nav justify-content-end" id="homenav">
  <li class="nav-item">
    <a class="nav-link" href="index.php"><i class="bi bi-house"></i> Home</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Product</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Electronics</a>
      <a class="dropdown-item" href="#">Fashion</a>
      <a class="dropdown-item" href="#">Jwellery</a>
    </div>
  </li>

<?php
  session_start();
  if(isset($_SESSION["sid"]) || isset($_SESSION["admineid"]))
  { 


    if(isset($_SESSION["sid"]))
    { ?>
  <li class="nav-item">
    <a class="nav-link" href="cart.php">Cart</a>
  </li>
    <?php } ?>

  <li class="nav-item">
    <a class="nav-link" href="user.php">Profile</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="logout.php">Logout</a>
  </li>
  <?php }
  else
  { ?>
      <li class="nav-item">
    <a class="nav-link" href="register.php">Register</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="login.php">Login</a>
  </li>
  <?php }

?>
</ul>