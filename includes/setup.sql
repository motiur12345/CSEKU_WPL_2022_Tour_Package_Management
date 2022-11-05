SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `admin_firstname` varchar(255) NOT NULL,
  `admin_lastname` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_contact` varchar(255) NOT NULL,
  `admin_profile_image` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `agencies` (
  `agency_id` int(11) NOT NULL,
  `agency_name` varchar(255) NOT NULL,
  `agency_firstname` varchar(255) NOT NULL,
  `agency_lastname` varchar(255) NOT NULL,
  `agency_email` varchar(255) NOT NULL,
  `agency_password` varchar(255) NOT NULL,
  `agency_contact` varchar(255) NOT NULL,
  `agency_address` varchar(255) NOT NULL,
  `agency_profile_image` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `tourist_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `tourist_firstname` varchar(255) NOT NULL,
  `tourist_lastname` varchar(255) NOT NULL,
  `tourist_email` varchar(255) NOT NULL,
  `tourist_contact` varchar(255) NOT NULL,
  `booking_status` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `package_images` text NOT NULL,
  `num_days` int(11) NOT NULL,
  `num_nights` int(11) NOT NULL,
  `budget_price` int(11) NOT NULL,
  `package_details` text NOT NULL,
  `package_status` varchar(255) NOT NULL,
  `package_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `agency_id` int(11) NOT NULL,
  `tourist_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `tourists` (
  `tourist_id` int(11) NOT NULL,
  `tourist_username` varchar(255) NOT NULL,
  `tourist_firstname` varchar(255) NOT NULL,
  `tourist_lastname` varchar(255) NOT NULL,
  `tourist_email` varchar(255) NOT NULL,
  `tourist_password` varchar(255) NOT NULL,
  `tourist_contact` varchar(255) NOT NULL,
  `tourist_address` varchar(255) NOT NULL,
  `profile_image` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `contact_us` (
  `contact_us_id` int(11) NOT NULL,
  `contact_us_username` varchar(255) NOT NULL,
  `contact_us_email` varchar(255) NOT NULL,
  `contact_us_phone` varchar(255) NOT NULL,
  `messages` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`agency_id`);


-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `tourist_id` (`tourist_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `tourist_id` (`tourist_id`);

--
-- Indexes for table `tourists`
--
ALTER TABLE `tourists`
  ADD PRIMARY KEY (`tourist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;



--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;


--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;



--
-- AUTO_INCREMENT for table `tourists`
--
ALTER TABLE `tourists`
  MODIFY `tourist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;


--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`tourist_id`) REFERENCES `tourists` (`tourist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`) ON DELETE CASCADE;



--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`) ON DELETE CASCADE ON UPDATE CASCADE;



--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_4` FOREIGN KEY (`tourist_id`) REFERENCES `tourists` (`tourist_id`) ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
