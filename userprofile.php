<?php
// Example of initializing the $data array
// This would typically come from a database query or other data source
/*$data = [
    'photo_path' => 'user_name/demo.jpg', // Correct key for the photo path
    'fullname' => 'John Doe',
    'email' => 'john.doe@example.com',
    'contact' => '123-456-7890'
];*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Include Bootstrap CSS for responsive images -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <table class="table">
            <tr>
                <th>Photo</th>
                <td>
                    <?php if (isset($data['photo_path']) && !empty($data['photo_path'])): ?>
                        <!-- Display the user photo -->
                        <img src="<?php echo htmlspecialchars($data['photo_path'], ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid" alt="User Photo">
                    <?php else: ?>
                        <!-- Placeholder if photo is not available -->
                        <img src="path_to_placeholder_image.jpg" class="img-fluid" alt="No Photo Available">
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Full Name</th>
                <td><?php echo htmlspecialchars($data["fullname"], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th>Email ID</th>
                <td><?php echo htmlspecialchars($data["email"], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr>
                <th>Contact</th>
                <td><?php echo htmlspecialchars($data["contact"], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        </table>
    </div>

    <!-- Include Bootstrap JS (optional, for additional features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
