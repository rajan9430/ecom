-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 07:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myweb_ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` int(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address_one` text NOT NULL,
  `address_two` text DEFAULT NULL,
  `city_name` varchar(100) NOT NULL,
  `pincode` int(6) NOT NULL,
  `state_name` varchar(50) NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `first_name`, `last_name`, `phone_number`, `email`, `address_one`, `address_two`, `city_name`, `pincode`, `state_name`, `country_name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Rajan', 'Tiwari test', 2147483647, 'hellotiwari94@gmail.com', 'jolva', 'jolva', 'Surat', 394305, 'Gujarat', 'India', 2, '2024-10-06 14:33:41', '2024-10-06 12:56:15'),
(2, 'shivam', 'mishra', 1254625466, 'shivam.2114503921@mujonline.edu.in', 'prayagraj', 'gaw', 'allahabad', 135646, 'utter pradesh', 'India', 2, '2024-10-06 14:59:37', '2024-10-06 12:59:37'),
(3, 'Rajan', 'Tiwari', 2147483647, 'hellotiwari94@gmail.com', 'jolva', 'jolva', 'Surat', 394305, 'Gujarat', 'India', 2, '2024-10-11 07:40:35', '2024-10-11 05:40:35'),
(4, 'sky', 'test', 243546, 'vikash@gmail.com', 'sadksfgkddkj', 'sdgjdfbk', 'new delhi', 233001, 'delhi', 'India', 1, '2024-10-21 19:52:50', '2024-10-21 17:52:50'),
(5, 'second', 'name', 2147483647, 'vishal_baba@gmail.com', 'dayanand colony', 'lajpat nagar 4', 'New delhi', 110024, 'Delhi', 'India', 1, '2024-10-21 20:11:32', '2024-10-21 18:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'admin', '$2y$10$fw8Lu8u9bVXFsjLfxifcA.MGNQSbfIT4QWnDOSeLqq/4wU2lp1XCO', '', '2024-10-24 20:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_slug_name` varchar(255) NOT NULL,
  `brand_category_id` varchar(50) NOT NULL,
  `brand_created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_slug_name`, `brand_category_id`, `brand_created_at`) VALUES
(1, 'Lenovo', 'lenovo-1', '2', '2024-05-05 09:24:06'),
(2, 'Samaung', 'samaung', '1', '2024-05-05 08:22:36'),
(3, 'Samaung', 'samaung-1', '3', '2024-05-05 08:22:55'),
(4, 'Nike', 'nike', '4', '2024-05-05 08:24:19'),
(5, 'Oppo', 'oppo', '1', '2024-05-06 10:39:35'),
(6, 'VIVO', 'vivo', '1', '2024-05-05 08:25:35'),
(7, 'Dell', 'dell', '5', '2024-05-06 10:21:27'),
(8, 'Puma', 'puma', '4', '2024-05-07 07:51:24'),
(9, 'Adidas', 'adidas', '4', '2024-05-07 07:51:40'),
(10, 'Sky bags', 'sky-bags', '6', '2024-05-07 08:07:30'),
(11, 'micramax', 'micramax', '1', '2024-06-26 06:40:52'),
(12, 'DELL', 'dell-1', '2', '2024-10-03 02:47:04'),
(13, 'Tliphone', 'tliphone', '1', '2024-10-03 02:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug_url` varchar(255) NOT NULL,
  `cat_created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_slug_url`, `cat_created_at`) VALUES
