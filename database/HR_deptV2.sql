SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `hr_dept` DEFAULT CHARACTER SET utf8 ;
USE `hr_dept` ;

-- -----------------------------------------------------
-- Table `hr_dept`.`department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`department` (
  `dept_no` INT(11) NOT NULL,
  `name` VARCHAR(30) NULL DEFAULT NULL,
  PRIMARY KEY (`dept_no`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`job_scale`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`job_scale` (
  `grade` CHAR(1) NOT NULL,
  `salary_basic` INT(11) NULL DEFAULT NULL,
  `salary_rent` INT(11) NULL DEFAULT NULL,
  `salary_transport` INT(11) NULL DEFAULT NULL,
  `salary_medical` INT(11) NULL DEFAULT NULL,
  `salary_sustenance` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`grade`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`designation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`designation` (
  `name` VARCHAR(30) NULL DEFAULT NULL,
  `code` CHAR(7) NOT NULL,
  `grade` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`code`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  INDEX `fk_grade` (`grade` ASC),
  CONSTRAINT `fk_grade`
    FOREIGN KEY (`grade`)
    REFERENCES `hr_dept`.`job_scale` (`grade`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`employee` (
  `id` INT(11) NOT NULL,
  `password` VARCHAR(30) NULL DEFAULT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `sex` CHAR(1) NULL DEFAULT NULL,
  `birth_date` DATE NULL DEFAULT NULL,
  `present_address` VARCHAR(80) NULL DEFAULT NULL,
  `permanent_address` VARCHAR(80) NULL DEFAULT NULL,
  `contact_no` VARCHAR(30) NULL DEFAULT NULL,
  `dept_no` INT(11) NULL DEFAULT NULL,
  `des_code` CHAR(7) NULL DEFAULT NULL,
  `ret_date` DATE NULL DEFAULT NULL,
  `super_id` INT(11) NULL DEFAULT NULL,
  `pension` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk1_des_code` (`des_code` ASC),
  INDEX `fk2_super_id` (`super_id` ASC),
  INDEX `fk3_dept_no` (`dept_no` ASC),
  CONSTRAINT `fk1_des_code`
    FOREIGN KEY (`des_code`)
    REFERENCES `hr_dept`.`designation` (`code`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk2_super_id`
    FOREIGN KEY (`super_id`)
    REFERENCES `hr_dept`.`employee` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk3_dept_no`
    FOREIGN KEY (`dept_no`)
    REFERENCES `hr_dept`.`department` (`dept_no`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`dependent`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`dependent` (
  `e_id` INT(11) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `sex` CHAR(1) NULL DEFAULT NULL,
  `relation` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`e_id`, `name`),
  CONSTRAINT `fk_e_id`
    FOREIGN KEY (`e_id`)
    REFERENCES `hr_dept`.`employee` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`designation_and_performance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`designation_and_performance` (
  `e_id` INT(11) NOT NULL,
  `start_date` DATE NULL DEFAULT NULL,
  `des_code` CHAR(7) NOT NULL,
  `net_per` DECIMAL(3,2) NULL DEFAULT NULL,
  PRIMARY KEY (`e_id`, `des_code`),
  INDEX `des_code_idx` (`des_code` ASC),
  CONSTRAINT `fk1_employee_id`
    FOREIGN KEY (`e_id`)
    REFERENCES `hr_dept`.`employee` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk2_designation_code`
    FOREIGN KEY (`des_code`)
    REFERENCES `hr_dept`.`designation` (`code`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`employee_qualification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`employee_qualification` (
  `e_id` INT(11) NOT NULL,
  `degree` VARCHAR(30) NOT NULL,
  `grad_year` INT(11) NULL DEFAULT NULL,
  `result` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`e_id`, `degree`),
  CONSTRAINT `fk1_e_id`
    FOREIGN KEY (`e_id`)
    REFERENCES `hr_dept`.`employee` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`employee_salary_record`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`employee_salary_record` (
  `e_id` INT(11) NOT NULL,
  `year` INT(11) NOT NULL,
  `month` INT(11) NOT NULL,
  `leave_adj` INT(11) NULL DEFAULT NULL,
  `loan_adj` INT(11) NULL DEFAULT NULL,
  `fin_amount` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`e_id`, `year`, `month`),
  CONSTRAINT `fk2_e_id`
    FOREIGN KEY (`e_id`)
    REFERENCES `hr_dept`.`employee` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`project` (
  `id` CHAR(10) NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `dept_no` INT(11) NULL DEFAULT NULL,
  `start_date` DATE NULL DEFAULT NULL,
  `end_date` DATE NULL DEFAULT NULL,
  `fund` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  INDEX `fk_dept_of_project_idx` (`dept_no` ASC),
  CONSTRAINT `fk_dept_of_project`
    FOREIGN KEY (`dept_no`)
    REFERENCES `hr_dept`.`department` (`dept_no`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`employee_work_project`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`employee_work_project` (
  `e_id` INT(11) NOT NULL,
  `p_id` CHAR(10) NOT NULL,
  PRIMARY KEY (`e_id`, `p_id`),
  INDEX `fk2_p_id` (`p_id` ASC),
  CONSTRAINT `fk2_p_id`
    FOREIGN KEY (`p_id`)
    REFERENCES `hr_dept`.`project` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk6_e_id`
    FOREIGN KEY (`e_id`)
    REFERENCES `hr_dept`.`employee` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`loan_taken`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`loan_taken` (
  `e_id` INT(11) NOT NULL,
  `amount` INT(11) NOT NULL,
  `sanc_date` DATE NOT NULL,
  `months_to_repay` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`e_id`, `amount`, `sanc_date`),
  CONSTRAINT `fk5_e_id`
    FOREIGN KEY (`e_id`)
    REFERENCES `hr_dept`.`employee` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`paid_leave`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`paid_leave` (
  `e_id` INT(11) NOT NULL,
  `type` VARCHAR(15) NOT NULL,
  `start_date` DATE NULL DEFAULT NULL,
  `end_date` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`type`, `e_id`),
  INDEX `fk4_e_id` (`e_id` ASC),
  CONSTRAINT `fk4_e_id`
    FOREIGN KEY (`e_id`)
    REFERENCES `hr_dept`.`employee` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `hr_dept`.`unpaid_leave`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hr_dept`.`unpaid_leave` (
  `e_id` INT(11) NOT NULL,
  `day` INT(11) NOT NULL,
  `month` INT(11) NOT NULL,
  `year` YEAR NOT NULL,
  PRIMARY KEY (`e_id`, `day`, `month`, `year`),
  CONSTRAINT `fk3_e_id`
    FOREIGN KEY (`e_id`)
    REFERENCES `hr_dept`.`employee` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
