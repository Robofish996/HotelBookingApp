<?php
session_start();

// Check if the user is logged in and has admin role, if not, redirect to login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}

// Database connection
$host = 'localhost';
$username = 'Mathew';
$password = 'mysql@123';
$database = 'stayhub';

$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT orders.*, users.name AS user_name, hotels.hotel_name
          FROM orders
          JOIN users ON orders.user_id = users.id
          JOIN hotels ON orders.hotel_id = hotels.hotel_id
          ORDER BY orders.user_id, orders.time_of_order DESC";


// Execute the query
$result = mysqli_query($connection, $query);

// Check for errors
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <link rel="stylesheet" type="text/css" href="../styling/css/usersOrders.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <h1 class="heading">User Orders</h1>

        <div>
            <?php
            $currentUserID = null;

            // Display user orders along with their hotel names
            while ($order = mysqli_fetch_assoc($result)) {
                if ($order['user_id'] != $currentUserID) {
                    // Display user information if it's a new user
                    echo '<h2 class="heading">User Name: ' . $order['user_name'] . '</h2>';
                    $currentUserID = $order['user_id'];
                }

                echo '<div class="order-cards-container">';
                echo '<p>Order ID: ' . $order['order_id'] . '</p>';
                echo '<p>Hotel Name: ' . $order['hotel_name'] . '</p>';
                echo '<p>Check-in Date: ' . $order['check_in_date'] . '</p>';
                echo '<p>Check-out Date: ' . $order['check_out_date'] . '</p>';
                echo '<p>Total Price: R' . $order['total_price'] . '</p>';
                echo '<p>Order Date: ' . $order['time_of_order'] . '</p>';
                echo '<p>Number of Nights: ' . $order['number_of_nights'] . '</p>';
                echo '</div>';
            }

            // If no orders found
            if (mysqli_num_rows($result) === 0) {
                echo '<p>No orders found.</p>';
            }

            // Close the database connection
            mysqli_close($connection);
            ?>
        </div>

        <script>
            // JavaScript code for dropdown
            const dropdown = document.querySelector('.user-dropdown');
            dropdown.addEventListener('click', () => {
                dropdown.classList.toggle('active');
            });
        </script>
    </div>
</body>
</html>
