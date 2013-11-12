-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2013 at 11:54 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mycartdb`
--
CREATE DATABASE `mycartdb` DEFAULT CHARACTER SET utf16 COLLATE utf16_general_ci;
USE `mycartdb`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  `parentId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `description`, `parentId`) VALUES
(1, 'all', 0),
(2, 'top', 1),
(3, 'bottom', 1),
(4, 'footwear', 1),
(5, 'misc', 1),
(6, 'accessories', 1),
(7, 'eyewear', 6),
(8, 'wristwear', 6),
(9, 'shirts', 2),
(10, 'singlets', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(35) NOT NULL,
  `lname` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(254) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `shipping` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `fname`, `lname`, `password`, `email`, `phone`, `address`, `shipping`) VALUES
(1, 'Matthew', 'Aisthorpe', 'admin', 'mattyace4@hotmail.com', '61434847969', 'Unit 2/14  \n Jephson St \n Toowong \n Toowong \n Australia \n QLD, 4066', '10 Dargai St    Moora  Australia  WA, 6510'),
(8, 'Link', 'Hylian', 'triforce', 'link@hyrule.com', '033473827', '120 E 87th Street \n  \n New York \n United States of America \n New York, 10128', '120 E 87th Street \n  \n New York \n United States of America \n New York, 10128');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerId` int(11) NOT NULL,
  `dateTimeOrdered` datetime NOT NULL,
  `paypalId` varchar(50) NOT NULL,
  `dateTimeSent` datetime DEFAULT NULL,
  `trackingId` int(11) DEFAULT NULL,
  `deliveryAddr` text,
  `billingAddr` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `customerId`, `dateTimeOrdered`, `paypalId`, `dateTimeSent`, `trackingId`, `deliveryAddr`, `billingAddr`) VALUES
(1, 1, '2013-09-17 05:09:28', '79E58157BN5460238', '2013-11-03 05:22:30', NULL, '10 dargai Street, Moora Western Australia 6510', NULL),
(2, 1, '2013-09-17 00:47:24', '25B79942AD136401N', '2013-11-03 05:13:13', NULL, '10 dargai Street Moora, Moora\nWestern Australia 6510', NULL),
(3, 1, '2013-09-17 02:05:35', '7L8467819H6561735', '2013-11-03 05:13:01', NULL, '10 dargai Street Moora\nWestern Australia 6510', NULL),
(4, 1, '2013-09-17 02:51:07', '6MK320666A7773454', NULL, NULL, '10 dargai Street Moora, Moora\nWestern Australia 6510', NULL),
(5, 1, '2013-09-17 03:29:26', '80Y33617LR894273C', '2013-11-03 05:12:45', NULL, '10 dargai Street Moora, Moora\nWestern Australia 6510', NULL),
(6, 1, '2013-09-17 03:33:56', '5F963882JW147852K', NULL, NULL, '10 dargai Street Moora, Moora\nWestern Australia 6510', NULL),
(7, 1, '2013-09-17 03:35:58', '5CY31784F35562620', NULL, NULL, '10 dargai Street Moora, Moora\nWestern Australia 6510', NULL),
(8, 1, '2013-09-17 03:57:10', '4D621921EK7739020', '2013-11-03 06:26:44', NULL, '10 dargai Street Moora, Moora\nWestern Australia 6510', NULL),
(9, 1, '2013-09-17 04:05:37', '7T069377NR690800F', NULL, NULL, '10 dargai Street Moora, Moora\nWestern Australia 6510', NULL),
(10, 1, '2013-09-23 04:33:44', '93V05856A3888633H', NULL, NULL, '10 dargai Street Moora, Moora\nWestern Australia 6510', NULL),
(11, 8, '2013-11-04 10:53:01', '91053164196508745', NULL, NULL, '2/14 Jephson st, Toowong\nQueensland 4066', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `image`, `archive`) VALUES
(1, 'Striped Shirt', '<p>A sheer striped shirt featuring a solid front and back yoke. Traditional collar. Full zipper placket. Long button cuffed sleeves. Finished hemline. Unlined. Woven. Lightweight.</p>', 'img/polo_a.jpg.jpg', 0),
(2, 'Dress Pants', '<p>Wear the pants, to have the dominant role, be in charge. I guess we know who wears the pants in that family.</p>', 'img/shorts_a.jpg.jpg', 1),
(3, 'Plain Shirt', '<p>T-shirts for Screen Printing,our Plain Tee Shirts are ideal for schools,clubs and team uniforms.</p>', 'img/shirt_c.jpg.jpg', 0),
(4, 'Canvas Shoes', '<p>A light shoe with a canvas upper and a rubber, leather, or fiber shoe</p>', 'img/polo_b.jpg.jpg', 1),
(5, 'Wallet', '<p>Leather wallet</p>', 'img/wallet_a.jpg.jpg', 1),
(6, 'Diving Watch', '<p>100m and 200m W/R Australian designed and hand finished watche that is both, stylish and practical, perfect for the Australian way of life.</p>', 'img/watch_a.jpg.jpg.jpg', 1),
(7, 'Glasses', '<p>A curved, slender, single-edged blade with a circular or squared guard and long grip to accommodate two hands.</p>', 'http://library.thinkquest.org/05aug/00716/Katana.gif', 1),
(8, 'Cargo Pants', 'Loosely cut pants designed for tough, outdoor activities distinguished by one or more cargo pockets', 'http://eurekareporters.com/wp-content/uploads/2013/01/cargo-pants-keef-reverse-by-burton-2.jpg', 1),
(9, 'Boots', 'Classic brown elastic sided dress boot design with heritage look cloth pull on tabs and new lightweight comfortable Nulite TPU sole. Designed and made in Australia.', 'http://www.westernworldsaddlery.com/contents/media/mens%20baxter%20western%20boots.jpg', 1),
(10, 'Singlet', 'The singlet has a round neck and relaxed fit.\r\n\r\nContrast colour and raw edge detail at the neckline and bottom hem adds a subtle point of difference.', 'http://jackedfibres.com/Ebay%20Listing%20Basic%20Y%20Back%20Singlet_files/Classic%20Singlet%20Sky%20Blue.jpg', 1),
(11, 'Almost Free Item', 'This item is the closest item to free we can provide for testing.', 'http://us.123rf.com/400wm/400/400/ermsla/ermsla1104/ermsla110400001/9270948-label-almost-free.jpg', 1),
(12, 'New product', '<p>A new product to test the form.</p>', 'img/shoes_a.jpg.jpg', 1),
(13, 'Jacket', '<p>This is a polo this that has both red and white stripes on the front and white and red strips on the back.</p>', 'img/jacket_a.jpg.jpg', 1),
(14, 'Button Shirt', '<p>This is a button up shirt.</p>', 'img/shirt_a.jpg.jpg', 1),
(15, 'Fantastic Watch', '<p>This is a new watch design with a quartz finish.</p>', 'img/watch_a.jpg.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`productId`, `categoryId`) VALUES
(1, 9),
(2, 3),
(3, 9),
(4, 4),
(5, 5),
(6, 8),
(7, 7),
(8, 3),
(9, 4),
(10, 10),
(11, 5),
(1, 9),
(3, 9),
(5, 5),
(6, 8),
(12, 4),
(13, 9),
(14, 9),
(15, 8);

-- --------------------------------------------------------

--
-- Table structure for table `product_cost`
--

CREATE TABLE IF NOT EXISTS `product_cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `product_cost`
--

