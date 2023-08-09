<?php
session_start();

// Connection details
$host = 'localhost';
$username = 'Mathew';
$password = 'mysql@123';
$database = 'stayhub';

//error message
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
    $query_members = "SELECT * FROM customers WHERE name = '$login_username'";

    // Execute the query
    $result_members = mysqli_query($connection, $query_members);

    if ($result_members && mysqli_num_rows($result_members) === 1) {
        $user = mysqli_fetch_assoc($result_members);

        if ($user['role'] === 'blocked') {
            // User is blocked, show an error message
            $error_message = "You have been blocked. Please contact the administrator for further assistance.";
        } elseif (password_verify($login_password, $user['password'])) {
            // Username and password are correct, store session data
            $_SESSION['username'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            // Redirect
            if ($user['role'] === 'customer') {
                header("Location: ./pages/customerLanding.php");
                exit();
            }
        } else {
            // Invalid password, show an error message
            $error_message = "Invalid password. Please try again.";
        }
    } else {
        // User not found, show an error message
        $error_message = "Invalid username. Please try again.";
    }

    // Close the database connection
    mysqli_close($connection);
}

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
    $register_query = "INSERT INTO customers (name, email, password, role) VALUES ('$register_username', '$register_email', '$hashed_password', 'customer')";

    if (mysqli_query($connection, $register_query)) {
        // Registration successful message
        $success_message = "Registration successful! Please proceed to log in.";
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
    <title>Login & Register</title>
    <link rel="stylesheet" type="text/css" href="./styling/css/index.css">
</head>

<body>
    <div class="container">
        <div class="form-container login">
            <h1>Login</h1>
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
        </div>
        <!-- Registration form -->
        <div class="form-container register">
            <h1>Register</h1>
            <?php if (isset($error_message)) : ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <?php if (isset($success_message)) : ?>
                <p class="success"><?php echo $success_message; ?></p>
            <?php endif; ?>
            <form action="" method="post">
                <input type="hidden" name="register" value="1">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</body>

</html>