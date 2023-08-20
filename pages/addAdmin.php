<?php
// Connection details
$host = 'localhost';
$username = 'Mathew';
$password = 'mysql@123';
$database = 'stayhub';

// Error message
$error_message = '';

// Registration values
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $register_username = $_POST['username'];
    $register_email = $_POST['email'];
    $register_password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($register_password, PASSWORD_DEFAULT);

    // Connect to the database
    $connection = mysqli_connect($host, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the registration
    $register_query = "INSERT INTO users (name, email, password, role) VALUES ('$register_username', '$register_email', '$hashed_password', 'admin')";

    if (mysqli_query($connection, $register_query)) {
        // Registration successful message
        $success_message = "Registration successful! Please wait we are redirecting you.";
        // Redirect after 2 seconds
        header("refresh:2;url=admin.php");
    } else {
        // Registration failed, show an error message
        $error_message = "Error: Unable to register. Please try again.";
    }

    // Close the database connection
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../styling/css/addAdmin.css">
</head>
<body>
        <!-- Navigation Bar -->
        <nav class="navbar">
        <div class="logo">
            <a href="#">Stayhub</a>
        </div>
        <ul class="nav-links">
            <li><a href="../pages/admin.php">Home</a></li>
        </ul>
        <div class="user-dropdown">
            <i class="fas fa-user"></i>
            <div class="dropdown-content">
                <a href="logout.php">Logout</a>
            </div>
        </div>
        </nav>
    <div class="container">
        <div class="form-container">
            <h1>Add Admin User</h1>
            <?php if (isset($success_message)): ?>
                <p class="success"><?php echo $success_message; ?></p>
            <?php endif; ?>
            <?php if (isset($error_message)): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form action="" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>

                <button type="submit" name="register">Register</button>
            </form>
        </div>
    </div>
    <script>
            // JavaScript code for dropdown
            const dropdown = document.querySelector('.user-dropdown');
            dropdown.addEventListener('click', () => {
                dropdown.classList.toggle('active');
            });
        </script>
</body>
</html>
