-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2023 at 06:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electronics_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Apple'),
(2, 'Lenovo'),
(3, 'HP'),
(4, 'Acer'),
(5, 'Asus'),
(6, 'Dell'),
(7, 'MSI'),
(8, 'Gigabyte'),
(9, 'Samsung'),
(10, 'Xiaomi');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'laptop'),
(2, 'smartphone'),
(3, 'tablet'),
(4, 'drone');

-- --------------------------------------------------------

--
-- Table structure for table `laptop_specs`
--

CREATE TABLE `laptop_specs` (
  `id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `cpu` varchar(80) NOT NULL,
  `ram` varchar(80) NOT NULL,
  `storage_drive` varchar(30) NOT NULL,
  `vga` varchar(80) NOT NULL,
  `screen` varchar(200) NOT NULL,
  `weight` varchar(20) NOT NULL,
  `battery` varchar(20) NOT NULL,
  `color` varchar(30) NOT NULL,
  `ports` varchar(500) DEFAULT NULL,
  `webcam` varchar(100) DEFAULT NULL,
  `bluetooth` varchar(30) DEFAULT NULL,
  `wifi` varchar(30) DEFAULT NULL,
  `audio` varchar(100) DEFAULT NULL,
  `images` varchar(1800) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `laptop_specs`
--

INSERT INTO `laptop_specs` (`id`, `product_id`, `cpu`, `ram`, `storage_drive`, `vga`, `screen`, `weight`, `battery`, `color`, `ports`, `webcam`, `bluetooth`, `wifi`, `audio`, `images`) VALUES
(1, '14ef0030TU 6K773PA', 'Intel Core i7-1255U 1.7GHz up to 4.7GHz 12MB', '16GB LPDDR4x 4266MHz (Onboard)', '1TB PCIe NVMe TLC M.2 SSD', 'Intel Iris Xe Graphics', '13.5 inch 3K2K (3000 x 2000), OLED, multitouch-enabled, UWVA, edge-to-edge glass, micro-edge, anti-reflection Corning Gorilla Glass NBT, Low Blue Light, SDR 400 nits, HDR 500 nits, 100% DCI-P3', '1.36 kg', '4 Cell 66WHr', 'Nocturne blue aluminum', '2x Thunderbolt 4 with USB4 Type-C 40Gbps signaling rate (USB Power Delivery, DisplayPort 1.4, HP Sleep and Charge);\r\n1x SuperSpeed USB Type-A 10Gbps signaling rate (HP Sleep and Charge);\r\n1x headphone/microphone combo;\r\nFingerPrint', 'HP True Vision 5MP IR camera with camera shutter, temporal noise reduction and integrated dual array', 'v5.0', 'Intel Wi-Fi 6E AX211 (2x2)', 'Bang & Olufsen, Quad Speakers, HP Audio Boost', 'laptop/HP/14ef0030TU 6K773PA/hp-spectre-x360-1.png;laptop/HP/14ef0030TU 6K773PA/hp-spectre-x360-2.png;laptop/HP/14ef0030TU 6K773PA/hp-spectre-x360-3.png;laptop/HP/14ef0030TU 6K773PA/hp-spectre-x360-4.png;laptop/HP/14ef0030TU 6K773PA/hp-spectre-x360-5.png;laptop/HP/14ef0030TU 6K773PA/hp-spectre-x360-6.png;'),
(2, '15ARH7 82RE0035VN', 'AMD Ryzen 7 6800H ', '8GB (8x1) DDR5 4800MHz', '512GB SSD M.2 2280 PCIe 4.0x4 ', 'NVIDIA GeForce RTX 3050 4GB GD', '15.6 inch FHD (1920x1080) IPS 300nits Anti-glare', '2.4 kg', '4Cell, 80WHrs', 'Storm Grey', '2x USB 3.2 Gen 1; \r\n1x USB 3.2 Gen 1 (Always On); \r\n2x USB-C 3.2 Gen 2 (support data transfer, DisplayPort 1.4); \r\n1x USB-C 3.2 Gen 2 (support data transfer, Power Delivery 135W & DisplayPort 1.4); \r\n1x HDMI (up to 8K/60Hz); \r\n1x Ethernet (RJ-45); \r\n1x Headphone / microphone combo jack (3.5mm)', '720p with E-camera Shutter', 'v5.2', 'Wi-Fi 6 11ax, 2x2', 'Stereo speakers, 2W x2, Nahimic Audio', 'laptop/Lenovo/15ARH7 82RE0035VN/lenovo_legion_5_15arh7h-1.png;laptop/Lenovo/15ARH7 82RE0035VN/lenovo_legion_5_15arh7h-2.png;laptop/Lenovo/15ARH7 82RE0035VN/lenovo_legion_5_15arh7h-3.png;laptop/Lenovo/15ARH7 82RE0035VN/lenovo_legion_5_15arh7h-4.png;laptop/Lenovo/15ARH7 82RE0035VN/lenovo_legion_5_15arh7h-5.png;laptop/Lenovo/15ARH7 82RE0035VN/lenovo_legion_5_15arh7h-6.png;'),
(3, '16ARHA7 82UH002NHH', 'AMD Ryzen 7 6800H (8C / 16T, 3.2 / 4.7GHz, 4MB L2 / 16MB L3)', '16 GB (2 x 8 GB) SO-DIMM DDR5 4800MHz', '1TB SSD M.2 2280 PCIe 4.0x4 NV', 'AMD Radeon RX 6700M 10GB GDDR6', '16.0 inch WQXGA (2560 x 1600), IPS, Anti-Glare, Dolby Vision™, Free-Sync, Non-Touch, HDR 400, 100% sRGB, 500 Nits, 165Hz', '2.53 kg', '4 Cell, 99.9Wh', 'Matte Black', '1x USB 3.2 Gen 1;\r\n1x USB 3.2 Gen 1 (Always On);\r\n1x USB-C 3.2 Gen 1 (support data transfer only);\r\n1x USB-C 3.2 Gen 2 (support data transfer and DisplayPort 1.4);\r\n1x USB-C 3.2 Gen 2 (support data transfer, Power Delivery 135W and DisplayPort 1.4);\r\n1x USB4 40Gbps (support data transfer and DisplayPort 1.4);\r\n1x HDMI, up to 8K/60Hz1x Ethernet (RJ-45);\r\n1x Headphone / microphone combo jack (3.5mm);\r\n1x Power connector', '1080p FHD Camera with E-camera Shutter', 'v5.1', 'Wi-Fi 6E 11ax, 2x2', '', 'laptop/Lenovo/16ARHA7 82UH002NHH/lenovo-gaming-legion-7-gen-7-16-amd-1.png;laptop/Lenovo/16ARHA7 82UH002NHH/lenovo-gaming-legion-7-gen-7-16-amd-10.png;laptop/Lenovo/16ARHA7 82UH002NHH/lenovo-gaming-legion-7-gen-7-16-amd-2.png;laptop/Lenovo/16ARHA7 82UH002NHH/lenovo-gaming-legion-7-gen-7-16-amd-3.png;laptop/Lenovo/16ARHA7 82UH002NHH/lenovo-gaming-legion-7-gen-7-16-amd-4.png;laptop/Lenovo/16ARHA7 82UH002NHH/lenovo-gaming-legion-7-gen-7-16-amd-5.png;laptop/Lenovo/16ARHA7 82UH002NHH/lenovo-gaming-legion-7-gen-7-16-amd-6.png;laptop/Lenovo/16ARHA7 82UH002NHH/lenovo-gaming-legion-7-gen-7-16-amd-7.png;laptop/Lenovo/16ARHA7 82UH002NHH/lenovo-gaming-legion-7-gen-7-16-amd-8.png;laptop/Lenovo/16ARHA7 82UH002NHH/lenovo-gaming-legion-7-gen-7-16-amd-9.png;'),
(4, 'GX650PZ NM031W', '	AMD Ryzen™ 9 7945HX Mobile Processor (16-core/32-thread, 64MB L3 cache, up to 5', '32GB (16x2) DDR5 4800MHz  (2x SO-DIMM socket, up to 64GB SDRAM)', '1TB M.2 NVMe™ PCIe® 4.0 Perfor', 'NVIDIA® GeForce RTX™ 4080 12GB GDDR6 With ROG Boost: 2330 MHz* at 165W (2280MHz ', '16inch QHD+ 16:10 (2560 x 1600, WQXGA), 240Hz, 3ms, anti-glare display, DCI-P3:100%, Pantone Validated, FreeSync Premium Pro, Support Dolby Vision HDR, Mini LED, 1100 Nits.', '2.67 kg', '90WHrs, 4S1P, 4-cell', 'Black', '1x 2.5G LAN port;\r\n1x USB 3.2 Gen 2 Type-C support DisplayPort™ / G-SYNC;\r\n1x USB 3.2 Gen 2 Type-C support DisplayPort™ / power delivery / G-SYNC;\r\n2x USB 3.2 Gen 2 Type-A;\r\n1x card reader (microSD) (UHS-II, 312MB/s);\r\n1x HDMI 2.1 FRL;\r\n1x 3.5mm Combo Audio Jack', 'FHD 1080P@30FPS', 'v5.2', 'Wi-Fi 6E(802.11ax) (2x2)', 'Dolby Atmos, 6-speaker(dual-force woofer) system with Smart Amplifier Technology', 'laptop/Asus/GX650PZ NM031W/rog-zephyrus-duo-16-1.png;laptop/Asus/GX650PZ NM031W/rog-zephyrus-duo-16-2.png;laptop/Asus/GX650PZ NM031W/rog-zephyrus-duo-16-3.png;laptop/Asus/GX650PZ NM031W/rog-zephyrus-duo-16-4.png;laptop/Asus/GX650PZ NM031W/rog-zephyrus-duo-16-5.png;laptop/Asus/GX650PZ NM031W/rog-zephyrus-duo-16-6.png;laptop/Asus/GX650PZ NM031W/rog-zephyrus-duo-16-7.png;laptop/Asus/GX650PZ NM031W/rog-zephyrus-duo-16-8.png;'),
(5, 'P109F001CBL', 'Intel Core i7-11800H 2.3GHz up to 4.6GHz 24MB', '32GB (16x2) DDR4 3200MHz (2x SO-DIMM socket, up to 64GB SDRAM)', '1TB SSD M.2 PCIe', 'NVIDIA GeForce RTX 3060 6GB GDDR6', '15.6 inch QHD (2560 x 1440) 240Hz, 2ms, with ComfortView plus, NVIDIA G-SYNC and Advanced Optimus, WVA Display', '2.69 kg', '6 Cell 86WHr ', 'Dark Side of the Moon', '1x Type-C port (Includes Thunderbolt™ 4i, USB 3.2 Gen 2, Display Port 1.4, and Power Delivery 15W Output (5V/3A) capabilities);\r\n3x Type-A USB 3.2 Gen 1 ports (one with PowerShare);\r\n1x HDMI 2.1 Output port;\r\n1x Killer E2600 1 Gbps rated RJ-45 Ethernet port;\r\n1x Global Headset jack;\r\n1x Power/DC-In port', 'Alienware HD (1280x720 resolution) camera with dual-array microphones', 'v5.2', '802.11AX (WiFi 6)', 'Realtek ALC3254 with A-Volute Nahimic audio – Integrated in Alienware Sound Center (AWSC)', 'laptop/Dell/P109F001CBL/dell-alienware-m15-r6-1.png;laptop/Dell/P109F001CBL/dell-alienware-m15-r6-2.png;laptop/Dell/P109F001CBL/dell-alienware-m15-r6-3.png;laptop/Dell/P109F001CBL/dell-alienware-m15-r6-4.png;laptop/Dell/P109F001CBL/dell-alienware-m15-r6-5.png;laptop/Dell/P109F001CBL/dell-alienware-m15-r6-6.png;'),
(11, 'M1405YA KM047W', 'Ryzen™ 5 7530U Mobile Processor (6-core/12-thread, 16MB cache, up to 4.3 GHz max', '8GB Onboard DDR4 3200MHz (1 x Sodimm Slot, up to 24GB Ram)', '512GB M.2 NVMe™ PCIe® 3.0 SSD ', 'AMD Radeon™ Graphics', '14', '1.6 kg', '50WHrs, 3S1P, 3-cell', 'Cool Silver', '1x USB 2.0 Type-A;\r\n1x USB 3.2 Gen 1 Type-C support power delivery;\r\n2x USB 3.2 Gen 1 Type-A;\r\n1x HDMI 1.4;\r\n1x 3.5mm Combo Audio Jack;\r\n1x DC-in', '720p HD camera With privacy shutter', 'v5.0', 'Wi-Fi 6E(802.11ax) (Dual band)', 'SonicMaster', 'laptop/Asus/M1405YA KM047W/vivobook14-2.png;laptop/Asus/M1405YA KM047W/vivobook14-3.png;laptop/Asus/M1405YA KM047W/vivobook14-4.png;laptop/Asus/M1405YA KM047W/vivobook14-5.png;laptop/Asus/M1405YA KM047W/vivobook14.png;'),
(13, 'SFX14 71G', 'Intel® Core™ i7-13700H 3.70 upto 5.00GHz ,14 Core 20 Threads, 24 MB Smart Cache', '32GB LPDDR5 Onboard', '1024GB PCIe NVMe SED SSD', 'NVIDIA® GeForce RTX™ Graphics 4050 with 6GB of dedicated GDDR6 VRAM', '14.5', '1.5kg', '76Whr Li-ion battery', 'Steel Gray', '', '', '', '', '', 'laptop/Acer/SFX14 71G/swift-x-sfx14-6.png; laptop/Acer/SFX14 71G/swift-x-sfx14-5.png; laptop/Acer/SFX14 71G/swift-x-sfx14-4.png; laptop/Acer/SFX14 71G/swift-x-sfx14-3.png; laptop/Acer/SFX14 71G/swift-x-sfx14-2.png; laptop/Acer/SFX14 71G/swift-x-sfx14-1.png; laptop/Acer/SFX14 71G/swift-x-sfx14.png; '),
(14, 'MSIAMG', 'Intel Core i9-13900H 4.1GHz up to 5.4GHz, 14 Cores 20 Threads ,24MB Cache', '32GB (16x2) DDR5 5200MHz (2x SO-DIMM socket, up to 64GB SDRAM)', '2TB SSD PCIE G4X4 (2 slots M.2', 'NVIDIA® GeForce RTX™ 4070 8GB GDDR6 + MUX Switch', '16\" UHD+ (3840x2400), 16:10, 100% DCI-P3, OLED, DisplayHDR True Black 600', '1.88 kg', '4 Cell 99.9WHrs', 'Selenite Gray', '', '', '', '', '', 'laptop/MSI/MSIAMG/4_38ee6e60844747f3a780f8cbfc795678_master.png;laptop/MSI/MSIAMG/8_cb852dc5c90744eeac825a0ab6d5bf3b_master.png;laptop/MSI/MSIAMG/5_e40e921e99d34efc87e74d21d48ed60b_master.png;laptop/MSI/MSIAMG/2_3013d5c7b77447a2b1995e7845adc708_master.png;laptop/MSI/MSIAMG/1_17f74834dacc4eb99ad85d3637bfae65_master.png;');

-- --------------------------------------------------------

--
-- Table structure for table `order_basic`
--

CREATE TABLE `order_basic` (
  `id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'usd'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_basic`
--

INSERT INTO `order_basic` (`id`, `total`, `amount`, `created_date`, `payment_method`, `status`, `username`, `fullname`, `address`, `phone`, `email`, `currency`) VALUES
(1692986492, 8460, 4, '2023-08-26 01:01:32', 'cash on delivery', 'unpaid', 'dzung', 'Dzung Nguyen ', 'Viet Nam', '12345678910', 'mr.dzung.2k@gmail.com', 'usd'),
(1692992727, 2860, 1, '2023-08-26 02:45:27', 'cash on delivery', 'unpaid', '', 'John Doe', 'Earth', '1234567890', 'abc@xyz.com', 'usd'),
(1692993341, 1355, 1, '2023-08-26 02:55:41', 'stripe', 'paid', 'dzung', 'Dzung Nguyen ', 'Viet Nam', '12345678910', 'mr.dzung.2k@gmail.com', 'usd'),
(1692997190, 2200, 1, '2023-08-26 03:59:50', 'stripe', 'paid', 'dzung', 'Dzung Nguyen ', 'Viet Nam', '12345678910', 'mr.dzung.2k@gmail.com', 'usd'),
(1693458680, 5050, 3, '2023-08-31 12:11:20', 'cash on delivery', 'unpaid', '', 'Jack Doe', 'HCM', '0123456789', 'abc@xyz.com', 'usd'),
(1693508711, 1234, 1, '2023-09-01 02:05:11', 'stripe', 'paid', 'dzung', 'Dzung Nguyen ', 'Viet Nam', '12345678910', 'mr.dzung.2k@gmail.com', 'usd');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `amount`, `price`) VALUES
(4, 1692986492, 'P109F001CBL', ' Alienware M15 R6', 2, 2200),
(5, 1692986492, 'S23ULTRA8_256BLACK', 'Galaxy S23 Ultra 256 GB Black', 1, 1200),
(6, 1692986492, 'iPadM1PRO12i', 'iPad Pro M1 12.9inch (2021) Grey', 1, 2860),
(7, 1692992727, 'iPadM1PRO12i', 'iPad Pro M1 12.9inch (2021) Grey', 1, 2860),
(8, 1692993341, 'IP14P128DP', 'iPhone 14 Pro 128GB Deep Purple', 1, 1355),
(11, 1692997190, 'P109F001CBL', ' Alienware M15 R6', 1, 2200),
(12, 1693458680, '14ef0030TU 6K773PA', 'HP Spectre x360', 1, 1550),
(13, 1693458680, '16ARHA7 82UH002NHH', 'Lenovo Legion 7', 1, 2300),
(14, 1693458680, 'S23ULTRA8_256BLACK', 'Galaxy S23 Ultra 256 GB Black', 1, 1200),
(16, 1693508711, 'IP14P128BLACK', 'iPhone 14 Pro 128GB Black', 1, 1234);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `views` int(11) DEFAULT 999,
  `sales` int(11) DEFAULT 99,
  `buy_price` int(11) DEFAULT NULL,
  `original_price` int(11) NOT NULL,
  `overview_image` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_id`, `name`, `category_id`, `brand_id`, `stock`, `views`, `sales`, `buy_price`, `original_price`, `overview_image`) VALUES
