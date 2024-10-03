-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2023-06-05 08:09:04
-- 伺服器版本： 8.0.31
-- PHP 版本： 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `klik_database1`
--

-- --------------------------------------------------------

--
-- 資料表結構 `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name_unique` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_description`) VALUES
(4, '中式料理', 'Ching chong'),
(5, '義式料理', 'Hawaii pizza '),
(8, '美式料理', 'what\'s up'),
(9, '日式料理', 'konijiwa'),
(13, '泰式料理', 'sawadika');

-- --------------------------------------------------------

--
-- 資料表結構 `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `post_topic` int NOT NULL,
  `post_by` int NOT NULL,
  `post_votes` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `post_topic` (`post_topic`),
  KEY `post_by` (`post_by`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `post_date`, `post_topic`, `post_by`, `post_votes`) VALUES
(159, '我愛curry', '2023-06-04 23:05:46', 67, 46, 0),
(161, '好吃欸', '2023-06-05 01:42:40', 69, 51, 0),
(162, '321', '2023-06-05 02:11:34', 69, 51, 0),
(165, '必勝客披薩有老鼠', '2023-06-05 11:45:20', 70, 56, 1),
(167, '挖鐵皮屋也太便宜了吧', '2023-06-05 14:10:04', 71, 46, 2),
(169, '真的欸我也這麼覺得', '2023-06-05 15:46:29', 71, 46, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `postvotes`
--

DROP TABLE IF EXISTS `postvotes`;
CREATE TABLE IF NOT EXISTS `postvotes` (
  `voteId` int NOT NULL AUTO_INCREMENT,
  `votePost` int NOT NULL,
  `voteBy` int NOT NULL,
  `voteDate` date NOT NULL,
  `vote` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`voteId`),
  KEY `voteBy` (`voteBy`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `postvotes`
--

INSERT INTO `postvotes` (`voteId`, `votePost`, `voteBy`, `voteDate`, `vote`) VALUES
(38, 165, 56, '2023-06-05', 1),
(39, 160, 56, '2023-06-05', 1),
(40, 158, 56, '2023-06-05', 1),
(41, 167, 46, '2023-06-05', 1),
(42, 167, 57, '2023-06-05', 1),
(43, 169, 46, '2023-06-05', 1);

--
-- 觸發器 `postvotes`
--
DROP TRIGGER IF EXISTS `calc_forum_votes_after_delete`;
DELIMITER $$
CREATE TRIGGER `calc_forum_votes_after_delete` AFTER DELETE ON `postvotes` FOR EACH ROW BEGIN

		update posts
        set posts.post_votes = posts.post_votes - old.vote
        where posts.post_id = old.votePost;	

END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `calc_forum_votes_after_insert`;
DELIMITER $$
CREATE TRIGGER `calc_forum_votes_after_insert` AFTER INSERT ON `postvotes` FOR EACH ROW BEGIN
	
	update posts
        set posts.post_votes = posts.post_votes + new.vote
        where posts.post_id = new.votePost;	
		
    END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `calc_forum_votes_after_update`;
DELIMITER $$
CREATE TRIGGER `calc_forum_votes_after_update` AFTER UPDATE ON `postvotes` FOR EACH ROW BEGIN
	
		update posts
        set posts.post_votes = posts.post_votes + (new.vote * 2)
        where posts.post_id = new.votePost;	
		
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
CREATE TABLE IF NOT EXISTS `restaurants` (
  `res_id` int NOT NULL AUTO_INCREMENT,
  `res_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`res_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `restaurants`
--

INSERT INTO `restaurants` (`res_id`, `res_name`) VALUES
(1, '牛旺'),
(2, '必勝客'),
(3, '築間'),
(4, '柴點'),
(5, '鐵皮屋'),
(6, '天香福'),
(7, '食大客'),
(8, '早到晚到'),
(9, '陳麻飯'),
(10, '雙醬咖哩');

-- --------------------------------------------------------

--
-- 資料表結構 `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int NOT NULL AUTO_INCREMENT,
  `topic_subject` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_cat` int NOT NULL,
  `topic_by` int NOT NULL,
  `topic_img` varchar(500) DEFAULT NULL,
  `topic_res` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `topic_cat` (`topic_cat`),
  KEY `topic_by` (`topic_by`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`, `topic_img`, `topic_res`) VALUES
(67, '陳啟恩陳啟恩', '2023-06-04 23:05:46', 5, 46, '../uploads/647ca84a7e3195.31017925.jpg', '10'),
(69, '你好', '2023-06-05 01:42:40', 13, 51, '../uploads/647ccd103ecdf8.52972500.jpg', '2'),
(70, '必勝客披薩有老鼠', '2023-06-05 11:45:20', 5, 56, '../uploads/647d5a5016b818.28615292.jpg', '2'),
(71, '鐵皮屋好吃', '2023-06-05 14:10:04', 4, 46, '../uploads/647d7c3c934820.64363006.jpg', '5');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int NOT NULL AUTO_INCREMENT,
  `userLevel` int NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `gender` char(1) NOT NULL,
  `headline` varchar(500) DEFAULT NULL,
  `bio` varchar(4000) DEFAULT NULL,
  `userImg` varchar(500) DEFAULT 'default.png',
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb3;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`idUsers`, `userLevel`, `name`, `uidUsers`, `emailUsers`, `pwdUsers`, `gender`, `headline`, `bio`, `userImg`) VALUES
(40, 0, 'kaiwei', 'kaiwei', 'kaiweiwang0106@gmail.com', '$2y$10$Nu4NlvaERaa1XA6lkLyCsulZ0Fb3CESWkLFwd7gHYvMbRtrtl/r4y', 'm', 'fuck you', '', '647d7d32245116.68723770.jpg'),
(46, 0, '69', '123', '69@gmail.com', '$2y$10$2Z6pSYOl0dr.rO.H0K/q1eD/RU0meV5OoAIFmu3sGBqYYnLSSM5su', 'm', '696996', '美式料理 日式料理 中式料理 義式料理 泰式料理 ', '647b89aab32b24.09671266.jpg'),
(51, 0, '王凱', '321', '321@gmail.com', '$2y$10$Z6InT/I.owAZIryuP5idPeipieLWjU9VG6HGLsQ5m4RxB.qbJ0vpG', 'm', '', '', '647ccceb1e0504.91979948.jpg'),
(52, 0, '878', '456', '456@gmail.com', '$2y$10$LQVNqiuKsVWlaoGhB1ACJuX5Vp.qnDvDaT7Fw3G4PPGz6HGxV38Bq', 'f', '我好帥', '義大利麵、ramen\r\n', '647d7d44387954.78317548.jpg'),
(56, 0, '謝凱勳', 'kaiwei0106', 'kaiweiwang0106@gmail.com', '$2y$10$v9H9cgrlGahvv3O1wy7hpuVeovWJAdX/pm3bpVoHGBw6tSco1c0lm', 'm', 'fuck you', '7888879999799797', '647d59bac6cdb5.07333484.png'),
(57, 0, 'DOGY', '8787', 'DOG@gmail.com', '$2y$10$Rlbe19ywcwl0HliUtCvhkuS6JPiS5LIVvAGKj34nBlgBxXhwxTbqe', 'm', '我是狗狗', '中式料理 日式料理 ', '647d8d6f606d60.15594262.jpg');

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_topic`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_by`) REFERENCES `users` (`idUsers`) ON UPDATE CASCADE;

--
-- 資料表的限制式 `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`topic_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`topic_by`) REFERENCES `users` (`idUsers`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
