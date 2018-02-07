-- -----------------------------------------------------
-- Table `t_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `t_user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `first_name` VARCHAR(100) NOT NULL ,
  `last_name` VARCHAR(100) NOT NULL ,
  `osu_id` VARCHAR(20) NOT NULL ,
  `role` INT NOT NULL DEFAULT 0 COMMENT '0 Student, 1 TA' ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `OSUID_UNIQUE` (`osu_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `t_class`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `t_class` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `r_user_class`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `r_user_class` (
  `user_id` INT NOT NULL ,
  `class_id` INT NOT NULL ,
  `role` int(11) NOT NULL DEFAULT '0',
  INDEX `fk_r_user_class_to_t_class` (`class_id` ASC) ,
  INDEX `fk_r_user_class_to_t_user` (`user_id` ASC) ,
  PRIMARY KEY (`user_id`, `class_id`, `role`) ,
  CONSTRAINT `fk_r_user_class_to_t_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `t_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_r_user_class_to_t_class`
    FOREIGN KEY (`class_id` )
    REFERENCES `t_class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
-- -----------------------------------------------------
-- Table `t_question`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `t_question` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `class_id` INT NOT NULL ,
  `stdnt_first_name` VARCHAR(100) NOT NULL ,
  `stdnt_last_name` VARCHAR(100) NOT NULL ,
  `stdnt_user_id` INT NOT NULL ,
  `created_time` DATETIME NOT NULL ,
  `title` VARCHAR(255) NOT NULL ,
  `description` VARCHAR(1000) NULL ,
  `course_keywords` VARCHAR(100) NULL ,
  `preferred_time` DATETIME NULL ,
  `ta_first_name` VARCHAR(100) NULL ,
  `ta_last_name` VARCHAR(100) NULL ,
  `ta_user_id` INT NULL ,
  `status` INT NOT NULL DEFAULT 0 COMMENT '0 proposed, 1 answered, 2 deleted' ,
  `concern` VARCHAR(1000) NULL ,
  `num_liked` INT NULL ,
  `comment` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_t_question_to_t_class` (`class_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `fk_t_question_to_t_class`
    FOREIGN KEY (`class_id` )
    REFERENCES `t_class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `t_question_concern`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `t_question_concern` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `question_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `first_name` VARCHAR(100) NOT NULL ,
  `last_name` VARCHAR(100) NOT NULL ,
  `created_time` DATETIME NOT NULL ,
  `comment` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_t_question_concern_t_question` (`question_id` ASC) ,
  CONSTRAINT `fk_t_question_concern_t_question`
    FOREIGN KEY (`question_id` )
    REFERENCES `t_question` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `d_dictionary`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `d_dictionary` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dict_attribute` VARCHAR(20) NOT NULL ,
  `dict_value` INT NOT NULL ,
  `dictdata_value` VARCHAR(50) NOT NULL ,
  `comment` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `t_keywords`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `t_keywords` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `class_id` INT NOT NULL ,
  `value` VARCHAR(50) NOT NULL ,
  `comment` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_t_keywords_to_t_class` (`class_id` ASC) ,
  CONSTRAINT `fk_t_keywords_to_t_class`
    FOREIGN KEY (`class_id` )
    REFERENCES `t_class` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
