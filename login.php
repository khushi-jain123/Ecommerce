<?php
session_start(); // Start the session

// Redirect if the user is already logged in
if (isset($_SESSION['sid'])) {
    // Check if the session ID corresponds to an admin or user
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin/admindashboard.php");
    } else {
        header("Location: user.php");
    }
    exit();
}

// Handle form submission
if (isset($_POST["login_btn"])) {
    // Establish database connection
    $connect = new mysqli("localhost", "root", "", "sample");

    // Check for connection errors
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // Sanitize and prepare input values
    $eid = $_POST["email"];
    $pwd = $_POST["password"];

    // Check if credentials match the admin login
    if ($eid === 'admin@gmail.com' && $pwd === 'admin') {
        // Set session variable for admin and redirect
        $_SESSION["sid"] = 'admin';  // or use any unique identifier for admin
        $_SESSION["role"] = 'admin'; // Set role to 'admin'
        header("Location: admin/admindashboard.php");
        exit();
    } else {
        // Prepare and execute the SQL statement for user login
        $stmt = $connect->prepare("SELECT id FROM user WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $eid, $pwd);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Fetch user ID
            $stmt->bind_result($id);
            $stmt->fetch();

            // Set session variable for user and redirect
            $_SESSION["sid"] = $id;
            $_SESSION["role"] = 'user'; // Set role to 'user'
            header("Location: user.php");
            exit();
        } else {
            $error_message = "Invalid email or password.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $connect->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Login</h3>
                        <?php if (isset($error_message)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                        <?php endif; ?>
                        <form id="loginForm" action="login.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="login_btn">Login</button>
                        </form>
                        <div class="switch-login mt-3">
                            <a href="register.php" class="btn btn-link">Or Create An Account</a>
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
