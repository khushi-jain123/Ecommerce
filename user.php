<?php 
session_start();

// Redirect if not logged in
if (!isset($_SESSION['sid'])) {
    header("Location: login.php");
    exit();
}

include("include/dbconnect.php");

// Check if database connection was successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_SESSION["sid"];

// Prepare and execute the SQL query to fetch user data
$qry = "SELECT * FROM user WHERE id = ?";
$stmt = mysqli_prepare($connect, $qry);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("User not found.");
}

// Handle form submission for password change
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_password_button"])) {
    // Validate and sanitize user inputs
    $op = isset($_POST["op"]) ? trim($_POST["op"]) : "";
    $np = isset($_POST["np"]) ? trim($_POST["np"]) : "";
    $rp = isset($_POST["rp"]) ? trim($_POST["rp"]) : "";

    // Verify the current password
    if (!password_verify($op, $data["password"])) {
        echo "Incorrect current password.";
    } elseif ($np !== $rp) {
        echo "New passwords do not match.";
    } elseif (strlen($np) < 6) { // Length check
        echo "New password must be at least 6 characters long.";
    } else {
        // Hash the new password
        $hashedPassword = password_hash($np, PASSWORD_DEFAULT);

        // Update the database with the new password
        $updateQry = "UPDATE user SET password = ? WHERE id = ?";
        $updateStmt = mysqli_prepare($connect, $updateQry);
        mysqli_stmt_bind_param($updateStmt, "si", $hashedPassword, $id);
        $success = mysqli_stmt_execute($updateStmt);

        if ($success) {
            echo "Password updated successfully.";
        } else {
            echo "Error updating password.";
        }

        // Close the prepared statement
        mysqli_stmt_close($updateStmt);
    }
}

// Handle form submission for profile update
if (isset($_POST["edit_btn"])) {
    // Retrieve and sanitize input data
    $fn = isset($_POST["fullname"]) ? trim($_POST["fullname"]) : '';
    $eid = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $cont = isset($_POST["contact"]) ? trim($_POST["contact"]) : '';

    // Ensure the user is logged in
    if (isset($_SESSION['sid'])) {
        $id = $_SESSION['sid'];

        // Prepare and execute the SQL query
        $qry = "UPDATE `user` SET `fullname` = ?, `email` = ?, `contact` = ? WHERE `id` = ?";
        $stmt = mysqli_prepare($connect, $qry);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $fn, $eid, $cont, $id);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                echo "<script>alert('Profile updated successfully');</script>";
            } else {
                echo "<script>alert('Something went wrong!');</script>";
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Failed to prepare statement.');</script>";
        }
    } else {
        echo "<script>alert('User not logged in.');</script>";
    }

    // Close the database connection
    mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to User!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Welcome to User!</h1>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar w/ text</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
            <span class="navbar-text">
                <a href="logout.php"><b>Logout</b>(<?php echo htmlspecialchars($data["fullname"]); ?>)</a>
            </span>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-3">
            <ul class="list-group sidebar">
                <li class="list-group-item"><a href="#userprofile" data-toggle="tab">User Profile</a></li>
                <li class="list-group-item"><a href="#editprofile" data-toggle="tab">Edit Profile</a></li>
                <li class="list-group-item"><a href="#changepassword" data-toggle="tab">Change Password</a></li>
                <li class="list-group-item"><a href="#orderhistory" data-toggle="tab">Order History</a></li>
                <li class="list-group-item"><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="userprofile">
                    <?php include("userprofile.php"); ?>
                </div>
                <div class="tab-pane fade" id="editprofile">
                    <div class="container px-5">
                        <h2>Edit Profile</h2>
                        <form method="POST">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($data['fullname']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($data['contact']); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="edit_btn">Update</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="changepassword">
                    <div class="row align-items-center" style="height: 80vh;">
                        <div class="col-md-6 mx-auto">
                            <form method="post">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Old Password" id="op" name="op" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="New Password" id="np" name="np" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm New Password" id="rp" name="rp" required>
                                </div>
                                <button type="submit" class="btn btn-outline-primary" name="update_password_button">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="orderhistory">
                    Order history
                </div>
            </div>
        </div>
    </div>
    <script >$('a[data-toggle="tab"]').on('click', function (e) {
    e.preventDefault();
    $(this).tab('show');
});</script>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>