(1, '14ef0030TU 6K773PA', 'HP Spectre x360', 1, 3, 15, 3000, 15, 1550, 1879, 'overview/14ef0030TU 6K773PA/hp-spectre-x360-4.png'),
(2, '15ARH7 82RE0035VN', 'Lenovo Legion 5 ', 1, 2, 20, 860, 55, 1650, 1900, 'overview/15ARH7 82RE0035VN/lenovo_legion_5_15arh7h-1.png'),
(3, '16ARHA7 82UH002NHH', 'Lenovo Legion 7', 1, 2, 30, 250, 30, 2300, 2300, 'overview/16ARHA7 82UH002NHH/lenovo-gaming-legion-7-gen-7-16-amd-2.png'),
(4, 'GX650PZ NM031W', 'Asus ROG Zephyrus Duo 16 ', 1, 5, 5, 550, 38, 4850, 5000, 'overview/GX650PZ NM031W/rog-zephyrus-duo-16-2.png'),
(5, 'IP14P128BLACK', 'iPhone 14 Pro 128GB Black', 2, 1, 25, 175, 66, 1234, 1350, 'overview/IP14P128BLACK/iphone-14-pro-black-4.jpg'),
(6, 'IP14P128DP', 'iPhone 14 Pro 128GB Deep Purple', 2, 1, 18, 1200, 12, 1355, 1355, 'overview/IP14P128DP/iphone-14-pro-purple-1.jpg'),
(7, 'IP14P256WHITE', 'iPhone 14 Pro 256GB White', 2, 1, 12, 3500, 28, 1800, 1800, 'overview/IP14P256WHITE/iphone-14-pro-white-3.jpg'),
(8, 'P109F001CBL', ' Alienware M15 R6', 1, 6, 10, 1234, 10, 2200, 2500, 'overview/P109F001CBL/dell-alienware-m15-r6-4.png'),
(9, 'S23ULTRA8_256BLACK', 'Galaxy S23 Ultra 256 GB Black', 2, 9, 21, 1689, 25, 1200, 1350, 'overview/S23ULTRA8_256BLACK/s23-ultra-1.jpg'),
(20, 'iPadM1PRO12i', 'iPad Pro M1 12.9inch (2021) Grey', 3, 1, 3, 2850, 36, 2860, 2986, 'overview/iPadM1PRO12i/ipad-pro-m1-2021-1.jpg'),
(21, 'M1405YA KM047W', 'Asus VivoBook 14', 1, 5, 10, 1234, 123, 800, 800, 'overview/M1405YA KM047W/vivobook14-2.png'),
(22, 'SSGTABA8GREY', 'Samsung Galaxy Tab A8 Grey', 3, 9, 10, 1234, 123, 500, 500, 'overview/SSGTABA8GREY/samsung-galaxy-tab-a8-1.jpg'),
(25, 'SFX14 71G', 'Acer Swift X SFX14', 1, 4, 3, 999, 99, 1750, 1750, 'overview/SFX14 71G/swift-x-sfx14-2.png'),
(26, 'IP13PMBLUE', 'iPhone 13 Pro Max 128GB Blue', 2, 1, 2, 999, 99, 1000, 1000, 'overview/IP13PMBLUE/iphone-13-pro-max-blue.png'),
(27, 'IP13W128', 'iPhone 13 128GB White', 2, 1, 5, 999, 99, 800, 800, 'overview/IP13W128/iphone-13-whitejpg.jpg'),
(28, 'TABM9', 'Lenovo Tab M9', 3, 2, 12, 999, 99, 300, 300, 'overview/TABM9/lenovo-tab-m9-1-1.jpg'),
(29, 'TABS9GREY', 'Samsung Galaxy Tab S9+ ', 3, 9, 5, 999, 99, 949, 1000, 'overview/TABS9GREY/samsung-galaxy-tab-s9-plus-xam-1.jpg'),
(30, 'SSGS8ULTRAB', 'Samsung Galaxy Tab S8 Ultra', 3, 9, 5, 999, 99, 2500, 2500, 'overview/SSGS8ULTRAB/samsung-galaxy-tab-s8-ultra-1-1.jpg'),
(31, 'MSIAMG', 'MSI Stealth 16 Mercedes AMG ', 1, 7, 1, 999, 99, 4000, 4000, 'overview/MSIAMG/1_17f74834dacc4eb99ad85d3637bfae65_master.png');