(1, 'Mobile', 'mobile', '2024-05-05 11:39:15'),
(2, 'Laptop', 'laptop', '2024-05-05 11:39:27'),
(3, 'TV', 'tv', '2024-05-05 11:39:38'),
(4, 'T-Shirt', 't-shirt', '2024-05-05 11:39:54'),
(5, 'Mouse', 'mouse', '2024-05-06 14:05:05'),
(6, 'Bag', 'bag', '2024-05-07 11:36:01'),
(7, 'Landline', 'landline', '2024-10-03 06:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_address_id` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  `created_at` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `order_date`, `order_address_id`, `payment_method`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 1, 29590, '2024-10-25 05:50:01', 5, 'cod', 'pending', '2024-10-22 22:35:48', '2024-10-22 20:35:48'),
(2, 1, 51539, '2024-10-24 21:18:18', 4, 'cod', 'shipped', '2024-10-22 23:22:07', '2024-10-22 21:22:07'),
(4, 2, 293598, '2024-10-25 06:19:40', 1, 'cod', 'waiting', '2024-10-25 08:19:40', '2024-10-25 06:19:40'),
(5, 2, 130990, '2024-10-25 07:54:26', 3, 'cod', 'waiting', '2024-10-25 09:54:26', '2024-10-25 07:54:26'),
(6, 2, 352498, '2024-10-27 11:13:13', 3, 'cod', 'waiting', '2024-10-27 12:13:13', '2024-10-27 11:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`) VALUES
(1, 1, 9, 'Sky bag Adjustable Straps', 1, 990.00),
(2, 1, 7, 'Dell KM 636', 2, 550.00),
(3, 1, 6, 'VIVO V27 Pro', 1, 27500.00),
(4, 2, 8, 'Nike Air', 1, 550.00),
(5, 2, 9, 'Sky bag Adjustable Straps', 1, 990.00),
(6, 2, 5, 'OPPO RENO 7PRO', 1, 49999.00),
(7, 3, 2, 'Samsung Glaxy a04s', 1, 30000.00),
(8, 3, 1, 'Samsung Glaxy S22 Ultra', 1, 130000.00),
(9, 4, 1, 'Samsung Glaxy S22 Ultra', 1, 130000.00),
(10, 4, 4, 'Lenovo Ideapad 330', 1, 32999.00),
(11, 4, 6, 'VIVO V27 Pro', 1, 27500.00),
(12, 4, 5, 'OPPO RENO 7PRO', 1, 49999.00),
(13, 4, 8, 'Nike Air', 1, 550.00),
(14, 4, 7, 'Dell KM 636', 1, 550.00),
(15, 4, 10, 'DELL Laptop', 1, 52000.00),
(16, 5, 9, 'Sky bag Adjustable Straps', 1, 990.00),
(17, 5, 1, 'Samsung Glaxy S22 Ultra', 1, 130000.00),
(18, 6, 10, 'DELL Laptop', 1, 52000.00),
(19, 6, 6, 'VIVO V27 Pro', 1, 27500.00),
(20, 6, 1, 'Samsung Glaxy S22 Ultra', 1, 130000.00),
(21, 6, 2, 'Samsung Glaxy a04s', 1, 30000.00),
(22, 6, 3, 'Samsung Glaxy S8', 1, 30000.00),
(23, 6, 4, 'Lenovo Ideapad 330', 1, 32999.00),
(24, 6, 5, 'OPPO RENO 7PRO', 1, 49999.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `category_id` int(20) NOT NULL,
  `brand_id` int(20) NOT NULL,
  `regular_price` varchar(50) NOT NULL,
  `selling_price` varchar(50) NOT NULL,
  `product_thumbnail` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `long_description` longtext NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `category_id`, `brand_id`, `regular_price`, `selling_price`, `product_thumbnail`, `short_description`, `long_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Samsung Glaxy S22 Ultra', 1, 2, '138000', '130000', '20240505022957.png', 'Samsung Galaxy S22 Ultra: Flagship smartphone with powerful specs, S Pen support, advanced camera system, and stunning design for premium user experience.', 'The Samsung Galaxy S22 Ultra epitomizes the pinnacle of smartphone technology, blending cutting-edge innovation with unparalleled design. Boasting a formidable array of features, it\'s a true powerhouse in the palm of your hand.\r\n\r\nAt its core, the S22 Ultra is driven by top-of-the-line hardware, featuring a blazing-fast processor coupled with ample RAM for seamless multitasking and gaming. Its expansive display, with stunning QHD+ resolution and a buttery-smooth 120Hz refresh rate, delivers an immersive viewing experience for content consumption and productivity alike.\r\n\r\nPhotography enthusiasts will revel in the S22 Ultra\'s advanced camera system, comprising a versatile quad-lens setup engineered to capture breathtaking photos and videos in any scenario. From ultra-wide landscapes to close-up macro shots, its AI-enhanced optics ensure stunning results every time.\r\n\r\nFor creatives and professionals, the S Pen support unlocks new possibilities, allowing for precise input and intuitive control over the device. Whether sketching, annotating documents, or navigating the UI with finesse, the S Pen elevates productivity to new heights.\r\n\r\nCrafted with premium materials and refined aesthetics, the S22 Ultra exudes sophistication and durability. From its sleek glass-and-metal construction to its ergonomic design, every detail is meticulously crafted to delight the senses and withstand the rigors of daily use.\r\n\r\nIn essence, the Samsung Galaxy S22 Ultra is more than just a smartphone; it\'s a testament to Samsung\'s unwavering commitment to innovation, pushing the boundaries of what\'s possible in mobile technology.', '1', '2024-05-05 14:29:57', '2024-05-05 12:29:57'),
(2, 'Samsung Glaxy a04s', 1, 2, '32000', '30000', '20240507013247.png', 'Samsung Galaxy A04s: Affordable smartphone featuring a large display, triple camera setup, long-lasting battery, and reliable performance, catering to diverse user needs without breaking the bank.', 'The Samsung Galaxy A04s offers a blend of essential features and affordability, catering to budget-conscious consumers. Boasting a sleek design, it features a large 6.5-inch Infinity-V display that provides an immersive viewing experience for multimedia content, gaming, and browsing.\r\n\r\nPowered by an octa-core processor, the Galaxy A04s ensures smooth performance for everyday tasks, such as web browsing, social media usage, and light gaming. With 3GB or 4GB of RAM options, users can multitask with ease, switching between apps without experiencing lag.\r\n\r\nIn terms of photography, the device sports a versatile triple camera setup, comprising a 13MP primary camera, a 2MP depth sensor for portrait shots, and a 2MP macro lens for close-up photography. This setup allows users to capture detailed photos with depth and clarity, as well as stunning macro shots of small subjects.\r\n\r\nFor selfies and video calls, the Galaxy A04s features a 5MP front-facing camera housed within the notch of the display. While it may not offer the highest resolution, it delivers decent results for everyday use.\r\n\r\nThe device also comes equipped with a sizable 5,000mAh battery, providing ample power to keep up with users\' demands throughout the day. Additionally, it supports 15W fast charging, ensuring minimal downtime when it comes to topping up the battery.\r\n\r\nOn the software front, the Galaxy A04s runs on Samsung\'s One UI, based on the latest Android operating system, offering a clean and user-friendly interface with a host of customization options and features.\r\n\r\nOverall, the Samsung Galaxy A04s presents a compelling option for those seeking an affordable smartphone with a decent display, capable performance, versatile camera setup, and long-lasting battery life.', '1', '2024-05-07 13:32:47', '2024-05-07 11:32:47'),
(3, 'Samsung Glaxy S8', 1, 2, '38000', '30000', '20240505025314.png', 'The Samsung Galaxy S8: sleek design, vibrant Infinity Display, powerful performance, advanced camera, iris scanning security, and seamless integration, offering an immersive smartphone experience.', 'The Samsung Galaxy S8, launched in 2017, revolutionized the smartphone market with its stunning design and innovative features. Boasting a sleek and futuristic appearance, the S8 features a striking Infinity Display that curves around the edges, providing an immersive viewing experience like never before. The 5.8-inch Quad HD+ Super AMOLED display delivers vibrant colors and deep blacks, making multimedia consumption a delight.\r\n\r\nUnder the hood, the Galaxy S8 packs powerful hardware, including the Qualcomm Snapdragon 835 processor (or Exynos 8895 outside the US), coupled with 4GB of RAM, ensuring smooth performance and multitasking capabilities. It also offers ample storage space, with options for 64GB built-in storage, expandable via microSD card.\r\n\r\nEquipped with a 12-megapixel rear camera with Dual Pixel technology, the S8 captures stunning photos even in low-light conditions. The 8-megapixel front camera, with autofocus and smart auto-detection features, takes sharp and detailed selfies. Additionally, the S8 introduces Bixby, Samsung\'s virtual assistant, providing users with contextual recommendations and intuitive voice commands.\r\n\r\nSecurity is paramount, with various biometric authentication options, including iris scanning, facial recognition, and a fingerprint sensor located on the rear of the device. The Galaxy S8 also features IP68 water and dust resistance, ensuring durability in various environments.\r\n\r\nConnectivity options are plentiful, with support for 4G LTE, Wi-Fi, Bluetooth 5.0, NFC, and USB Type-C. The S8 runs on Android Nougat out of the box, with Samsung\'s customizable UI overlay, providing a seamless and intuitive user experience.\r\n\r\nOverall, the Samsung Galaxy S8 remains a flagship device renowned for its stunning design, powerful performance, and advanced features, making it a compelling choice for smartphone enthusiasts.', '1', '2024-05-05 14:53:14', '2024-05-05 12:53:14'),
(4, 'Lenovo Ideapad 330', 2, 1, '38000', '32999', '20240505025636.jpeg', 'The Lenovo Ideapad 330: a reliable laptop with a sleek design and powerful performance for everyday tasks. Featuring a crisp display, ample storage, and smooth multitasking, it\'s a versatile choice for work and entertainment.', 'The Lenovo IdeaPad 330 is a versatile laptop designed for everyday computing needs. Boasting a sturdy build and a sleek design, it combines affordability with functionality. With a range of configuration options, users can choose the specifications that best suit their requirements.\r\n\r\nPowered by Intel Core processors, the IdeaPad 330 delivers reliable performance for multitasking, productivity, and entertainment. Whether you\'re browsing the web, streaming videos, or working on documents, this laptop handles tasks with ease. It offers ample storage space with HDD or SSD options, ensuring quick access to files and applications.\r\n\r\nThe IdeaPad 330 features a crisp display with vibrant colors, providing an immersive viewing experience for movies, photos, and presentations. Its Dolby Audio technology enhances sound quality, delivering clear and immersive audio for music, movies, and games.\r\n\r\nEquipped with a range of connectivity options including USB ports, HDMI, and SD card reader, the IdeaPad 330 allows for seamless connectivity with peripherals and external devices. Additionally, it features built-in Wi-Fi and Bluetooth capabilities for wireless connectivity.\r\n\r\nDesigned with user convenience in mind, the IdeaPad 330 comes with a comfortable keyboard and a responsive touchpad for effortless typing and navigation. Its durable chassis and long-lasting battery ensure reliability and mobility, making it an ideal companion for both work and leisure.\r\n\r\nOverall, the Lenovo IdeaPad 330 offers a balance of performance, affordability, and versatility, making it a reliable choice for everyday computing tasks.', '1', '2024-05-05 14:56:36', '2024-05-05 12:56:36'),
(5, 'OPPO RENO 7PRO', 1, 5, '55000', '49999', '20240505030057.png', 'The Oppo Reno 7 Pro boasts impressive camera capabilities, sleek design, AMOLED display, fast charging, and 5G connectivity, offering a premium smartphone experience.', 'The Oppo Reno 7 Pro is a flagship smartphone that offers a blend of impressive features and stylish design. With a focus on photography, performance, and user experience, it caters to discerning consumers looking for a premium mobile device.\r\n\r\nAt the heart of the Oppo Reno 7 Pro lies a powerful Qualcomm Snapdragon chipset, ensuring smooth and responsive performance for everyday tasks and demanding applications alike. Coupled with ample RAM and storage options, users can multitask effortlessly and store their files, apps, and media with ease.\r\n\r\nOne of the standout features of the Reno 7 Pro is its camera system. Equipped with a versatile quad-camera setup, including a high-resolution primary sensor, ultra-wide-angle lens, and depth sensor, users can capture stunning photos in various scenarios. Additionally, the device boasts advanced AI algorithms for scene recognition, optimization, and enhanced image quality.\r\n\r\nIn terms of design, the Oppo Reno 7 Pro exudes elegance and sophistication. Its sleek and slim profile, combined with premium materials and finishes, makes it a fashion statement in the hand of the user. The vibrant and immersive display further enhances the overall viewing experience, whether gaming, streaming, or browsing content.\r\n\r\nThe Reno 7 Pro also prioritizes user convenience and security, offering features such as fast and secure biometric authentication methods and intuitive gesture controls. Additionally, the device supports fast charging technology, ensuring minimal downtime and keeping users connected throughout the day.\r\n\r\nOverall, the Oppo Reno 7 Pro delivers a compelling package with its blend of performance, photography prowess, stylish design, and user-centric features, making it a top choice for those seeking a premium smartphone experience.', '1', '2024-05-05 15:00:57', '2024-05-05 13:00:57'),
(6, 'VIVO V27 Pro', 1, 6, '32500', '27500', '20240505030352.png', 'Vivo V27 Pro: Sleek design, vibrant AMOLED display, powerful performance, impressive camera setup, and 5G connectivity for seamless experience.', 'The Vivo V27 Pro is a feature-packed smartphone that caters to users seeking a blend of style, performance, and functionality. With its sleek design and premium build quality, the V27 Pro stands out in the crowded smartphone market.\r\n\r\nAt its core, the V27 Pro boasts powerful hardware that ensures smooth performance across various tasks. Powered by a Qualcomm Snapdragon processor, coupled with ample RAM, the device handles multitasking, gaming, and multimedia with ease. Users can expect a responsive experience whether they\'re browsing the web, streaming videos, or running graphics-intensive applications.\r\n\r\nOne of the standout features of the V27 Pro is its stunning display. The device sports a vibrant Super AMOLED screen with crisp visuals and vibrant colors, making it ideal for multimedia consumption and gaming. The large display offers an immersive viewing experience, whether you\'re watching movies or playing games.\r\n\r\nIn terms of photography, the V27 Pro doesn\'t disappoint. Equipped with a versatile camera setup, including a high-resolution primary camera, ultra-wide lens, and depth sensor, the device captures detailed and vivid photos in various lighting conditions. Additionally, AI-powered features enhance the overall photography experience, allowing users to unleash their creativity and capture stunning shots effortlessly.\r\n\r\nThe V27 Pro also prioritizes user convenience and security. It incorporates advanced biometric authentication methods, such as in-display fingerprint scanning and facial recognition, ensuring quick and secure access to the device. Moreover, the device offers ample storage space for your apps, photos, and multimedia content, allowing you to store and access your data conveniently.\r\n\r\nOverall, the Vivo V27 Pro combines style, performance, and innovation to deliver a compelling smartphone experience. Whether you\'re a power user, a photography enthusiast, or someone who values aesthetics, the V27 Pro is sure to impress with its impressive features and capabilities.', '1', '2024-05-05 15:03:52', '2024-05-05 13:03:52'),
(7, 'Dell KM 636', 5, 7, '800', '550', '20240507022424.jpeg', 'This mouse is good.', 'This is log discription.', '1', '2024-05-07 14:24:24', '2024-05-07 12:24:24'),
(8, 'Nike Air', 4, 4, '800', '550', '20240507012547.png', 'Nike Air full t-shirt: Lightweight, breathable fabric with iconic Nike Air logo, perfect for casual wear or workouts.', 'The Nike Air Full T-Shirt is a pinnacle of comfort and style, designed to elevate your athletic wardrobe and provide all-day wearability. Crafted with premium materials and innovative technology, this shirt seamlessly blends performance and fashion.\r\n\r\nConstructed from a soft and breathable cotton blend fabric, the Nike Air Full T-Shirt offers superior comfort and moisture-wicking properties, keeping you cool and dry during intense workouts or everyday activities. The fabric\'s stretchability ensures unrestricted movement, allowing you to perform at your best without any constraints.\r\n\r\nFeaturing a classic crew neckline and short sleeves, this shirt boasts a timeless silhouette that suits any occasion. The iconic Nike Air logo is prominently displayed across the chest, adding a touch of sporty flair and instantly recognizable style. Whether you\'re hitting the gym, running errands, or hanging out with friends, this shirt makes a bold statement while keeping you comfortable and on-trend.\r\n\r\nAvailable in a variety of color options, the Nike Air Full T-Shirt allows you to express your personal style and coordinate with your favorite athletic or casual outfits. Whether you prefer classic neutrals or eye-catching hues, there\'s a shade to suit every taste.\r\n\r\nElevate your wardrobe with the Nike Air Full T-Shirt and experience the perfect blend of performance, style, and comfort.', '1', '2024-05-07 13:25:47', '2024-05-07 11:25:47'),
(9, 'Sky bag Adjustable Straps', 6, 10, '1300', '990', '20240507015031.png', 'Sky Bag: Durable, stylish backpacks known for quality and comfort, perfect for everyday use and travel adventures.', 'Sky bags are a renowned brand of backpacks known for their durability, functionality, and style. Crafted with meticulous attention to detail, Sky bags cater to the needs of modern travelers, students, and professionals alike.\r\n\r\nDesigned to withstand the rigors of daily use, Sky bags feature high-quality materials such as rugged polyester or nylon, ensuring longevity and resilience. Reinforced stitching enhances durability, providing peace of mind for those who rely on their backpacks for carrying essential belongings.\r\n\r\nFunctionality is a cornerstone of Sky bags\' design philosophy. Thoughtfully organized compartments and pockets offer ample storage space for laptops, textbooks, gadgets, and other essentials, keeping everything neatly organized and easily accessible. Ergonomic padded straps and back panels ensure comfortable carrying, even during extended periods.\r\n\r\nSky bags come in a variety of styles, ranging from sleek and minimalist designs to vibrant and eye-catching patterns, allowing users to express their personality while on the go. Whether navigating bustling city streets or embarking on outdoor adventures, Sky bags seamlessly blend form and function.\r\n\r\nIn summary, Sky bags combine durability, functionality, and style to provide users with reliable companions for their everyday journeys. Trusted by millions worldwide, Sky bags continue to set the standard for backpack excellence.', '1', '2024-05-07 13:50:31', '2024-05-07 11:50:31'),
(10, 'DELL Laptop', 2, 12, '56000', '52000', '20241003082001.jpg', 'adfgh', 'dasudghfdghifhfhdfhf', '1', '2024-10-03 08:20:01', '2024-10-03 06:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `buy_now_link` varchar(255) NOT NULL,
  `read_more_link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `title`, `buy_now_link`, `read_more_link`, `created_at`) VALUES
(9, '1729833490_slider-1.jpg', 'Lorem ipsum dolor sit amet, comsectetur adipisicing elit, Beatae, dicta!', 'http://localhost/shubham/product.php?product_id=10', '', '2024-10-25 05:18:10'),
(10, '1729833512_slider-3.jpg', 'Lorem ipsum dolor sit amet, comsectetur adipisicing elit, Beatae, dicta!', 'http://localhost/shubham/product.php?product_id=8', '', '2024-10-25 05:18:32'),
(11, '1729833645_home_banner.jpg', 'Lorem ipsum dolor sit amet, comsectetur adipisicing elit, Beatae, dicta!', 'http://localhost/shubham/product.php?product_id=6', '', '2024-10-25 05:20:45'),
(12, '1729836629_slider-2.jpg', 'Lorem ipsum dolor sit amet, comsectetur adipisicing elit, Beatae, dicta!', 'http://localhost/shubham/product.php?product_id=10', '', '2024-10-25 06:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(190) NOT NULL,
  `last_name` varchar(190) NOT NULL,
  `email` varchar(190) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_status` enum('0','1') NOT NULL,
  `created_at` varchar(30) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `user_status`, `created_at`, `updated_at`) VALUES
(1, 'Rajan', 'Tiwari', 'hellotiwari@gmail.com', '08511871095', '12345', '1', '2024-05-28 05:08:36', '2024-06-28 16:21:19'),
(2, 'Rajan', 'Tiwari', 'hellotiwari94@gmail.com', '09430571095', 'Rajan@123', '1', '2024-06-28 18:22:53', '2024-06-28 16:22:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
