-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2025-06-17 17:59:23
-- 服务器版本： 9.1.0
-- PHP 版本： 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `admission`
--
CREATE DATABASE IF NOT EXISTS `admission` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `admission`;

-- --------------------------------------------------------

--
-- 表的结构 `admin_accounts`
--

DROP TABLE IF EXISTS `admin_accounts`;
CREATE TABLE IF NOT EXISTS `admin_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '管理员账号',
  `password` varchar(50) NOT NULL COMMENT '密码(明文)',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- 转存表中的数据 `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin123', '2025-06-17 03:41:29');

-- --------------------------------------------------------

--
-- 表的结构 `admission_results`
--

DROP TABLE IF EXISTS `admission_results`;
CREATE TABLE IF NOT EXISTS `admission_results` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) NOT NULL COMMENT '考生号',
  `id_card` varchar(18) NOT NULL COMMENT '身份证号',
  `name` varchar(50) NOT NULL COMMENT '考生姓名',
  `major` varchar(100) NOT NULL COMMENT '录取专业',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- 转存表中的数据 `admission_results`
--

INSERT INTO `admission_results` (`id`, `student_id`, `id_card`, `name`, `major`, `created_at`) VALUES
(1, '20230001', '440106199901011234', '张三', '计算机科学与技术', '2025-06-17 03:41:29'),
(2, '20230002', '440106199902022345', '李四', '软件工程', '2025-06-17 03:41:29'),
(3, '20230003', '440106199903033456', '王五', '人工智能', '2025-06-17 03:41:29');

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '新闻标题',
  `content` text NOT NULL COMMENT '新闻内容',
  `publish_date` date NOT NULL COMMENT '发布日期',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- 转存表中的数据 `news`
--

-- --------------------------------------------------------

--
-- 表的结构 `consultations`
--

DROP TABLE IF EXISTS `consultations`;
CREATE TABLE IF NOT EXISTS `consultations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '咨询人姓名',
  `phone` varchar(20) NOT NULL COMMENT '联系电话',
  `content` text NOT NULL COMMENT '咨询内容',
  `reply` text COMMENT '回复内容',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `replied_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 转存表中的数据 `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `publish_date`, `created_at`) VALUES
(1, '123123', '123123123', '2025-06-17', '2025-06-17 04:09:17'),
(2, '2232223', '232323232323', '2025-06-17', '2025-06-17 04:09:34'),
(3, '323323', '323323323323', '2025-06-17', '2025-06-17 04:09:47'),
(4, '444444', '4444444', '2025-06-17', '2025-06-17 04:09:55'),
(5, '555555', '555555555', '2025-06-17', '2025-06-17 04:10:02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
