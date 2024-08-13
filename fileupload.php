<?php
if(isset($_POST["upload_button"])) {
    $connect = mysqli_connect("localhost", "root", "", "photodb");

    $orgname = $_FILES["photo"]["name"];
    $filesize = $_FILES["photo"]["size"];
    $filename = $_FILES["photo"]["tmp_name"];

    // Directory where uploaded files will be saved
    $upload_directory = "user_name/";

    // Move uploaded file to specified directory
    if(move_uploaded_file($filename, $upload_directory . $orgname)) {
        // File uploaded successfully, now insert into database
        $qry = "INSERT INTO `photodb`(`photo`, `created_at`) VALUES ('$orgname', NOW())"; // Assuming `created_at` is a TIMESTAMP column
        $result = mysqli_query($connect, $qry);

        if($result) {
            echo "<script>alert('Image uploaded successfully');</script>";
        } else {
            echo "<script>alert('Failed to upload');</script>";
        }
    } else {
        echo "<script>alert('Failed to move file');</script>";
    }
}







?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		photo - <input type="file" name="photo"><br><br>
		<button  type="submit" name="upload_button"> Upload </button>
	</form>



</body>
</html>