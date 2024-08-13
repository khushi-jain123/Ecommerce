<?php
include("include/dbconnect.php");

if(isset($_POST["addtocart_btn"]))
{   
    session_start();    
    $id = $_SESSION["sid"];

    $pid = $_POST["productid"];
    $prize = $_POST["prize"];

    $qry = "INSERT INTO `addtocart`(`addtocart_id`, `uid`, `pid`, `totalprize`, `uploaded_at`, `modified_at`) VALUES (NULL,'$id','$pid','$prize',now(),now())";

    $result = mysqli_query($connect, $qry);

    if($result)
    {
        ?><script> alert("Product added to Cart"); </script> <?php
    }
    else{
        ?><script> alert("Something went wrong"); </script> <?php

    }
}



$pid = $_GET["pid"];


$qry = "select * from product where productid = '$pid'";
$result = mysqli_query($connect, $qry);

$data = mysqli_fetch_assoc($result);
$imgpath = "images/".$data['productcatogery']."/".$data['productimage'];
?>


<?php include("include/allheadercdn.php") ?>
<link href="css/style.css" rel="stylesheet">
<?php include("include/homeheader.php") ?>


<div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $imgpath ?>" class="img-fluid" alt="Product Image">
            </div>
            <div class="col-md-6">
                <h2><?php echo $data["productname"] ?> </h2>
                <h4>$<?php echo $data["productprize"] ?></h4>
                <p><?php echo $data["productdescription"] ?></p>
                <form action="check-out.php" method="post">
                    <input type="hidden" name="prize" value="<?php echo $data["productprize"] ?>" class="form-control d-inline-block">

                    <input type="hidden" name="productid" value="<?php echo $data["productid"] ?>" class="form-control d-inline-block">


                <div class="quantity">         
                                        
                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="10" class="form-control d-inline-block" style="width: 60px; text-align: center;">                  
                    
                </div>
                <button class="btn btn-success mt-3" type="submit">Buy Now</button>
                </form>

                <form method="post">
                     <input type="hidden" name="prize" value="<?php echo $data["productprize"] ?>" class="form-control d-inline-block">

                    <input type="hidden" name="productid" value="<?php echo $data["productid"] ?>" class="form-control d-inline-block">



                    <button class="btn btn-primary mt-3" type="submit" name="addtocart_btn">Add to Cart</button>
                </form>

                <p class="mt-3"><strong>Features:</strong></p>
                <ul>
                    <li>Feature 1</li>
                    <li>Feature 2</li>
                    <li>Feature 3</li>
                    <li>Feature 4</li>
                    <li>Feature 5</li>
                </ul>
                <p class="mt-3"><strong>Stock Available:</strong> <?php echo $data["availble"] ?></p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <h3>Reviews</h3>
                <div class="review">
                    <p><strong>User 1</strong> <span>⭐⭐⭐⭐⭐</span></p>
                    <p>This is an amazing product!</p>
                </div>
                <div class="review">
                    <p><strong>User 2</strong> <span>⭐⭐⭐⭐</span></p>
                    <p>Very good quality.</p>
                </div>
                <!-- Add more reviews as needed -->
            </div>
        </div>
    </div>


<?php include("include/allfooterlinks.php") ?>
<script type="text/javascript" src="js/script.js">
</script>