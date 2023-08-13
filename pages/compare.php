<?php session_start();

$host = 'localhost';
$username = 'Mathew';
$password = 'mysql@123';
$database = 'stayhub';

$connection = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stayhub</title>
    <link rel="stylesheet" href="../styling/css/compare.css">
    <!-- Include FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link defer href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">
            <h2>StayHub</h2>
        </div>
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <li><a href="#">Contact</a></li>
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

    <!-- Selected Hotel Information -->
    <div class="selected-hotel mt-5">
        <?php
        if (isset($_GET['hotel_id'])) {
            $selected_hotel_id = $_GET['hotel_id'];

            // Get the selected hotel details
            $selected_hotel = null;
            foreach ($_SESSION['all_hotels'] as $hotel) {
                if ($hotel['hotel_id'] == $selected_hotel_id) {
                    $selected_hotel = $hotel;
                    echo '<h2>' . $hotel['hotel_name'] . '</h2>';
                    echo '<div class="jumbotron jumbotron-fluid">';
                    echo '    <div class="container">';
                    echo '<img src="' . $hotel['image_path'] . '" alt="' . $hotel['hotel_name'] . '">';

                    echo '    </div>';
                    echo '</div>';


                    // Different Views Tab Menu
                    echo '<h2> Different Views </h2>';
                    echo '<ul class="nav nav-tabs" id="viewsTab" role="tablist">';
                    echo '<li class="nav-item" role="presentation">';
                    echo '<a class="nav-link active" id="room-tab" data-bs-toggle="tab" href="#room" role="tab" aria-controls="room" aria-selected="true">Room</a>';
                    echo '</li>';
                    echo '<li class="nav-item" role="presentation">';
                    echo '<a class="nav-link" id="bath-tab" data-bs-toggle="tab" href="#bath" role="tab" aria-controls="bath" aria-selected="false">Bath</a>';
                    echo '</li>';
                    echo '<li class="nav-item" role="presentation">';
                    echo '<a class="nav-link" id="view-tab" data-bs-toggle="tab" href="#view" role="tab" aria-controls="view" aria-selected="false">View</a>';
                    echo '</li>';
                    echo '</ul>';

                    // Tab Content
                    echo '<div class="tab-content">';
                    echo '<div class="tab-pane fade show active" id="room" role="tabpanel" aria-labelledby="room-tab">';
                    echo '<img src="' . $hotel['room_image'] . '" class="img-fluid" alt="Room Image">';
                    echo '</div>';
                    echo '<div class="tab-pane fade" id="bath" role="tabpanel" aria-labelledby="bath-tab">';
                    echo '<img src="' . $hotel['bath_image'] . '" class="img-fluid" alt="Bath Image">';
                    echo '</div>';
                    echo '<div class="tab-pane fade" id="view" role="tabpanel" aria-labelledby="view-tab">';
                    echo '<img src="' . $hotel['view_image'] . '" class="img-fluid" alt="View Image">';
                    echo '</div>';
                    echo '</div>';


                    echo '<p>' . $hotel['overview'] . '</p>';
                    echo '<p><i class="fas fa-bed"></i> Number of beds: ' . $hotel['number_of_beds'] . '</p>';
                    echo '<p><i class="fas fa-swimming-pool"></i> Pool Availability: ' . $hotel['pool_avail'] . '</p>';
                    echo '<p><i class="fas fa-umbrella-beach"></i> Beach within Walk distance: ' . $hotel['beach_view'] . '</p>';
                    echo '<p><i class="fas fa-tree"></i> Forest within Walk distance: ' . $hotel['forest_view'] . '</p>';
                    echo '<p><i class="fas fa-shuttle-van"></i> Shuttle Service: ' . $hotel['shuttle_service'] . '</p>';
                    echo '<p><i class="fas fa-wifi"></i> WiFi Availability: ' . $hotel['wifi_service'] . '</p>';
                    echo '<p><i class="fas fa-concierge-bell"></i> Concierge Availability: ' . $hotel['concierge_service'] . '</p>';
                    echo '<p><i class="fas fa-dollar-sign"></i> Price per night: R' . $hotel['price_per_night'] . '</p>';
                    break;
                }
            }

            // Comparison Hotel Dropdown
            echo '<form method="post" action="#">';
            echo '<h4> Compare to Different Hotels</h4>';


            echo '<select name="comparison_hotel">';
            foreach ($_SESSION['all_hotels'] as $hotel) {
                if ($hotel['hotel_id'] != $selected_hotel_id) {
                    echo '<option value="' . $hotel['hotel_id'] . '">' . $hotel['hotel_name'] . '</option>';
                }
            }
            echo '</select>';
            echo '<button type="submit" name="compare">Compare</button>';
            echo '</form>';

            // Compare with selected hotel
            if (isset($_POST['compare']) && isset($_POST['comparison_hotel'])) {
                $comparison_hotel_id = $_POST['comparison_hotel'];
                $comparison_hotel = null;
                foreach ($_SESSION['all_hotels'] as $hotel) {
                    if ($hotel['hotel_id'] == $comparison_hotel_id) {
                        $comparison_hotel = $hotel;
                        break;
                    }
                }

                // Comparison Results
                echo '<div class="comparison-results">';
                echo '<h3>Comparison Results</h3>';
                echo '<p><i class="fas fa-bed"></i> Number of beds: ';
                if ($selected_hotel['number_of_beds'] != $comparison_hotel['number_of_beds']) {
                    echo 'Different (' . $selected_hotel['number_of_beds'] . ' vs ' . $comparison_hotel['number_of_beds'] . ')';
                } else {
                    echo $selected_hotel['number_of_beds'];
                }
                echo '</p>';
                echo '<p><i class="fas fa-swimming-pool"></i> Pool Availability: ';
                if ($selected_hotel['pool_avail'] != $comparison_hotel['pool_avail']) {
                    echo 'Different (' . $selected_hotel['pool_avail'] . ' vs ' . $comparison_hotel['pool_avail'] . ')';
                } else {
                    echo $selected_hotel['pool_avail'];
                }
                echo '</p>';
                echo '<p><i class="fas fa-umbrella-beach"></i> Beach within Walk distance: ';
                if ($selected_hotel['beach_view'] != $comparison_hotel['beach_view']) {
                    echo 'Different (' . $selected_hotel['beach_view'] . ' vs ' . $comparison_hotel['beach_view'] . ')';
                } else {
                    echo $selected_hotel['beach_view'];
                }
                echo '</p>';
                echo '<p><i class="fas fa-tree"></i> Forest within Walk distance: ';
                if ($selected_hotel['forest_view'] != $comparison_hotel['forest_view']) {
                    echo 'Different (' . $selected_hotel['forest_view'] . ' vs ' . $comparison_hotel['forest_view'] . ')';
                } else {
                    echo $selected_hotel['forest_view'];
                }
                echo '</p>';
                echo '<p><i class="fas fa-shuttle-van"></i> Shuttle Availability: ';
                if ($selected_hotel['shuttle_service'] != $comparison_hotel['shuttle_service']) {
                    echo 'Different (' . $selected_hotel['shuttle_service'] . ' vs ' . $comparison_hotel['shuttle_service'] . ')';
                } else {
                    echo $selected_hotel['shuttle_service'];
                }
                echo '</p>';
                echo '<p><i class="fas fa-wifi"></i> WiFi Availability: ';
                if ($selected_hotel['wifi_service'] != $comparison_hotel['wifi_service']) {
                    echo 'Different (' . $selected_hotel['wifi_service'] . ' vs ' . $comparison_hotel['wifi_service'] . ')';
                } else {
                    echo $selected_hotel['wifi_service'];
                }
                echo '</p>';
                echo '<p><i class="fas fa-concierge-bell"></i> Concierge Availability: ';
                if ($selected_hotel['concierge_service'] != $comparison_hotel['concierge_service']) {
                    echo 'Different (' . $selected_hotel['concierge_service'] . ' vs ' . $comparison_hotel['concierge_service'] . ')';
                } else {
                    echo $selected_hotel['concierge_service'];
                }
                echo '</p>';
                echo '<p><i class="fas fa-dollar-sign"></i> Price per night: ';
                if ($selected_hotel['price_per_night'] != $comparison_hotel['price_per_night']) {
                    echo 'Different (R' . $selected_hotel['price_per_night'] . ' vs R' . $comparison_hotel['price_per_night'] . ')';
                } else {
                    echo $selected_hotel['price_per_night'];
                }
                echo '</p>';
                echo '</div>';
                // Select this hotel button
                echo '<form method="post" action="?hotel_id=' . $comparison_hotel_id . '">';
                echo '<button type="submit" name="select_comparison_hotel">Select this hotel</button>';
                echo '</form>';

                echo '</div>';
                // Handle selecting comparison hotel
                if (isset($_POST['select_comparison_hotel'])) {
                    $selected_hotel_id = $_GET['hotel_id'] = $_POST['comparison_hotel'];
                    // Redirect to the page with the newly selected hotel
                    header('Location: ?hotel_id=' . $selected_hotel_id);
                    exit();
                }
            }
            if (isset($_POST['book_room'])) {
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    $check_in_date = $_POST['check_in_date'];
                    $check_out_date = $_POST['check_out_date'];

                    // Calculate the number of nights
                    $check_in = new DateTime($check_in_date);
                    $check_out = new DateTime($check_out_date);
                    $interval = $check_in->diff($check_out);
                    $number_of_nights = $interval->days;

                    // Calculate the total price
                    $total_price = $number_of_nights * $selected_hotel['price_per_night'];

                    // Insert booking data into the orders table
                    $query = "INSERT INTO orders (user_id, hotel_id, check_in_date, check_out_date, number_of_nights, total_price, time_of_order)
                              VALUES ('$user_id', '$selected_hotel_id', '$check_in_date', '$check_out_date', '$number_of_nights', '$total_price', NOW())";
                    mysqli_query($connection, $query);

                    // Display a success message and reload the current page
                    echo '<script>';
                    echo 'alert("Booking successful!");';
                    echo 'window.location.href = "hotels.php";';
                    echo '</script>';
                    exit();
                } else {
                    // Redirect to the login page if the user is not logged in
                    header("Location: login.php");
                    exit();
                }
            }
        }

        // Check In and Check Out Dates Input
        echo '<form method="post" action="#">';
        echo '<label for="check_in_date">Check In Date:</label>';
        echo '<input type="date" name="check_in_date" required>';
        echo '<label for="check_out_date">Check Out Date:</label>';
        echo '<input type="date" name="check_out_date" required>';

        // Book Room Button
        echo '<button type="submit" name="book_room">Book Room</button>';
        echo '</form>';


        ?>
    </div>

    <!-- Include FontAwesome JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <!--Adding scripts for website-->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>