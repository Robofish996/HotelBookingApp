<?php
session_start();

// Check if the user is logged in and has admin role, if not, redirect to login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}

// Assuming you have a database connection setup earlier in your code
$host = 'localhost';
$username = 'Mathew';
$password = 'mysql@123';
$database = 'stayhub';

$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

class HotelManager
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getAllHotels()
    {
        $query = "SELECT * FROM hotels";
        $result = mysqli_query($this->connection, $query);

        $hotels = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $hotels[] = $row;
        }

        return $hotels;
    }

    public function updateHotelAttributes($hotelId, $newHotelName, $newOverview, $newPricePerNight, $newStatus, $newNumberOfBeds, $newPoolAvail, $newBeachView, $newForestView, $newShuttleService, $newWifiService, $newConciergeService)
    {
        $query = "UPDATE hotels SET 
            hotel_name = '$newHotelName',
            overview = '$newOverview',
            price_per_night = '$newPricePerNight',
            status = '$newStatus',
            number_of_beds = '$newNumberOfBeds',
            pool_avail = '$newPoolAvail',
            beach_view = '$newBeachView',
            forest_view = '$newForestView',
            shuttle_service = '$newShuttleService',
            wifi_service = '$newWifiService',
            concierge_service = '$newConciergeService'
            WHERE hotel_id = $hotelId";

        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($this->connection));
        }
    }
}

$hotelManager = new HotelManager($connection);

// Handle hotel attribute updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_hotel'])) {
    $hotelId = $_POST['hotel_id'];
    $newHotelName = mysqli_real_escape_string($connection, $_POST['new_hotel_name']);
    $newOverview = mysqli_real_escape_string($connection, $_POST['new_overview']);
    $newPricePerNight = isset($_POST['new_price_per_night']) ? floatval($_POST['new_price_per_night']) : 0.00;
    $newStatus = $_POST['new_status'];
    $newNumberOfBeds = isset($_POST['new_number_of_beds']) ? intval($_POST['new_number_of_beds']) : 0;
    $newPoolAvail = $_POST['new_pool_avail'];
    $newBeachView = $_POST['new_beach_view'];
    $newForestView = $_POST['new_forest_view'];
    $newShuttleService = $_POST['new_shuttle_service'];
    $newWifiService = $_POST['new_wifi_service'];
    $newConciergeService = $_POST['new_concierge_service'];

    // Validate and set new_pool_avail value
    if (isset($_POST['new_pool_avail']) && ($_POST['new_pool_avail'] === 'yes' || $_POST['new_pool_avail'] === 'no')) {
        $newPoolAvail = $_POST['new_pool_avail'];
    } else {
        // Default to 'no' if the value is invalid
        $newPoolAvail = 'no';
    }

    // Validate and set new_beach_view value
    if (isset($_POST['new_beach_view']) && ($_POST['new_beach_view'] === 'yes' || $_POST['new_beach_view'] === 'no')) {
        $newBeachView = $_POST['new_beach_view'];
    } else {
        // Default to 'no' if the value is invalid
        $newBeachView = 'no';
    }
    // Validate and set new_forest_view value
    if (isset($_POST['new_forest_view']) && ($_POST['new_forest_view'] === 'yes' || $_POST['new_forest_view'] === 'no')) {
        $newForestView = $_POST['new_forest_view'];
    } else {
        // Default to 'no' if the value is invalid
        $newForestView = 'no';
    }
    // Validate and set new_shuttle_service value
    if (isset($_POST['new_shuttle_service']) && ($_POST['new_shuttle_service'] === 'yes' || $_POST['new_shuttle_service'] === 'no')) {
        $newShuttleService = $_POST['new_shuttle_service'];
    } else {
        // Default to 'no' if the value is invalid
        $newShuttleService = 'no';
    }
        // Validate and set newWifiService value
        if (isset($_POST['newWifiService']) && ($_POST['newWifiService'] === 'yes' || $_POST['newWifiService'] === 'no')) {
            $newWifiService = $_POST['newWifiService'];
        } else {
            // Default to 'no' if the value is invalid
            $newWifiService = 'no';
        }
    // Validate and set new_concierge_service value
    if (isset($_POST['new_concierge_service']) && ($_POST['new_concierge_service'] === 'yes' || $_POST['new_concierge_service'] === 'no')) {
        $newConciergeService = $_POST['new_concierge_service'];
    } else {
        // Default to 'no' if the value is invalid
        $newConciergeService = 'no';
    }

    $hotelManager->updateHotelAttributes($hotelId, $newHotelName, $newOverview, $newPricePerNight, $newStatus, $newNumberOfBeds, $newPoolAvail, $newBeachView, $newForestView, $newShuttleService, $newWifiService, $newConciergeService);

    // Redirect back to the same page after updating the hotel
    header("Location: removeHotel.php");
    exit;
}


