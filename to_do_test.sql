--
-- Database: `to_do_test`
--
CREATE DATABASE IF NOT EXISTS `to_do_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `to_do_test`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories_tasks`
--

CREATE TABLE `categories_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories_tasks`
--

INSERT INTO `categories_tasks` (`id`, `category_id`, `task_id`) VALUES
(2, 10, 2),
(3, 11, 3),
(4, 11, 4),
(6, 19, 14),
(7, 20, 14),
(9, 30, 16),
(10, 31, 17),
(11, 31, 18),
(13, 39, 29),
(14, 40, 29),
(16, 50, 31),
(17, 51, 32),
(18, 51, 33),
(20, 58, 44),
(21, 59, 45),
(22, 60, 45),
(24, 70, 47),
(25, 71, 48),
(26, 71, 49),
(28, 78, 60),
(29, 79, 61),
(30, 80, 61),
(32, 90, 63),
(33, 91, 64),
(34, 91, 65),
(36, 98, 76),
(37, 99, 77),
(38, 100, 77),
(40, 111, 81),
(41, 112, 82),
(42, 112, 83),
(44, 119, 94),
(45, 120, 95),
(46, 121, 95),
(48, 132, 99),
(49, 133, 100),
(50, 133, 101),
(52, 140, 112),
(53, 141, 113),
(54, 142, 113),
(56, 153, 117),
(57, 154, 118),
(58, 154, 119),
(60, 161, 130),
(61, 162, 131),
(62, 163, 131),
(64, 174, 135),
(65, 175, 136),
(66, 175, 137),
(68, 182, 148),
(69, 183, 149),
(70, 184, 149),
(72, 195, 153),
(73, 196, 154),
(74, 196, 155),
(76, 203, 166),
(77, 204, 167),
(78, 205, 167),
(80, 216, 171),
(81, 217, 172),
(82, 217, 173),
(84, 224, 184),
(85, 225, 185),
(86, 226, 185),
(88, 237, 189),
(89, 238, 190),
(90, 238, 191),
(92, 245, 202),
(93, 246, 203),
(94, 247, 203),
(96, 258, 207),
(97, 259, 208),
(98, 259, 209),
(100, 266, 220),
(101, 267, 221),
(102, 268, 221),
(104, 279, 225),
(105, 280, 226),
(106, 280, 227),
(108, 287, 238),
(109, 288, 239),
(110, 289, 239),
(112, 300, 243),
(113, 301, 244),
(114, 301, 245),
(116, 308, 256),
(117, 309, 257),
(118, 310, 257),
(120, 321, 261),
(121, 322, 262),
(122, 322, 263),
(124, 329, 274),
(125, 330, 275),
(126, 331, 275),
(128, 342, 279),
(129, 343, 280),
(130, 343, 281),
(132, 350, 292),
(133, 351, 293),
(134, 352, 293),
(136, 363, 297),
(137, 364, 298),
(138, 364, 299),
(140, 371, 310),
(141, 372, 311),
(142, 373, 311),
(144, 383, 313),
(145, 384, 314),
(146, 384, 315),
(148, 391, 326),
(149, 392, 327),
(150, 393, 327),
(152, 403, 331),
(153, 404, 332),
(154, 404, 333),
(156, 411, 344),
(157, 412, 345),
(158, 413, 345),
(160, 423, 349),
(161, 424, 350),
(162, 424, 351),
(164, 431, 362),
(165, 432, 363),
(166, 433, 363),
(168, 443, 365),
(169, 444, 366),
(170, 444, 367),
(172, 451, 378),
(173, 452, 379),
(174, 453, 379),
(176, 463, 383),
(177, 464, 384),
(178, 464, 385),
(180, 471, 396),
(181, 472, 397),
(182, 473, 397),
(184, 483, 401),
(185, 484, 402),
(186, 484, 403),
(188, 491, 414),
(189, 492, 415),
(190, 493, 415);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `completion` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `categories_tasks`
--
ALTER TABLE `categories_tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494;
--
-- AUTO_INCREMENT for table `categories_tasks`
--
ALTER TABLE `categories_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
