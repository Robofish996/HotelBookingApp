-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2023 at 06:00 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stayhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `overview` text,
  `price_per_night` decimal(10,2) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `number_of_beds` int(11) DEFAULT NULL,
  `pool_avail` enum('yes','no') DEFAULT NULL,
  `beach_view` enum('yes','no') DEFAULT NULL,
  `forest_view` enum('yes','no') DEFAULT NULL,
  `shuttle_service` enum('yes','no') DEFAULT NULL,
  `wifi_service` enum('yes','no') DEFAULT NULL,
  `concierge_service` enum('yes','no') DEFAULT NULL,
  `room_image` varchar(255) DEFAULT NULL,
  `bath_image` varchar(255) DEFAULT NULL,
  `view_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `hotel_name`, `overview`, `price_per_night`, `image_path`, `status`, `number_of_beds`, `pool_avail`, `beach_view`, `forest_view`, `shuttle_service`, `wifi_service`, `concierge_service`, `room_image`, `bath_image`, `view_image`) VALUES
(1, 'Grand View Hotel', 'Experience luxury and comfort like never before at the Grand View Hotel. With stunning panoramic views, modern amenities, and impeccable service, we offer an unforgettable stay for both business and leisure travelers.\r\n', '1500.00', '../styling/images/hotels/grandViewHotel.jpg', 'Available', 1, 'yes', 'no', 'no', 'yes', 'yes', 'yes', '../styling/images/hotelRoom/Grand_view_hotel_room.jpg', '../styling/images/hotelBath/Grand_view_hotel_bathroom.jpg', '../styling/images/hotelView/Grand_view_hotel_view.jpg'),
(2, 'Oceanfront Paradise Resort', 'Dive into relaxation at Oceanfront Paradise Resort. Our pristine sandy beaches, crystal-clear waters, and endless activities make us the perfect destination for families and couples seeking a tropical getaway.', '3000.00', '../styling/images/hotels/oceanFrontParadiseResort.jpg', 'Available', 2, 'yes', 'yes', 'no', 'no', 'yes', 'no', '../styling/images/hotelRoom/Oceanfront_paradise_resort_room.jpg', '../styling/images/hotelBath/Oceanfront_paradise_resort_bathtoom.jpg', '../styling/images/hotelView/Oceanfront_paradise_resort_view.jpg'),
(3, 'Mountain Retreat Lodge', 'Escape to the tranquility of the mountains at Mountain Retreat Lodge. Surround yourself with nature\'s beauty, enjoy hiking trails, and savor gourmet dining while experiencing the utmost in relaxation.', '3599.00', '../styling/images/hotels/mountainRetreatLodge.jpg', 'Available', 2, 'no', 'no', 'yes', 'yes', 'no', 'no', '../styling/images/hotelRoom/Mountain_retreat_lodge_room.jpg', '../styling/images/hotelBath/Mountain_retreat_lodge_bathroom.jpg', '../styling/images/hotelView/Mountain_retreat_lodge_view.jpg'),
(4, 'Tranquil Oasis Inn', 'Find solace and serenity at the Tranquil Oasis Inn. Nestled away from the bustle of the city, our peaceful ambiance, comfortable rooms, and wellness facilities offer an ideal escape from everyday life.', '999.00', '../styling/images/hotels/tranquilOasisInn.jpg', 'Available', 1, 'no', 'no', 'yes', 'no', 'yes', 'yes', '../styling/images/hotelRoom/Tranquil_oasis_inn_room.jpg', '../styling/images/hotelBath/Tranquil_oasis_inn_bathroom.jpg', '../styling/images/hotelView/Tranquil_oasis_inn_view.jpg'),
(5, 'Sunset Beach Resort', 'Embrace the magic of breathtaking sunsets at Sunset Beach Resort. Our oceanfront location, beachside dining, and vibrant nightlife options ensure an unforgettable coastal vacation.', '1000.00', '../styling/images/hotels/sunsetBeachResort.jpg', 'Available', 1, 'no', 'yes', 'no', 'yes', 'no', 'yes', '../styling/images/hotelRoom/Sunset_beach_resort-room.jpg', '../styling/images/hotelBath/Sunset_beach_resort-bathroom.jpg', '../styling/images/hotelView/Sunset_beach_resort-view.jpg'),
(6, 'Serenity Valley Hotel', 'Discover a world of calm and serenity at Serenity Valley Hotel. Surrounded by lush greenery, our hotel offers a sanctuary of peace with comfortable accommodations and holistic wellness activities.', '4999.00', '../styling/images/hotels/serenityValleyHotel.jpg', 'Available', 2, 'yes', 'no', 'no', 'no', 'yes', 'no', '../styling/images/hotelRoom/Serenity_valley_hotel_room.jpg', '../styling/images/hotelBath/Serenity_valley_hotel_bathroom.jpg', '../styling/images/hotelView/Serenity_valley_hotel_view.jpg'),
(7, 'Cityscape Suites', 'Immerse yourself in urban luxury at Cityscape Suites. Located in the heart of the city, our stylish suites, gourmet dining, and proximity to attractions cater to both business and leisure travelers.', '750.00', '../styling/images/hotels/cityScapeSuites.jpg', 'Available', 1, 'yes', 'no', 'no', 'yes', 'no', 'no', '../styling/images/hotelRoom/Cityscape_suites_room.jpg', '../styling/images/hotelBath/Cityscape_suites_bathroom.jpg', '../styling/images/hotelView/Cityscape_suites_view.jpg'),
(8, 'Lakeside Haven Lodge', 'Unwind by the tranquil lakeside at Lakeside Haven Lodge. With charming cabins, water activities, and a cozy atmosphere, we provide an idyllic escape for families and nature enthusiasts.', '2599.00', '../styling/images/hotels/lakeSideHavenLodge.jpg', 'Available', 2, 'no', 'no', 'no', 'no', 'yes', 'yes', '../styling/images/hotelRoom/Lakesided_haven_lodge_rooom.jpg', '../styling/images/hotelBath/Lakesided_haven_lodge_bathroom.jpg', '../styling/images/hotelView/Lakesided_haven_lodge_view.jpg'),
(9, 'Royal Garden Inn', 'Experience regal elegance at the Royal Garden Inn. Our opulent rooms, impeccable service, and lush gardens create an enchanting setting fit for royalty.', '1000.00', '../styling/images/hotels/royalGardenInn.jpg', 'Available', 1, 'no', 'no', 'no', 'yes', 'no', 'yes', '../styling/images/hotelRoom/Royal_garden_inn_room.jpg', '../styling/images/hotelBath/Royal_garden_inn_bathroom.jpg', '../styling/images/hotelView/Royal_garden_inn_view.jpg'),
(10, 'Harbor View Resort', 'Enjoy a picturesque waterfront retreat at Harbor View Resort. Our stunning harbor views, comfortable accommodations, and maritime adventures offer an authentic coastal experience.', '3000.00', '../styling/images/hotels/harborViewResort.jpg', 'Available', 2, 'yes', 'yes', 'no', 'no', 'yes', 'no', '../styling/images/hotelRoom/Harbor_view_resort_room.jpg', '../styling/images/hotelBath/Harbor_view_resort_bathroom.jpg', '../styling/images/hotelView/Harbor_view_resort_view.jpg'),
(11, 'Wilderness Lodge Retreat', 'Embrace the great outdoors at Wilderness Lodge Retreat. Surrounded by untouched nature, our lodge provides rustic charm, outdoor excursions, and a rustic getaway.', '1670.57', '../styling/images/hotels/wildernessLodgeRetreat.jpg', 'Available', 1, 'yes', 'no', 'yes', 'yes', 'no', 'no', '../styling/images/hotelRoom/Wilderness_lodge_retreat_room.jpg', '../styling/images/hotelBath/Wilderness_lodge_retreat_bathroom.jpg', '../styling/images/hotelView/Wilderness_lodge_retreat_view.jpg'),
(12, 'Urban Oasis Hotel', 'Recharge in the heart of the city at Urban Oasis Hotel. Our modern amenities, sleek design, and vibrant neighborhood make us the perfect choice for urban explorers.', '3499.00', '../styling/images/hotels/urbanOasisHotel.jpg', 'Available', 2, 'no', 'no', 'no', 'no', 'yes', 'yes', '../styling/images/hotelRoom/Urban_oasis_hotel_room.jpg', '../styling/images/hotelBath/Urban_oasis_hotel_bathroom.jpg', '../styling/images/hotelView/Urban_oasis_hotel_view.jpg'),
(13, 'Paradise Cove Retreat', 'Find your paradise at Paradise Cove Retreat. Set against a backdrop of turquoise waters and lush gardens, our resort offers relaxation, adventure, and unforgettable memories.', '1507.20', '../styling/images/hotels/paradiseCoveRetreat.jpg', 'Available', 1, 'no', 'no', 'no', 'yes', 'no', 'yes', '../styling/images/hotelRoom/Paradise_cove_retreat_room.jpg', '../styling/images/hotelBath/Paradise_cove_retreat_bathroom.jpg', '../styling/images/hotelView/Paradise_cove_retreat_view.jpg'),
(14, 'Skyline Heights Suites', 'Rise above the city at Skyline Heights Suites. Our panoramic views, contemporary style, and easy access to city attractions create a seamless blend of comfort and excitement.', '2300.00', '../styling/images/hotels/skylineHeightsSuites.jpg', 'Available', 2, 'no', 'no', 'no', 'no', 'yes', 'no', '../styling/images/hotelRoom/Skyline_heights_suites_room.jpg', '../styling/images/hotelBath/Skyline_heights_suites_bathroom.jpg', '../styling/images/hotelView/Skyline_heights_suites_view.jpg'),
(15, 'Coastal Breeze Resort', 'Experience the refreshing coastal breeze at Coastal Breeze Resort. With direct beach access, ocean-inspired decor, and beachfront dining, we offer the ultimate seaside escape.', '1343.83', '../styling/images/hotels/coastalBreezeResort.jpg', 'Available', 1, 'no', 'yes', 'no', 'yes', 'no', 'no', '../styling/images/hotelRoom/Coastal_breeze_resort_room.jpg', '../styling/images/hotelBath/Coastal_breeze_resort_bathroom.jpg', '../styling/images/hotelView/Coastal_breeze_resort_view.jpg'),
(16, 'Enchanted Forest Inn', 'Step into an enchanting world at Enchanted Forest Inn. Our woodland retreat features charming cottages, whimsical decor, and an array of outdoor activities for all ages.', '4262.15', '../styling/images/hotels/enchantedForestInn.jpg', 'Available', 2, 'yes', 'no', 'yes', 'no', 'yes', 'yes', '../styling/images/hotelRoom/Enchanted_forest_inn_room.jpg', '../styling/images/hotelBath/Enchanted_forest_inn_bathroom.jpg', '../styling/images/hotelView/Enchanted_forest_inn_view.jpg'),
(17, 'Seaside Bliss Hotel', 'Revel in seaside bliss at Seaside Bliss Hotel. Our coastal charm, luxurious accommodations, and oceanfront relaxation guarantee a memorable coastal vacation.', '1180.47', '../styling/images/hotels/seasideBlissHotel.jpg', 'Available', 1, 'yes', 'no', 'no', 'yes', 'no', 'yes', '../styling/images/hotelRoom/Seaside_bliss_hotel_room.jpg', '../styling/images/hotelBath/Seaside_bliss_hotel_bathroom.jpg', '../styling/images/hotelView/Seaside_bliss_hotel_view.jpg'),
(18, 'Majestic Mountain Resort', 'Reach new heights of luxury at Majestic Mountain Resort. Surrounded by majestic peaks, our resort offers opulent rooms, outdoor adventures, and gourmet dining.', '3098.78', '../styling/images/hotels/majesticMountainResort.jpg', 'Available', 2, 'no', 'no', 'no', 'no', 'yes', 'no', '../styling/images/hotelRoom/Majestic_mountain_resort_room.jpg', '../styling/images/hotelBath/Majestic_mountain_resort_bathroom.jpg', '../styling/images/hotelView/Majestic_mountain_resort_view.jpg'),
(19, 'Riverside Retreat Inn', 'Find comfort by the riverside at Riverside Retreat Inn. Our cozy accommodations, riverfront views, and a variety of outdoor activities provide the perfect escape.', '1017.10', '../styling/images/hotels/riversideRetreatInn.jpg', 'Available', 1, 'no', 'no', 'no', 'yes', 'no', 'no', '../styling/images/hotelRoom/Riverside_mountain_inn_room.jpg', '../styling/images/hotelBath/Riverside_mountain_inn_bathroom.jpg', '../styling/images/hotelView/Riverside_mountain_inn_view.jpg'),
(20, 'Charming Village Inn', 'Experience the charm of a quaint village at Charming Village Inn. Our historic inn, local character, and personalized service offer a unique and delightful stay.', '935.42', '../styling/images/hotels/charmingVillageInn.jpg', 'Available', 1, 'yes', 'no', 'no', 'no', 'yes', 'yes', '../styling/images/hotelRoom/Charming_village_inn_room.jpg', '../styling/images/hotelBath/Charming_village_inn_bathroom.jpg', '../styling/images/hotelView/Charming_village_inn_view.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `time_of_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `number_of_nights` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `hotel_id`, `check_in_date`, `check_out_date`, `total_price`, `time_of_order`, `number_of_nights`) VALUES
(8, 1, 2, '2023-08-14', '2023-08-18', '12000.00', '2023-08-13 17:19:10', 4),
(10, 41, 1, '2023-08-17', '2023-08-24', '10500.00', '2023-08-14 01:09:37', 7),
(11, 1, 10, '2023-08-17', '2023-08-16', '3000.00', '2023-08-15 15:07:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabmenu`
--

CREATE TABLE `tabmenu` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tabmenu`
--

INSERT INTO `tabmenu` (`id`, `hotel_name`, `image_path`) VALUES
(1, 'Grand View Hotel', './styling/images/hotels/grandViewHotel.jpg'),
(2, 'Oceanfront Paradise Resort', './styling/images/hotels/oceanFrontParadiseResort.jpg'),
(3, 'Mountain Retreat Lodge', './styling/images/hotels/mountainRetreatLodge.jpg'),
(4, 'Tranquil Oasis Inn', './styling/images/hotels/tranquilOasisInn.jpg'),
(5, 'Sunset Beach Resort', './styling/images/hotels/sunsetBeachResort.jpg'),
(6, 'Serenity Valley Hotel', './styling/images/hotels/serenityValleyHotel.jpg'),
(7, 'Cityscape Suites', './styling/images/hotels/cityScapeSuites.jpg'),
(8, 'Lakeside Haven Lodge', './styling/images/hotels/lakeSideHavenLodge.jpg'),
(9, 'Royal Garden Inn', './styling/images/hotels/royalGardenInn.jpg'),
(10, 'Harbor View Resort', './styling/images/hotels/harborViewResort.jpg'),
(11, 'Wilderness Lodge Retreat', './styling/images/hotels/wildernessLodgeRetreat.jpg'),
(12, 'Urban Oasis Hotel', './styling/images/hotels/urbanOasisHotel.jpg'),
(13, 'Paradise Cove Retreat', './styling/images/hotels/paradiseCoveRetreat.jpg'),
(14, 'Skyline Heights Suites', './styling/images/hotels/skylineHeightsSuites.jpg'),
(15, 'Coastal Breeze Resort', './styling/images/hotels/coastalBreezeResort.jpg'),
(16, 'Enchanted Forest Inn', './styling/images/hotels/enchantedForestInn.jpg'),
(17, 'Seaside Bliss Hotel', './styling/images/hotels/seasideBlissHotel.jpg'),
(18, 'Majestic Mountain Resort', './styling/images/hotels/majesticMountainResort.jpg'),
(19, 'Riverside Retreat Inn', './styling/images/hotels/riversideRetreatInn.jpg'),
(20, 'Charming Village Inn', './styling/images/hotels/charmingVillageInn.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin','blocked') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'kyla', 'kyla@example.com', '$2y$10$Ximcxaq2PpFo01XYVQZjb.qJwji8c1qYkfy83mN3JJa8kGqYu3iOS', 'customer'),
(41, 'matt', 'test@test.com', '$2y$10$aFcNC2ekBlMrKcGb.hzAleuYUXSuLUY3sgi8Z01GmT/1AFaS0zqQC', 'admin'),
(42, 'carl', 'carl@example.com', '$2y$10$.XNOvJzcvPfJBvhxmug2peLdvgkduBMldRdh2fLOOSFWEidR/nhhq', 'admin'),
(43, 'Elz', 'cas@example.com', '$2y$10$.QMSAVYmg/zfm7hB9mOKL./9vSm/l2WCWiIrNR6K7SQ3sNhvt9lbu', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tabmenu`
--
ALTER TABLE `tabmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
