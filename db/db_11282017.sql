-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host: oniddb
-- Generation Time: Nov 28, 2017 at 06:33 PM
-- Server version: 5.5.55
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `d_dictionary`
--

INSERT INTO `d_dictionary` (`id`, `dict_attribute`, `dict_value`, `dictdata_value`, `comment`) VALUES
(1, 'user_type', 0, 'Student', NULL),
(2, 'user_type', 1, 'TA', NULL),
(3, 'question_status', 0, 'proposed', NULL),
(4, 'question_status', 1, 'answered', NULL),
(5, 'question_status', 2, 'deleted', NULL),
(6, 'question_status', 3, 'signed', NULL);

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
(1, 1, 0),
(2, 1, 0),
(3, 1, 0),
(4, 1, 0),
(6, 1, 1),
(7, 1, 1),
(11, 1, 0),
(13, 1, 0),
(15, 1, 0),
(15, 1, 1),
(17, 1, 0),
(18, 1, 0),
(18, 1, 1),
(41, 1, 0),
(3, 2, 0),
(4, 2, 0),
(11, 2, 0),
(13, 2, 0),
(17, 2, 0),
(18, 2, 0),
(5, 3, 0),
(6, 3, 0),
(9, 3, 0),
(11, 3, 0),
(13, 3, 0),
(18, 3, 0),
(7, 4, 0),
(8, 4, 0),
(10, 4, 0),
(18, 4, 1),
(18, 5, 1),
(41, 5, 0),
(9, 14, 0),
(9, 15, 0),
(41, 15, 0),
(9, 17, 0),
(9, 18, 0),
(9, 19, 0),
(9, 20, 0),
(17, 24, 0),
(41, 25, 0),
(17, 26, 0),
(17, 30, 0),
(41, 30, 0),
(15, 45, 0),
(17, 45, 0),
(35, 45, 1),
(39, 49, 1),
(37, 51, 1),
(38, 51, 1),
(41, 51, 0),
(41, 51, 1),
(44, 55, 1),
(32, 59, 1),
(33, 59, 1),
(34, 59, 1),
(15, 60, 0),
(17, 62, 0),
(17, 70, 0),
(40, 90, 1),
(17, 99, 0),
(11, 102, 1),
(17, 102, 1),
(13, 103, 0),
(13, 103, 1),
(17, 103, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_class`
--

CREATE TABLE IF NOT EXISTS `t_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- Dumping data for table `t_class`
--

INSERT INTO `t_class` (`id`, `name`) VALUES
(1, 'CS561'),
(2, 'CS550'),
(3, 'CS534'),
(4, 'CS581'),
(5, 'CS666'),
(14, 'CS111'),
(15, 'MTH140'),
(16, 'MTH111'),
(17, 'Cs555555'),
(18, 'CS11111'),
(19, 'CS562'),
(20, 'CS160e'),
(21, 'Test001'),
(23, 'CS1111'),
(24, 'CS12345'),
(25, 'EE12'),
(26, 'CS496'),
(27, 'CS496'),
(28, 'CS496'),
(29, 'CS496'),
(30, 'gg'),
(45, 'Data Structures'),
(48, 'cs testtest'),
(49, 'CS160'),
(50, 'CS 325'),
(51, 'cs 161'),
(52, 'ps 201'),
(55, '23'),
(59, 'ph211'),
(60, 'ps 203'),
(62, 'ph 777'),
(63, 'CS 161'),
(68, 'ph666'),
(69, 'ps213'),
(70, 'CS 561'),
(75, 'ph555'),
(81, '610'),
(82, 'ps212'),
(84, '244'),
(90, 'CS 162'),
(92, 'ph222'),
(93, 'ph444'),
(97, 'CS 160'),
(99, 'CS162'),
(102, 'CS000000'),
(103, 'cs 0'),
(104, 'CS New');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `t_keywords`
--

INSERT INTO `t_keywords` (`id`, `class_id`, `value`, `comment`) VALUES
(1, 1, '1', 'lecture'),
(2, 1, '2', 'homework'),
(3, 1, '3', 'exam'),
(4, 2, '1', 'lecture'),
(5, 2, '2', 'homework'),
(6, 3, '3', 'exam'),
(7, 1, 'new tag', 'new tag'),
(14, 102, '1', 'testag'),
(15, 102, '2', 'tstag2'),
(16, 102, '3', 'tstag3'),
(17, 1, 'postman_tag', 'postman_tag'),
(18, 1, 'postman_tag', 'postman_tag'),
(19, 104, '1', 'test'),
(20, 103, '1', '0'),
(21, 103, '2', '1'),
(22, 103, '3', '2'),
(23, 103, 'new tag', 'new tag'),
(24, 103, 'a', 'a'),
(25, 2, 'testtag', 'testtag');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `t_question`
--

INSERT INTO `t_question` (`id`, `class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `ta_first_name`, `ta_last_name`, `ta_user_id`, `status`, `concern`, `num_liked`, `comment`) VALUES
(3, 1, 'Jaime', 'Lannister', 7, '2017-10-07 12:20:35', 'test2', 'what ?', '1,2,3', '2017-10-08 08:30:00', NULL, NULL, NULL, 1, 'Jianchang Bi,2017-10-31 15:44:35.', 1, NULL),
(4, 1, 'Daenerys', 'Tyrion', 6, '2017-10-08 13:30:23', 'test3', 'When ?', NULL, '2017-10-09 11:30:00', NULL, NULL, NULL, 1, 'Tyrion Lannister,2017-10-8 15:11:06.Teng Li,2017-11-16 16:16:27.Deqing Qu,2017-11-22 16:31:53.Chengxi Yang,2017-11-28 11:54:30.Jianchang Bi,2017-11-28 18:06:22.', 5, NULL),
(5, 2, 'Jon', 'Snow', 4, '2017-10-09 10:31:18', 'test4', 'Where ?', '1', '2017-10-09 18:30:00', NULL, NULL, NULL, 1, 'Jianchang Bi,2017-11-10 16:19:56.', 1, NULL),
(6, 3, 'Sansa', 'Stark', 5, '2017-10-10 20:30:28', 'test5', 'Where ？', NULL, '2017-10-11 12:30:00', NULL, NULL, NULL, 1, 'Daenerys  Targaryen,2017-10-10 21:21:15.Jianchang Bi,2017-11-22 11:38:01.', 2, NULL),
(7, 3, 'Daenerys', 'Tyrion', 6, '2017-10-09 18:00:11', 'test6', 'When ?', NULL, '2017-10-11 08:30:00', 'Catelyn', 'Stark', 9, 1, 'Sansa Stark,2017-10-9 11:05:25.Jianchang Bi,2017-10-31 16:00:31.', 2, NULL),
(8, 4, 'Jaime', 'Lannister', 7, '2017-10-06 15:15:37', 'test7', 'How ?', NULL, '2017-10-07 08:30:00', NULL, NULL, NULL, 1, '', 0, NULL),
(9, 4, 'Tyrion', 'Lannister', 8, '2017-10-05 14:27:51', 'test8', 'Why ?', NULL, '2017-10-06 08:30:00', 'Ned', 'Stark', 10, 1, '', 0, NULL),
(10, 4, 'Tyrion', 'Lannister', 8, '2017-10-06 11:52:09', 'test9', 'Where ?', NULL, '2017-10-06 08:30:00', NULL, NULL, NULL, 1, 'Jianchang Bi,2017-11-08 12:27:44.', 1, NULL),
(12, 1, 'Jack', 'Chan', 1, '2017-10-05 19:30:25', 'test2', 'Why ?', '1,2', '2017-10-06 08:30:00', NULL, NULL, NULL, 1, 'Kang Li,2017-11-19 10:42:11.', 1, NULL),
(13, 1, 'Jack', 'Chan', 1, '2017-10-05 20:30:25', 'test3', 'Why ?', '2', '2017-10-06 08:30:00', NULL, NULL, NULL, 1, 'Jianchang Bi,2017-11-02 18:27:11.', 1, NULL),
(15, 1, 'Jack', 'Chan', 1, '2017-10-05 22:30:25', 'test5', 'Why ?', '2', '2017-10-06 08:30:00', NULL, NULL, NULL, 1, NULL, 0, NULL),
(16, 1, 'Jack', 'Chan', 1, '2017-10-05 17:20:25', 'test6', 'Why ?', '1,2', '2017-10-06 08:30:00', NULL, NULL, NULL, 1, NULL, 0, NULL),
(17, 1, 'Jack', 'Chan', 1, '2017-10-05 16:30:25', 'test7', 'Why ?', '1,2', '2017-10-06 08:30:00', NULL, NULL, NULL, 1, NULL, 0, NULL),
(18, 1, 'Jack', 'Chan', 1, '2017-10-05 15:30:25', 'test8', 'Why ?', '1,2', '2017-10-06 08:30:00', NULL, NULL, NULL, 1, 'Jianchang Bi,2017-11-09 15:47:57.', 1, NULL),
(19, 1, 'Jack', 'Chan', 1, '2017-10-05 14:30:25', 'test9', 'Why ?', '1,2', '2017-10-06 08:30:00', NULL, NULL, NULL, 1, 'Jianchang Bi,2017-11-01 21:45:46.', 1, NULL),
(47, 1, 'Tyrion', 'Lannister', 8, '2017-10-14 23:25:00', 'TEST', 'TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST', NULL, '2017-10-14 21:59:00', NULL, NULL, NULL, 0, NULL, 0, NULL),
(48, 1, 'Tyrion', 'Lannister', 8, '2017-10-14 23:35:17', 'dsadsadsadsa', 'dsadsadsadsad', NULL, '2017-10-14 21:30:00', NULL, NULL, NULL, 0, 'Jianchang Bi,2017-11-03 10:32:05.', 1, NULL),
(49, 1, 'Tyrion', 'Lannister', 8, '2017-10-14 23:51:56', 'sa''d''sa''d', 'sadsadsad', NULL, '2017-10-14 23:51:56', NULL, NULL, NULL, 0, NULL, 0, NULL),
(50, 1, 'Tyrion', 'Lannister', 8, '2017-10-14 23:52:09', 'sadasd', 'asdsad', NULL, '2017-10-14 23:52:09', NULL, NULL, NULL, 0, NULL, 0, NULL),
(51, 1, 'Tyrion', 'Lannister', 8, '2017-10-15 00:21:50', 'asdsad', 'sadsadsad', NULL, '2017-10-15 00:21:50', NULL, NULL, NULL, 0, NULL, 0, NULL),
(52, 1, 'Tyrion', 'Lannister', 8, '2017-10-15 00:22:36', 'asds', 'sad', NULL, '2017-10-15 00:22:36', NULL, NULL, NULL, 0, NULL, 0, NULL),
(53, 1, 'Tyrion', 'Lannister', 8, '2017-10-15 00:22:40', 'asd', 'sdsd', NULL, '2017-10-15 00:22:40', NULL, NULL, NULL, 0, NULL, 0, NULL),
(54, 1, 'Tyrion', 'Lannister', 8, '2017-10-15 00:22:44', 'sadsadsd', 'sadsad', NULL, '2017-10-15 00:22:00', 'Teng', 'Li', 18, 3, '', 0, NULL),
(55, 1, 'Tyrion', 'Lannister', 8, '2017-10-15 00:25:48', 'asdsad', 'sadsadsad', NULL, '2017-10-15 00:25:48', 'Deqing', 'Qu', 15, 3, 'Teng Li,2017-11-16 16:16:29.Deqing Qu,2017-11-22 16:33:13.Jianchang Bi,2017-11-28 18:05:02.', 3, NULL),
(56, 1, 'Tyrion', 'Lannister', 8, '2017-10-15 00:25:58', 'ts', 'ts', NULL, '2017-10-15 00:25:58', NULL, NULL, NULL, 0, 'Jianchang Bi,2017-11-01 21:39:38.', 1, NULL),
(57, 1, 'Tyrion', 'Lannister', 8, '2017-10-15 18:58:25', 'test 6666', '6666666666', NULL, '2017-10-15 18:58:25', NULL, NULL, NULL, 0, '', 0, NULL),
(58, 1, 'Tyrion', 'Lannister', 8, '2017-10-16 14:03:33', 'hahahahhaha', 'hahahah', NULL, '2017-10-16 15:00:00', NULL, NULL, NULL, 0, 'Jianchang Bi,2017-11-15 17:32:24.', 1, NULL),
(59, 1, 'Tyrion', 'Lannister', 8, '2017-10-16 15:16:12', 'Title_Question', 'Description', NULL, '2017-10-16 15:16:12', 'Teng', 'Li', 18, 3, '', 0, NULL),
(60, 1, 'Tyrion', 'Lannister', 8, '2017-10-17 14:08:06', 'I would place a summary here.', 'And then my full question here', NULL, '2017-10-17 15:00:00', NULL, NULL, NULL, 0, '', 0, NULL),
(61, 1, 'Tyrion', 'Lannister', 8, '2017-10-17 14:09:45', 'q', 'q', NULL, '2017-10-17 14:09:45', 'Deqing', 'Qu', 15, 3, 'Jianchang Bi,2017-10-31 15:19:10.', 1, NULL),
(62, 1, 'Tyrion', 'Lannister', 8, '2017-10-17 17:05:56', 'I have a question', 'This is my question', NULL, '2017-10-17 17:05:56', 'Deqing', 'Qu', 15, 3, '', 0, NULL),
(63, 1, 'Samuel', 'Lichlyter', 11, '2017-10-17 17:08:26', 'new question', 'another question', NULL, '2017-10-17 17:08:26', NULL, NULL, NULL, 0, 'Jianchang Bi,2017-10-31 15:12:33.', 1, NULL),
(64, 1, 'Samuel', 'Lichlyter', 11, '2017-10-17 17:22:45', 'New Question', 'Another test question', NULL, '2017-10-17 17:22:45', NULL, NULL, NULL, 0, 'Jianchang Bi,2017-10-31 15:01:55.', 1, NULL),
(65, 1, 'Tyrion', 'Lannister', 8, '2017-10-17 17:59:11', 'Test by Bi', 'contemt', NULL, '2017-10-17 17:59:11', 'Teng', 'Li', 18, 3, '', 0, NULL),
(66, 1, 'Jianchang', 'Bi', 13, '2017-10-17 18:06:22', 'sdsadsa', 'dsadsadsad', NULL, '2017-10-17 18:06:22', NULL, NULL, NULL, 0, NULL, 0, NULL),
(68, 1, 'Jianchang', 'Bi', 13, '2017-10-17 19:20:02', 'Title', 'Test', NULL, '2017-10-17 19:20:02', NULL, NULL, NULL, 0, NULL, 0, NULL),
(69, 1, 'Jianchang', 'Bi', 13, '2017-10-17 19:48:58', 'Hi', 'Testetst', NULL, '2017-10-17 20:00:00', NULL, NULL, NULL, 0, NULL, 0, NULL),
(74, 1, 'Daniel', 'Lin', 20, '2017-10-23 20:34:11', 'Why am i in grad school', 'I need help plz thanks ', NULL, '2017-10-23 20:34:11', 'Deqing', 'Qu', 15, 3, '', 0, NULL),
(75, 1, 'Jianchang', 'Bi', 13, '2017-10-30 14:39:10', 'Mytest', 'MytestMytestMytestMytestMytestMytestMytestMytestMytestMytestMytest', NULL, '2017-10-30 14:39:10', 'Deqing', 'Qu', 15, 3, NULL, 0, NULL),
(76, 21, 'Jianchang', 'Bi', 13, '2017-11-03 11:21:39', 'Is this class 21?', 'Just test the post question for specific class', NULL, '2017-11-03 11:21:39', NULL, NULL, NULL, 0, NULL, 0, NULL),
(77, 23, 'Jianchang', 'Bi', 13, '2017-11-03 11:35:30', 'Hi! CS1111', 'Test', NULL, '2017-11-03 11:35:00', NULL, NULL, NULL, 0, NULL, 0, NULL),
(78, 26, 'Jianchang', 'Bi', 13, '2017-11-03 14:06:25', 'Haha', 'Test', NULL, '2017-11-03 14:30:00', NULL, NULL, NULL, 0, NULL, 0, NULL),
(79, 1, 'Samuel', 'Lichlyter', 11, '2017-11-06 11:03:46', 'Some Question', 'How do you do git?', NULL, '2017-11-06 11:11:00', 'Deqing', 'Qu', 15, 3, 'Deqing Qu,2017-11-22 16:31:01.Chengxi Yang,2017-11-28 11:45:52.', 2, NULL),
(80, 1, 'Samuel', 'Lichlyter', 11, '2017-11-06 14:11:35', 'test q', 'hi', NULL, '2017-11-06 14:11:35', NULL, NULL, NULL, 0, '', 0, NULL),
(81, 1, 'Samuel', 'Lichlyter', 11, '2017-11-06 15:05:58', 'Question', 'Question???', NULL, '2017-11-06 16:00:00', NULL, NULL, NULL, 0, 'Deqing Qu,2017-11-22 16:32:07.', 1, NULL),
(82, 99, 'Jianchang', 'Bi', 13, '2017-11-06 17:03:08', 'Test for CS162', 'This is a question of CS162', NULL, '2017-11-06 17:03:08', NULL, NULL, NULL, 0, NULL, 0, NULL),
(83, 23, 'Jianchang', 'Bi', 13, '2017-11-07 15:08:27', 'Test', 'qweqeqwew', NULL, '2017-11-07 15:08:27', NULL, NULL, NULL, 0, NULL, 0, NULL),
(84, 27, 'Jianchang', 'Bi', 13, '2017-11-07 16:54:15', 'Test CS496 first', 'testtest hnahahahah', NULL, '2017-11-07 17:30:00', NULL, NULL, NULL, 0, NULL, 0, NULL),
(86, 1, 'Samuel', 'Lichlyter', 11, '2017-11-09 15:35:17', 'Another new question', 'description', NULL, '2017-11-09 17:00:00', NULL, NULL, NULL, 0, '', 0, NULL),
(87, 1, 'Jianchang', 'Bi', 13, '2017-11-09 15:40:13', 'New qjest', 'qweqwe', NULL, '2017-11-09 15:40:13', NULL, NULL, NULL, 0, 'Deqing Qu,2017-11-22 16:34:06.', 1, NULL),
(88, 26, 'Chengxi', 'Yang', 17, '2017-11-09 19:14:25', 'TJIJIJI', 'I want to change', NULL, '2017-11-09 19:14:00', NULL, NULL, NULL, 0, NULL, 0, NULL),
(89, 26, 'Chengxi', 'Yang', 17, '2017-11-12 00:39:32', '321', '321321321', NULL, '2017-11-12 00:39:00', NULL, NULL, NULL, 0, NULL, 0, NULL),
(90, 1, 'Chengxi', 'Yang', 17, '2017-11-17 11:36:59', 'ycx''s qustion', 'grfagfsvfds', NULL, '2017-11-27 21:48:00', NULL, NULL, NULL, 0, 'Jianchang Bi,2017-11-22 11:38:33.Deqing Qu,2017-11-22 16:04:35.', 2, NULL),
(91, 1, 'Chengxi', 'Yang', 17, '2017-11-17 20:21:48', 'ycx''s questionnnnnnnnnnn', 'nnnnnnnnnnnnn6666666666666666', NULL, '2017-11-28 11:55:00', NULL, NULL, NULL, 0, 'Deqing Qu,2017-11-22 16:00:16.', 1, NULL),
(94, 63, 'Kang', 'Li', 41, '2017-11-21 14:10:08', 'ddd', 'dddd', NULL, '2017-11-21 14:10:08', NULL, NULL, NULL, 0, NULL, 0, NULL),
(95, 69, 'Jianchang', 'Bi', 13, '2017-11-22 16:50:29', 'Test for ta question detail page ', 'test', NULL, '2017-11-22 16:50:29', 'Jianchang', 'Bi', 13, 3, NULL, 0, NULL),
(108, 103, 'Jianchang', 'Bi', 13, '2017-11-28 18:20:15', 'test', 'test', 'a', '2017-11-28 18:20:15', NULL, NULL, NULL, 0, NULL, 0, NULL),
(109, 2, 'Jianchang', 'Bi', 13, '2017-11-28 18:23:30', 'test', 'test', 'testtag', '2017-11-28 18:23:30', NULL, NULL, NULL, 0, NULL, 0, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=141 ;

--
-- Dumping data for table `t_question_concern`
--

INSERT INTO `t_question_concern` (`id`, `question_id`, `user_id`, `first_name`, `last_name`, `created_time`, `comment`) VALUES
(3, 4, 8, 'Tyrion', 'Lannister', '2017-10-08 15:11:06', NULL),
(4, 6, 6, 'Daenerys', 'Targaryen', '2017-10-10 21:21:15', NULL),
(6, 7, 5, 'Sansa', 'Stark', '2017-10-09 11:05:25', NULL),
(21, 64, 13, 'Jianchang', 'Bi', '2017-10-31 15:01:55', NULL),
(31, 63, 13, 'Jianchang', 'Bi', '2017-10-31 15:12:33', NULL),
(37, 61, 13, 'Jianchang', 'Bi', '2017-10-31 15:19:10', NULL),
(46, 3, 13, 'Jianchang', 'Bi', '2017-10-31 15:44:35', NULL),
(51, 7, 13, 'Jianchang', 'Bi', '2017-10-31 16:00:31', NULL),
(56, 56, 13, 'Jianchang', 'Bi', '2017-11-01 21:39:38', NULL),
(60, 19, 13, 'Jianchang', 'Bi', '2017-11-01 21:45:46', NULL),
(70, 13, 13, 'Jianchang', 'Bi', '2017-11-02 18:27:11', NULL),
(72, 48, 13, 'Jianchang', 'Bi', '2017-11-03 10:32:05', NULL),
(96, 10, 13, 'Jianchang', 'Bi', '2017-11-08 12:27:44', NULL),
(102, 18, 13, 'Jianchang', 'Bi', '2017-11-09 15:47:57', NULL),
(104, 5, 13, 'Jianchang', 'Bi', '2017-11-10 16:19:56', NULL),
(109, 58, 13, 'Jianchang', 'Bi', '2017-11-15 17:32:24', NULL),
(114, 4, 18, 'Teng', 'Li', '2017-11-16 16:16:27', NULL),
(115, 55, 18, 'Teng', 'Li', '2017-11-16 16:16:29', NULL),
(117, 12, 41, 'Kang', 'Li', '2017-11-19 10:42:11', NULL),
(122, 6, 13, 'Jianchang', 'Bi', '2017-11-22 11:38:01', NULL),
(123, 90, 13, 'Jianchang', 'Bi', '2017-11-22 11:38:33', NULL),
(125, 91, 15, 'Deqing', 'Qu', '2017-11-22 16:00:16', NULL),
(127, 90, 15, 'Deqing', 'Qu', '2017-11-22 16:04:35', NULL),
(128, 79, 15, 'Deqing', 'Qu', '2017-11-22 16:31:01', NULL),
(129, 4, 15, 'Deqing', 'Qu', '2017-11-22 16:31:53', NULL),
(130, 81, 15, 'Deqing', 'Qu', '2017-11-22 16:32:07', NULL),
(131, 55, 15, 'Deqing', 'Qu', '2017-11-22 16:33:13', NULL),
(132, 87, 15, 'Deqing', 'Qu', '2017-11-22 16:34:06', NULL),
(135, 79, 17, 'Chengxi', 'Yang', '2017-11-28 11:45:52', NULL),
(137, 4, 17, 'Chengxi', 'Yang', '2017-11-28 11:54:30', NULL),
(139, 55, 13, 'Jianchang', 'Bi', '2017-11-28 18:05:02', NULL),
(140, 4, 13, 'Jianchang', 'Bi', '2017-11-28 18:06:22', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `first_name`, `last_name`, `osu_id`, `role`) VALUES
(1, 'Jack', 'Chan', '900000001', 0),
(2, 'Bruce', 'Lee', '900000002', 1),
(3, 'Jet', 'Li', '900000003', 0),
(4, 'Jon', 'Snow', '900000004', 0),
(5, 'Sansa', 'Stark', '900000005', 0),
(6, 'Daenerys', 'Targaryen', '900000006', 0),
(7, 'Jaime', 'Lannister', '900000007', 0),
(8, 'Tyrion', 'Lannister', '900000008', 0),
(9, 'Catelyn', 'Stark', '900000009', 1),
(10, 'Ned', 'Stark', '900000010', 1),
(11, 'Samuel', 'Lichlyter', 'lichlyts', 1),
(13, 'Jianchang', 'Bi', 'bij', 1),
(15, 'Deqing', 'Qu', 'qud', 1),
(17, 'Chengxi', 'Yang', 'yangchen', 1),
(18, 'Teng', 'Li', 'lite', 0),
(20, 'Daniel', 'Lin', 'lintzu', 0),
(21, 'Shannon', 'Ernst', 'ernstsh', 2),
(22, 'TBA', 'TBA', 'ta', 1),
(23, 'TBA', 'TBA', 'ta2', 1),
(24, 'TBA', 'TBA', 'ta3', 1),
(25, 'TBA', 'TBA', 'ta4', 1),
(26, 'TBA', 'TBA', 'ta5', 1),
(27, 'TBA', 'TBA', 'ta6', 1),
(28, 'TBA', 'TBA', 'ta7', 1),
(29, 'TBA', 'TBA', 'ta10', 1),
(30, 'TBA', 'TBA', 'ta11', 1),
(31, 'TBA', 'TBA', 'ta12', 1),
(32, 'TBA', 'TBA', 'ta14', 1),
(33, 'TBA', 'TBA', 'ta15', 1),
(34, 'TBA', 'TBA', 'ta16', 1),
(35, 'TBA', 'TBA', 'buffumw', 1),
(36, 'Samuel', 'Lichlyter', 'ersntsh', 1),
(37, 'TBA', 'TBA', 'duvoisin', 1),
(38, 'TBA', 'TBA', 'grokid', 1),
(39, 'TBA', 'TBA', 'shellhal', 1),
(40, 'TBA', 'TBA', 'hillkai', 1),
(41, 'Kang', 'Li', 'likang', 1),
(44, 'TBA', 'TBA', '', 1),
(45, 'TBA', 'TBA', 'non', 1),
(46, 'TBA', 'TBA', 'non2', 1);

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
