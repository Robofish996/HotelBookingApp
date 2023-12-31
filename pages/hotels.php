<?php
session_start();

// Database connection
$connection = mysqli_connect('localhost', 'Mathew', 'mysql@123', 'stayhub');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch hotels from the hotels table
$query_hotels = "SELECT * FROM hotels";
$result_hotels = mysqli_query($connection, $query_hotels);

// Store all hotels in session
$all_hotels = [];
while ($row = mysqli_fetch_assoc($result_hotels)) {
    $all_hotels[] = $row;
}

// Store the hotels in the session
$_SESSION['all_hotels'] = $all_hotels;

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stayhub</title>
    <link rel="stylesheet" href="../styling/css/hotels.css">
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
                echo '<a href="./pages/login.php">Login</a>';
                echo '<a href="./pages/register.php">Register</a>';
            }
            ?>
        </div>
    </nav>

    <!-- Hotel List -->
    <div class="hotel-list">
        <?php
        // Database connection
        $connection = mysqli_connect('localhost', 'Mathew', 'mysql@123', 'stayhub');
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch hotels from the hotels table
        $query_hotels = "SELECT * FROM hotels";
        $result_hotels = mysqli_query($connection, $query_hotels);

        // Display hotels in cards
        while ($row = mysqli_fetch_assoc($result_hotels)) {
            echo '<div class="hotel-card">';
            echo '<img src="' . $row['image_path'] . '" alt="' . $row['hotel_name'] . '">';
            echo '<h2>' . $row['hotel_name'] . '</h2>';
            echo '<p>' . $row['overview'] . '</p>';
            echo '<p>Price per night: R' . $row['price_per_night'] . '</p>';
            echo '<p>Status: ' . $row['status'] . '</p>';

            // Check if the status is "Available" before displaying the "Compare" button
            if ($row['status'] === 'Available') {
                echo '<div class="card-buttons">';
                if (isset($_SESSION['user_id'])) {
                    echo '<a class="button" href="compare.php?hotel_id=' . $row['hotel_id'] . '">Compare</a>';
                } else {
                    echo '<a class="button" href="./pages/login.php">Login to Compare</a>';
                }
                echo '</div>';
            }

            echo '</div>';
        }

        // Close the database connection
        mysqli_close($connection);
        ?>
    </div>
</body>

</html>