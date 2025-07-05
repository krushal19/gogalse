CREATE DATABASE gogalse;


CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `cart` (`id`, `product_id`, `name`, `price`, `image`, `added_at`) VALUES
(25, 9, 'img2', 99999999.99, 'gogalse/images/img2.jpg', '2025-05-12 05:55:10'),
(28, 8, 'img1', 99999999.99, 'gogalse/images/img1.jpg', '2025-06-17 02:15:45'),
(36, 9, 'img2', 99999999.99, 'gogalse/images/img2.jpg', '2025-06-23 10:48:51'),
(37, 8, 'img1', 99999999.99, 'gogalse/images/img1.jpg', '2025-07-03 02:06:09'),
(38, 10, 'img3', 9898989.00, 'gogalse/images/img3.jpg', '2025-07-03 02:06:11');



CREATE TABLE `customer` (
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `goggles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `goggles` (`id`, `name`, `type`, `image`, `price`, `description`) VALUES
(1, 'RayBan Aviator', 'Sunglasses', 'assets/images/rayban.jpg', 120.00, 'Stylish aviator sunglasses for daily wear'),
(2, '3M Safety Glasses', 'Safety Goggles', 'assets/images/3m.jpg', 20.00, 'Protective eyewear for industrial use'),
(3, 'Speedo Swim Goggles', 'Swimming Goggles', 'assets/images/speedo.jpg', 25.00, 'Anti-fog swimming goggles for clear vision'),
(4, 'Smith I/O Mag', 'Ski Goggles', 'assets/images/ski.jpg', 180.00, 'Premium ski goggles for snow sports'),
(5, 'Meta Quest 2', 'VR Goggles', 'assets/images/vr.jpg', 299.00, 'Advanced virtual reality headset');



CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `orders` (`id`, `name`, `address`, `city`, `zip`, `phone`, `total_price`, `created_at`) VALUES
(11, 'khushi', 'fukfghtuhg', 'bardoli', '89562325', '9876541478', 99999999.99, '2025-05-08 06:29:02'),
(12, 'khushi', 'fukfghtuhg', 'bardoli', '89562325', '9876541478', 19.99, '2025-05-08 06:32:01'),
(13, 'khushi', 'fukfghtuhg', 'bardoli', '89562325', '9876541478', 0.00, '2025-05-08 06:38:17'),
(14, 'jk', 'hyygghgytrf', 'surat', '394111', '0987654565', 99999999.99, '2025-05-08 06:40:19'),
(15, 'khushi', 'hyygghgytrf', 'bardoli', '897654', '0987654565', 99999999.99, '2025-05-08 06:43:35'),
(16, 'jk', 'fukfghtuhg', 'surat', '897654', '9876541478', 99999999.99, '2025-05-09 11:41:38'),
(17, 'jk', 'fukfghtuhg', 'surat', '897654', '9876541478', 99999999.99, '2025-05-12 05:55:39'),
(18, 'joshi krushal', '55,sardarvill', 'bardoli', '394601', '9876541478', 99999999.99, '2025-06-16 18:38:36'),
(19, 'joshi krushal', '55,sardarvill', 'bardoli', '394601', '78994564236', 99999999.99, '2025-06-17 02:16:09'),
(20, 'joshi krushal', '55,sardarvill', 'bardoli', '394601', '560556055605', 99999999.99, '2025-06-19 05:25:26'),
(21, 'joshi krushal', '55,sardarvill', 'bardoli', '394601', '9876541478', 99999999.99, '2025-06-23 02:04:30'),
(22, 'joshi krushal', '55,sardarvill', 'bardoli', '394601', '9876541478', 99999999.99, '2025-07-03 02:05:06'),
(23, 'joshi krushal', '55,sardarvill', 'bardoli', '394601', '9876541478', 99999999.99, '2025-07-03 02:06:41');



CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `company` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `products` (`id`, `name`, `type`, `image`, `price`, `description`, `created_at`, `company`, `user_id`) VALUES
(8, 'img1', 'sun gogalse', 'gogalse/images/img1.jpg', 99999999.99, 'best img1 sun gogalse', '2025-05-07 07:53:31', NULL, 0),
(9, 'img2', 'sun gogalse', 'gogalse/images/img2.jpg', 99999999.99, 'img2 sun gogalse', '2025-05-07 07:55:19', NULL, 0),
(10, 'img3', 'sun gogalse', 'gogalse/images/img3.jpg', 9898989.00, 'img3 sun gogalse', '2025-05-07 07:56:04', NULL, 0),
(11, 'img4', 'sun gogalse', 'gogalse/images/img4.jpg', 99999999.99, 'img4 sun gogalse', '2025-05-07 07:56:36', NULL, 0),
(12, 'i1', 'number gogalse', 'gogalse/images/i1.jpg', 111119.00, 'number gogalse', '2025-05-07 08:01:41', NULL, 0),
(13, 'i2', 'number gogalse', 'gogalse/images/i2.jpg', 99999999.99, 'number gogalse', '2025-05-07 08:02:11', NULL, 0),
(14, 'i3', 'number gogalse', 'gogalse/images/i3.jpg', 997874.00, 'number gogalse', '2025-05-07 08:02:38', NULL, 0),
(15, 'i4', 'number gogalse', 'gogalse/images/i4.jpg', 859674.00, 'number gogalse', '2025-05-07 08:03:12', NULL, 0),
(16, 'jk', '1 Sun GoGalse', 'gogalse/images/h1.jpg.png', 99999.00, 'demo for edite option', '2025-05-07 08:09:08', 'Ray-Ban', 0),
(17, 'i1.1', '2 Num GoGalse', 'gogalse/images/i1.jpg', 99999999.99, 'example ', '2025-05-07 08:15:28', 'Ray-Ban', 0),
(18, 'jk', '2 Num GoGalse', 'gogalse/images/IMG_20240423_100539.jpg', 999.00, 'hgugiy', '2025-05-08 04:55:05', 'Gucci', 0),
(22, 'demo2', '2 Num GoGalse', 'gogalse/images/kajalmaam.jpg', 125.00, 'demo2', '2025-05-12 04:58:07', 'Armani', 0),
(23, 'demo1', '1 Sun GoGalse', 'gogalse/images/68218a1d0f6b0_IMG_20240512_191131.jpg', 9896.00, 'demo1', '2025-05-12 05:41:49', 'Armani', 0),
(25, 'ndemo1', '1 Sun GoGalse', 'gogalse/images/68218b603b173_IMG_20240428_000455.jpg', 99999999.99, 'ndemo1 image and prodiuct', '2025-05-12 05:47:12', 'Ray-Ban', 2),
(26, 'newus', '1 Sun GoGalse', 'gogalse/images/68218d1449d6e_IMG_20240423_101432.jpg', 99999999.99, 'demo test njhfjbrhej', '2025-05-12 05:54:28', 'Gucci', 2),
(27, 'jkvghj cfgmmmmmm', '1 Sun GoGalse', 'gogalse/images/68665484a4c3e_canvademo bnana.png', 111111.00, 'after iupdate sellet.php', '2025-07-03 09:59:32', 'Ray-Ban', 31);




CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','seller') NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`, `phone`) VALUES
(2, 'seller1', 'pass123', 'seller', 'example@example.com', '1234567890'),
(3, 'joshi', '$2y$10$4f8x2bQOxXQ6N9BOrOYJaeXntKjoC307fqGb7yGTZsl2XTxBoC0JW', 'customer', '', 'N/A'),
(4, 'krushal', '$2y$10$O19mzate2DtqQKMpEETCneUJBMxgf6X.O1wbs62qRhN3oDDSm00qq', 'customer', '', 'N/A'),
(5, 'jkr', '$2y$10$cHMpCg/496djUlybSqD3me7wmALMuqRPRmrYr2phj5Lg4XwgyaxEy', 'seller', '', 'N/A'),
(6, 'farhan', '$2y$10$zqwmm1r8jRAkQxLBU1sNvebrkxlkLL5IjEegA3TSz6rRL0HcwxtNy', 'customer', '', 'N/A'),
(7, 'rana', '$2y$10$f3aq3xXa7SACL31I7kvQpe5QEWGdEUfHuD.t8k1J4Vvf45UNEIpaO', 'seller', '', 'N/A'),
(8, 'ram', '$2y$10$hTcsqbXi8QlX7LmU8lwqhuq/Z2w45zAGnuMjg.QV2nZ8N7gbBgYfi', 'seller', '', 'N/A'),
(9, 'ravi', '$2y$10$THOU/odeEBbJlUQ/R8dmr.TdV59RSknZRNQJXI3P0rB.FlPlfUSgO', 'seller', '', 'N/A'),
(11, 'cus', '$2y$10$KA5h15Qo9S71yfHt807I7eoQewBSRDsAX683ngHRJCC.L7bEGpUjG', 'customer', '', 'N/A'),
(13, 'se', '$2y$10$md1vaMYsqvI5BnNNC1KRxebokw6XsYVDKCNMC01N./K9lLzG4tkpa', 'seller', '', 'N/A'),
(14, 'cus2', '$2y$10$DjCwBHJ0lVhzU4Hm1h2WKuQdqEaEkB6pYXro4wcvpQiUsgqRUTbim', 'customer', '', 'N/A'),
(15, 'example', '$2y$10$3SeNsdtr0dLP2uBbZlvm9u8Vmp3BL9AEnOPs2i5zdHJeSCuQq8yum', 'customer', '', 'N/A'),
(16, 'joshi123', '$2y$10$Uq7G4JawO1U6dxfABJi6Z.kRvIAV0TDp2UKEF.Acgke6NmbX7U4LO', 'customer', '', 'N/A'),
(17, 'cus123', '$2y$10$o5zYvjKIsB/g0ezzyVpk0eUlrqcVBVB/FYTlkWXiIEXbZFxyXNmOC', 'customer', '', 'N/A'),
(18, 'se123', '$2y$10$fjzW3eWyhSpJjwGxi4z3ZeeLSbrVuLNADlJhCJDLBP0Ru4EJ0Xas.', 'seller', '', 'N/A'),
(19, 'demo1', '$2y$10$qVkAB/Rmvw/cCI2rMxh8legf40vrhhj6POqibvnFDmYScBidaK8gu', 'seller', '', 'N/A'),
(20, 'ndemo1', '$2y$10$Qy.VCqNJuaXEKyN8fCplEeUXVqdTL8SC0bvWThKuToTcesPsojAwC', 'seller', '', 'N/A'),
(21, 'newus', '$2y$10$NK1DMmuO7tjVUtCldJTHmeK8cpeioChqpX8HHS/KMDbFlZxRwN0BS', 'seller', '', 'N/A'),
(22, 'exam1', '$2y$10$Tn3nhaacu9Ku.mctw9SRZeTbgDIwRhp.DuXty9BMU9WjOlInrabPW', 'customer', 'exam@gmail.com', '1231231231'),
(24, 'ram123', '$2y$10$ncVI/6.XTUCYjctYTQK/O.vpq7REK.Z19gSN7iFM8cs4LPWm/eAJW', 'seller', 'ram123@gmail.com', '1234567895'),
(25, 'ram5605', '$2y$10$DsRqukHaJ5k16tJKRiiFN.zSVzDHfUVxnPx5/9JVwiJ8hhbeC2OT2', 'seller', 'ram5605@gmail.com', '560556055605'),
(26, 'jk123', '$2y$10$L75LyYC7Wc4f74pIcAvtWePz2xnQkTnvmbEO.eOc4.rLY93yIcdzq', 'seller', 'jk123@gmail.com', '1234567854'),
(27, 'raj', '$2y$10$eAldaGidcTyoXQCDUnr2We5Yrk8qmpPEqci0VakRG814VegBH2Vqm', 'customer', 'raj1@gmail.com', '7897537419'),
(28, 'a1', '$2y$10$P3LBXtPFlfk.9qySFjfawe0itol62EFHxVdBwAI4Cl2IDUbE2jZAW', 'seller', 'a1@gmail.com', '9876541478'),
(29, 'mmmm', '$2y$10$OG8sf.uCk7al3C0ZG5oncOQc27KmoEUjDwbcZBVMBp7AGRVgqvozq', 'seller', 'acb@gmail.com', '9876541478'),
(30, 'c1', '$2y$10$zHQRG9G3MsSAMEb5p5f3AeOTRHciH8ykE/q5jD5CZhXpg/5nXJgii', 'customer', 'c1@gmail.com', '9876541478'),
(31, 'm1', '$2y$10$Kio5wgcho6teMasxY7AJ7.jbquu1H3o7lRpSDXHOsZ4qbn78eMfcC', 'seller', 'm1@gmail.com', '8596526345');


ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`);

  ALTER TABLE `goggles`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

  ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

  ALTER TABLE `customer`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

  ALTER TABLE `goggles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

  ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

  ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;