INSERT INTO `product_cost` (`id`, `productId`, `dateTime`, `cost`) VALUES
(1, 1, '2013-08-14 00:00:00', 13.99),
(2, 2, '2013-08-14 00:00:00', 12.00),
(3, 3, '2013-08-14 00:00:00', 8.50),
(4, 4, '2013-08-14 00:00:00', 69.00),
(5, 5, '2013-08-14 00:00:00', 230.00),
(6, 6, '2013-08-14 00:00:00', 870.00),
(7, 7, '2013-08-14 00:00:00', 1200.00),
(8, 8, '2013-08-14 00:00:00', 25.00),
(9, 9, '2013-08-14 00:00:00', 120.00),
(10, 10, '2013-08-14 00:00:00', 5.00),
(11, 11, '2013-08-14 00:00:00', 0.01),
(12, 12, '2013-11-03 00:00:00', 23.00),
(13, 13, '2013-11-01 00:00:00', 25.00),
(14, 13, '2013-11-03 02:13:29', 32.00),
(15, 14, '2013-11-03 02:15:35', 15.00),
(16, 14, '2013-11-03 02:17:04', 15.00),
(17, 14, '2013-11-03 02:17:17', 15.00),
(18, 15, '2013-11-03 02:23:58', 250.00),
(19, 1, '2013-11-03 02:33:54', 13.99),
(20, 13, '2013-11-03 02:46:49', 25.00),
(21, 13, '2013-11-03 02:47:16', 25.00),
(22, 1, '2013-11-03 02:50:08', 13.50),
(23, 2, '2013-11-03 03:32:14', 12.00),
(24, 3, '2013-11-03 06:17:25', 8.50),
(25, 4, '2013-11-03 06:18:54', 69.00),
(26, 5, '2013-11-03 06:23:56', 230.00),
(27, 5, '2013-11-03 06:24:23', 230.00),
(28, 5, '2013-11-03 06:24:52', 230.00),
(29, 5, '2013-11-03 06:25:23', 230.00),
(30, 5, '2013-11-03 06:25:39', 23.00),
(31, 6, '2013-11-03 06:27:39', 870.00),
(32, 6, '2013-11-03 06:27:53', 870.00),
(33, 2, '2013-11-03 06:40:36', 12.00),
(34, 7, '2013-11-03 08:49:22', 250.00),
(35, 7, '2013-11-03 08:49:42', 1200.00),
(36, 13, '2013-11-04 11:42:34', 35.00),
(37, 13, '2013-11-04 11:45:15', 35.00),
(38, 13, '2013-11-04 11:47:29', 75.00);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE IF NOT EXISTS `product_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productVarId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`id`, `orderId`, `productId`, `productVarId`, `quantity`) VALUES
(1, 0, 11, 21, 1),
(2, 0, 11, 21, 1),
(3, 0, 11, 21, 1),
(4, 0, 11, 21, 1),
(5, 0, 11, 21, 1),
(6, 8, 11, 21, 1),
(7, 9, 11, 21, 3),
(8, 10, 11, 21, 1),
(9, 11, 11, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_variation`
--

