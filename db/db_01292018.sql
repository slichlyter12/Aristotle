-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host: oniddb
-- Generation Time: Jan 30, 2018 at 12:04 AM
-- Server version: 5.5.58
-- PHP Version: 5.2.6-1+lenny16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `likang-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `d_dictionary`
--

CREATE TABLE IF NOT EXISTS `d_dictionary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dict_attribute` varchar(20) NOT NULL,
  `dict_value` int(11) NOT NULL,
  `dictdata_value` varchar(50) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `d_dictionary`
--

INSERT INTO `d_dictionary` (`id`, `dict_attribute`, `dict_value`, `dictdata_value`, `comment`) VALUES
(1, 'user_type', 0, 'Student', NULL),
(2, 'user_type', 1, 'TA', NULL),
(3, 'question_status', 0, 'proposed', NULL),
(4, 'question_status', 1, 'answered', NULL),
(5, 'question_status', 2, 'deleted', NULL),
(6, 'question_status', 3, 'signed', NULL),
(7, 'user_type', 2, 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `r_user_class`
--

CREATE TABLE IF NOT EXISTS `r_user_class` (
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`class_id`,`role`),
  KEY `fk_r_user_class_to_t_class` (`class_id`),
  KEY `fk_r_user_class_to_t_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `r_user_class`
--