// Get all hotels using the getAllHotels method
$allHotels = $hotelManager->getAllHotels();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../styling/css/removeHotels.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Nav Bar -->
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
    <div class="hotels-list">
    <?php foreach ($allHotels as $hotel) : ?>
        <div class="hotel-item">
            <img src="<?php echo $hotel['image_path']; ?>" alt="<?php echo $hotel['hotel_name']; ?>">
            <H2>Name: <?php echo $hotel['hotel_name']; ?></H2>
            <h3>ID: <?php echo $hotel['hotel_id']; ?></h3>
            <p>Overview: <?php echo $hotel['overview']; ?></p>
            <p>Price per Night: R<?php echo $hotel['price_per_night']; ?></p>
                    <?php echo '<p><i class="fas fa-bed"></i> Number of beds: ' . $hotel['number_of_beds'] . '</p>'; ?>
                    <?php echo '<p><i class="fas fa-swimming-pool"></i> Pool Availability: ' . $hotel['pool_avail'] . '</p>';?>
                    <?php echo '<p><i class="fas fa-umbrella-beach"></i> Beach within Walk distance: ' . $hotel['beach_view'] . '</p>';?>
                    <?php echo '<p><i class="fas fa-tree"></i> Forest within Walk distance: ' . $hotel['forest_view'] . '</p>';?>
                    <?php echo '<p><i class="fas fa-shuttle-van"></i> Shuttle Service: ' . $hotel['shuttle_service'] . '</p>';?>
                    <?php echo '<p><i class="fas fa-wifi"></i> WiFi Availability: ' . $hotel['wifi_service'] . '</p>';?>
                    <?php  echo '<p><i class="fas fa-concierge-bell"></i> Concierge Availability: ' . $hotel['concierge_service'] . '</p>';?>
                    <?php echo '<p><i class="fas fa-dollar-sign"></i> Price per night: R' . $hotel['price_per_night'] . '</p>';?>
            <form method="post">
                <input type="hidden" name="hotel_id" value="<?php echo $hotel['hotel_id']; ?>">
                <label for="new_hotel_name">Hotel Name:</label>
                <input type="text" id="new_hotel_name" name="new_hotel_name" placeholder="New Hotel Name" value="<?php echo $hotel['hotel_name']; ?>">
                
                <label for="new_overview">Overview:</label>
                <textarea id="new_overview" name="new_overview" placeholder="New Overview"><?php echo $hotel['overview']; ?></textarea>
                
                <label for="new_price_per_night">Price per Night:</label>
                <input type="number" id="new_price_per_night" name="new_price_per_night" placeholder="New Price per Night" value="<?php echo $hotel['price_per_night']; ?>">
                
                <label for="new_status">Status:</label>
                <select id="new_status" name="new_status">
                    <option value="Available" <?php if ($hotel['status'] == 'Available') echo 'selected'; ?>>Available</option>
                    <option value="Unavailable" <?php if ($hotel['status'] == 'Unavailable') echo 'selected'; ?>>Unavailable</option>
                </select>
                
                <label for="new_number_of_beds">Number of Beds:</label>
                <input type="number" id="new_number_of_beds" name="new_number_of_beds" placeholder="New Number of Beds" value="<?php echo $hotel['number_of_beds']; ?>">
                
                <label for="new_pool_avail">Pool Availability:</label>
                <select id="new_pool_avail" name="new_pool_avail">
                    <option value="yes" <?php if ($hotel['pool_avail'] == 'yes') echo 'selected'; ?>>Yes</option>
                    <option value="no" <?php if ($hotel['pool_avail'] == 'no') echo 'selected'; ?>>No</option>
                </select>

                <label for="new_beach_view">Beach View Availability:</label>
                <select id="new_beach_view" name="new_beach_view">
                    <option value="yes" <?php if ($hotel['beach_view'] == 'yes') echo 'selected'; ?>>Yes</option>
                    <option value="no" <?php if ($hotel['beach_view'] == 'no') echo 'selected'; ?>>No</option>
                </select>

                <label for="new_forest_view">Forest View Availability:</label>
                <select id="new_forest_view" name="new_forest_view">
                    <option value="yes" <?php if ($hotel['forest_view'] == 'yes') echo 'selected'; ?>>Yes</option>
                    <option value="no" <?php if ($hotel['forest_view'] == 'no') echo 'selected'; ?>>No</option>
                </select>

                <label for="new_shuttle_service">Shuttle Availability:</label>
                <select id="new_shuttle_service" name="new_shuttle_service">
                    <option value="yes" <?php if ($hotel['shuttle_service'] == 'yes') echo 'selected'; ?>>Yes</option>
                    <option value="no" <?php if ($hotel['shuttle_service'] == 'no') echo 'selected'; ?>>No</option>
                </select>

                <label for="newWifiService">WiFi Availability:</label>
                <select id="newWifiService" name="newWifiService">
                    <option value="yes" <?php if ($hotel['wifi_service'] == 'yes') echo 'selected'; ?>>Yes</option>
                    <option value="no" <?php if ($hotel['wifi_service'] == 'no') echo 'selected'; ?>>No</option>
                </select>

                <label for="new_concierge_service">Concierge Availability:</label>
                <select id="new_concierge_service" name="new_concierge_service">
                    <option value="yes" <?php if ($hotel['concierge_service'] == 'yes') echo 'selected'; ?>>Yes</option>
                    <option value="no" <?php if ($hotel['concierge_service'] == 'no') echo 'selected'; ?>>No</option>
                </select>
                
    
                
                <button type="submit" name="update_hotel">Update Hotel</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
</body>

</html>