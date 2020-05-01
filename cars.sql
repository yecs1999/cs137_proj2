-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 05:18 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars`
--

-- --------------------------------------------------------

--
-- Table structure for table `cardata`
--

CREATE TABLE `cardata` (
  `category` varchar(20) NOT NULL,
  `pid` int(10) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `trim` varchar(50) NOT NULL,
  `color` varchar(20) NOT NULL,
  `year` int(18) NOT NULL,
  `odo` varchar(60) NOT NULL,
  `gearbox` varchar(30) NOT NULL,
  `engine` varchar(30) NOT NULL,
  `price` varchar(50) NOT NULL,
  `location` varchar(80) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cardata`
--

INSERT INTO `cardata` (`category`, `pid`, `make`, `model`, `trim`, `color`, `year`, `odo`, `gearbox`, `engine`, `price`, `location`, `description`) VALUES
('sports', 10, 'Chevrolet', 'Corvette Z06', 'LZ3', 'Yellow', 2016, '19000', 'Automatic', '6.2 8cyl', '60000', 'Tustin, CA', 'One owner example, Highway miles, AC, NAV, Supercharger, Heated Leather Seats, 20in Alloy Wheels, Paddle Shifters, Sunroof'),
('sports', 11, 'Lotus', 'Esprit', 'V8', 'Silver', 2003, '50000', 'Manual', '3.5 8cyl', '40000', 'Scottsdale, AZ', 'Family owned for 17 years, mostly highway miles, always maintained at lotus dealership. Very rare twin turbo v8 version, this is one of the last affordable exotic cars.'),
('hatch', 12, 'Honda', 'Fit', 'Sport', 'Blue', 2011, '90000', 'Manual', '1.5 4cyl', '5300', 'Oakland, CA', 'Commuter car, lots of space, folding seats, sport trim with zippy performance, always serviced on time, fuel efficient, very reliable.'),
('hatch', 13, 'Kia', 'Rio 4DR Hatchback', 'LX', 'Red', 2014, '40000', 'Manual', '1.6 4cyl', '7500', 'Washington, DC', 'Reliable car, Economic 35mpg, electric windows, beige interior, cargo net, cargo tray, carpet floor mats.'),
('sedan', 14, 'Ford', 'Fusion', 'SE', 'Black', 2017, '9800', 'Automatic', '1.5 4cyl', '14000', 'Milpitas, CA', 'Sunroof, NAV/GPS, Backup Camera, Black leather interior, heated front seats, ecoboost 30mpg combined.'),
('sedan', 15, 'Toyota', 'Camry', 'XLE', 'White', 2007, '120000', 'Automatic', '3.5 6cyl', '6000', 'Boise, ID', 'One owner, powerful engine, recently serviced, v6 33mpg combined, GPS/NAV.'),
('suv', 16, 'Kia', 'Sportage AWD', 'EX', 'Black', 2013, '73000', 'Automatic', '2.4 4cyl', '10000', 'Chicago, IL', 'AWD model, leather seats, heated front seats, Sirius traffic, push-button start, panoramic moonroof, homelink.'),
('suv', 17, 'Cadillac', 'Escalade', 'Platinum', 'Silver', 2018, '51800', 'Automatic', '6.2 8cyl', '52300', 'Little Rock, AR', '4WD, black leather seats, 16 speaker sound system, 3rd row seating, split bench, adaptive cruise control, SiriusXM, lane change assist, adaptive electronic suspension.'),
('minivan', 18, 'Honda', 'Odyssey', 'EX', 'Grey', 2013, '77000', 'Automatic', '3.5 6cyl', '11200', 'Atlanta, GA', '27 highway mpg, bluetooth connectivity, CD/DVD player, premium sound system, electric tilt wheel.'),
('minivan', 19, 'Chrysler', 'Town and Country', 'Touring', 'White', 2009, '140200', 'Automatic', '3.6 6cyl', '5720', 'Gary, IN', 'keyless entry, DVD player, usb audio interface, power liftgate, folding mirrors, power sliding doors, rear AC, third row seating, movable rows.');

-- --------------------------------------------------------

--
-- Table structure for table `carimages`
--

CREATE TABLE `carimages` (
  `pid` int(10) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carimages`
--

INSERT INTO `carimages` (`pid`, `image`) VALUES
(10, './img/sports/csp10/1.jpg'),
(10, './img/sports/csp10/2.jpg'),
(10, './img/sports/csp10/3.jpg'),
(11, './img/sports/csp11/1.jpg'),
(11, './img/sports/csp11/2.jpg'),
(11, './img/sports/csp11/3.jpg'),
(12, './img/hatch/ch10/1.jpg'),
(12, './img/hatch/ch10/2.jpg'),
(12, './img/hatch/ch10/3.jpg'),
(13, './img/hatch/ch11/1.jpg'),
(13, './img/hatch/ch11/2.jpg'),
(13, './img/hatch/ch10/3.jpg'),
(14, './img/sedan/cse10/1.jpg'),
(14, './img/sedan/cse10/2.jpg'),
(14, './img/sedan/cse10/3.jpg'),
(15, './img/sedan/cse11/1.jpg'),
(15, './img/sedan/cse11/2.jpg'),
(15, './img/sedan/cse11/3.jpg'),
(16, './img/suv/csu10/1.jpg'),
(16, './img/suv/csu10/2.jpg'),
(16, './img/suv/csu10/3.jpg'),
(17, './img/suv/csu11/1.jpg'),
(17, './img/suv/csu11/2.jpg'),
(17, './img/suv/csu11/3.jpg'),
(18, './img/minivan/cmi10/1.jpg'),
(18, './img/minivan/cmi10/2.jpg'),
(18, './img/minivan/cmi10/3.jpg'),
(18, './img/minivan/cmi11/1.jpg'),
(18, './img/minivan/cmi11/2.jpg'),
(18, './img/minivan/cmi11/3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cardata`
--
ALTER TABLE `cardata`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `carimages`
--
ALTER TABLE `carimages`
  ADD KEY `pid` (`pid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carimages`
--
ALTER TABLE `carimages`
  ADD CONSTRAINT `carimages_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `cardata` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
