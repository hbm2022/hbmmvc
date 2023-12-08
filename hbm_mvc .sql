-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 03:36 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hbm_mvc`
--
CREATE DATABASE IF NOT EXISTS `hbm_mvc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hbm_mvc`;

-- --------------------------------------------------------

--
-- Table structure for table `fixedtransactionsfortransactions`
--

CREATE TABLE `fixedtransactionsfortransactions` (
  `id_transactions` int(11) NOT NULL,
  `id_fixtransactions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fixtransactionsforusers`
--

CREATE TABLE `fixtransactionsforusers` (
  `id_user` int(11) NOT NULL,
  `id_fixtransactions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groupforusers`
--

CREATE TABLE `groupforusers` (
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `savesforuser`
--

CREATE TABLE `savesforuser` (
  `user_id` int(11) NOT NULL,
  `saves_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblfixedtransactions`
--

CREATE TABLE `tblfixedtransactions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `next_published` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` float NOT NULL,
  `target_saving` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblfixedtransactions`
--

INSERT INTO `tblfixedtransactions` (`id`, `title`, `type`, `comment`, `created_at`, `next_published`, `amount`, `target_saving`, `user_id`) VALUES
(204, 'רר', 'הוצאה קבועה', '', '2023-03-01 22:26:00', '2023-05-02 22:26:00', 4, 0, 5),
(205, 'ששששש', 'הכנסה קבועה', 'דד', '2023-03-07 22:36:00', '2023-05-07 22:36:00', 16, 0, 5),
(207, '42', 'הכנסה קבועה', '42', '2023-03-20 21:30:00', '2023-05-20 21:30:00', 21, 0, 5),
(213, 'תחילת חודש', 'הוצאה קבועה', '', '2023-04-01 22:53:00', '2023-05-01 22:53:00', 15, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblgroups`
--

CREATE TABLE `tblgroups` (
  `id` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblgroups`
--

INSERT INTO `tblgroups` (`id`, `nickname`, `manager_id`, `type`) VALUES
(48, 'שדדד', 4, 'משפחת'),
(49, 'חישגוזים', 4, 'משפחת'),
(53, 'פולקע', 5, 'משפחת');

-- --------------------------------------------------------

--
-- Table structure for table `tblreports`
--

CREATE TABLE `tblreports` (
  `id` int(11) NOT NULL,
  `name` varchar(126) NOT NULL,
  `email` varchar(126) NOT NULL,
  `status` varchar(126) NOT NULL DEFAULT 'חדש',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL,
  `title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblreports`
--

INSERT INTO `tblreports` (`id`, `name`, `email`, `status`, `created_at`, `description`, `title`) VALUES
(5, 'aaaaaaaaaaaaas', 'eliran93211@gmail.com', 'חדש', '2022-12-30 22:17:39', 'ss', 'as'),
(6, 'מדווחחחח', 'mail@mil.mail', 'חדש', '2022-12-30 22:18:13', 'דיווווחחחחחחחח מתואר', 'כותרתתת');

-- --------------------------------------------------------

--
-- Table structure for table `tblsaves`
--

CREATE TABLE `tblsaves` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `target_amount` float NOT NULL,
  `current_amount` float NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsaves`
--

INSERT INTO `tblsaves` (`id`, `title`, `target_amount`, `current_amount`, `user_id`) VALUES
(1, 'רכב חדש', 545, 150200, 4),
(8, 'ננ', 4545, 0, 2),
(14, 'ד', 1, 0, 2),
(15, 'fff', 43, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbltransactions`
--

CREATE TABLE `tbltransactions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `published_at` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `target_saving` int(11) NOT NULL,
  `fixtransaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbltransactions`
--

INSERT INTO `tbltransactions` (`id`, `title`, `type`, `comment`, `published_at`, `amount`, `user_id`, `target_saving`, `fixtransaction_id`) VALUES
(42, 'דד', 'הוצאה קבועה', '', '2022-11-27 21:37:20', 3, 4, 0, 0),
(74, 'gus 50', 'הוצאה', '', '2022-11-20 11:18:00', 50, 5, 0, 0),
(84, 'חיסכון 1', 'הוצאה', '', '2022-12-02 16:43:00', 66, 5, 0, 0),
(86, 'ss', 'הוצאה', '', '2022-12-29 17:07:00', 4, 5, 0, 0),
(87, 'עשרוני', 'הכנסה', 'ע', '2022-11-27 00:30:00', 0.1, 5, 0, 0),
(92, 'גינון', 'הוצאה', 'פעמיים בחודש', '2022-12-01 23:17:00', 1000, 6, 0, 0),
(93, 'אחזקת מעליות + ביקורת מהנדס', 'הוצאה', '', '2022-12-01 23:18:00', 3320, 6, 0, 0),
(94, 'חברת ניקיון', 'הוצאה', '', '2022-12-01 23:21:00', 7000, 6, 0, 0),
(95, 'מילוי ריחנים אוטומטיים', 'הוצאה', '', '2022-12-30 23:21:00', 200, 6, 0, 0),
(96, 'חשמל בינין', 'הוצאה', '', '2022-12-10 23:22:00', 5000, 6, 0, 0),
(97, 'החלפת נורות', 'הוצאה', '', '2022-12-09 23:23:00', 350, 6, 0, 0),
(98, 'ביטוח צד ג + מבנה', 'הוצאה', '', '2022-12-01 23:24:00', 1650, 6, 0, 0),
(99, 'הדברה', 'הוצאה', '', '2022-12-01 23:26:00', 90, 6, 0, 0),
(100, 'אינטרנט + מצלמות', 'הוצאה', '', '2022-12-01 23:34:00', 120, 6, 0, 0),
(101, 'מערכות בניין', 'הוצאה', '', '2022-12-01 23:36:00', 3000, 6, 0, 0),
(109, 'as', 'הכנסה', '', '2022-12-07 13:39:00', 35, 6, 0, 0),
(110, 'gfh', 'הכנסה', '', '2022-11-29 10:29:00', 555, 6, 0, 0),
(111, 'dd', 'הוצאה', '', '2022-12-11 14:30:00', 44444, 6, 0, 0),
(120, 'gg', 'הכנסה', '', '2022-12-04 21:05:00', 66, 5, 0, 0),
(121, 'g', 'הוצאה', '', '2022-12-02 23:25:00', 44, 5, 0, 0),
(126, 'd', 'הוצאה', 'd', '2022-12-25 17:39:00', 4, 7, 0, 0),
(177, 'asdaaa', 'הוצאה', 'ddd', '2023-02-01 13:40:00', 222, 2, 0, 0),
(181, 'k', 'הוצאה', '', '2022-12-13 19:02:00', 0.5, 2, 0, 0),
(186, 'ss', 'הוצאה', 'asa', '2023-01-19 10:31:00', 22, 5, 0, 0),
(187, 'fgh', 'הוצאה', '', '2023-03-07 23:05:00', 4, 2, 0, 0),
(192, 'yj', 'הוצאה', 'yt', '2023-02-27 23:33:00', 55, 5, 0, 0),
(196, 'כןןןןןןןןן', 'הוצאה', '', '2023-03-14 23:22:00', 55, 5, 0, 0),
(215, 'רר', 'הוצאה קבועה', '', '2023-03-01 22:26:00', 4, 5, 0, 204),
(216, 'כככ', 'הוצאה', 'דד', '2023-03-15 22:36:00', 16, 5, 0, 205),
(217, 'גג', 'הוספה לחיסכון', 'שדג', '2023-03-26 23:17:00', 234, 5, 16, 206),
(218, 'שדגשדג', 'הוספה לחיסכון', '', '2023-03-27 23:22:00', 0.2311, 5, 17, 0),
(219, 'הוספה', 'הוספה לחיסכון', '', '2023-03-28 00:22:00', 3000, 5, 17, 0),
(220, 'hhh', 'הכנסה', '42', '2023-03-20 21:30:00', 21, 5, 0, 207),
(229, 'יש', 'הוספה לחיסכון', '', '2023-03-07 23:42:00', 25.2, 5, 27, 0),
(230, 'פיקדון', 'קיפול חיסכון', '15000 יעד', '2023-03-27 22:43:00', 25.2, 5, 0, 0),
(231, '333', 'הוספה לחיסכון', '', '2023-03-03 23:58:00', 0.255, 5, 29, 209),
(232, '55', 'הוספה לחיסכון', '', '2023-03-03 23:59:00', 900000, 5, 28, 210),
(233, 'אר', 'הוספה לחיסכון', '', '2023-03-16 00:01:00', 44, 5, 28, 211),
(234, 'ככ', 'הוספה לחיסכון', '', '2023-03-23 00:02:00', 10, 5, 28, 212),
(235, 'אחדדד', 'קיפול חיסכון', '1222 יעד', '2023-03-27 23:03:00', 900054, 5, 0, 0),
(237, 'לא נחשב', 'קיפול חיסכון', '333 יעד', '2023-03-28 20:22:00', 0.255, 5, 0, 0),
(240, 'ששששש', 'הכנסה קבועה', 'דד', '2023-04-07 22:36:00', 16, 5, 0, 205),
(241, '42', 'הכנסה קבועה', '42', '2023-04-20 21:30:00', 21, 5, 0, 207),
(242, 'תחילת חודש', 'הוצאה קבועה', '', '2023-04-01 22:53:00', 15, 5, 0, 213),
(244, 'dd', 'הוצאה', '', '2023-04-01 01:13:00', 232, 5, 0, 0),
(245, 'sad', 'הוצאה', '', '2023-04-02 01:13:00', 121, 5, 0, 0),
(246, 'df', 'הוצאה', 'fd', '2023-04-09 19:03:00', 44, 5, 0, 0),
(249, '444', 'הוספה לחיסכון', '', '2023-04-10 16:55:00', 15, 5, 30, 214),
(250, '444', 'קיפול חיסכון', '44222 יעד', '2023-04-10 15:56:00', 15, 5, 0, 0),
(251, 'Check 1', 'הוצאה', 'd', '2023-04-11 11:51:00', 22, 5, 0, 0),
(252, 'sa', 'הוצאה', 'as', '2023-04-11 14:40:00', 222, 5, 0, 0),
(253, 'eeeeeeeee', 'הכנסה', '', '2023-04-05 12:41:00', 2222220000, 5, 0, 0),
(254, 'dd', 'הוצאה', 'dd', '2023-04-11 14:41:00', 2222, 5, 0, 0),
(255, 'assasd', 'הוצאה', '', '2023-04-11 15:46:00', 234234, 5, 0, 0),
(256, 'dddd', 'הוצאה', '', '2023-04-01 17:49:00', 23, 5, 0, 0),
(257, 'jh', 'הכנסה', 'tt', '2023-04-11 04:04:00', 121, 5, 0, 0),
(258, 'zz', 'הוצאה', '', '2023-05-11 16:07:00', 55, 5, 0, 0),
(259, 'asd', 'הוצאה', 'asd', '2023-04-11 16:21:00', 22, 2, 0, 0),
(260, '21213', 'הכנסה', '', '2023-04-11 16:21:00', 321, 2, 0, 0),
(261, 'gfg', 'הוספה לחיסכון', '', '2023-04-11 16:26:00', 55, 5, 31, 0),
(262, 'ss', 'קיפול חיסכון', '21312 יעד', '2023-04-11 15:27:00', 55, 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'default_user',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `group_id` int(11) DEFAULT 0,
  `sum_expenses` float NOT NULL,
  `sum_revenues` float NOT NULL,
  `balance` float NOT NULL,
  `weekly_budget_threshold` float NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `reset_token_exp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `first_name`, `last_name`, `password`, `phone_number`, `email`, `type`, `created_at`, `group_id`, `sum_expenses`, `sum_revenues`, `balance`, `weekly_budget_threshold`, `reset_token`, `reset_token_exp`) VALUES
(1, 'Eliran Zabari', '', '$2y$10$xfwEw/OBUhofNn3bnR//ReF3HaAIb0qInzNXAERRJw8mRoh/FZ9E2', '', 'aa@aa.aa', 'admin', '2022-11-21 23:43:29', 0, 0, 0, 0, 0, '', '2023-01-31'),
(2, 'אלירן', 'צברי', '$2y$10$/IL0/ycKNbVCqSFQMhHeyOKhaGhIO/3uRnbtq5rw6777JskBNIZRa', '0542124524', 'eliran93211@gmail.com', 'low_user', '2022-11-22 17:40:49', 53, 22, 321, 299, 0, '', '0000-00-00'),
(4, 'ישראל', 'ישראלי', '$2y$10$IaQVU0Xe2QaJLyr3NeiH7.SC9H7Zqi3GF2hOOX8DX0fbT/ylA.JVG', '', 'user2@gmail.com', 'high_user', '2022-11-26 11:45:49', 48, 3, 0, -3, 0, '', '1899-12-31'),
(5, 'מיכלי', 'פולק', '$2y$10$e/xFSj5dd7Vll2mVwPYRhe/Etcmcyzn5Jcod4GEfEY7Y.bwAJ5CMu', '039320982', 'user1@gmail.com', 'high_user', '2022-11-27 23:04:53', 53, 237205, 2222220000, 2221980000, 333, '', '2023-01-31'),
(6, 'user4', 'sss', '$2y$10$C.v3QliKGcKq5ZeVVPK0Z.J6zLCTYw4LWI7KmjXDeU69F5ELDG1Zu', '0524367503', 'user4@gmail.com', 'waiting_to_confirmed', '2022-12-08 00:41:20', 13, 66174, 590, -65584, 0, '', '2023-01-31'),
(7, 'פרטי חדש', 'משפחה חדש', '$2y$10$PHxYXZVBzznPrnhuuCFNZOQ28/XFiYCX0rdalmsmtyQDqbC5SOjC.', '234234234222', 'test1@gg.gg', 'default_user', '2022-12-24 14:24:41', 0, 0, 0, 0, 0, '', '2023-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `transactionforsave`
--

CREATE TABLE `transactionforsave` (
  `transaction_id` int(11) NOT NULL,
  `save_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactionsforusers`
--

CREATE TABLE `transactionsforusers` (
  `id_user` int(11) NOT NULL,
  `id_transactions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fixedtransactionsfortransactions`
--
ALTER TABLE `fixedtransactionsfortransactions`
  ADD KEY `id_transactions` (`id_fixtransactions`),
  ADD KEY `id_fixtransactions` (`id_fixtransactions`),
  ADD KEY `id_transactions_2` (`id_transactions`);

--
-- Indexes for table `fixtransactionsforusers`
--
ALTER TABLE `fixtransactionsforusers`
  ADD UNIQUE KEY `id_fixtransactions` (`id_fixtransactions`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `id_fixtransactions_2` (`id_fixtransactions`);

--
-- Indexes for table `groupforusers`
--
ALTER TABLE `groupforusers`
  ADD UNIQUE KEY `id_user` (`id_user`,`id_group`),
  ADD KEY `id_group` (`id_group`);

--
-- Indexes for table `savesforuser`
--
ALTER TABLE `savesforuser`
  ADD UNIQUE KEY `user_id` (`user_id`,`saves_id`),
  ADD UNIQUE KEY `saves_id` (`saves_id`);

--
-- Indexes for table `tblfixedtransactions`
--
ALTER TABLE `tblfixedtransactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `target_saving` (`target_saving`);

--
-- Indexes for table `tblgroups`
--
ALTER TABLE `tblgroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblreports`
--
ALTER TABLE `tblreports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsaves`
--
ALTER TABLE `tblsaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltransactions`
--
ALTER TABLE `tbltransactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `target_saving` (`target_saving`),
  ADD KEY `fixtransaction_id` (`fixtransaction_id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactionforsave`
--
ALTER TABLE `transactionforsave`
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD UNIQUE KEY `save_id` (`save_id`);

--
-- Indexes for table `transactionsforusers`
--
ALTER TABLE `transactionsforusers`
  ADD UNIQUE KEY `id_transactions` (`id_transactions`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `id_transactions_2` (`id_transactions`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblfixedtransactions`
--
ALTER TABLE `tblfixedtransactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `tblgroups`
--
ALTER TABLE `tblgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tblreports`
--
ALTER TABLE `tblreports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblsaves`
--
ALTER TABLE `tblsaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbltransactions`
--
ALTER TABLE `tbltransactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fixedtransactionsfortransactions`
--
ALTER TABLE `fixedtransactionsfortransactions`
  ADD CONSTRAINT `fixedtransactionsfortransactions_ibfk_1` FOREIGN KEY (`id_fixtransactions`) REFERENCES `tblfixedtransactions` (`id`),
  ADD CONSTRAINT `fixedtransactionsfortransactions_ibfk_2` FOREIGN KEY (`id_transactions`) REFERENCES `tbltransactions` (`id`);

--
-- Constraints for table `fixtransactionsforusers`
--
ALTER TABLE `fixtransactionsforusers`
  ADD CONSTRAINT `fixtransactionsforusers_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tblusers` (`id`),
  ADD CONSTRAINT `fixtransactionsforusers_ibfk_4` FOREIGN KEY (`id_fixtransactions`) REFERENCES `tblfixedtransactions` (`id`);

--
-- Constraints for table `groupforusers`
--
ALTER TABLE `groupforusers`
  ADD CONSTRAINT `groupforusers_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `tblgroups` (`id`),
  ADD CONSTRAINT `groupforusers_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tblusers` (`id`);

--
-- Constraints for table `savesforuser`
--
ALTER TABLE `savesforuser`
  ADD CONSTRAINT `savesforuser_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tblusers` (`id`),
  ADD CONSTRAINT `savesforuser_ibfk_2` FOREIGN KEY (`saves_id`) REFERENCES `tblsaves` (`id`);

--
-- Constraints for table `transactionforsave`
--
ALTER TABLE `transactionforsave`
  ADD CONSTRAINT `transactionforsave_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `tbltransactions` (`id`),
  ADD CONSTRAINT `transactionforsave_ibfk_2` FOREIGN KEY (`save_id`) REFERENCES `tblsaves` (`id`);

--
-- Constraints for table `transactionsforusers`
--
ALTER TABLE `transactionsforusers`
  ADD CONSTRAINT `transactionsforusers_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tblusers` (`id`),
  ADD CONSTRAINT `transactionsforusers_ibfk_4` FOREIGN KEY (`id_transactions`) REFERENCES `tbltransactions` (`id`);
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

--
-- Dumping data for table `pma__bookmark`
--

INSERT INTO `pma__bookmark` (`id`, `dbase`, `user`, `label`, `query`) VALUES
(1, 'hbm_mvc', 'root', 'cpecific user', 'SELECT * FROM `tblusers` WHERE`id`=4');

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Dumping data for table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"angular_direct\":\"direct\",\"snap_to_grid\":\"off\",\"relation_lines\":\"true\",\"full_screen\":\"on\",\"small_big_all\":\">\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'Backup hbm Database', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"groupforusers\",\"savesforuser\",\"tblgroups\",\"tblsaves\",\"tbltransactions\",\"tblusers\",\"transactionforsave\",\"transactionsforusers\"],\"table_structure[]\":[\"groupforusers\",\"savesforuser\",\"tblgroups\",\"tblsaves\",\"tbltransactions\",\"tblusers\",\"transactionforsave\",\"transactionsforusers\"],\"table_data[]\":[\"groupforusers\",\"savesforuser\",\"tblgroups\",\"tblsaves\",\"tbltransactions\",\"tblusers\",\"transactionforsave\",\"transactionsforusers\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"csv_columns\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}'),
(2, 'root', 'database', 'hbn backup db', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"groupforusers\",\"savesforuser\",\"tblgroups\",\"tblsaves\",\"tbltransactions\",\"tblusers\",\"transactionforsave\",\"transactionsforusers\"],\"table_structure[]\":[\"groupforusers\",\"savesforuser\",\"tblgroups\",\"tblsaves\",\"tbltransactions\",\"tblusers\",\"transactionforsave\",\"transactionsforusers\"],\"table_data[]\":[\"groupforusers\",\"savesforuser\",\"tblgroups\",\"tblsaves\",\"tbltransactions\",\"tblusers\",\"transactionforsave\",\"transactionsforusers\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"csv_columns\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}'),
(3, 'root', 'server', 'hbm_mvc ', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"db_select[]\":[\"hbm_mvc\",\"phpmyadmin\",\"test\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@SERVER@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"yaml_structure_or_data\":\"data\",\"\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"csv_columns\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_drop_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_procedure_function\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

--
-- Dumping data for table `pma__navigationhiding`
--

INSERT INTO `pma__navigationhiding` (`username`, `item_name`, `item_type`, `db_name`, `table_name`) VALUES
('root', 'fixedtransactionsfortransactions', 'table', 'hbm_mvc', ''),
('root', 'fixtransactionsforusers', 'table', 'hbm_mvc', ''),
('root', 'groupforusers', 'table', 'hbm_mvc', ''),
('root', 'savesforuser', 'table', 'hbm_mvc', ''),
('root', 'transactionforsave', 'table', 'hbm_mvc', ''),
('root', 'transactionsforusers', 'table', 'hbm_mvc', '');

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

--
-- Dumping data for table `pma__pdf_pages`
--

INSERT INTO `pma__pdf_pages` (`db_name`, `page_nr`, `page_descr`) VALUES
('hbm_mvc', 1, 'realations');

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"hbm_mvc\",\"table\":\"tblusers\"},{\"db\":\"hbm_mvc\",\"table\":\"tbltransactions\"},{\"db\":\"hbm_mvc\",\"table\":\"tblfixedtransactions\"},{\"db\":\"hbm_mvc\",\"table\":\"tblsaves\"},{\"db\":\"hbm_mvc\",\"table\":\"fixtransactionsforusers\"},{\"db\":\"hbm_mvc\",\"table\":\"fixedtransactionsfortransactions\"},{\"db\":\"hbm_mvc\",\"table\":\"transactionsforusers\"},{\"db\":\"hbm_mvc\",\"table\":\"savesforuser\"},{\"db\":\"hbm_mvc\",\"table\":\"groupforusers\"},{\"db\":\"hbm_mvc\",\"table\":\"transactionforsave\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

--
-- Dumping data for table `pma__table_coords`
--

INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES
('hbm_mvc', 'fixedtransactionsfortransactions', 1, 1113, 495),
('hbm_mvc', 'fixtransactionsforusers', 1, 865, 37),
('hbm_mvc', 'groupforusers', 1, 308, 33),
('hbm_mvc', 'savesforuser', 1, 236, 193),
('hbm_mvc', 'tblfixedtransactions', 1, 1276, 102),
('hbm_mvc', 'tblgroups', 1, 66, 33),
('hbm_mvc', 'tblsaves', 1, 92, 328),
('hbm_mvc', 'tbltransactions', 1, 805, 269),
('hbm_mvc', 'tblusers', 1, 551, 26),
('hbm_mvc', 'transactionforsave', 1, 355, 576),
('hbm_mvc', 'transactionsforusers', 1, 798, 146);

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

--
-- Dumping data for table `pma__table_info`
--

INSERT INTO `pma__table_info` (`db_name`, `table_name`, `display_field`) VALUES
('hbm_mvc', 'tbltransactions', 'title');

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'hbm_mvc', 'tblfixedtransactions', '{\"sorted_col\":\"`tblfixedtransactions`.`next_published` ASC\"}', '2023-04-04 19:45:44'),
('root', 'hbm_mvc', 'tblgroups', '{\"sorted_col\":\"`tblgroups`.`manager_id` ASC\"}', '2022-12-19 12:39:48'),
('root', 'hbm_mvc', 'tbltransactions', '{\"sorted_col\":\"`tbltransactions`.`type` DESC\"}', '2023-03-19 22:54:56'),
('root', 'hbm_mvc', 'tblusers', '{\"sorted_col\":\"`id` ASC\"}', '2023-03-31 13:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2023-04-11 13:35:35', '{\"Console\\/Mode\":\"show\",\"Console\\/Height\":27.451999999999998,\"ThemeDefault\":\"pmahomme\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
