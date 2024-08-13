-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 07:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtocart`
--

CREATE TABLE `addtocart` (
  `addtocart_id` int(40) NOT NULL,
  `uid` int(55) NOT NULL,
  `pid` int(55) NOT NULL,
  `totalprize` text NOT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addtocart`
--

INSERT INTO `addtocart` (`addtocart_id`, `uid`, `pid`, `totalprize`, `uploaded_at`, `modified_at`) VALUES
(1, 6, 1, '80,000,000', '2024-08-13 10:00:27', '2024-08-13 10:00:27'),
(2, 1, 1, '90,000,000', '2024-08-13 10:01:20', '2024-08-13 10:01:20'),
(3, 2, 1, '90,000,000', '2024-08-13 10:01:20', '2024-08-13 10:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `oid` int(40) NOT NULL,
  `uid` int(55) NOT NULL,
  `pid` int(55) NOT NULL,
  `quantity` int(255) NOT NULL,
  `totalprize` text NOT NULL,
  `debitcard` int(20) NOT NULL,
  `address` varchar(2500) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`oid`, `uid`, `pid`, `quantity`, `totalprize`, `debitcard`, `address`, `uploaded_at`) VALUES
(1, 4, 1, 56, '8,000,000,00', 1893906767, 'Amaravati maharashtra', '2024-08-13 16:45:30'),
(2, 9, 1, 5, '63,000,000,00', 234567891, 'arvi, maharashtra', '2024-08-13 16:46:46'),
(3, 10, 4, 2, '1400', 674523456, 'mahalok, Ujjain', '2024-08-13 17:09:54'),
(4, 5, 4, 3, '2100', 672345633, 'ganpati ward,Arvi', '2024-08-13 17:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `productname` varchar(55) NOT NULL,
  `productcatogery` varchar(55) NOT NULL,
  `productprize` int(11) NOT NULL,
  `productdescription` text NOT NULL,
  `available` int(11) NOT NULL,
  `productimage` varchar(250) NOT NULL,
  `uploaded_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `productname`, `productcatogery`, `productprize`, `productdescription`, `available`, `productimage`, `uploaded_at`) VALUES
(1, 'apple iphone', 'electronics', 95000, '', 1, 'anulinkedin.jpg', '2024-08-10 23:32:20'),
(2, 'neclace', 'jwellery', 500, 'one of the prestigious neclace set ever ', 10, 'neclace.jpg', '2024-08-13 10:04:44'),
(3, 'bangles', 'jwellery', 250, 'bangles that add the glorious look in your beautifulness', 15, 'bangles.jpg', '2024-08-13 10:06:35'),
(4, 'tshirt', 'fashion', 700, 'tshirt that help you to wear and create the impression', 30, 'tshirt3.jpg', '2024-08-13 10:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `password`, `contact`, `photo`) VALUES
(1, 'khushi Taresh Jain', 'ktjain1456@gmail.com', 'khushi@123', '8767909773', ''),
(2, 'riti', 'rirti123@gmail.com', '29104544f0c04971daeeb42b3e178d3c', '6534567809', ''),
(3, 'ruchi', 'r@gmail.com', 'ruchi\'123', '123456789', ''),
(4, 'priyshre', 'pri@gmil.com', 'priya@!23', '9028794461', ''),
(5, 'krish', 'krish@gmail.com', 'krish234', '234567892', ''),
(6, 'anushkaJain', 'anushka@gmail.com', 'anu123', '7846926281', ''),
(7, 'yashika jain', 'yashu@gmail.com', 'khushi@123', '8946276543', 'demo.jpg'),
(8, 'khushi', 'admin@gmail.com', 'admin', '9478256734', 'demo.jpg'),
(9, 'sachi ganjiwale', 'sachi123@gmail.com', 'sachi@123', '9822155473', 'img6 - Copy - Copy.jpg'),
(10, 'saush ganjiwale', 'saish@gmail.com', 'saish@123', '9545900830', 'img6.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtocart`
--
ALTER TABLE `addtocart`
  ADD PRIMARY KEY (`addtocart_id`),
  ADD KEY `users` (`uid`),
  ADD KEY `products` (`pid`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `int` (`pid`),
  ADD KEY `order_details` (`uid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addtocart`
--
ALTER TABLE `addtocart`
  MODIFY `addtocart_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `oid` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addtocart`
--
ALTER TABLE `addtocart`
  ADD CONSTRAINT `products` FOREIGN KEY (`pid`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `users` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `int` FOREIGN KEY (`pid`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `order_details` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
