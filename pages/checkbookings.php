<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

// Assuming you have a database connection setup earlier in your code
$host = 'localhost';
$username = 'Mathew';
$password = 'mysql@123';
$database = 'stayhub';

$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch user's orders
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY time_of_order DESC";
$result = mysqli_query($connection, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bookings</title>
    <link rel="stylesheet" href="../styling/css/checkBookings.css">
</head>

<body>
        <!-- Navigation Bar -->
        <nav class="navbar">
        <div class="logo">
            <h2>StayHub</h2>
        </div>
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <li><a href="checkBookings.php">Check Bookings</a></li>
        </ul>
        <div class="user-buttons">
            <?php
            session_start();

            if (isset($_SESSION['user_id'])) {
                echo '<a href="../pages/logout.php">Logout</a>';
            } else {
                echo '<a href="../pages/login.php">Login</a>';
                echo '<a href="../pages/register.php">Register</a>';
            }
            ?>
        </div>
    </nav>
    <h1>Your Bookings</h1>

    <?php
while ($row = mysqli_fetch_assoc($result)) {
    $order_id = $row['order_id'];
    $check_in_date = strtotime($row['check_in_date']);
    $now = time();
    $hours_difference = round(($check_in_date - $now) / 3600);

    // Format the order date
    $order_date = date('j F Y', strtotime($row['time_of_order']));

    echo '<div class="booking-card">';
    echo '   <h4>Order Date: ' . $order_date . '</h4>';
    
    // Fetch hotel information for the booking
    $hotel_id = $row['hotel_id'];
    $hotel_query = "SELECT hotel_name FROM hotels WHERE hotel_id = '$hotel_id'";
    $hotel_result = mysqli_query($connection, $hotel_query);
    $hotel_name = mysqli_fetch_assoc($hotel_result)['hotel_name'];

    // Fetch total price for the booking
    $total_price = $row['total_price'];

    echo '   <h4>Hotel Name: ' . $hotel_name . '</h4>';
    echo '   <p>Check In Date: ' . $row['check_in_date'] . '</p>';
    echo '   <p>Total Price: R' . $total_price . '</p>';
    echo '   <p>Order ID: ' . $order_id . '</p>';
    
    if ($hours_difference > 48) {
        echo '   <form method="post" action="#">';
        echo '       <input type="hidden" name="order_id" value="' . $order_id . '">';
        echo '       <button type="submit" name="cancel_order" class="cancel-button">Cancel</button>';
        echo '   </form>';
    }
    echo '</div>';

    if (isset($_POST['cancel_order']) && $_POST['order_id'] == $order_id) {
        $cancel_query = "DELETE FROM orders WHERE order_id = '$order_id'";
        mysqli_query($connection, $cancel_query);

        // Redirect to the same page to refresh the list after cancellation
        header('Location: checkBookings.php');
        exit();
    }
}
?>



</body>

</html>
