-- t_user
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Jack', 'Chan', 900000001, 0);
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Bruce', 'Lee', 900000002, 1);
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Jet', 'Li', 900000003, 0);
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Jon', 'Snow', 900000004, 0);
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Sansa', 'Stark', 900000005, 0);
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Daenerys', 'Targaryen', 900000006, 0);
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Jaime', 'Lannister', 900000007, 0);
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Tyrion', 'Lannister', 900000008, 0);
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Catelyn', 'Stark', 900000009, 1);
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Ned', 'Stark', 900000010, 1);


-- t_class
INSERT INTO `t_class` (`name`) VALUES ('CS561 Software Engineering');
INSERT INTO `t_class` (`name`) VALUES ('CS550 Introduction to Computer Graphics');
INSERT INTO `t_class` (`name`) VALUES ('CS534 Machine Learning');
INSERT INTO `t_class` (`name`) VALUES ('CS581 PROGRAMMING LANGUAGES');


-- r_user_class
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (1, 1);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (2, 1);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (3, 1);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (3, 2);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (9, 3);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (10, 4);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (4, 1);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (4, 2);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (5, 3);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (6, 3);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (6, 1);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (7, 1);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (7, 4);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (8, 4);

-- t_keywords
INSERT INTO `t_keywords` (`class_id`, `value`, `comment`) VALUES (1, '1', 'lecture');
INSERT INTO `t_keywords` (`class_id`, `value`, `comment`) VALUES (1, '2', 'homework');
INSERT INTO `t_keywords` (`class_id`, `value`, `comment`) VALUES (1, '3', 'exam');
INSERT INTO `t_keywords` (`class_id`, `value`, `comment`) VALUES (2, '1', 'lecture');
INSERT INTO `t_keywords` (`class_id`, `value`, `comment`) VALUES (2, '2', 'homework');
INSERT INTO `t_keywords` (`class_id`, `value`, `comment`) VALUES (3, '3', 'exam');

-- t_question
INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 18:30:25', 'test', 'Why ?', '1,2', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 18:30:25 Jet 2017-10-5 20:30:15', 2);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `ta_first_name`, `ta_last_name`, `ta_user_id`, `status`, `concern`,`num_liked`) 
VALUES (1, 'Bruce', 'Lee', 2, '2017-10-06 11:37:13', 'test1', 'How ？', '3', '2017-10-07 08:30:00', 'Bruce', 'Lee', 2, 4, 'Bruce 2017-10-06 11:37:13 Jon 2017-10-6 18:23:41 Daenerys 2017-10-6 19:37:21', 3);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jaime', 'Lannister', 7, '2017-10-07 12:20:35', 'test2', 'what ？', '1,2,3', '2017-10-08 08:30:00', 1, 'Jaime 2017-10-07 12:20:35', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Daenerys', 'Tyrion', 6, '2017-10-08 13:30:23', 'test3', 'When ？', '2017-10-09 11:30:00', 1, 'Daenerys 2017-10-08 13:30:23 Tyrion 2017-10-8 15:11:06', 2);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (2, 'Jon', 'Snow', 4, '2017-10-09 10:31:18', 'test4', 'Where ？', '1', '2017-10-09 18:30:00', 1,'Jon 2017-10-09 10:31:18', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (3, 'Sansa', 'Stark', 5, '2017-10-10 20:30:28', 'test5', 'Where ？', '2017-10-11 12:30:00', 1, 'Sansa 2017-10-10 20:30:28 Daenerys 2017-10-10 21:21:15', 2);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `preferred_time`, `ta_first_name`, `ta_last_name`, `ta_user_id`, `status`, `concern`, `num_liked`) 
VALUES (3, 'Daenerys', 'Tyrion', 6, '2017-10-09 18:00:11', 'test6', 'When ？', '2017-10-11 08:30:00', 'Catelyn', 'Stark', 9, 1, 'Daenerys 2017-10-09 18:00:11 Sansa 2017-10-9 11:05:25', 2);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (4, 'Jaime', 'Lannister', 7, '2017-10-06 15:15:37', 'test7', 'How ？', '2017-10-07 08:30:00', 1, 'Jaime 2017-10-06 15:15:37', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `preferred_time`, `ta_first_name`, `ta_last_name`, `ta_user_id`, `status`, `concern`, `num_liked`) 
VALUES (4, 'Tyrion', 'Lannister', 8, '2017-10-05 14:27:51', 'test8', 'Why ?', '2017-10-06 08:30:00', 'Ned', 'Stark', 10, 1, 'Tyrion 2017-10-05 14:27:51', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (4, 'Tyrion', 'Lannister', 8, '2017-10-06 11:52:09', 'test9', 'Where ？', '2017-10-06 08:30:00', 1, 'Tyrion 2017-10-06 11:52:09', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 18:30:25', 'test1', 'Why ?', '1,2', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 18:30:25', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 19:30:25', 'test2', 'Why ?', '1,2', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 19:30:25', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 20:30:25', 'test3', 'Why ?', '2', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 20:30:25', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 21:30:25', 'test4', 'Why ?', '2', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 21:30:25', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 22:30:25', 'test5', 'Why ?', '2', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 22:30:25', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 17:20:25', 'test6', 'Why ?', '1,2', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 17:30:25', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 16:30:25', 'test7', 'Why ?', '1,2', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 16:30:25', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 15:30:25', 'test8', 'Why ?', '1,2', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 15:30:25', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 14:30:25', 'test9', 'Why ?', '1,2', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 14:30:25', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 13:30:25', 'test10', 'Why ?', '1', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 13:30:25', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 12:30:25', 'test1', 'Why ?', '1', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 12:30:25', 1);

INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stdnt_user_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) 
VALUES (1, 'Jack', 'Chan', 1, '2017-10-5 11:30:25', 'test12', 'Why ?', '1', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 11:30:25', 1);





-- t_question_concern
INSERT INTO `t_question_concern` (`question_id`, `user_id`, `first_name`, `last_name`, `created_time`) VALUES (1, 3, 'Jet', 'Li', '2017-10-5 20:30:15');
INSERT INTO `t_question_concern` (`question_id`, `user_id`, `first_name`, `last_name`, `created_time`) VALUES (2, 4, 'Jon', 'Snow', '2017-10-6 18:23:41');
INSERT INTO `t_question_concern` (`question_id`, `user_id`, `first_name`, `last_name`, `created_time`) VALUES (4, 8, 'Tyrion', 'Lannister', '2017-10-8 15:11:06');
INSERT INTO `t_question_concern` (`question_id`, `user_id`, `first_name`, `last_name`, `created_time`) VALUES (6, 6, 'Daenerys', 'Targaryen', '2017-10-10 21:21:15');
INSERT INTO `t_question_concern` (`question_id`, `user_id`, `first_name`, `last_name`, `created_time`) VALUES (2, 6, 'Daenerys', 'Targaryen', '2017-10-6 19:37:21');
INSERT INTO `t_question_concern` (`question_id`, `user_id`, `first_name`, `last_name`, `created_time`) VALUES (7, 5, 'Sansa', 'Stark', '2017-10-9 11:05:25');






-- d_dictionary
INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('user_type', 0, 'Student');
INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('user_type', 1, 'TA');

INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('question_status', 0, 'proposed');
INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('question_status', 1, 'answered');
INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('question_status', 2, 'deleted');
INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('question_status', 3, 'signed');

