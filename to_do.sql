--
-- Database: `to_do`
--
CREATE DATABASE IF NOT EXISTS `to_do` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `to_do`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(5, 'Yard work'),
(6, 'WAY BACK WHEN'),
(7, 'Pet Stuff');

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
(1, 1, 1),
(2, 2, 2),
(3, 4, 5),
(4, 4, 5),
(5, 4, 3),
(6, 4, 4),
(7, 4, 3),
(8, 5, 6),
(9, 5, 7),
(10, 5, 6),
(11, 5, 7),
(12, 6, 8),
(13, 6, 9),
(14, 6, 10);

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
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `description`, `due_date`, `completion`) VALUES
(6, 'weed the veggie bed', '2016-02-29', 1),
(7, 'Green thumb', '2016-02-10', 1),
(8, 'Clean stove', '2016-03-04', NULL),
(9, 'Wash floors', '2016-03-05', NULL),
(10, 'ewrr', '2013-09-10', 1);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `categories_tasks`
--
ALTER TABLE `categories_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
