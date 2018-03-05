-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host: oniddb
-- Generation Time: Mar 04, 2018 at 03:29 PM
-- Server version: 5.5.58
-- PHP Version: 5.2.6-1+lenny16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

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
(9, 1, 1),
(10, 1, 0),
(11, 1, 0),
(12, 1, 0),
(13, 1, 0),
(15, 1, 0),
(17, 1, 0),
(18, 1, 0),
(19, 1, 0),
(19, 1, 1),
(20, 1, 1),
(21, 1, 1),
(22, 1, 0),
(22, 1, 1),
(23, 1, 1),
(24, 1, 1),
(25, 1, 1),
(26, 1, 1),
(27, 1, 0),
(27, 1, 1),
(28, 1, 1),
(29, 1, 1),
(30, 1, 1),
(31, 1, 1),
(32, 1, 0),
(32, 1, 1),
(33, 1, 1),
(34, 1, 1),
(35, 1, 1),
(36, 1, 1),
(37, 1, 1),
(38, 1, 0),
(38, 1, 1),
(39, 1, 0),
(39, 1, 1),
(40, 1, 0),
(40, 1, 1),
(41, 1, 1),
(42, 1, 0),
(42, 1, 1),
(43, 1, 1),
(44, 1, 1),
(45, 1, 1),
(46, 1, 1),
(47, 1, 0),
(47, 1, 1),
(50, 1, 0),
(50, 1, 1),
(58, 1, 0),
(61, 1, 0),
(62, 1, 0),
(63, 1, 0),
(64, 1, 0),
(65, 1, 0),
(66, 1, 0),
(67, 1, 0),
(68, 1, 0),
(69, 1, 0),
(70, 1, 0),
(71, 1, 0),
(72, 1, 0),
(77, 1, 0),
(78, 1, 0),
(79, 1, 0),
(80, 1, 0),
(81, 1, 0),
(82, 1, 0),
(83, 1, 0),
(84, 1, 0),
(86, 1, 0),
(87, 1, 0),
(88, 1, 0),
(89, 1, 0),
(90, 1, 0),
(93, 1, 0),
(94, 1, 0),
(95, 1, 0),
(96, 1, 0),
(97, 1, 0),
(98, 1, 0),
(99, 1, 0),
(100, 1, 0),
(101, 1, 0),
(105, 1, 0),
(107, 1, 0),
(108, 1, 0),
(109, 1, 0),
(110, 1, 0),
(116, 1, 0),
(130, 1, 0),
(10, 8, 0),
(10, 8, 2),
(11, 8, 0),
(17, 8, 0),
(50, 8, 0),
(92, 8, 0),
(97, 8, 0),
(112, 8, 0),
(113, 8, 0),
(114, 8, 0),
(115, 8, 0),
(118, 8, 0),
(119, 8, 0),
(120, 8, 0),
(122, 8, 0),
(123, 8, 0),
(124, 8, 0),
(125, 8, 0),
(127, 8, 0),
(128, 8, 0),
(129, 8, 0),
(130, 8, 0),
(9, 9, 0),
(11, 9, 1),
(17, 9, 0),
(104, 9, 0),
(105, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_class`
--

CREATE TABLE IF NOT EXISTS `t_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `t_class`
--

INSERT INTO `t_class` (`id`, `name`) VALUES
(1, 'CS 161 Introduction to Computer Science I'),
(8, 'CS480 Translator'),
(9, 'CS290 Web Development');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `t_keywords`
--

INSERT INTO `t_keywords` (`id`, `class_id`, `value`, `comment`) VALUES
(49, 1, 'functions', 'functions'),
(50, 1, 'conditionals', 'conditionals'),
(51, 1, 'variables', 'variables'),
(52, 1, 'assignment', 'assignment'),
(53, 1, 'bug', 'bug'),
(57, 8, 'flex', 'flex'),
(58, 8, 'bison', 'bison'),
(68, 8, 'll', 'll'),
(76, 1, 'cs', 'cs'),
(79, 8, 'new tag', 'new tag'),
(83, 1, 'text', 'text'),
(85, 9, 'Web', 'Web'),
(86, 9, 'Development', 'Development'),
(87, 8, 'test', 'test'),
(88, 8, 'test', 'test'),
(89, 8, 'test', 'test'),
(90, 8, 'test', 'test'),
(91, 8, 'test', 'test'),
(92, 8, 'test', 'test'),
(93, 8, 'test', 'test'),
(94, 8, 'test', 'test'),
(95, 8, 'test', 'test'),
(96, 8, 'test', 'test'),
(97, 8, 'test', 'test'),
(98, 8, 'test', 'test');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `t_question`
--

INSERT INTO `t_question` (`id`, `class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `ta_first_name`, `ta_last_name`, `ta_user_id`, `status`, `concern`, `num_liked`, `comment`) VALUES
(26, 8, 'Chengxi', 'Yang', 10, '2018-02-12 13:13:15', 'How does bison work?', 'need example codes!', 'new tag', '2018-02-12 13:00:00', NULL, NULL, NULL, 0, 'Deqing Qu,2018-02-27 09:37:30.Cameron Barrie,2018-02-27 14:10:25.Evan Milton,2018-02-27 14:15:35.', 3, NULL),
(52, 9, 'Trang', 'Lam', 105, '2018-02-25 16:36:40', 'How can I learn Node.js better?', 'I am not as good at backend JavaScript.', 'Web', '2018-02-25 19:36:00', NULL, NULL, NULL, 0, 'Kang Li,2018-03-04 14:59:59.', 1, NULL),
(53, 1, 'Flynn', 'Killen', 107, '2018-02-27 11:43:21', 'Scoring functions', 'How to sort an array numerically for the scoring function 1-6 and how to create a counter for pairs. ', 'functions', '2018-02-27 11:43:21', NULL, NULL, NULL, 0, 'Chengxi Yang,2018-03-01 13:24:08.', 1, NULL),
(54, 1, 'Tobias', 'Bird', 108, '2018-02-27 11:44:38', 'Pointers', 'How pointers work', 'functions', '2018-02-27 11:44:38', NULL, NULL, NULL, 0, 'Chengxi Yang,2018-03-01 13:24:23.', 1, NULL),
(56, 1, 'Teng', 'Li', 17, '2018-02-27 13:16:12', 'Question #1', 'This is a question', 'functions', '2018-02-27 13:16:12', NULL, NULL, NULL, 0, 'Chengxi Yang,2018-03-01 13:24:19.', 1, NULL),
(57, 8, 'Cameron', 'Barrie', 112, '2018-02-27 14:10:35', 'test ', '11', 'flex', '2018-02-27 14:10:35', NULL, NULL, NULL, 0, 'Evan Milton,2018-02-27 14:15:34.', 1, NULL),
(58, 8, 'Evan', 'Milton', 113, '2018-02-27 14:15:53', 'test3', '123', 'flex', '2018-02-27 14:15:53', NULL, NULL, NULL, 0, 'Chengxi Yang,2018-02-27 15:45:20.', 1, NULL),
(59, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:03:58', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:03:58', NULL, NULL, NULL, 0, NULL, 0, NULL),
(60, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:00', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:04:00', NULL, NULL, NULL, 0, NULL, 0, NULL),
(61, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:02', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:04:02', NULL, NULL, NULL, 0, NULL, 0, NULL),
(62, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:03', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:04:03', NULL, NULL, NULL, 0, NULL, 0, NULL),
(63, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:04', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:04:04', NULL, NULL, NULL, 0, NULL, 0, NULL),
(64, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:04', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:04:04', NULL, NULL, NULL, 0, NULL, 0, NULL),
(65, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:04', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:04:04', NULL, NULL, NULL, 0, NULL, 0, NULL),
(66, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:04', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:04:04', NULL, NULL, NULL, 0, NULL, 0, NULL),
(67, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:05', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:04:05', NULL, NULL, NULL, 0, NULL, 0, NULL),
(68, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:05', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:04:05', NULL, NULL, NULL, 0, NULL, 0, NULL),
(69, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:06', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:04:06', NULL, NULL, NULL, 0, NULL, 0, NULL),
(70, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:06', 'This is a test question?', 'Testing!', 'test', '2018-02-27 16:04:06', NULL, NULL, NULL, 0, NULL, 0, NULL),
(71, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:09', 'This is a test question?', 'Testing!', 'new tag', '2018-02-27 16:04:09', NULL, NULL, NULL, 0, NULL, 0, NULL),
(72, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:10', 'This is a test question?', 'Testing!', 'new tag', '2018-02-27 16:04:10', NULL, NULL, NULL, 0, NULL, 0, NULL),
(73, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:10', 'This is a test question?', 'Testing!', 'new tag', '2018-02-27 16:04:10', NULL, NULL, NULL, 0, NULL, 0, NULL),
(74, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:11', 'This is a test question?', 'Testing!', 'new tag', '2018-02-27 16:04:11', NULL, NULL, NULL, 0, NULL, 0, NULL),
(75, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:14', 'This is a test question?', 'Testing!', 'flex', '2018-02-27 16:04:14', NULL, NULL, NULL, 0, NULL, 0, NULL),
(76, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:14', 'This is a test question?', 'Testing!', 'flex', '2018-02-27 16:04:14', NULL, NULL, NULL, 0, NULL, 0, NULL),
(77, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:14', 'This is a test question?', 'Testing!', 'flex', '2018-02-27 16:04:14', NULL, NULL, NULL, 0, 'Jacob Murphy,2018-02-27 16:31:36.Louis Leon,2018-03-01 14:06:05.', 2, NULL),
(78, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:14', 'This is a test question?', 'Testing!', 'flex', '2018-02-27 16:04:14', NULL, NULL, NULL, 0, NULL, 0, NULL),
(79, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:33', 'eeee', 'eeee', 'flex', '2018-02-27 16:04:33', NULL, NULL, NULL, 0, NULL, 0, NULL),
(80, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:34', 'eeee', 'eeee', 'flex', '2018-02-27 16:04:34', NULL, NULL, NULL, 0, NULL, 0, NULL),
(81, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:34', 'eeee', 'eeee', 'flex', '2018-02-27 16:04:34', NULL, NULL, NULL, 0, NULL, 0, NULL),
(82, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:34', 'eeee', 'eeee', 'flex', '2018-02-27 16:04:34', NULL, NULL, NULL, 0, NULL, 0, NULL),
(83, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:35', 'eeee', 'eeee', 'flex', '2018-02-27 16:04:35', NULL, NULL, NULL, 0, NULL, 0, NULL),
(84, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:40', 'eeee', 'eeee', 'new tag', '2018-02-27 16:04:40', NULL, NULL, NULL, 0, NULL, 0, NULL),
(85, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:40', 'eeee', 'eeee', 'new tag', '2018-02-27 16:04:40', NULL, NULL, NULL, 0, NULL, 0, NULL),
(86, 8, 'Trevor', 'Swope', 118, '2018-02-27 16:04:40', 'eeee', 'eeee', 'new tag', '2018-02-27 16:04:40', NULL, NULL, NULL, 0, NULL, 0, NULL),
(87, 8, 'Louis', 'Leon', 122, '2018-03-01 14:06:43', 'Question title', 'Example Question here', 'bison', '2018-03-01 14:06:43', NULL, NULL, NULL, 0, 'Cody Holliday,2018-03-01 14:11:12.', 1, NULL),
(88, 8, 'Daniel', 'Ross', 124, '2018-03-01 14:37:19', 'Testing again', 'How is being a ta', 'flex', '2018-03-01 14:37:19', NULL, NULL, NULL, 0, NULL, 0, NULL),
(89, 8, 'Rohit', 'Chaudhary', 125, '2018-03-01 14:44:09', 'test ', 'question', 'bison', '2018-03-01 15:00:00', NULL, NULL, NULL, 0, 'Namtalay Laorattanavech,2018-03-01 15:08:29.Sean Marty,2018-03-01 15:26:17.Joseph Struth,2018-03-01 15:50:35.', 3, NULL),
(90, 8, 'Joseph', 'Struth', 129, '2018-03-01 15:51:35', 'software question', 'I need help with something', 'flex', '2018-03-01 15:51:35', NULL, NULL, NULL, 0, NULL, 0, NULL),
(91, 1, 'Nicholas', 'Jeffreys', 130, '2018-03-01 16:21:40', 'QUESTION', 'Where?', 'conditionals', '2018-03-01 16:21:40', NULL, NULL, NULL, 0, NULL, 0, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `t_question_concern`
--

INSERT INTO `t_question_concern` (`id`, `question_id`, `user_id`, `first_name`, `last_name`, `created_time`, `comment`) VALUES
(42, 26, 11, 'Deqing', 'Qu', '2018-02-27 09:37:30', NULL),
(47, 26, 112, 'Cameron', 'Barrie', '2018-02-27 14:10:25', NULL),
(48, 57, 113, 'Evan', 'Milton', '2018-02-27 14:15:34', NULL),
(49, 26, 113, 'Evan', 'Milton', '2018-02-27 14:15:35', NULL),
(57, 58, 10, 'Chengxi', 'Yang', '2018-02-27 15:45:20', NULL),
(58, 77, 119, 'Jacob', 'Murphy', '2018-02-27 16:31:36', NULL),
(61, 53, 10, 'Chengxi', 'Yang', '2018-03-01 13:24:08', NULL),
(62, 56, 10, 'Chengxi', 'Yang', '2018-03-01 13:24:19', NULL),
(63, 54, 10, 'Chengxi', 'Yang', '2018-03-01 13:24:23', NULL),
(64, 77, 122, 'Louis', 'Leon', '2018-03-01 14:06:05', NULL),
(65, 87, 123, 'Cody', 'Holliday', '2018-03-01 14:11:12', NULL),
(66, 89, 127, 'Namtalay', 'Laorattanavech', '2018-03-01 15:08:29', NULL),
(67, 89, 128, 'Sean', 'Marty', '2018-03-01 15:26:17', NULL),
(68, 89, 129, 'Joseph', 'Struth', '2018-03-01 15:50:35', NULL),
(69, 52, 9, 'Kang', 'Li', '2018-03-04 14:59:59', NULL);

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
  `token` varchar(50) DEFAULT NULL,
  `token_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `OSUID_UNIQUE` (`osu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=132 ;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `first_name`, `last_name`, `osu_id`, `role`, `token`, `token_time`) VALUES
(1, 'Shannon', 'TBA', 'ernstsh', 2, NULL, NULL),
(2, 'TBA', 'TBA', 'mccormeg', 1, NULL, NULL),
(3, 'Louis', 'Duvoisin', 'duvoisil', 1, NULL, NULL),
(4, 'TBA', 'TBA', 'chenyuha', 1, NULL, NULL),
(6, 'Nicole', 'TBA', 'freitagn', 0, NULL, NULL),
(7, 'Jianchang', 'TBA', 'bij', 1, NULL, NULL),
(8, 'Kai', 'TBA', 'liukai', 0, NULL, NULL),
(9, 'Kang', 'Li', 'likang', 1, NULL, NULL),
(10, 'Chengxi', 'Yang', 'yangchen', 1, NULL, NULL),
(11, 'Deqing', 'Qu', 'qud', 1, NULL, NULL),
(12, 'Kai', 'TBA', 'tuka', 1, NULL, NULL),
(13, 'Yuanhao', 'TBA', 'wangyu2', 0, NULL, NULL),
(14, 'Wenbo', 'TBA', 'houw', 0, NULL, NULL),
(15, 'Andrew', 'TBA', 'anderan2', 0, NULL, NULL),
(17, 'Teng', 'Li', 'lite', 1, NULL, NULL),
(18, 'Zhiyuan', 'TBA', 'hezhi', 0, NULL, NULL),
(19, 'Yipeng', 'TBA', 'songyip', 1, NULL, NULL),
(20, 'Melissa', 'TBA', 'barrm', 1, NULL, NULL),
(21, 'Katherine', 'TBA', 'bajnok', 1, NULL, NULL),
(22, 'TBA', 'TBA', 'niebura', 1, NULL, NULL),
(23, 'TBA', 'TBA', 'grockid', 1, NULL, NULL),
(24, 'TBA', 'TBA', 'freischj', 1, NULL, NULL),
(25, 'TBA', 'TBA', 'chickj', 1, NULL, NULL),
(26, 'Hannah', 'Vaughan', 'vaughanh', 1, NULL, NULL),
(27, 'Phillip', 'TBA', 'mestasp', 1, NULL, NULL),
(28, 'TBA', 'TBA', 'olsenme', 1, NULL, NULL),
(29, 'TBA', 'TBA', 'bartonad', 1, NULL, NULL),
(30, 'TBA', 'TBA', 'bostelmf', 1, NULL, NULL),
(31, 'Zongyan', 'TBA', 'luzo', 1, NULL, NULL),
(32, 'Conner', 'Maddalozzo', 'maddaloc', 1, NULL, NULL),
(33, 'Ryan', 'TBA', 'cryarr', 1, NULL, NULL),
(34, 'Lucas', 'TBA', 'camposdl', 1, NULL, NULL),
(35, 'Matthew', 'Sessions', 'sessionm', 1, NULL, NULL),
(36, 'TBA', 'TBA', 'kimth', 1, NULL, NULL),
(37, 'TBA', 'TBA', 'upthagrg', 1, NULL, NULL),
(38, 'Evan', 'TBA', 'newmanev', 1, NULL, NULL),
(39, 'Jason', 'TBA', 'obriejas', 1, NULL, NULL),
(40, 'TBA', 'TBA', 'nelsonai', 1, NULL, NULL),
(41, 'Ty', 'Haggerty', 'haggertt', 1, NULL, NULL),
(42, 'Kyle', 'TBA', 'nichokyl', 1, NULL, NULL),
(43, 'TBA', 'TBA', 'burnettn', 1, NULL, NULL),
(44, 'Henry', 'TBA', 'peterhen', 1, NULL, NULL),
(45, 'TBA', 'TBA', 'sidebotm', 1, NULL, NULL),
(46, 'Tasman', 'Thenell', 'thenellt', 1, NULL, NULL),
(47, 'William', 'TBA', 'buffumw', 1, NULL, NULL),
(50, 'Samuel', 'TBA', 'lichlyts', 1, NULL, NULL),
(51, 'Evan', 'TBA', 'schweike', 2, NULL, NULL),
(57, 'Yenifer', 'TBA', 'ramireye', 0, NULL, NULL),
(58, 'Samantha', 'TBA', 'mursulis', 0, NULL, NULL),
(61, 'Ashyan', 'TBA', 'rahavia', 0, NULL, NULL),
(62, 'Anna', 'TBA', 'mollerea', 0, NULL, NULL),
(63, 'Peri', 'TBA', 'cabralep', 0, NULL, NULL),
(64, 'Delun', 'TBA', 'fand', 0, NULL, NULL),
(65, 'Victoria', 'TBA', 'vasquevi', 0, NULL, NULL),
(66, 'Branden', 'TBA', 'hollowab', 0, NULL, NULL),
(67, 'Andrew', 'TBA', 'victoran', 0, NULL, NULL),
(68, 'Rachel', 'TBA', 'sousar', 0, NULL, NULL),
(69, 'Michael', 'TBA', 'barnemic', 0, NULL, NULL),
(70, 'Jacob', 'Nielsen', 'nielsjac', 0, NULL, NULL),
(71, 'Thien', 'TBA', 'namt', 0, NULL, NULL),
(72, 'Hayden', 'TBA', 'barnhurh', 0, NULL, NULL),
(73, 'Isabella', 'TBA', 'bratlani', 2, NULL, NULL),
(77, 'Odyssey', 'TBA', 'wilsono', 0, NULL, NULL),
(78, 'Sneha', 'TBA', 'shahsn', 0, NULL, NULL),
(79, 'Nolan', 'TBA', 'grossman', 0, NULL, NULL),
(80, 'Peng', 'TBA', 'zhanpeng', 0, NULL, NULL),
(81, 'Ashton', 'TBA', 'burrelas', 0, NULL, NULL),
(82, 'Daniel', 'Jones', 'jonesd5', 0, NULL, NULL),
(83, 'Joseph', 'TBA', 'andrjose', 0, NULL, NULL),
(84, 'Tengjiao', 'TBA', 'weite', 0, NULL, NULL),
(86, 'Naisen', 'TBA', 'xuna', 0, NULL, NULL),
(87, 'Andy', 'TBA', 'yuyan', 0, NULL, NULL),
(88, 'Lindsey', 'TBA', 'kvarforl', 0, NULL, NULL),
(89, 'Renee', 'TBA', 'myersren', 0, NULL, NULL),
(90, 'Matthew', 'TBA', 'mazonm', 0, NULL, NULL),
(91, 'Stephanie', 'TBA', 'leungste', 0, NULL, NULL),
(92, 'George', 'TBA', 'craryg', 0, NULL, NULL),
(93, 'Andrew', 'TBA', 'morrilan', 0, NULL, NULL),
(94, 'Robert', 'TBA', 'chungro', 0, NULL, NULL),
(95, 'Leland', 'TBA', 'debowl', 0, NULL, NULL),
(96, 'Emerald', 'TBA', 'sealee', 0, NULL, NULL),
(97, 'Neal', 'TBA', 'blackbne', 0, NULL, NULL),
(98, 'Muqi', 'TBA', 'wangmuq', 0, NULL, NULL),
(99, 'Yiting', 'TBA', 'wangyit', 0, NULL, NULL),
(100, 'Yuchen', 'TBA', 'yangyuc', 0, NULL, NULL),
(101, 'Shuyan', 'TBA', 'zhanshuy', 0, NULL, NULL),
(102, 'Xiaozhe', 'Ma', 'maxi', 0, NULL, NULL),
(103, 'Ziyuan', 'TBA', 'xiezi', 0, NULL, NULL),
(104, 'Shangjia', 'Dong', 'dongs', 0, NULL, NULL),
(105, 'Trang', 'TBA', 'lamtr', 0, NULL, NULL),
(106, 'Harlan', 'TBA', 'waldroha', 1, NULL, NULL),
(107, 'Flynn', 'Killen', 'killenf', 0, NULL, NULL),
(108, 'Tobias', 'Bird', 'birdto', 0, NULL, NULL),
(109, 'Cheng', 'Xie', 'xiech', 0, NULL, NULL),
(110, 'Kate', 'Galle', 'gallek', 0, NULL, NULL),
(111, 'Tanner', 'Gestrin', 'gestrint', 0, NULL, NULL),
(112, 'Cameron', 'Barrie', 'barrieca', 0, NULL, NULL),
(113, 'Evan', 'Milton', 'miltone', 0, NULL, NULL),
(114, 'Hao', 'Wang', 'wangha', 0, NULL, NULL),
(115, 'Tommy', 'Hollenberg', 'hollenbt', 0, NULL, NULL),
(116, 'Tyler', 'Pettigrew', 'pettigrt', 0, NULL, NULL),
(117, 'Alexander', 'Hull', 'hullale', 0, NULL, NULL),
(118, 'Trevor', 'Swope', 'swopet', 0, NULL, NULL),
(119, 'Jacob', 'Murphy', 'murphjac', 0, NULL, NULL),
(120, 'Mark', 'Bereza', 'berezam', 0, NULL, NULL),
(122, 'Louis', 'Leon', 'leonl', 0, NULL, NULL),
(123, 'Cody', 'Holliday', 'hollidac', 0, NULL, NULL),
(124, 'Daniel', 'Ross', 'rossda', 0, NULL, NULL),
(125, 'Rohit', 'Chaudhary', 'chaudhro', 0, NULL, NULL),
(126, 'Claude', 'Maimon', 'maimonc', 0, NULL, NULL),
(127, 'Namtalay', 'Laorattanavech', 'laorattn', 0, NULL, NULL),
(128, 'Sean', 'Marty', 'martys', 0, NULL, NULL),
(129, 'Joseph', 'Struth', 'struthj', 0, NULL, NULL),
(130, 'Nicholas', 'Jeffreys', 'jeffreyn', 0, NULL, NULL),
(131, 'Liao', 'Sheng', 'shengli', 0, NULL, NULL);

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
