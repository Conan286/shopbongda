-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3309
-- Thời gian đã tạo: Th4 25, 2024 lúc 03:48 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopthoitrang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_image`) VALUES
(2, 'Admin', 'admin@gmail.com', '123', '00626-3406267920.jpeg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `ip_add` int(10) NOT NULL,
  `p_size` varchar(255) NOT NULL,
  `p_price` varchar(255) NOT NULL,
  `p_quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `ip_add`, `p_size`, `p_price`, `p_quantity`) VALUES
(200, 32, 0, '1', '690000', 1),
(202, 32, 0, '1', '690000', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) NOT NULL,
  `category_title` varchar(255) NOT NULL,
  `category_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`, `category_desc`) VALUES
(2, 'Nữ', ''),
(3, 'Nam', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `coupon_title` varchar(255) NOT NULL,
  `coupon_price` varchar(255) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_limit` int(100) NOT NULL,
  `coupon_used` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `product_id`, `coupon_title`, `coupon_price`, `coupon_code`, `coupon_limit`, `coupon_used`) VALUES
(12, 33, 'tesr', '590', 'test', 99, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_image` text NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `customer_password`, `customer_image`, `customer_ip`, `created_at`) VALUES
(28, 'User Test', 'user@gmail.com', '0123456789', 'HCM', '$2y$10$UKYpGB1LAmMXe1Fv9NfiH.FWiV0kZ0UzylPEpp1CIyDNGA6FfeUI2', '186459515_515604526308215_5245455360375216631_n.jpg', '::1', '2024-04-25 13:40:16'),
(30, 'User1', 'user1@gmail.com', '028395', 'abc', '$2y$10$1pcJc8Cr/nqROifWaHGk.eprkyGv3nsfPp./SMFsEmWCL1YjST0b2', '2023-10-04_02-58-33.png', '::1', '2024-04-25 13:40:16'),
(33, '2509roblox', '2509roblox@gmail.com', '2509roblox', '2509roblox', '$2y$10$aDzqLGipN7De4oQR0C/xwOC68lYnhhtOcHeX2ShN/wNeDhjLT.sXC', '34984539_123433795217891_3850175453419536384_n.jpg', '::1', '2024-04-25 13:40:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_orders`
--

CREATE TABLE `customer_orders` (
  `order_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `due_amount` int(100) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_quantity` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer_orders`
--

INSERT INTO `customer_orders` (`order_id`, `customer_id`, `due_amount`, `invoice_no`, `product_id`, `product_size`, `product_quantity`, `order_date`, `order_status`) VALUES
(10, 33, 590000, 'DH437942', 33, '2', 1, '2024-04-25', 'Pending');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL,
  `product_category_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_title` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_image_1` text NOT NULL,
  `product_image_2` text NOT NULL,
  `product_image_3` text NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_label` text NOT NULL,
  `product_sale` varchar(255) NOT NULL,
  `product_total` int(10) DEFAULT NULL,
  `product_quantity_size_s` int(11) DEFAULT NULL,
  `product_quantity_size_m` int(11) DEFAULT NULL,
  `product_quantity_size_l` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_category_id`, `category_id`, `date`, `product_title`, `product_price`, `product_image_1`, `product_image_2`, `product_image_3`, `product_keywords`, `product_description`, `product_label`, `product_sale`, `product_total`, `product_quantity_size_s`, `product_quantity_size_m`, `product_quantity_size_l`) VALUES
(19, 1, 2, '2024-01-05 06:38:53', 'Áo thi đấu clb Brighton', '650000', 'product_images/72126862_2399196567007918_36652662493544448_o.jpg', 'product_images/60337718_2294678607459715_7587335581248520192_o.jpg', 'product_images/72300551_2399191497008425_479029857280327680_o.jpg', 'dress, vay', 'BST mới nhất của Lalla lấy cảm hứng từ bộ phim Crash Landing on You - Hạ cánh nơi anh ✈️ với hình ảnh người phụ nữ hiện đại, năng động và đầy quyền lực. Chất tơ xốp Hàn bên ngoài và đầm lụa lót b&a', 'sale', '590000', 20, 147, 127, 120),
(21, 1, 2, '2024-01-03 08:00:14', 'Áo thi đấu clb Arsenal', '590000', 'product_images/49274283_2207455782848665_5964890596895096832_o.jpg', 'product_images/49210956_2207455802848663_2798101486024785920_o.jpg', 'product_images/49210956_2207455802848663_2798101486024785920_o.jpg', 'dress, vay', 'Với gam màu pastel nhẹ nhàng : Trắng , hồng , xanh, chiếc đầm Honu dress của Lalla sẽ giúp bạn thật thanh lịch và nữ tính dù ở bất cứ đâu.\r\n\r\n <br><br><br>\r\n\r\n-Màu: xanh, hồng', 'new', '0', 19, 14, 50, 24),
(23, 1, 2, '2024-01-03 08:00:25', 'Áo thi đấu clb Manchester United', '590000', 'product_images/47084530_2183357158591861_4386413819816050688_o.jpg', 'product_images/47084963_2183357118591865_5765777940277100544_o.jpg', 'product_images/47084963_2183357118591865_5765777940277100544_o.jpg', 'dress, vay', 'Jumpsuit Jubi của #lalla thích hợp cho các cô gái yêu thích vẻ năng động, bồng bềnh nhưng vẫn cá tính đây !!!\r\nChất vải mỏng nhẹ , form jumpsuit vừa vặn tạo độ thoải', 'new', '0', 13, 10, 15, 22),
(24, 9, 2, '2024-01-03 08:00:37', 'Áo thi đấu clb Manchester City', '970000', 'product_images/53678183_2250640148530228_1014424498826379264_o.jpg', 'product_images/53488075_2250638645197045_8604971770719502336_o.jpg', 'product_images/53488075_2250638645197045_8604971770719502336_o.jpg', 'top skirt', 'Nếu bạn đang tìm bộ cánh thanh lịch mà vẫn sang chảnh thì đừng bỏ lỡ set trang phục này của Lalla nhé ❤️\r\n\r\n <br><br><br>\r\n\r\n- Màu:  Kem , đỏ', 'sale', '870000', 13, 20, 11, 23),
(25, 1, 2, '2024-01-03 08:00:47', 'Áo thi đấu clb Real Madrid', '590000', 'product_images/89021214_2535040043423569_2145711342630207488_o.jpg', 'product_images/87385314_2535040080090232_936441791245189120_o.jpg', 'product_images/87385314_2535040080090232_936441791245189120_o.jpg', 'dress, vay', 'Không gì cuốn hút hơn 1 cô gái mặc váy lụa đỏ ?vì khi ấy nàng như một đoá hồng rực rỡ và kiêu sa đến não lòng ...\r\n<br><br><br>\r\n \r\n\r\n- Màu: đỏ - rê', 'new', '0', 5, 15, 5, 24),
(26, 1, 2, '2024-01-03 11:53:34', 'Áo Lino ', '690000', 'product_images/64828089_2338504446410464_7369705783019175936_o.jpg', 'product_images/67586870_2338504523077123_5408338306498822144_o.jpg', 'product_images/67091089_2338504719743770_1933520626560008192_o.jpg', 'dress, vay', 'Lalla chính thức lên kệ với những thiết kế nhẹ nhàng, trẻ trung và lãng đãng như chính tên gọi của BST.\r\n\r\n<br><br><br>\r\n\r\n- Màu: Xanh lá - Xanh cẩm thạch', 'new', '0', 34, 50, 21, 3),
(27, 9, 2, '2024-01-03 08:01:15', 'Áo Cobi', '900000', 'product_images/46514410_2178404795753764_580730220378587136_o.jpg', 'product_images/46485713_2178404872420423_524984813346619392_o.jpg', 'product_images/46519328_2178404842420426_1736984318959419392_o.jpg', 'top skirt', 'Thiết kế mới toanh trong BST mới của Lalla là chiếc áo Cobi top với chất voan lụa thoáng mát điểm xuyết chấm bi duyên dáng, Cobi Top 390.000, Tuta Skirt 420.000', 'sale', '810000', 37, 20, 10, 12),
(28, 9, 2, '2024-01-03 08:01:25', 'Áo Nono', '840000', 'product_images/65719129_2324549207805988_7892096113996464128_o.jpg', 'product_images/65370961_2324549577805951_8650683996709060608_o.jpg', 'product_images/65188678_2324549714472604_7817738556381593600_o.jpg', 'top skirt', 'Ngọt ngào nhưng vẫn vô cùng cá tính với những mẫu thiết kế mới nhất trong BST SUMMER VIBE của #Lalla', 'new', '0', 59, 11, 12, 13),
(30, 1, 2, '2024-01-03 08:01:36', 'Áo Tập', '690000', 'product_images/97478285_2596228327304740_6979566454387507200_o (1).jpg', 'product_images/96809365_2596228173971422_4155707954999328768_o.jpg', 'product_images/96809365_2596228173971422_4155707954999328768_o.jpg', 'dress, vay', 'BST mới nhất của Lalla lấy cảm hứng từ bộ phim Crash Landing on You - Hạ cánh nơi anh ✈️ với hình ảnh người phụ nữ hiện đại, năng động và đầy quyền lực. Chất tơ xốp Hàn bên ngoài và đầm lụa lót b&a', 'sale', '590000', 59, 5, 8, 10),
(31, 1, 2, '2024-04-25 12:00:16', 'Áo đấu clb Inter Miami', '590000', 'product_images/106719668.jpg', 'product_images/107693707.jpg', 'product_images/107663751.jpg', 'dress, vay', 'BST S/S 2020 của Lalla lấy cảm hứng từ khu vườn thiên nhiên với những sắc hoa pastel hồng, tím, baby blue nhẹ nhàng thanh thoát sẽ giúp mùa hè của bạn trở nên tươi trẻ và rực rỡ. Thiết kế độc quyền của thương hiệu thời trang Lalla. ', 'new', '0', -34, 40, 23, 27),
(32, 1, 2, '2024-04-25 12:39:10', 'Áo thi đấu clb Al Nassr', '690000', 'product_images/129841855_2778718839055687_4921207847791622071_o.jpg', 'product_images/129646589_2778719239055647_5672869489056169002_o.jpg', 'product_images/129938944_2778719585722279_3449075532910701693_o.jpg', 'dress, vay', 'XMAS PREMIUM COLLECTION là BST thời trang cao cấp độc quyền từ thương hiệu #Lalla của diễn viên MIDU ra mắt đặc biệt cho mùa lễ hội. Với tiêu chí Giá trị cao - Giá thành ưu đãi. Những sản phẩm của #Lalla luôn ưu tiên cho chất lượng, form dáng và giá thành vô cùng ưu đãi chỉ #590k', 'sale', '590000', 2, 12, 10, 25),
(33, 1, 2, '2024-04-25 12:56:26', 'Áo đội tuyển Anh', '590000', 'product_images/82196573_2481185252142382_7444610077085925376_o.jpg', 'product_images/81070717_2481184978809076_2107956170621714432_o.jpg', 'product_images/81090549_2481185388809035_7955383887327133696_o.jpg', 'dress, vay', 'Tết năm nay, hãy cùng Lalla, Midu và Jun Vũ tự tin trở thành người phụ nữ biết yêu thương và giải phóng chính bản thân mình bạn nhé.', 'new', '0', -190, 45, 38, 80);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_quantity_size`
--

CREATE TABLE `products_quantity_size` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity_s` int(11) DEFAULT NULL,
  `product_quantity_m` int(11) DEFAULT NULL,
  `product_quantity_l` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_quantity_size`
--

INSERT INTO `products_quantity_size` (`id`, `product_id`, `product_quantity_s`, `product_quantity_m`, `product_quantity_l`) VALUES
(1, 19, 147, 127, 120),
(2, 21, 14, 50, 24),
(3, 23, 10, 15, 22),
(4, 24, 20, 11, 23),
(5, 25, 15, 5, 24),
(6, 26, 50, 21, 3),
(7, 27, 20, 10, 12),
(8, 28, 11, 12, 13),
(9, 30, 5, 8, 10),
(10, 31, 50, 23, 27),
(11, 32, 12, 18, 25),
(12, 33, 45, 38, 80);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_categories`
--

CREATE TABLE `product_categories` (
  `product_category_id` int(10) NOT NULL,
  `product_category_title` varchar(255) NOT NULL,
  `product_category_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_categories`
--

INSERT INTO `product_categories` (`product_category_id`, `product_category_title`, `product_category_desc`) VALUES
(1, 'Dress', '\"Mùa hè và thể thao\" rất phong cách và đầy sức mạnh chính thức lên kệ với những thiết kế nhẹ nhàng, trẻ trung và năng động như chính tên gọi của PtitSport'),
(9, 'Top + Skirt', 'Thiết kế nhẹ nhàng, trẻ trung và lãng đãng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `rating` int(11) NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `customer_id`, `review_text`, `rating`, `review_date`) VALUES
(4, 33, 33, '123213', 5, '2024-04-25 13:46:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(10) NOT NULL,
  `slide_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_image`) VALUES
(1, 'slides_images/slide01b.jpg'),
(2, 'slides_images/slide02.jpg'),
(3, 'slides_images/slide03.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `customer_orders`
--
ALTER TABLE `customer_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `products_quantity_size`
--
ALTER TABLE `products_quantity_size`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `customer_orders`
--
ALTER TABLE `customer_orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `products_quantity_size`
--
ALTER TABLE `products_quantity_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `product_category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