-- --------------------------------------------------------

--
-- Table structure for table `smartphone_tablet_prototypes`
--

CREATE TABLE `smartphone_tablet_prototypes` (
  `id` int(11) NOT NULL,
  `prototype` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `os` varchar(100) NOT NULL,
  `cpu` varchar(200) DEFAULT NULL,
  `gpu` varchar(200) DEFAULT NULL,
  `length` varchar(50) DEFAULT NULL,
  `width` varchar(50) DEFAULT NULL,
  `depth` varchar(50) DEFAULT NULL,
  `battery` varchar(300) DEFAULT NULL,
  `charge` varchar(300) DEFAULT NULL,
  `screen` varchar(400) DEFAULT NULL,
  `front_camera` varchar(500) DEFAULT NULL,
  `back_camera` varchar(500) DEFAULT NULL,
  `video` varchar(500) DEFAULT NULL,
  `features` varchar(300) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `smartphone_tablet_prototypes`
--

INSERT INTO `smartphone_tablet_prototypes` (`id`, `prototype`, `category_id`, `os`, `cpu`, `gpu`, `length`, `width`, `depth`, `battery`, `charge`, `screen`, `front_camera`, `back_camera`, `video`, `features`, `weight`) VALUES
(2, 'iPhone 14 Pro', 2, 'iOS 16.0', 'A16 Bionic 6‑core CPU', 'A16 Bionic 5‑core GPU', '147.5 mm', '71.5 mm', '7.85 mm', 'Li-Ion, 3200 mAh', 'Up to 50% charge in around 30 minutes with 20W adapter;', 'Super Retina XDR display;\r\n6.1‑inch all‑screen OLED display;\r\n2556‑by‑1179-pixel resolution at 460 ppi\r\n', '1x 48MP,  2x 12MP', '1x 12MP', '4K video recording at 24 fps, 25 fps, 30 fps, 60 fps;\r\n1080p HD video recording at 25 fps, 30 fps, 60 fps;\r\n720p HD video recording at 30 fps', 'Splash, Water, and Dust Resistant: IP68 (maximum depth of 6 meters up to 30 minutes)\r\n', '206g'),
(4, 'Samsung Galaxy S23 Ultra 5G', 2, 'Android 13', 'Snapdragon 8 Gen 2 ', ' Adreno 740 ', '163.4 mm ', '78.1 mm', '8.9 mm', 'Li-Ion,  500 mAh', 'Max-charge: 45 W; Support Fast charge & Wireless charge', 'Dynamic AMOLED 2X;\r\n2K+ (1440 x 3088 Pixels);\r\n6.8inch -up to 120 Hz;', '12 MP', ' Main: 200 MP & Minor: 12 MP, 10 MP, 10 MP ', 'HD 720p@960fps;\r\nFullHD 1080p@60fps;\r\nFullHD 1080p@30fps;\r\nFullHD 1080p@240fps;\r\n4K 2160p@30fps;\r\n4K', 'Water-Resis: IP68\r\nFace Recognition;\r\nFinger Print Identification', '223 g'),
(6, 'iPad M1 Pro (2021) 12.9 inch', 3, ' iPadOS 15 ', ' Apple M1 8-core', ' Apple GPU 8-core', '280.6 mm', '214.9 mm', '6.4 mm', '  Li-Po , 40.88 Wh (~ 10.835 mAh) ', '20W', 'Liquid Retina XDR mini-LED LCD, Fresh Rate 120 Hz;\r\n12.9 inch (2048 x 2732 Pixels)\r\n', '12 MP', 'Main: 12 MP & Minor: 10 MP, TOF 3D LiDAR', 'FullHD 1080p@25fps;\r\nFullHD 1080p@30fps;\r\nFullHD 1080p@60fps;\r\nFullHD 1080p@120fps;\r\nFullHD 1080p@240fps;\r\nHD 720p@30fps;\r\n4K 2160p@24fps;\r\n4K 2160p@30fps;\r\n4K 2160p@60fps;\r\n4K 2160p@25fps', '', '685 g'),
(7, 'Samsung Galaxy Tab A8 (2022)', 3, 'Android 11', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 'iPhone 13 Pro Max', 2, 'iOS', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 'iPhone 13', 2, 'iOS', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 'Lenovo Tab M9', 3, 'Android', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 'Samsung Galaxy Tab S9+', 3, 'Android', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 'Samsung Galaxy Tab S8 Ultra', 3, 'Android ', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `smartphone_tablet_specs`
--

CREATE TABLE `smartphone_tablet_specs` (
  `id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `prototype` varchar(100) DEFAULT NULL,
  `ram` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `storage` varchar(100) NOT NULL,
  `images` varchar(1500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `smartphone_tablet_specs`
--

INSERT INTO `smartphone_tablet_specs` (`id`, `product_id`, `prototype`, `ram`, `color`, `storage`, `images`) VALUES
(1, 'IP14P128BLACK', 'iPhone 14 Pro', '6GB', 'Black', '128GB', 'smartphone/Apple/iPhone 14 Pro/Black/iphone-14-pro-black-1.jpg;smartphone/Apple/iPhone 14 Pro/Black/iphone-14-pro-black-2.jpg;smartphone/Apple/iPhone 14 Pro/Black/iphone-14-pro-black-3.jpg;smartphone/Apple/iPhone 14 Pro/Black/iphone-14-pro-org.jpg;'),
(2, 'IP14P128DP', 'iPhone 14 Pro', '6GB', 'Deep Purple', '128GB', 'smartphone/Apple/iPhone 14 Pro/Deep Purple/iphone-14-pro-purple-1.jpg;smartphone/Apple/iPhone 14 Pro/Deep Purple/iphone-14-pro-purple-2.jpg;smartphone/Apple/iPhone 14 Pro/Deep Purple/iphone-14-pro-purple-3.jpg;smartphone/Apple/iPhone 14 Pro/Deep Purple/iphone-14-pro-purple-4.jpg;'),
(3, 'IP14P256WHITE', 'iPhone 14 Pro', '6GB', 'White', '256GB', 'smartphone/Apple/iPhone 14 Pro/White/iphone-14-pro-org.jpg;smartphone/Apple/iPhone 14 Pro/White/iphone-14-pro-white-1.jpg;smartphone/Apple/iPhone 14 Pro/White/iphone-14-pro-white-2.jpg;smartphone/Apple/iPhone 14 Pro/White/iphone-14-pro-white-3.jpg;smartphone/Apple/iPhone 14 Pro/White/iphone-14-pro-white-4.jpg;smartphone/Apple/iPhone 14 Pro/White/iphone-14-pro-white-5.jpg;'),
(4, 'S23ULTRA8_256BLACK', 'Samsung Galaxy S23 Ultra 5G', '8GB', 'Black', '256GB', 'smartphone/Samsung/Samsung Galaxy S23 Ultra 5G/Black/s23-ultra-1.jpg;smartphone/Samsung/Samsung Galaxy S23 Ultra 5G/Black/s23-ultra-2.jpg;smartphone/Samsung/Samsung Galaxy S23 Ultra 5G/Black/s23-ultra-3.jpg;smartphone/Samsung/Samsung Galaxy S23 Ultra 5G/Black/s23-ultra-4.jpg;smartphone/Samsung/Samsung Galaxy S23 Ultra 5G/Black/s23-ultra-5.jpg;smartphone/Samsung/Samsung Galaxy S23 Ultra 5G/Black/s23-ultra-6.jpg;smartphone/Samsung/Samsung Galaxy S23 Ultra 5G/Black/s23-ultra-7.jpg;smartphone/Samsung/Samsung Galaxy S23 Ultra 5G/Black/s23-ultra-openbox.jpg;'),
(9, 'iPadM1PRO12i', 'iPad M1 Pro (2021) 12.9 inch', '16GB', 'Grey', '2TB', 'tablet/Apple/iPadM1PRO12i/ipad-pro-m1-2021-open.jpg;tablet/Apple/iPadM1PRO12i/ipad-pro-m1-2021-7.jpg;tablet/Apple/iPadM1PRO12i/ipad-pro-m1-2021-6.jpg;tablet/Apple/iPadM1PRO12i/ipad-pro-m1-2021-5.jpg;tablet/Apple/iPadM1PRO12i/ipad-pro-m1-2021-4.jpg;tablet/Apple/iPadM1PRO12i/ipad-pro-m1-2021-3.jpg;tablet/Apple/iPadM1PRO12i/ipad-pro-m1-2021-2.jpg;tablet/Apple/iPadM1PRO12i/ipad-pro-m1-2021-1.jpg;'),
(10, 'SSGTABA8GREY', 'Samsung Galaxy Tab A8 (2022)', '4 GB', 'Grey', '64 GB', 'tablet/Samsung/SSGTABA8GREY/samsung-galaxy-tab-a8-15-org.jpg;tablet/Samsung/SSGTABA8GREY/samsung-galaxy-tab-a8-11-1.jpg;tablet/Samsung/SSGTABA8GREY/samsung-galaxy-tab-a8-5-1.jpg;tablet/Samsung/SSGTABA8GREY/samsung-galaxy-tab-a8-4-1.jpg;tablet/Samsung/SSGTABA8GREY/samsung-galaxy-tab-a8-3-1.jpg;tablet/Samsung/SSGTABA8GREY/samsung-galaxy-tab-a8-2-1.jpg;tablet/Samsung/SSGTABA8GREY/samsung-galaxy-tab-a8-1.jpg;'),
(11, 'IP13PMBLUE', 'iPhone 13 Pro Max', '6 GB', 'Blue', '128GB', 'smartphone/Apple/IP13PMBLUE/iphone-13-pro-max-blue.png;'),
(12, 'IP13W128', 'iPhone 13', '4 GB', 'White', '128GB', 'smartphone/Apple/IP13W128/iphone-13-whitejpg.jpg;'),
(13, 'TABM9', 'Lenovo Tab M9', '4GB', 'Light Blue', '64GB', 'tablet/Lenovo/TABM9/lenovo-tab-m9-11.jpg;tablet/Lenovo/TABM9/lenovo-tab-m9-10.jpg;tablet/Lenovo/TABM9/lenovo-tab-m9-4-1.jpg;tablet/Lenovo/TABM9/lenovo-tab-m9-3-1.jpg;tablet/Lenovo/TABM9/lenovo-tab-m9-2-1.jpg;tablet/Lenovo/TABM9/lenovo-tab-m9-1-1.jpg;'),
(14, 'TABS9GREY', 'Samsung Galaxy Tab S9+', '12GB', 'Grey', '256', 'tablet/Samsung/TABS9GREY/samsung-galaxy-tab-s9-plus-5g-bbh-org.jpg;tablet/Samsung/TABS9GREY/samsung-galaxy-tab-s9-plus-xam-1.jpg;'),
(15, 'SSGS8ULTRAB', 'Samsung Galaxy Tab S8 Ultra', '8GB', 'Matte Black', '128GB', 'tablet/Samsung/SSGS8ULTRAB/samsung-galaxy-tab-s8-ultra-2.jpg;tablet/Samsung/SSGS8ULTRAB/samsung-galaxy-tab-s8-ultra-1-1.jpg;tablet/Samsung/SSGS8ULTRAB/samsung-galaxy-tab-s8-ultra-bhh-org.jpg;');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `verify_code` mediumint(9) NOT NULL,
  `verify_status` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(20) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `phone`, `email`, `address`, `verify_code`, `verify_status`, `role`) VALUES
(1, 'customer', '4eea43778faed17e59a9e07e9178af4d', 'John', 'Doe', '0123456789', 'abcdeghjk@abc.xyz', '', 781053, 0, 'customer'),
(2, 'devchitect', 'e10adc3949ba59abbe56e057f20f883e', 'Dzung ', 'Nguyen', '0123456789', NULL, NULL, 0, 0, 'admin'),
(3, 'dzung', '7fe997c8d3b2dd1a1ae5e76b0acc6084', 'Dzung', 'Nguyen ', '12345678910', 'mr.dzung.2k@gmail.com', 'Viet Nam', 951620, 1, 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laptop_specs`
--
ALTER TABLE `laptop_specs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`product_id`);

--
-- Indexes for table `order_basic`
--
ALTER TABLE `order_basic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `model` (`name`);

--
-- Indexes for table `smartphone_tablet_prototypes`
--
ALTER TABLE `smartphone_tablet_prototypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prototype` (`prototype`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `smartphone_tablet_specs`
--
ALTER TABLE `smartphone_tablet_specs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`product_id`),
  ADD KEY `prototype` (`prototype`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laptop_specs`
--
ALTER TABLE `laptop_specs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `smartphone_tablet_prototypes`
--
ALTER TABLE `smartphone_tablet_prototypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `smartphone_tablet_specs`
--
ALTER TABLE `smartphone_tablet_specs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laptop_specs`
--
ALTER TABLE `laptop_specs`
  ADD CONSTRAINT `laptop_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);

--
-- Constraints for table `smartphone_tablet_prototypes`
--
ALTER TABLE `smartphone_tablet_prototypes`
  ADD CONSTRAINT `smartphone_tablet_prototypes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `smartphone_tablet_specs`
--
ALTER TABLE `smartphone_tablet_specs`
  ADD CONSTRAINT `smartphone_tablet_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `smartphone_tablet_specs_ibfk_2` FOREIGN KEY (`prototype`) REFERENCES `smartphone_tablet_prototypes` (`prototype`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
