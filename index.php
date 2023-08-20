<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stayhub</title>
    <link rel="stylesheet" href="./styling/css/index.css">
</head>

<body>
    <!-- Navigation Bar -->

    <nav class="navbar">
    <div class="logo">
        <h2>StayHub</h2>
    </div>
    <ul class="nav-links">
        <li><a href="<?php echo isset($_SESSION['user_id']) ? './pages/home.php' : './pages/login.php'; ?>">Home</a></li>
        <li><a href="<?php echo isset($_SESSION['user_id']) ? './pages/hotels.php' : './pages/login.php'; ?>">Hotels</a></li>
        <li><a href="<?php echo isset($_SESSION['user_id']) ? './pages/checkbookings.php' : './pages/checkbookings.php'; ?>">Check Bookings</a></li>
    </ul>
    <div class="user-buttons">
        <?php
        session_start();

        if (isset($_SESSION['user_id'])) {
            echo '<a href="./pages/logout.php">Logout</a>';
        } else {
            echo '<a href="./pages/login.php">Login</a>';
            echo '<a href="./pages/register.php">Register</a>';
        }
        ?>
    </div>
</nav>
 <!-- About Us section -->

    <div class="about-container">
        <div class="about-content">
            <img src="./styling/images/bckgrnd_imgs/aboutUsbckgrnd.jpg" alt="About Us Image">
            <div class="text-container">
                <h1>About Us</h1>
                <p>Welcome to StayHub, your ultimate hotel booking app! At StayHub, we are committed to revolutionizing your travel experience, one accommodation at a time. With a passion for enhancing your journey, we provide a seamless and convenient platform to explore and book your next hotel stay.</p>
                <p>Our mission is to ensure that your travel dreams come true by offering an extensive collection of accommodations that cater to your unique preferences. From luxurious resorts to charming boutique hotels, StayHub has something for every traveler.</p>
                <p>Our user-friendly platform empowers you to effortlessly browse through a diverse range of hotels, access detailed information, and effortlessly compare prices - all in one place. Whether you're embarking on a leisurely vacation or an important business trip, StayHub simplifies the process of discovering your ideal stay.</p>
                <p>We understand that the perfect stay is an integral part of any journey, and our dedication to excellence drives us to curate a selection that resonates with your individual needs. StayHub goes beyond booking; it's about making memories, fostering connections, and creating lasting impressions.</p>
                <p>However, it's important to note that while we are your ultimate destination for finding accommodation, we specialize exclusively in hotel bookings. As much as we'd love to help you soar through the skies and explore new horizons, we do not provide assistance with flights and visas. Our expertise lies in ensuring that your stay is comfortable, unforgettable, and hassle-free.</p>
                <p>Choose StayHub as your trusted travel companion and embark on a journey of unparalleled comfort, convenience, and discovery. Our commitment to providing exceptional service extends from our platform to your next adventure, and we're honored to be a part of your travel story.</p>
                <p>Thank you for choosing StayHub. Your journey is our inspiration.</p>
                <p>Select the different Countries below to see what hotels we support.</p>
            </div>
        </div>
    </div>


 <!-- tab Menu -->

    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'Europe')">Europe</button>
        <button class="tablinks" onclick="openTab(event, 'Africa')">Africa</button>
        <button class="tablinks" onclick="openTab(event, 'America')">America</button>
        <button class="tablinks" onclick="openTab(event, 'Asia')">Asia</button>
    </div>

    <div id="Europe" class="tabcontent">
        <h3>Europe</h3>
        <div class="hotel-cards">
            <div class="hotel-cards">
                <?php
                $host = 'localhost';
                $username = 'Mathew';
                $password = 'mysql@123';
                $database = 'stayhub';

                // Connect to the database
                $connection = mysqli_connect($host, $username, $password, $database);

                if (!$connection) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch hotel information from the tabmenu table
                $query = "SELECT hotel_name, image_path FROM tabmenu WHERE id BETWEEN 1 AND 5";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="hotel-card">';
                    echo '<img src="' . $row['image_path'] . '" alt="Hotel Image">';
                    echo '<h3>' . $row['hotel_name'] . '</h3>';
                    echo '</div>';
                }

                // Close the database connection
                mysqli_close($connection);
                ?>
            </div>
        </div>
    </div>

    <div id="Africa" class="tabcontent">
        <h3>Africa</h3>
        <div class="hotel-cards">
            <?php
            $host = 'localhost';
            $username = 'Mathew';
            $password = 'mysql@123';
            $database = 'stayhub';

            // Connect to the database
            $connection = mysqli_connect($host, $username, $password, $database);

            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch hotel information from the tabmenu table
            $query = "SELECT hotel_name, image_path FROM tabmenu WHERE id BETWEEN 6 AND 10";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="hotel-card">';
                echo '<img src="' . $row['image_path'] . '" alt="Hotel Image">';
                echo '<h3>' . $row['hotel_name'] . '</h3>';
                echo '</div>';
            }

            // Close the database connection
            mysqli_close($connection);
            ?>
        </div>
    </div>

    <div id="America" class="tabcontent">
        <h3>America</h3>
        <div class="hotel-cards">
            <?php
            $host = 'localhost';
            $username = 'Mathew';
            $password = 'mysql@123';
            $database = 'stayhub';

            // Connect to the database
            $connection = mysqli_connect($host, $username, $password, $database);

            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch hotel information from the tabmenu table
            $query = "SELECT hotel_name, image_path FROM tabmenu WHERE id BETWEEN 11 AND 15";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="hotel-card">';
                echo '<img src="' . $row['image_path'] . '" alt="Hotel Image">';
                echo '<h3>' . $row['hotel_name'] . '</h3>';
                echo '</div>';
            }

            // Close the database connection
            mysqli_close($connection);
            ?>
        </div>
    </div>
    <div id="Asia" class="tabcontent">
        <h3>Asia</h3>
        <div class="hotel-cards">
            <?php
            $host = 'localhost';
            $username = 'Mathew';
            $password = 'mysql@123';
            $database = 'stayhub';

            // Connect to the database
            $connection = mysqli_connect($host, $username, $password, $database);

            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch hotel information from the tabmenu table
            $query = "SELECT hotel_name, image_path FROM tabmenu WHERE id BETWEEN 16 AND 20";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="hotel-card">';
                echo '<img src="' . $row['image_path'] . '" alt="Hotel Image">';
                echo '<h3>' . $row['hotel_name'] . '</h3>';
                echo '</div>';
            }

            // Close the database connection
            mysqli_close($connection);
            ?>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2023 StayHub. All rights reserved.</p>
    </footer>
    <script>
        function openTab(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</body>

</html>