CREATE TABLE IF NOT EXISTS `product_variation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `product_variation`
--

INSERT INTO `product_variation` (`id`, `description`, `productId`, `quantity`) VALUES
(1, 'S', 1, 3),
(2, 'M', 1, 4),
(3, 'XL', 1, 2),
(4, 'XXL', 1, 5),
(5, 'XXXL', 1, 4),
(6, 'Emo Black', 2, 4),
(7, 'Goth Black', 2, 4),
(8, 'white', 3, 2),
(9, 'red', 3, 1),
(10, 'blue', 3, 0),
(11, 'black with laces', 4, 4),
(12, 'One Shade 2 Cool', 5, 2),
(13, 'Crystal Face', 6, 1),
(14, 'Twin Blade', 7, 1),
(15, 'Big Pockets', 8, 1),
(16, 'Little Pockets', 8, 1),
(17, 'High Calf', 9, 2),
(18, 'White', 10, 3),
(19, 'Blue', 10, 3),
(20, 'Black', 10, 3),
(21, 'Free as it can be', 11, 1),
(22, 'Brown, 13D', 12, 5),
(23, 'XXXL', 13, 15),
(24, 'Blue, XL', 14, 32),
(25, 'Blue, XXL', 14, 15),
(26, 'Blue, XXXL', 14, 5),
(27, 'Round Face Watch', 15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
