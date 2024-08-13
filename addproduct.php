<?php

if(isset($_POST["add_product_button"]))
{

include("../include/dbconnect.php");

$pname = $_POST["productname"];
$pcat = $_POST["productcatogery"];
$pprize = $_POST["productprize"];
$pdesc = mysqli_real_escape_string($connect, $_POST["productdescription"]);
$pavail = $_POST["availble"];

$filename = $_FILES["productimage"]["tmp_name"];
$orgname = $_FILES["productimage"]["name"];
$filesize = $_FILES["productimage"]["size"];

$fileinfo = explode(".", $orgname);

$fileext = strtolower($fileinfo[1]);

$allowtypes = array('jpg', 'png', 'jpeg');


if(in_array($fileext, $allowtypes))
{        
    if($filesize > 0 && $filesize < 5000000 )
    {
        move_uploaded_file($filename, "../images/".$pcat."/".$orgname);

        $qry = "insert into product values(NULL,'$pname','$pcat','$pprize','$pdesc','$pavail','$orgname',now())";

        $result = mysqli_query($connect, $qry);

        if($result)
        {
            ?><script> alert("Product Added Successfully - <?php echo $pname; ?>") </script> <?php
        }else
        {
            echo "Failed to add product - ".mysqli_error($connect);
        }

    }
    else
    {
        ?><script> alert("Invalid file size") </script> <?php
    }
}
else
{
    ?><script> alert("Invalid Extension") </script> <?php
}

}
?>


    <title>Add Product | ECom</title>

    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card border-light p-4">
                    <h2 class="text-center mb-4">Add Product</h2>
                    <form id="registrationForm" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="productname">Product Name</label>
                            <input type="text" class="form-control" id="productname" name="productname" required>
                        </div>
                        <div class="form-group">
                            <label for="productcatogery">Product catogery</label>
                            <select class="form-control" name="productcatogery" id="productcatogery">
                                <option value="jwellery"> Jwellery </option>
                                <option value="fashion"> Fashion </option>
                                <option value="Books"> Books </option>
                                <option value="electronics"> Electronics </option>
                                <option value="pets"> Pets </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="productprize">Product prize</label>
                            <input type="number" class="form-control" id="productprize" name="productprize" required>
                        </div>
                        <div class="form-group">
                            <label for="productdescription">Product Description</label>
                            <textarea class="form-control" name="productdescription" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="availble">Available</label>
                            <input type="number" class="form-control" id="availble" name="availble">
                        </div>
                        <div class="form-group">
                            <label for="productimage">Product Image</label>
                            <input type="file" class="form-control" id="productimage" name="productimage">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="add_product_button">Add Product</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>
</html>




