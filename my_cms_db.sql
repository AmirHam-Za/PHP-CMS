-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 10:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_cms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(11, 'News'),
(12, 'Sports'),
(13, 'Career');

-- --------------------------------------------------------

--
-- Table structure for table `category_tag`
--

CREATE TABLE `category_tag` (
  `category_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `name`, `comment`, `created_at`) VALUES
(75, 'Amir Hamza', 'is simply dummy text of the printing and typesetting industry.', '2023-12-17 16:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT 'Mr. Commentor',
  `comment` text DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `comment`, `post_id`, `created_at`) VALUES
(58, 'Alamin Shikder', 'The formatting rules are not configurable but are already optimized for the best possible output. Note that the ', 5, '2023-12-17 22:29:03'),
(61, 'Nur Mohammad', 'Travelling is the best entertainment!!!!!!!!!!!!!!', 0, '2023-12-18 10:13:03'),
(77, 'Alamin', 'Well Done!!!!!', 70, '2023-12-22 21:24:00'),
(78, 'Tuhin', 'NIce', 70, '2023-12-22 21:24:18'),
(79, 'ওয়ান ব্যাংক', ' কোনো অভিজ্ঞতার প্রয়োজন নেই', 71, '2023-12-22 21:32:24'),
(80, 'সেলস অফিসার', 'প্রতিষ্ঠানটি ট্রেইনি সেলস অফিসার পদে কর্মী নিয়োগ দেবে', 71, '2023-12-22 21:33:08'),
(81, ' টিয়া পাখি', 'বিদ্যুতের তারে আটকে পড়েছিল টিয়া পাখি', 72, '2023-12-22 21:40:10'),
(82, 'স্বেচ্ছাসেবী', 'সেই টিয়া পাখি উদ্ধার করতে গিয়ে বিদ্যুৎস্পৃষ্ট হন স্বেচ্ছাসেবী', 72, '2023-12-22 21:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `read_time` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `description`, `image`, `read_time`, `category_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(70, 'আইপিএল নিলামের সবচেয়ে দামি ৫', 'ইংল্যান্ড অলরাউন্ডার ও টেস্ট অধিনায়কের ভিত্তিমূল্য ছিল ২ কোটি রুপি। সানরাইজার্স হায়দরাবাদ, লক্ষ্ণৌ সুপার জায়ান্টস ও চেন্নাইয়ের ত্রিমুখী লড়াইয়ের পর তাঁকে ১৬ কোটি ২৫ লাখ রুপিতে কেনে চেন্নাই। তবে ২০২৩ সালে সর্বোচ্চ দামি দুজন খেলোয়াড়ের ভেতরে ছিলেন না তিনি।', 'uploads/Screenshot_9.png', 1, 12, 14, '2023-12-22 21:18:50', '2023-12-22 21:18:50'),
(71, 'ওয়ান ব্যাংকে স্নাতক পাসে চাকরি', 'বেসরকারি ওয়ান ব্যাংক লিমিটেড জনবল নিয়োগে বিজ্ঞপ্তি প্রকাশ করেছে। প্রতিষ্ঠানটি ট্রেইনি সেলস অফিসার পদে কর্মী নিয়োগ দেবে। আগ্রহী প্রার্থীদের অনলাইনে আবেদন করতে হবে। এ পদের আবেদনের জন্য কোনো অভিজ্ঞতার প্রয়োজন নেই।', 'uploads/Screenshot_11.png', 1, 13, 11, '2023-12-22 21:28:57', '2023-12-22 21:28:57'),
(72, 'টিয়া পাখি উদ্ধারে গিয়ে বিদ্যুৎস্পৃষ্ট', 'বিদ্যুতের তারে আটকে পড়েছিল টিয়া পাখি। সেই টিয়া পাখি উদ্ধার করতে গিয়ে বিদ্যুৎস্পৃষ্ট হন স্বেচ্ছাসেবী সংগঠন ‘রবিনহুড-দ্য অ্যানিমেল রেসকিউয়ার’–এর তিন স্বেচ্ছাসেবী। পরে তাঁদের একজন চিকিৎসাধীন অবস্থায় মারা গেছেন। ঢাকার দক্ষিণ কেরানীগঞ্জের হাসনাবাদ এলাকায় বৃহস্পতিবার বিকেলে এ ঘটনা ঘটে। ', 'uploads/Screenshot_12.png', 3, 11, 15, '2023-12-22 21:31:26', '2023-12-22 21:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`id`, `name`) VALUES
(32, 'Syed Amir Hamza');

-- --------------------------------------------------------

--
-- Table structure for table `header_footer`
--

CREATE TABLE `header_footer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `header_footer`
--

INSERT INTO `header_footer` (`id`, `name`, `logo_path`) VALUES
(39, 'Syed Amir Hamza', 'uploadsBMW_logo_(gray).svg.png');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`) VALUES
(1, 'Home'),
(2, 'About'),
(3, 'Contact');

-- --------------------------------------------------------

--
-- Table structure for table `submenus`
--

CREATE TABLE `submenus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submenus`
--

INSERT INTO `submenus` (`id`, `name`, `menu_id`) VALUES
(1, 'Sub 1.1', 1),
(2, 'Submenu 1.2', 1),
(3, 'Submenu 2.1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(11, 'Programming'),
(14, 'International'),
(15, 'Recent');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(12, 'admin', '$2y$10$21FsBCmD3xj3YWNpFe9pWu9x0awohvvOscXawdkCBpogxD7wXboYK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_tag`
--
ALTER TABLE `category_tag`
  ADD PRIMARY KEY (`category_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_footer`
--
ALTER TABLE `header_footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenus`
--
ALTER TABLE `submenus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `header_footer`
--
ALTER TABLE `header_footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `submenus`
--
ALTER TABLE `submenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_tag`
--
ALTER TABLE `category_tag`
  ADD CONSTRAINT `category_tag_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `category_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `content_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `submenus`
--
ALTER TABLE `submenus`
  ADD CONSTRAINT `submenus_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
