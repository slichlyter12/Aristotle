-- t_user
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Jack', 'Chan', 900000001, 0);
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Bruce', 'Lee', 900000002, 1);
INSERT INTO `t_user` (`first_name`, `last_name`, `osu_id`, `role`) VALUES ('Jet', 'Li', 900000003, 0);

-- t_class
INSERT INTO `t_class` (`name`) VALUES ('CS561 Software Engineering');

-- r_user_class
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (1, 1);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (2, 1);
INSERT INTO `r_user_class` (`user_id`, `class_id`) VALUES (3, 1);

-- t_keywords
INSERT INTO `t_keywords` (`class_id`, `value`, `comment`) VALUES (1, '1', 'lecture');
INSERT INTO `t_keywords` (`class_id`, `value`, `comment`) VALUES (1, '2', 'homework');
INSERT INTO `t_keywords` (`class_id`, `value`, `comment`) VALUES (1, '3', 'exam');


-- t_question
INSERT INTO `t_question` (`class_id`, `stdnt_first_name`, `stdnt_last_name`, `stunt_osu_id`, `created_time`, `title`, `description`, `course_keywords`, `preferred_time`, `status`, `concern`, `num_liked`) VALUES (1, 'Jack', 'Chan', 900000001, '2017-10-5 18:30:25', 'test', 'Why ?', '1,2', '2017-10-6 8:30:00', 1, 'Jack 2017-10-5 18:30:25, Jet 2017-10-5 20:30:15', 1);

-- t_question_concern
INSERT INTO `t_question_concern` (`question_id`, `osu_id`, `first_name`, `last_name`, `created_time`) VALUES (1, 900000003, 'Jet', 'Li', '2017-10-5 20:30:15');

-- d_dictionary
INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('user_type', 0, 'Student');
INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('user_type', 1, 'TA');

INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('question_status', 0, 'proposed');
INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('question_status', 1, 'answered');
INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('question_status', 2, 'deleted');
INSERT INTO `d_dictionary` (`dict_attribute`, `dict_value`, `dictdata_value`) VALUES ('question_status', 3, 'signed');

