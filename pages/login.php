<?php
session_start();

// Connection details
$host = 'localhost';
$username = 'Mathew';
$password = 'mysql@123';
$database = 'stayhub';

// Error message variable
$error_message = '';

// Login values
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $login_username = $_POST['username'];
    $login_password = $_POST['password'];

    // Connect to the database
    $connection = mysqli_connect($host, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare to fetch the user data based on the username
    $query_users = "SELECT * FROM users WHERE name = '$login_username'";
    $result_users = mysqli_query($connection, $query_users);

    if ($result_users && mysqli_num_rows($result_users) === 1) {
        $user = mysqli_fetch_assoc($result_users);

        if ($user['role'] === 'blocked') {
            // User is blocked, show an error message
            $error_message = "You have been blocked. Please contact the administrator for further assistance. +44123242123";
        } elseif (password_verify($login_password, $user['password'])) {
            // Username and password are correct, store session data and redirect
            $_SESSION['username'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Redirect based on role
            if ($user['role'] === 'customer') {
                header("Location: ../index.php");
                exit();
            } elseif ($user['role'] === 'admin') {
                header("Location: ../admin.php");
                exit();
            }
        } else {
            // Invalid password, show an error message
            $error_message = "Invalid password. Please try again.";
        }
    } else {
        // User not found, show an error message
        $error_message = "Invalid username or password. Please try again.";
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
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../styling/css/login.css">
</head>
<body>
    
    <div class="wrapper">
        <div class="container">
            <div class="form-container login">
            <h1>Login to StayHub</h1>
                <?php if (isset($error_message)) : ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <form action="" method="post">
                    <input type="hidden" name="login" value="1">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                    <button type="submit">Login</button>
                </form>
                <div class="login-register">
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
