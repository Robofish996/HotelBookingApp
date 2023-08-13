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
            
            if(isset($_SESSION['user_id'])) {
                echo '<a href="../pages/logout.php">Logout</a>';
            } else {
                echo '<a href="../pages/login.php">Login</a>';
                echo '<a href="../pages/register.php">Register</a>';
            }
            ?>
        </div>
    </nav>

    <!-- Selected Hotel Information -->
    <div class="selected-hotel">
        <?php
        if (isset($_GET['hotel_id'])) {
            $selected_hotel_id = $_GET['hotel_id'];

            // Get the selected hotel details
            $selected_hotel = null;
            foreach ($_SESSION['all_hotels'] as $hotel) {
                if ($hotel['hotel_id'] == $selected_hotel_id) {
                    $selected_hotel = $hotel;
                    echo '<img src="' . $hotel['image_path'] . '" alt="' . $hotel['hotel_name'] . '">';
                    echo '<img src="' . $hotel['view_image'] . '" alt="' . $hotel['hotel_name'] . '">';
                    echo '<img src="' . $hotel['room_image'] . '" alt="' . $hotel['hotel_name'] . '">';
                    echo '<img src="' . $hotel['bath_image'] . '" alt="' . $hotel['hotel_name'] . '">';
                    echo '<h2>' . $hotel['hotel_name'] . '</h2>';
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
            echo '<label for="comparison_hotel">Select a Hotel to Compare:</label>';
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
            }
        }
        ?>
    </div>

    <!-- Include FontAwesome JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