INSERT INTO `r_user_class` (`user_id`, `class_id`, `role`) VALUES
(1, 1, 2),
(2, 1, 1),
(3, 1, 0),
(3, 1, 1),
(4, 1, 1),
(6, 1, 0),
(7, 1, 0),
(8, 1, 0),
(9, 1, 0),
(10, 1, 0),
(12, 1, 0),
(13, 1, 0),
(15, 1, 0),
(18, 1, 0),
(19, 1, 0),
(19, 1, 1),
(20, 1, 1),
(21, 1, 1),
(22, 1, 1),
(23, 1, 1),
(24, 1, 1),
(25, 1, 1),
(26, 1, 1),
(27, 1, 1),
(28, 1, 1),
(29, 1, 1),
(30, 1, 1),
(31, 1, 1),
(32, 1, 1),
(33, 1, 1),
(34, 1, 1),
(35, 1, 1),
(36, 1, 1),
(37, 1, 1),
(38, 1, 1),
(39, 1, 1),
(40, 1, 0),
(40, 1, 1),
(41, 1, 1),
(42, 1, 1),
(43, 1, 1),
(44, 1, 1),
(45, 1, 1),
(46, 1, 1),
(47, 1, 1),
(50, 1, 1),
(7, 7, 0),
(10, 7, 0),
(11, 7, 0),
(11, 7, 1),
(11, 7, 2),
(12, 7, 0),
(14, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_class`
--

CREATE TABLE IF NOT EXISTS `t_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `t_class`
--

INSERT INTO `t_class` (`id`, `name`) VALUES
(1, 'CS 161 Introduction to Computer Science I'),
(7, 'CS561-POSTMAN');

-- --------------------------------------------------------

--
-- Table structure for table `t_keywords`
--

CREATE TABLE IF NOT EXISTS `t_keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `value` varchar(50) NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_keywords_to_t_class` (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `t_keywords`
--

INSERT INTO `t_keywords` (`id`, `class_id`, `value`, `comment`) VALUES
(23, 7, '1', 'postman'),
(24, 7, '2', 'test'),
(29, 7, 'postman_tag', 'postman_tag'),
(30, 7, 'postman_tag', 'postman_tag'),
(31, 7, 'postman_tag', 'postman_tag'),
(32, 7, 'postman_tag', 'postman_tag'),
(33, 7, 'postman_tag', 'postman_tag'),
(34, 7, 'postman_tag', 'postman_tag'),
(35, 7, 'postman_tag', 'postman_tag'),
(36, 7, 'postman_tag', 'postman_tag'),
(37, 7, 'postman_tag', 'postman_tag'),
(40, 7, 'grading', 'grading'),
(42, 7, 'new tag', 'new tag'),
(49, 1, 'functions', 'functions'),
(50, 1, 'conditionals', 'conditionals'),
(51, 1, 'variables', 'variables'),
(52, 1, 'assignment', 'assignment'),
(53, 1, 'bug', 'bug');

-- --------------------------------------------------------

--
-- Table structure for table `t_question`
--

CREATE TABLE IF NOT EXISTS `t_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `stdnt_first_name` varchar(100) NOT NULL,
  `stdnt_last_name` varchar(100) NOT NULL,
  `stdnt_user_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `course_keywords` varchar(100) DEFAULT NULL,
  `preferred_time` datetime DEFAULT NULL,
  `ta_first_name` varchar(100) DEFAULT NULL,
  `ta_last_name` varchar(100) DEFAULT NULL,
  `ta_user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 proposed,  2 deleted',
  `concern` varchar(1000) DEFAULT NULL,
  `num_liked` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_t_question_to_t_class` (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `t_question`
--

INSERT INTO `t_question` (`id`, `class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `ta_first_name`, `ta_last_name`, `ta_user_id`, `status`, `concern`, `num_liked`, `comment`) VALUES
(2, 1, 'TBA', 'TBA', 3, '2017-11-29 12:16:44', 'vbvn', 'fghfhgfgh', 'new tag', '2017-11-29 12:16:44', 'Jianchang', 'Bi', 7, 3, 'Kai Liu,2017-11-29 15:56:23.Jianchang Bi,2017-11-30 13:36:16.Kai Tu,2017-11-30 13:46:03.Andrew Anderson,2017-11-30 16:47:17.Chengxi Yang,2018-01-28 19:36:31.', 5, NULL),
(3, 1, 'Jianchang', 'Bi', 5, '2017-11-29 12:37:56', 'rwdas', 'sdasd', 'new tag', '2017-11-29 12:37:56', 'Jianchang', 'Bi', 7, 3, NULL, 0, NULL),
(4, 1, 'Jianchang', 'Bi', 5, '2017-11-29 12:56:04', 'rwa', 'weqe', 'new tag', '2017-11-29 12:56:04', 'Jianchang', 'Bi', 7, 3, 'Jianchang Bi,2017-11-29 14:44:30.', 1, NULL),
(5, 1, 'Jianchang', 'Bi', 7, '2017-11-29 14:42:43', 'why are arrays indexed at 0', 'the title describes it', 'new tag', '2017-11-29 14:42:43', 'Jianchang', 'Bi', 7, 3, NULL, 0, NULL),
(6, 1, 'Jianchang', 'Bi', 7, '2017-11-29 15:44:15', 'LALAL', 'LOL', 'help', '2017-11-29 15:50:00', 'TBA', 'TBA', 3, 3, 'Andrew Anderson,2017-11-30 16:47:17.', 1, NULL),
(7, 1, 'Kai', 'Liu', 8, '2017-11-29 15:56:06', 'how to type functions?', 'how many functions?', 'new tag', '2017-11-29 15:53:00', 'Jianchang', 'Bi', 7, 3, 'Andrew Anderson,2017-11-30 16:47:31.', 1, NULL),
(17, 1, 'Kai', 'Tu', 12, '2017-11-30 13:45:13', 'haha', 'hahaha', 'new tag', '2017-11-30 13:44:00', 'TBA', 'TBA', 31, 3, 'Yuanhao Wang,2017-11-30 14:50:16.Andrew Anderson,2017-11-30 16:44:12.', 2, NULL),
(18, 1, 'Yuanhao', 'Wang', 13, '2017-11-30 14:49:27', 'Test-wang', 'What is the website?', 'test', '2017-11-30 14:49:27', NULL, NULL, NULL, 0, NULL, 0, NULL),
(19, 7, 'Wenbo', 'Hou', 14, '2017-11-30 15:07:25', 'grading on assignment #1', 'what is the grading rubric?\r\nhow to check it?', 'grading', '2017-11-30 15:10:00', NULL, NULL, NULL, 0, '', 0, NULL),
(20, 1, 'Andrew', 'Anderson', 15, '2017-11-30 16:50:00', 'Wut dis?', 'Just testing', 'new tag', '2017-11-30 16:49:00', NULL, NULL, NULL, 0, NULL, 0, NULL),
(21, 7, 'Teng', 'Li', 17, '2018-01-24 11:42:55', 'test', 'test', 'new tag', '2018-01-24 11:42:55', NULL, NULL, NULL, 0, NULL, 0, NULL),
(22, 1, 'Chengxi', 'Yang', 10, '2018-01-28 19:37:09', 'Chengxi çš„é—®é¢˜', 'å•¦å•¦å•¦å•¦', 'new tag', '2018-01-28 19:37:09', NULL, NULL, NULL, 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_question_concern`
--

CREATE TABLE IF NOT EXISTS `t_question_concern` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `created_time` datetime NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_question_concern_t_question` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `t_question_concern`
--

INSERT INTO `t_question_concern` (`id`, `question_id`, `user_id`, `first_name`, `last_name`, `created_time`, `comment`) VALUES
(2, 4, 7, 'Jianchang', 'Bi', '2017-11-29 14:44:30', NULL),
(4, 2, 8, 'Kai', 'Liu', '2017-11-29 15:56:23', NULL),
(5, 2, 7, 'Jianchang', 'Bi', '2017-11-30 13:36:16', NULL),
(6, 2, 12, 'Kai', 'Tu', '2017-11-30 13:46:03', NULL),
(7, 17, 13, 'Yuanhao', 'Wang', '2017-11-30 14:50:16', NULL),
(8, 17, 15, 'Andrew', 'Anderson', '2017-11-30 16:44:12', NULL),
(9, 6, 15, 'Andrew', 'Anderson', '2017-11-30 16:47:17', NULL),
(10, 2, 15, 'Andrew', 'Anderson', '2017-11-30 16:47:17', NULL),
(11, 7, 15, 'Andrew', 'Anderson', '2017-11-30 16:47:31', NULL),
(18, 2, 10, 'Chengxi', 'Yang', '2018-01-28 19:36:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `osu_id` varchar(20) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0' COMMENT '0 Student, 1 TA',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `OSUID_UNIQUE` (`osu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `first_name`, `last_name`, `osu_id`, `role`) VALUES
(1, 'Shannon', 'Ernst', 'ernstsh', 2),
(2, 'TBA', 'TBA', 'mccormeg', 1),
(3, 'TBA', 'TBA', 'duvoisil', 1),
(4, 'TBA', 'TBA', 'chenyuha', 1),
(6, 'Nicole', 'Freitag', 'freitagn', 0),
(7, 'Jianchang', 'Bi', 'bij', 1),
(8, 'Kai', 'Liu', 'liukai', 0),
(9, 'Kang', 'Li', 'likang', 0),
(10, 'Chengxi', 'Yang', 'yangchen', 0),
(11, 'Deqing', 'Qu', 'qud', 1),
(12, 'Kai', 'Tu', 'tuka', 1),
(13, 'Yuanhao', 'Wang', 'wangyu2', 0),
(14, 'Wenbo', 'Hou', 'houw', 0),
(15, 'Andrew', 'Anderson', 'anderan2', 0),
(17, 'TBA', 'TBA', 'lite', 1),
(18, 'Zhiyuan', 'He', 'hezhi', 0),
(19, 'TBA', 'TBA', 'songyip', 1),
(20, 'TBA', 'TBA', 'barrm', 1),
(21, 'TBA', 'TBA', 'bajnok', 1),
(22, 'TBA', 'TBA', 'niebura', 1),
(23, 'TBA', 'TBA', 'grockid', 1),
(24, 'TBA', 'TBA', 'freischj', 1),
(25, 'TBA', 'TBA', 'chickj', 1),
(26, 'TBA', 'TBA', 'vaughanh', 1),
(27, 'TBA', 'TBA', 'mestasp', 1),
(28, 'TBA', 'TBA', 'olsenme', 1),
(29, 'TBA', 'TBA', 'bartonad', 1),
(30, 'TBA', 'TBA', 'bostelmf', 1),
(31, 'TBA', 'TBA', 'luzo', 1),
(32, 'TBA', 'TBA', 'maddaloc', 1),
(33, 'TBA', 'TBA', 'cryarr', 1),
(34, 'TBA', 'TBA', 'camposdl', 1),
(35, 'TBA', 'TBA', 'sessionm', 1),
(36, 'TBA', 'TBA', 'kimth', 1),
(37, 'TBA', 'TBA', 'upthagrg', 1),
(38, 'TBA', 'TBA', 'newmanev', 1),
(39, 'TBA', 'TBA', 'obriejas', 1),
(40, 'TBA', 'TBA', 'nelsonai', 1),
(41, 'TBA', 'TBA', 'haggertt', 1),
(42, 'TBA', 'TBA', 'nichokyl', 1),
(43, 'TBA', 'TBA', 'burnettn', 1),
(44, 'TBA', 'TBA', 'peterhen', 1),
(45, 'TBA', 'TBA', 'sidebotm', 1),
(46, 'TBA', 'TBA', 'thenellt', 1),
(47, 'TBA', 'TBA', 'buffumw', 1),
(50, 'TBA', 'TBA', 'lichlyts', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `r_user_class`
--
ALTER TABLE `r_user_class`
  ADD CONSTRAINT `fk_r_user_class_to_t_class` FOREIGN KEY (`class_id`) REFERENCES `t_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_r_user_class_to_t_user` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_keywords`
--
ALTER TABLE `t_keywords`
  ADD CONSTRAINT `fk_t_keywords_to_t_class` FOREIGN KEY (`class_id`) REFERENCES `t_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_question`
--
ALTER TABLE `t_question`
  ADD CONSTRAINT `fk_t_question_to_t_class` FOREIGN KEY (`class_id`) REFERENCES `t_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_question_concern`
--
ALTER TABLE `t_question_concern`
  ADD CONSTRAINT `fk_t_question_concern_t_question` FOREIGN KEY (`question_id`) REFERENCES `t_question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
