<?php

if (isset($_POST["register_btn"])) {

    // Establish database connection
    $connect = mysqli_connect("localhost", "root", "", "sample");

    // Check connection
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $fn = $_POST["fullname"];
    $eid = $_POST["email"];
    $pwd = mysqli_real_escape_string($connect, $_POST["password"]);
    $con = $_POST["contact"];
    $filename = $_FILES["photo"]["tmp_name"];
    $orgname = $_FILES["photo"]["name"];
    $filesize = $_FILES["photo"]["size"];

    // Extract file extension
    $fileinfo = explode(".", $orgname);
    $filetext = strtolower(end($fileinfo));

    // Allowed file types
    $allowtypes = array('jpg', 'png', 'jpeg');

    if (in_array($filetext, $allowtypes)) {
       

            // Define the upload path
            $uploadPath = "user_name/" . $orgname;

            // Move uploaded file
            if (move_uploaded_file($filename, $uploadPath)) {
                // Insert record into the database
                $qry = "INSERT INTO `user` (`fullname`, `email`, `password`, `contact`, `photo`) 
                        VALUES ('$fn', '$eid', '$pwd', '$con', '$orgname')";
                
                if (mysqli_query($connect, $qry)) {
                    echo "<script>alert('Registration Successful');</script>";
                } else {
                    echo "<script>alert('Failed to register');</script>";
                }
            } else {
                echo "<script>alert('Failed to upload file');</script>";
            }
    } else {
        echo "<script>alert('Invalid file extension!');</script>";
    }

    // Close database connection
    mysqli_close($connect);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Register</h3>
                        <form id="registerForm"action="register.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" required>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="register_btn">Register</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="login.php">Sign In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>

<!-- steps to insert values in the databasse
1.connection with database and sholud have connecrtion variavkb
2. get the value in the variable ($POST["na,eattribute"])
3.write query to insert record $qry="sql statement" insert into student 
4.execute query //mysqli_query($connect, $qry)
5.(optional)  //mysqli_num/-rows()
6. -->