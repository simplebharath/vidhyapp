-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2018 at 12:10 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 7.0.28-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vidyapp_sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE IF NOT EXISTS `academic_years` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_date` varchar(255) NOT NULL,
  `to_date` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `from_date`, `to_date`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, '2018-07-12', '2019-04-27', 1, 1, 0, '2018-07-26 15:25:36', '2018-07-26 15:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_title` varchar(255) NOT NULL,
  `foldername` varchar(255) NOT NULL,
  `album_description` text NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assignment_title` varchar(255) NOT NULL,
  `assignment_description` text NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `last_date` varchar(20) NOT NULL,
  `assignment_file` varchar(255) NOT NULL,
  `academic_year_id` int(20) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `class_section_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `assign_books`
--

CREATE TABLE IF NOT EXISTS `assign_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_section_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `staff_type_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `given_date` varchar(255) NOT NULL,
  `return_date` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `staff_department_id` int(11) NOT NULL,
  `returned` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `assign_feetypes`
--

CREATE TABLE IF NOT EXISTS `assign_feetypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_id` int(11) NOT NULL,
  `fee_type_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `non_editable` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_types`
--

CREATE TABLE IF NOT EXISTS `attendance_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `academic_year_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Dumping data for table `attendance_types`
--

INSERT INTO `attendance_types` (`id`, `title`, `created_at`, `updated_at`, `academic_year_id`, `status`, `created_user_id`, `updated_user_id`) VALUES
(1, 'Day wise', '2018-01-25 10:51:47', '2018-01-25 16:21:47', 1, '0', 2, 1),
(2, 'Subject wise', '2017-07-18 05:45:39', '2017-07-18 11:15:39', 1, '1', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_department_id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_unique_id` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_publisher` varchar(255) NOT NULL,
  `book_price` varchar(255) NOT NULL,
  `number_of_books` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `staff_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `calendar_events`
--

CREATE TABLE IF NOT EXISTS `calendar_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calender_event_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `allDay` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `city_name`) VALUES
(1, 1, 'Hyderabad'),
(2, 1, 'Manikonda');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `class_exams`
--

CREATE TABLE IF NOT EXISTS `class_exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `exams_start_date` varchar(255) NOT NULL,
  `exams_end_date` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `class_fees`
--

CREATE TABLE IF NOT EXISTS `class_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_f_id` int(11) NOT NULL,
  `migrated` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `fee_type_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `fee_amount` varchar(20) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assign_feetype_id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `class_sections`
--

CREATE TABLE IF NOT EXISTS `class_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `migrated` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE IF NOT EXISTS `class_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_sub_id` int(11) NOT NULL,
  `migrated` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `institute_timing_id` int(11) NOT NULL,
  `start_time` varchar(25) NOT NULL,
  `end_time` varchar(25) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `staff_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `class_teachers`
--

CREATE TABLE IF NOT EXISTS `class_teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE IF NOT EXISTS `days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day_title` varchar(255) NOT NULL,
  `working_day` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `day_title`, `working_day`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 'Monday', 1, 1, 1, 0, '2018-01-31 08:02:39', '2018-01-31 13:32:39'),
(2, 'Tuesday', 1, 1, 1, 0, '2018-01-31 08:02:39', '2018-01-31 13:32:39'),
(3, 'Wednesday', 1, 1, 1, 0, '2018-01-31 08:02:39', '2018-01-31 13:32:39'),
(4, 'Thursday', 1, 1, 1, 0, '2018-01-31 08:02:39', '2018-01-31 13:32:39'),
(5, 'Friday', 1, 1, 1, 0, '2018-01-31 08:02:39', '2018-01-31 13:32:39'),
(6, 'Saturday', 1, 1, 1, 0, '2018-01-31 08:02:39', '2018-01-31 13:32:39'),
(7, 'Sunday', 0, 1, 1, 0, '2018-01-31 08:02:39', '2018-01-31 13:32:39'),
(8, 'All days', 1, 1, 1, 0, '2017-07-13 06:09:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title_id` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `event_poster` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_albums`
--

CREATE TABLE IF NOT EXISTS `event_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL,
  `image_description` text NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `folder_name` varchar(255) NOT NULL,
  `academic_year_id` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_participantes`
--

CREATE TABLE IF NOT EXISTS `event_participantes` (
  `event_partipant_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `participent_type` varchar(255) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`event_partipant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_titles`
--

CREATE TABLE IF NOT EXISTS `event_titles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `foldername` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `exam_description` text NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_type_id` int(11) NOT NULL,
  `pay_to` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `paid_by` varchar(255) NOT NULL,
  `paid_on` date NOT NULL,
  `description` text NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

CREATE TABLE IF NOT EXISTS `expense_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `expense_types`
--

INSERT INTO `expense_types` (`id`, `title`, `status`, `academic_year_id`, `created_at`, `updated_at`, `created_user_id`, `updated_user_id`) VALUES
(1, 'Salary', 1, 1, '2018-07-26 15:13:40', '0000-00-00 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE IF NOT EXISTS `fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_title` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `non_editable` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `fee_title`, `academic_year_id`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`, `non_editable`) VALUES
(1, 'Transport Fee', 1, 1, 1, 0, '2018-07-26 15:17:33', NULL, 1),
(2, 'Tuition Fee', 1, 1, 1, 0, '2018-07-27 08:13:59', '2018-07-27 08:13:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fee_discounts`
--

CREATE TABLE IF NOT EXISTS `fee_discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `discount` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE IF NOT EXISTS `fee_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_name` varchar(255) NOT NULL,
  `yearly` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`id`, `fee_name`, `yearly`, `academic_year_id`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 'Yearly', 1, 1, 1, 1, 0, '2018-07-26 15:19:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fuels`
--

CREATE TABLE IF NOT EXISTS `fuels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_driver_id` int(11) NOT NULL,
  `rate_for_liter` varchar(255) NOT NULL,
  `kilometre` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `cost` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `album_description` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grade_settings`
--

CREATE TABLE IF NOT EXISTS `grade_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grade_type_id` int(11) NOT NULL,
  `percentage_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `grade_settings`
--

INSERT INTO `grade_settings` (`id`, `grade_type_id`, `percentage_id`, `status`, `academic_year_id`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 1, 1, 1, 0, '2017-07-14 20:38:36', '2017-07-14 20:38:36'),
(2, 2, 9, 1, 1, 1, 0, '2017-07-14 20:38:47', '2017-07-14 20:38:47'),
(3, 3, 8, 1, 1, 1, 0, '2017-07-14 20:38:59', '2017-07-14 20:38:59'),
(4, 4, 7, 1, 1, 1, 0, '2017-07-14 20:39:08', '2017-07-14 20:39:08'),
(5, 5, 6, 1, 1, 1, 0, '2017-07-14 20:39:20', '2017-07-14 20:39:20'),
(6, 6, 5, 1, 1, 1, 0, '2017-07-14 20:39:33', '2017-07-14 20:39:33'),
(7, 7, 4, 1, 1, 1, 0, '2017-07-14 20:39:43', '2017-07-14 20:39:43'),
(8, 8, 3, 1, 1, 1, 0, '2017-07-14 20:39:59', '2017-07-14 20:39:59'),
(9, 9, 2, 1, 1, 1, 0, '2017-07-14 20:40:09', '2017-07-14 20:40:09'),
(10, 10, 1, 1, 1, 1, 0, '2018-01-25 10:54:05', '2018-01-25 16:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `grade_types`
--

CREATE TABLE IF NOT EXISTS `grade_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `grade_types`
--

INSERT INTO `grade_types` (`id`, `title`, `academic_year_id`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 'A1', 1, 1, 1, 0, '2017-07-14 20:32:03', '2017-07-14 20:32:03'),
(2, 'A2', 1, 1, 1, 0, '2017-07-14 20:32:12', '2017-07-14 20:32:12'),
(3, 'B1', 1, 1, 1, 3, '2017-07-14 20:32:20', '2017-07-14 20:32:31'),
(4, 'B2', 1, 1, 1, 0, '2017-07-14 20:32:38', '2017-07-14 20:32:38'),
(5, 'C1', 1, 1, 1, 5, '2017-07-14 20:32:46', '2017-07-14 20:35:58'),
(6, 'C2', 1, 1, 1, 6, '2017-07-14 20:32:54', '2017-07-14 20:36:09'),
(7, 'D1', 1, 1, 1, 7, '2017-07-14 20:35:47', '2017-07-14 20:36:19'),
(8, 'D2', 1, 1, 1, 0, '2017-07-14 20:36:27', '2017-07-14 20:36:27'),
(9, 'E', 1, 1, 1, 0, '2017-07-14 20:36:34', '2017-07-14 20:36:34'),
(10, 'F', 1, 1, 1, 0, '2017-07-14 20:36:41', '2018-01-25 16:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `individual_sent_messages`
--

CREATE TABLE IF NOT EXISTS `individual_sent_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `message_count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `institute_details`
--

CREATE TABLE IF NOT EXISTS `institute_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institution_name` varchar(255) NOT NULL,
  `institution_email` varchar(255) NOT NULL,
  `registration_number` varchar(30) NOT NULL,
  `office_contact_number1` varchar(20) NOT NULL,
  `office_contact_number2` varchar(20) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `fee_type_id` int(11) NOT NULL,
  `attendance_type_id` int(11) NOT NULL,
  `institution_logo` varchar(255) NOT NULL,
  `institution_image` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `institution_code` varchar(255) NOT NULL,
  `tag_line` varchar(255) NOT NULL,
  `youtube_channel` varchar(255) NOT NULL,
  `established_in` varchar(255) NOT NULL,
  `affliated_by` varchar(255) NOT NULL,
  `cp2_name` varchar(255) NOT NULL,
  `cp2_email` varchar(255) NOT NULL,
  `cp2_phone1` varchar(20) NOT NULL,
  `cp2_phone2` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mon` int(11) NOT NULL,
  `tue` int(11) NOT NULL,
  `wed` int(11) NOT NULL,
  `thus` int(11) NOT NULL,
  `fri` int(11) NOT NULL,
  `sat` int(11) NOT NULL,
  `sun` int(11) NOT NULL,
  `casual_leaves` int(11) NOT NULL,
  `sms` int(11) NOT NULL DEFAULT '0',
  `sms_count` int(11) NOT NULL,
  `sms_sender` varchar(255) NOT NULL,
  `short_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `institute_details`
--

INSERT INTO `institute_details` (`id`, `institution_name`, `institution_email`, `registration_number`, `office_contact_number1`, `office_contact_number2`, `academic_year_id`, `fee_type_id`, `attendance_type_id`, `institution_logo`, `institution_image`, `state_id`, `city_id`, `address`, `institution_code`, `tag_line`, `youtube_channel`, `established_in`, `affliated_by`, `cp2_name`, `cp2_email`, `cp2_phone1`, `cp2_phone2`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`, `mon`, `tue`, `wed`, `thus`, `fri`, `sat`, `sun`, `casual_leaves`, `sms`, `sms_count`, `sms_sender`, `short_url`) VALUES
(1, 'Global High School', 'ghjvbnkjc@gjhkji.com', '1234', '9704244851', '9704244851', 1, 1, 1, '2017-06-19-20-20-13-image.jpg', '2017-06-19-20-20-13-logo.jpg', 1, 1, 'chgxjvbdhjhjhchbdj', 'VIDS0001', 'jhcbdjk hkciudkj', 'UCkZO__3PN4uBE2krqjiXMOw', '2001', 'cvsgdhbcyusdj', 'vdujhcyuds', 'global@school.com', '9752655358', '9635244568', 1, 1, 0, '2018-07-26 15:38:14', '2018-07-26 15:25:41', 1, 1, 1, 1, 1, 1, 0, 1, 0, 4954, 'vidhya', 'goo.gl/5gHJTr');

-- --------------------------------------------------------

--
-- Table structure for table `institute_helpers`
--

CREATE TABLE IF NOT EXISTS `institute_helpers` (
  `helper_id` int(11) NOT NULL AUTO_INCREMENT,
  `helper_name` varchar(255) NOT NULL,
  `helper_email` varchar(11) NOT NULL,
  `helper_work` varchar(11) NOT NULL,
  `helper_address` text NOT NULL,
  `helper_photo` varchar(255) NOT NULL,
  `helper_contactnumber` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`helper_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `institute_holidays`
--

CREATE TABLE IF NOT EXISTS `institute_holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `holiday_date` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `institute_timings`
--

CREATE TABLE IF NOT EXISTS `institute_timings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time_id` int(11) NOT NULL,
  `migrated` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `class_start` varchar(255) NOT NULL,
  `class_end` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_user_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_type` varchar(255) NOT NULL,
  `user_login_id` int(11) NOT NULL,
  `user_browser` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `log_in` timestamp NULL DEFAULT NULL,
  `log_out` timestamp NULL DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `log_type`, `user_login_id`, `user_browser`, `ip_address`, `log_in`, `log_out`, `status`, `academic_year_id`, `created_at`) VALUES
(1, 'Login', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', '2018-07-26 11:10:48', NULL, 1, 2, '2018-07-26 11:10:48'),
(2, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:11:19', 1, 2, '2018-07-26 11:11:19'),
(3, 'Login', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', '2018-07-26 11:11:25', NULL, 1, 2, '2018-07-26 11:11:25'),
(4, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:17', 1, 2, '2018-07-26 11:24:17'),
(5, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:18', 1, 2, '2018-07-26 11:24:18'),
(6, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:18', 1, 2, '2018-07-26 11:24:18'),
(7, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:18', 1, 2, '2018-07-26 11:24:18'),
(8, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:19', 1, 2, '2018-07-26 11:24:19'),
(9, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:19', 1, 2, '2018-07-26 11:24:19'),
(10, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:19', 1, 2, '2018-07-26 11:24:19'),
(11, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:20', 1, 2, '2018-07-26 11:24:20'),
(12, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:20', 1, 2, '2018-07-26 11:24:20'),
(13, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:20', 1, 2, '2018-07-26 11:24:20'),
(14, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:20', 1, 2, '2018-07-26 11:24:20'),
(15, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:21', 1, 2, '2018-07-26 11:24:21'),
(16, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 11:24:21', 1, 2, '2018-07-26 11:24:21'),
(17, 'Login', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', '2018-07-26 11:47:58', NULL, 1, 2, '2018-07-26 11:47:58'),
(18, 'Login', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', '2018-07-26 14:51:33', NULL, 1, 2, '2018-07-26 14:51:33'),
(19, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 15:24:54', 1, 1, '2018-07-26 15:24:54'),
(20, 'Logout', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', NULL, '2018-07-26 15:49:07', 1, 1, '2018-07-26 15:49:07'),
(21, 'Login', 1, 'Google Chrome 67.0.3396.99 on windows', '::1', '2018-07-26 15:49:15', NULL, 1, 1, '2018-07-26 15:49:15'),
(22, 'Login', 1, 'Google Chrome 67.0.3396.99 on windows', '183.83.65.216', '2018-07-27 07:53:01', NULL, 1, 1, '2018-07-27 07:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `log_details`
--

CREATE TABLE IF NOT EXISTS `log_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_type` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `old_value` text NOT NULL,
  `new_value` text NOT NULL,
  `user_login_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `log_details`
--

INSERT INTO `log_details` (`id`, `log_type`, `message`, `old_value`, `new_value`, `user_login_id`, `academic_year_id`, `status`, `created_at`) VALUES
(1, 'Academic year added successfully!', 'Added', 'No old values', '12-07-2018-27-04-2019', 1, 0, 1, '2018-07-26 15:25:36'),
(2, 'settings Add Institution details', 'first time institute_details', 'Global High School,ghjvbnkjc@gjhkji.com,1234,9704244851,9704244851,1,1,1,1,1,chgxjvbdhjhjhchbdj,jhcbdjk hkciudkj,UCkZO__3PN4uBE2krqjiXMOw,2001,cvsgdhbcyusdj,vdujhcyuds,global@school.com,9752655358,9635244568,1', 'No New Value for Add Activity', 1, 0, 1, '2018-07-26 15:48:49'),
(3, 'fee added successfully!', 'Added', 'No old values', 'Tuition Fee', 1, 1, 1, '2018-07-27 02:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `meter_readings`
--

CREATE TABLE IF NOT EXISTS `meter_readings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_driver_id` int(11) NOT NULL,
  `reading` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration_students`
--

CREATE TABLE IF NOT EXISTS `migration_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_class_section_id` int(11) NOT NULL,
  `students` varchar(255) NOT NULL,
  `to_class_section_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `from_class_id` int(11) NOT NULL,
  `from_section_id` int(11) NOT NULL,
  `to_class_id` int(11) NOT NULL,
  `to_section_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `from_academic_year_id` int(11) NOT NULL,
  `to_academic_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module`, `rank`, `image`, `link`, `academic_year_id`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 'Classes', 2, 'fa fa-book', 'view-classes', 1, 1, 1, 2, '2017-06-30 14:22:07', '2017-06-30 19:52:07'),
(2, 'Staff', 3, 'fa fa-user', 'view-staff', 1, 1, 1, 2, '2017-06-30 14:22:31', '2017-06-30 19:52:31'),
(3, 'Settings', 50, 'fa fa-cog', 'view-academic-years', 1, 1, 1, 1, '2017-07-05 14:23:01', '2017-06-19 11:59:02'),
(4, 'Logs', 51, 'fa fa-history', 'log-history', 1, 1, 1, 1, '2017-07-05 14:23:11', '2017-06-19 11:58:35'),
(5, 'Dashboard', 1, 'fa fa-home', 'admin-dashboard', 1, 1, 1, 1, '2018-01-25 10:48:38', '2018-01-25 16:18:38'),
(6, 'Users', 49, 'fa fa-users', 'view-user', 1, 1, 1, 1, '2017-07-05 14:23:55', '2017-06-24 06:24:42'),
(7, 'Fees', 6, 'fa fa-rupee', 'view-fee-types', 1, 1, 1, NULL, '2017-06-28 15:17:40', '2017-06-24 06:43:05'),
(8, 'Students', 4, 'fa fa-users', 'view-students', 1, 1, 2, 2, '2017-06-30 14:21:15', '2017-06-30 19:51:15'),
(9, 'Transport', 7, 'fa fa-bus', 'view-vehicle-types', 1, 1, 2, 2, '2017-07-05 14:25:17', '2017-06-27 22:34:46'),
(10, 'Exams', 5, 'fa fa-book', 'view-exams', 1, 1, 2, 2, '2017-07-05 14:24:45', '2017-07-03 20:58:44'),
(11, 'Expenses', 8, 'fa fa-rupee', 'view-expenses', 1, 1, 2, NULL, '2017-07-05 14:26:59', '2017-07-05 19:47:39'),
(12, 'Inventory', 9, 'fa fa-file', 'view-product-quantities', 1, 1, 2, 1, '2017-07-28 13:19:06', '2017-07-28 18:49:06'),
(13, 'Events', 13, 'fa fa-file-image-o', 'view-events', 1, 1, 2, 1, '2017-07-27 12:01:51', '2017-07-27 17:31:51'),
(14, 'Payments', 10, 'fa fa-rupee', 'payment-history-institute', 1, 1, 2, 1, '2017-07-28 13:17:43', '2017-07-28 18:47:43'),
(15, 'Marks', 14, 'fa fa-bar-chart', 'view-students-marks', 1, 1, 2, 2, '2017-07-13 02:22:17', '2017-07-13 07:52:17'),
(16, 'Library', 15, 'fa fa-file', 'view-books', 1, 1, 2, NULL, '2017-07-13 00:36:19', '2017-07-13 00:36:19'),
(17, 'Remarks', 16, 'fa fa-comment', 'view-students-remarks', 1, 1, 1, NULL, '2017-07-13 11:51:25', '2017-07-13 11:51:25'),
(18, 'Assignments', 17, 'fa fa-inbox', 'view-class-assignments', 1, 1, 1, 1, '2017-07-13 06:26:22', '2017-07-13 11:56:22'),
(19, 'Reports', 18, 'fa fa-line-chart', 'view-institute-classes', 1, 1, 1, NULL, '2017-07-17 20:06:14', '2017-07-17 20:06:14'),
(20, 'Balance Sheet', 20, 'fa fa-rupee', 'balance-sheet-payments-academic-years', 1, 1, 1, 1, '2017-07-19 19:24:34', '2017-07-20 00:54:34'),
(21, 'Media', 21, 'fa fa-image', 'view-gallery', 1, 1, 1, 1, '2018-01-30 08:02:35', '2018-01-30 13:32:35'),
(22, 'My Profile', 11, 'fa fa-user', 'view-staff-profile', 1, 1, 1, 1, '2017-07-27 12:06:33', '2017-07-27 17:36:33'),
(23, 'My  profile', 12, 'fa fa-user', 'view-student-profile', 1, 1, 1, 1, '2017-07-27 12:06:56', '2017-07-27 17:36:56'),
(24, 'Institute timings', 19, 'fa fa-calendar-check-o ', 'view-institute-timings', 1, 1, 1, 1, '2017-07-27 11:55:35', '2017-07-27 17:25:35'),
(25, 'Institute holidays', 22, 'fa fa-compass', 'view-institute-holidays', 1, 1, 1, 1, '2017-07-27 11:58:43', '2017-07-27 17:28:43'),
(26, 'View staff', 23, 'fa fa-users', 'view-staffs', 1, 1, 1, NULL, '2017-07-26 19:44:36', '2017-07-26 19:44:36'),
(27, 'View Students', 24, 'fa fa-user', 'view-institutes-student', 1, 1, 1, 1, '2017-07-27 12:05:55', '2017-07-27 17:35:55'),
(28, 'View Routes', 25, 'fa fa-bus', 'view-vehicles-routes', 1, 1, 1, NULL, '2017-07-26 21:26:59', '2017-07-26 21:26:59'),
(29, 'Student Attendance', 30, 'fa fa-calendar', 'staff-view-students-attendance', 1, 1, 1, 1, '2017-07-28 06:49:39', '2017-07-28 12:19:39'),
(30, 'Student Marks', 35, 'fa fa-pencil', 'staff-view-students-marks', 1, 1, 1, 1, '2017-07-28 06:52:40', '2017-07-28 12:22:40'),
(31, 'Student Remarks', 38, 'fa fa-edit', 'staff-view-students-remarks', 1, 1, 1, NULL, '2017-07-28 12:15:06', '2017-07-28 12:15:06'),
(32, 'Student Assignments', 39, 'fa fa-book', 'staff-view-class-assignments', 1, 1, 1, NULL, '2017-07-28 12:16:00', '2017-07-28 12:16:00'),
(33, 'My books', 41, 'fa fa-book', 'student-books', 1, 1, 1, NULL, '2017-07-28 14:13:56', '2017-07-28 14:13:56'),
(34, 'Transport students', 42, 'fa fa-bus', 'driver-route-students', 1, 1, 1, NULL, '2017-07-28 14:48:45', '2017-07-28 14:48:45'),
(35, 'My stops', 45, 'fa fa-stop', 'driver-my-stops', 1, 1, 1, NULL, '2017-07-28 15:52:35', '2017-07-28 15:52:35'),
(36, 'Sent Messages', 46, 'fa fa-envelope-o', 'view-messages', 1, 1, 1, 1, '2017-07-28 12:54:52', '2017-07-28 18:24:52'),
(37, 'Messages', 47, 'fa fa-envelope', 'admin-view-messages', 1, 1, 1, 1, '2017-07-28 12:54:07', '2017-07-28 18:24:07'),
(38, 'Migration', 36, 'fa fa-arrow-right', 'classes-migration', 1, 1, 1, 1, '2017-08-08 02:22:48', '2017-08-08 07:52:48'),
(39, 'SMS', 26, 'fa fa-edit', 'sms-sent', 1, 1, 1, 1, '2018-02-16 04:07:54', '2018-02-16 09:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE IF NOT EXISTS `months` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(50) NOT NULL,
  `work_days` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `month`, `work_days`) VALUES
(1, 'January', 31),
(2, 'February', 28),
(3, 'March', 31),
(4, 'April', 30),
(5, 'May', 31),
(6, 'June', 30),
(7, 'July', 31),
(8, 'August', 31),
(9, 'September', 30),
(10, 'October', 31),
(11, 'November', 30),
(12, 'December', 31);

-- --------------------------------------------------------

--
-- Table structure for table `parent_details`
--

CREATE TABLE IF NOT EXISTS `parent_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `user_login_id` int(11) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_email` varchar(255) NOT NULL,
  `mother_number` varchar(20) NOT NULL,
  `father_number` varchar(20) NOT NULL,
  `mother_education` varchar(255) NOT NULL,
  `father_education` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mother_photo` varchar(255) NOT NULL,
  `father_photo` varchar(255) NOT NULL,
  `father_email` varchar(255) NOT NULL,
  `mother_occupation` varchar(255) NOT NULL,
  `father_occupation` varchar(255) NOT NULL,
  `family_income` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `parent_messages`
--

CREATE TABLE IF NOT EXISTS `parent_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `subject` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_no` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `payed_amount` varchar(20) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `active` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_records`
--

CREATE TABLE IF NOT EXISTS `payment_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `paid_amount` varchar(255) NOT NULL,
  `paid_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `received_by` varchar(255) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `percentages`
--

CREATE TABLE IF NOT EXISTS `percentages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percentage_from` int(11) NOT NULL,
  `percentage_to` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=11 ;

--
-- Dumping data for table `percentages`
--

INSERT INTO `percentages` (`id`, `percentage_from`, `percentage_to`, `created_at`, `updated_at`, `status`, `created_user_id`, `updated_user_id`, `academic_year_id`) VALUES
(1, 0, 9, '2017-07-14 20:36:55', '2017-07-14 20:36:55', '1', 1, 0, 1),
(2, 10, 20, '2017-07-14 20:37:03', '2017-07-14 20:37:03', '1', 1, 0, 1),
(3, 21, 30, '2017-07-14 20:37:11', '2017-07-14 20:37:11', '1', 1, 0, 1),
(4, 31, 40, '2017-07-14 20:37:18', '2017-07-14 20:37:18', '1', 1, 0, 1),
(5, 41, 50, '2017-07-14 20:37:27', '2017-07-14 20:37:27', '1', 1, 0, 1),
(6, 51, 60, '2017-07-14 20:37:41', '2017-07-14 20:37:41', '1', 1, 0, 1),
(7, 61, 70, '2017-07-14 20:37:49', '2017-07-14 20:37:49', '1', 1, 0, 1),
(8, 71, 80, '2017-07-14 20:37:57', '2017-07-14 20:37:57', '1', 1, 0, 1),
(9, 81, 90, '2017-07-14 20:38:05', '2017-07-14 20:38:05', '1', 1, 0, 1),
(10, 91, 100, '2018-01-25 10:53:39', '2018-01-25 16:23:39', '1', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_quantities`
--

CREATE TABLE IF NOT EXISTS `product_quantities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `total_quantity` varchar(255) NOT NULL,
  `each_quantity_price` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `return_books`
--

CREATE TABLE IF NOT EXISTS `return_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assign_book_id` int(11) NOT NULL,
  `fine` varchar(255) NOT NULL,
  `late_by` varchar(255) NOT NULL,
  `fine_per_day` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `route_stops`
--

CREATE TABLE IF NOT EXISTS `route_stops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_id` int(11) NOT NULL,
  `stop_name` varchar(255) NOT NULL,
  `stop_latitude` varchar(255) NOT NULL,
  `stop_longitude` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `pickup_time` varchar(255) NOT NULL,
  `drop_time` varchar(255) NOT NULL,
  `stop_address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_exams`
--

CREATE TABLE IF NOT EXISTS `schedule_exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `exams_start_time` varchar(255) NOT NULL,
  `exams_end_time` varchar(255) NOT NULL,
  `exam_duration` varchar(255) NOT NULL,
  `max_marks` varchar(255) NOT NULL,
  `pass_marks` varchar(255) NOT NULL,
  `exam_syllabus` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `exam_date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_name` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sent_messages`
--

CREATE TABLE IF NOT EXISTS `sent_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `message_count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings_check`
--

CREATE TABLE IF NOT EXISTS `settings_check` (
  `settings_check_id` int(11) NOT NULL AUTO_INCREMENT,
  `acadamic_year_id` int(11) NOT NULL,
  `set_institute_details` int(11) NOT NULL,
  `set_fee_details` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`settings_check_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `migrated` int(11) NOT NULL,
  `user_login_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL DEFAULT '6',
  `employee_id` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `emergency_number` varchar(20) NOT NULL,
  `staff_department_id` int(11) NOT NULL,
  `emp_designation` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `joined_date` varchar(255) NOT NULL,
  `experience` varchar(50) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `staff_type_id` int(11) NOT NULL,
  `add_rights` int(11) NOT NULL,
  `edit_rights` int(11) NOT NULL,
  `view_rights` int(11) NOT NULL,
  `delete_rights` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `basic_salary` varchar(255) NOT NULL,
  `incentives` varchar(255) NOT NULL,
  `other_salary` varchar(255) NOT NULL,
  `salary_cuttings` varchar(255) NOT NULL,
  `total_salary` varchar(255) NOT NULL,
  `aadhaar_number` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `father_number` varchar(255) NOT NULL,
  `present_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `gender` varchar(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `caste` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `spouse_name` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `child_number` varchar(255) NOT NULL,
  `domicile` varchar(255) NOT NULL,
  `staff_unique_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_attendances`
--

CREATE TABLE IF NOT EXISTS `staff_attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(3) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `staff_type_id` int(11) NOT NULL,
  `staff_department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_departments`
--

CREATE TABLE IF NOT EXISTS `staff_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_type_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_documents`
--

CREATE TABLE IF NOT EXISTS `staff_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_experiences`
--

CREATE TABLE IF NOT EXISTS `staff_experiences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `organisation_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `from_year` varchar(255) NOT NULL,
  `to_year` varchar(255) NOT NULL,
  `total_years` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `academic_year_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_qualifications`
--

CREATE TABLE IF NOT EXISTS `staff_qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `stream_branch` varchar(255) NOT NULL,
  `institute_name` varchar(255) NOT NULL,
  `percentage` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `academic_year_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_salaries`
--

CREATE TABLE IF NOT EXISTS `staff_salaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `month_id` varchar(255) NOT NULL,
  `gross_salary` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deducted_salary` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `staff_type_id` int(11) NOT NULL,
  `staff_department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_subjects`
--

CREATE TABLE IF NOT EXISTS `staff_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class_section_id` int(11) NOT NULL,
  `institute_timing_id` int(11) NOT NULL,
  `staff_department_id` int(20) NOT NULL,
  `staff_type_id` int(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_types`
--

CREATE TABLE IF NOT EXISTS `staff_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `staff_types`
--

INSERT INTO `staff_types` (`id`, `title`, `status`, `academic_year_id`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 'Teaching', 1, 1, 1, 1, '2017-06-20 11:14:19', '2018-01-24 14:51:31'),
(2, 'Non teaching', 1, 1, 1, 1, '2017-06-20 11:14:29', '2018-01-29 11:44:20'),
(3, 'others ', 1, 1, 1, 1, '2017-07-15 11:19:39', '2018-07-13 16:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`) VALUES
(1, 'Telangana'),
(2, 'Andhra pradesh');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `emergency_number` varchar(20) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `mark_1` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `present_address` text NOT NULL,
  `admission_number` varchar(50) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `roll_number` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `aadhaar_number` varchar(20) NOT NULL,
  `joined_date` varchar(255) NOT NULL,
  `student_type_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class_section_id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `father_number` varchar(255) NOT NULL,
  `mother_number` varchar(255) NOT NULL,
  `permanent_address` text NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `caste` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `domicile` varchar(255) NOT NULL,
  `physical_handicapped` int(11) NOT NULL,
  `siblings` int(11) NOT NULL,
  `mark_2` varchar(255) NOT NULL,
  `hobbies` text NOT NULL,
  `view_rights` int(11) NOT NULL,
  `edit_rights` int(11) NOT NULL,
  `add_rights` int(11) NOT NULL,
  `student_academic_year_id` int(11) NOT NULL,
  `joined_class_id` int(11) NOT NULL,
  `joined_section_id` int(11) NOT NULL,
  `joined_roll_number` varchar(255) NOT NULL,
  `route_id` int(11) NOT NULL,
  `stop_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `promoted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_academic_years`
--

CREATE TABLE IF NOT EXISTS `student_academic_years` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_section_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `roll_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `new` int(11) NOT NULL DEFAULT '0',
  `academic_year_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_attendances`
--

CREATE TABLE IF NOT EXISTS `student_attendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `attendance_status` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `attendance_date` date NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `active` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class_section_id` int(11) NOT NULL,
  `attendance_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_documents`
--

CREATE TABLE IF NOT EXISTS `student_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_educations`
--

CREATE TABLE IF NOT EXISTS `student_educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_from` varchar(255) NOT NULL,
  `class_to` varchar(255) NOT NULL,
  `from_year` varchar(255) NOT NULL,
  `institute_name` varchar(255) NOT NULL,
  `to_year` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `academic_year_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `education_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_fee`
--

CREATE TABLE IF NOT EXISTS `student_fee` (
  `student_fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `fee_type_id` int(11) NOT NULL,
  `fee_amount` int(11) NOT NULL,
  `fee_description` text NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `active` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`student_fee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_marks`
--

CREATE TABLE IF NOT EXISTS `student_marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_section_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `marks_obtained` varchar(11) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `schedule_exam_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_remarks`
--

CREATE TABLE IF NOT EXISTS `student_remarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `remark_title` varchar(255) NOT NULL,
  `remark_description` text NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_transport_fees`
--

CREATE TABLE IF NOT EXISTS `student_transport_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `transport_fee_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `stop_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_types`
--

CREATE TABLE IF NOT EXISTS `student_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student_types`
--

INSERT INTO `student_types` (`id`, `title`, `status`, `academic_year_id`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 'School transport', 1, 1, 1, 2, '2017-06-21 04:52:14', '2017-06-30 20:03:34'),
(2, 'Hostler', 1, 1, 1, 2, '2017-06-21 04:52:23', '2017-06-30 20:03:16'),
(3, 'Day schooler', 1, 1, 1, 2, '2017-06-23 09:37:57', '2017-06-30 20:03:04'),
(4, 'NRI''S', 1, 1, 1, 0, '2018-01-24 14:03:54', '2018-01-24 14:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `teaching_emp`
--

CREATE TABLE IF NOT EXISTS `teaching_emp` (
  `teaching_emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `emergency_number` varchar(20) NOT NULL,
  `emp_department` varchar(20) NOT NULL,
  `emp_designation` varchar(50) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `upload1` varchar(255) NOT NULL,
  `upload2` varchar(255) NOT NULL,
  `upload3` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `joing_date` date NOT NULL,
  `experience` varchar(50) NOT NULL,
  `active` int(3) NOT NULL DEFAULT '1',
  `status` varchar(50) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`teaching_emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transport_fees`
--

CREATE TABLE IF NOT EXISTS `transport_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transport_f_id` int(11) NOT NULL,
  `migrated` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL,
  `fee_type_id` int(11) NOT NULL,
  `transport_fee` varchar(20) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assign_feetype_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `stop_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) NOT NULL,
  `add_rights` int(11) NOT NULL DEFAULT '0',
  `view_rights` int(11) NOT NULL DEFAULT '1',
  `edit_rights` int(11) NOT NULL DEFAULT '0',
  `delete_rights` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign_key` (`user_login_id`),
  KEY `user_login_id` (`user_login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_login_id`, `user_type_id`, `add_rights`, `view_rights`, `edit_rights`, `delete_rights`, `first_name`, `last_name`, `email_id`, `contact_number`, `photo`, `address`, `academic_year_id`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 'Bharath', 'Reddy', 'bharath@gmail.com', '9704244851', '', '', 1, 1, 1, NULL, '2018-07-26 15:24:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE IF NOT EXISTS `user_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `user_type_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_name`, `password`, `token`, `academic_year_id`, `status`, `user_type_id`, `created_at`, `updated_at`) VALUES
(1, 'bharath', '123456', '', 1, 1, '1', '2018-07-26 15:22:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_modules`
--

CREATE TABLE IF NOT EXISTS `user_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `user_modules`
--

INSERT INTO `user_modules` (`id`, `user_type_id`, `module_id`, `academic_year_id`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(2, 1, 2, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(3, 1, 3, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(4, 1, 4, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(5, 1, 5, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(6, 1, 6, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(7, 1, 7, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(8, 1, 8, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(9, 1, 9, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(10, 1, 10, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(11, 1, 11, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(12, 1, 12, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(13, 1, 13, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(14, 1, 14, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(15, 1, 15, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(16, 1, 16, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(17, 1, 17, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(18, 1, 18, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(19, 1, 19, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(20, 1, 20, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(21, 1, 21, 1, 1, 1, 0, '2017-07-27 03:42:07', '0000-00-00 00:00:00'),
(22, 2, 1, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(23, 2, 2, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(24, 2, 3, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(25, 2, 4, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(26, 2, 5, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(27, 2, 6, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(28, 2, 7, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(29, 2, 8, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(30, 2, 9, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(31, 2, 10, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(32, 2, 11, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(33, 2, 12, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(34, 2, 13, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(35, 2, 14, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(36, 2, 15, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(37, 2, 16, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(38, 2, 17, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(39, 2, 18, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(40, 2, 19, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(41, 2, 20, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(42, 2, 21, 1, 1, 1, 0, '2017-07-27 03:42:42', '0000-00-00 00:00:00'),
(43, 4, 13, 1, 1, 1, 0, '2017-07-27 03:44:33', '0000-00-00 00:00:00'),
(44, 4, 21, 1, 1, 1, 0, '2017-07-27 03:44:33', '0000-00-00 00:00:00'),
(45, 4, 22, 1, 1, 1, 0, '2017-07-27 03:44:33', '0000-00-00 00:00:00'),
(46, 4, 24, 1, 1, 1, 0, '2017-07-27 03:44:33', '0000-00-00 00:00:00'),
(47, 4, 25, 1, 1, 1, 0, '2017-07-27 03:44:33', '0000-00-00 00:00:00'),
(48, 4, 27, 1, 1, 1, 0, '2017-07-27 03:44:33', '0000-00-00 00:00:00'),
(49, 4, 30, 1, 1, 1, 1, '2017-07-27 10:50:06', '2017-07-27 16:20:06'),
(50, 4, 31, 1, 1, 1, 1, '2017-07-28 06:47:21', '2017-07-28 12:17:21'),
(51, 4, 32, 1, 1, 1, 1, '2017-07-28 06:46:38', '2017-07-28 12:16:37'),
(52, 4, 29, 1, 1, 1, 0, '2017-07-27 08:33:28', '0000-00-00 00:00:00'),
(53, 9, 11, 1, 1, 1, 0, '2017-07-27 11:02:19', '0000-00-00 00:00:00'),
(54, 9, 12, 1, 1, 1, 0, '2017-07-27 11:02:19', '0000-00-00 00:00:00'),
(55, 9, 13, 1, 1, 1, 0, '2017-07-27 11:02:19', '0000-00-00 00:00:00'),
(56, 9, 14, 1, 1, 1, 0, '2017-07-27 11:02:19', '0000-00-00 00:00:00'),
(57, 9, 21, 1, 1, 1, 0, '2017-07-27 11:02:19', '0000-00-00 00:00:00'),
(58, 9, 22, 1, 1, 1, 0, '2017-07-27 11:02:19', '0000-00-00 00:00:00'),
(59, 9, 24, 1, 1, 1, 0, '2017-07-27 11:02:19', '0000-00-00 00:00:00'),
(60, 9, 25, 1, 1, 1, 0, '2017-07-27 11:02:19', '0000-00-00 00:00:00'),
(61, 9, 27, 1, 1, 1, 0, '2017-07-27 11:02:19', '0000-00-00 00:00:00'),
(62, 9, 7, 1, 1, 1, 0, '2017-07-27 11:03:47', '0000-00-00 00:00:00'),
(63, 8, 13, 1, 1, 1, 0, '2017-07-27 11:07:39', '0000-00-00 00:00:00'),
(64, 8, 16, 1, 1, 1, 0, '2017-07-27 11:07:39', '0000-00-00 00:00:00'),
(65, 8, 21, 1, 1, 1, 0, '2017-07-27 11:07:39', '0000-00-00 00:00:00'),
(66, 8, 22, 1, 1, 1, 0, '2017-07-27 11:07:39', '0000-00-00 00:00:00'),
(67, 8, 24, 1, 1, 1, 0, '2017-07-27 11:07:39', '0000-00-00 00:00:00'),
(68, 8, 25, 1, 1, 1, 0, '2017-07-27 11:07:39', '0000-00-00 00:00:00'),
(69, 8, 27, 1, 1, 1, 0, '2017-07-27 11:07:39', '0000-00-00 00:00:00'),
(70, 8, 28, 1, 1, 1, 0, '2017-07-27 11:07:39', '0000-00-00 00:00:00'),
(71, 7, 13, 1, 1, 1, 0, '2017-07-27 11:30:30', '0000-00-00 00:00:00'),
(72, 7, 21, 1, 1, 1, 0, '2017-07-27 11:30:30', '0000-00-00 00:00:00'),
(73, 7, 23, 1, 1, 1, 0, '2017-07-27 11:30:30', '0000-00-00 00:00:00'),
(74, 7, 24, 1, 1, 1, 0, '2017-07-27 11:30:30', '0000-00-00 00:00:00'),
(75, 7, 25, 1, 1, 1, 0, '2017-07-27 11:30:30', '0000-00-00 00:00:00'),
(76, 7, 26, 1, 1, 1, 0, '2017-07-27 11:30:30', '0000-00-00 00:00:00'),
(77, 6, 9, 1, 1, 1, 0, '2017-07-27 11:34:02', '0000-00-00 00:00:00'),
(78, 6, 21, 1, 1, 1, 0, '2017-07-27 11:34:02', '0000-00-00 00:00:00'),
(79, 6, 22, 1, 1, 1, 0, '2017-07-27 11:34:02', '0000-00-00 00:00:00'),
(80, 6, 24, 1, 1, 1, 0, '2017-07-27 11:34:02', '0000-00-00 00:00:00'),
(81, 6, 25, 1, 1, 1, 0, '2017-07-27 11:34:02', '0000-00-00 00:00:00'),
(82, 5, 13, 1, 1, 1, 0, '2017-07-27 11:35:50', '0000-00-00 00:00:00'),
(83, 5, 21, 1, 1, 1, 0, '2017-07-27 11:35:50', '0000-00-00 00:00:00'),
(84, 5, 23, 1, 1, 1, 0, '2017-07-27 11:35:50', '0000-00-00 00:00:00'),
(85, 5, 24, 1, 1, 1, 0, '2017-07-27 11:35:50', '0000-00-00 00:00:00'),
(86, 5, 25, 1, 1, 1, 0, '2017-07-27 11:35:50', '0000-00-00 00:00:00'),
(87, 5, 26, 1, 1, 1, 0, '2017-07-27 11:35:50', '0000-00-00 00:00:00'),
(88, 3, 7, 1, 1, 1, 0, '2017-07-27 11:39:28', '0000-00-00 00:00:00'),
(89, 3, 9, 1, 1, 1, 0, '2017-07-27 11:39:28', '0000-00-00 00:00:00'),
(90, 3, 12, 1, 1, 1, 0, '2017-07-27 11:39:28', '0000-00-00 00:00:00'),
(91, 3, 13, 1, 1, 1, 0, '2017-07-27 11:39:28', '0000-00-00 00:00:00'),
(92, 3, 14, 1, 1, 1, 0, '2017-07-27 11:39:28', '0000-00-00 00:00:00'),
(93, 3, 19, 1, 1, 1, 0, '2017-07-27 11:39:28', '0000-00-00 00:00:00'),
(94, 3, 21, 1, 1, 1, 0, '2017-07-27 11:39:28', '0000-00-00 00:00:00'),
(95, 3, 22, 1, 1, 1, 0, '2017-07-27 11:39:28', '0000-00-00 00:00:00'),
(96, 3, 24, 1, 1, 1, 0, '2017-07-27 11:39:28', '0000-00-00 00:00:00'),
(97, 3, 25, 1, 1, 1, 0, '2017-07-27 11:39:28', '0000-00-00 00:00:00'),
(98, 6, 13, 1, 1, 1, 0, '2017-07-27 14:15:36', '0000-00-00 00:00:00'),
(99, 5, 33, 1, 1, 1, 0, '2017-07-28 08:47:51', '0000-00-00 00:00:00'),
(100, 6, 34, 1, 1, 1, 0, '2017-07-28 09:19:13', '0000-00-00 00:00:00'),
(101, 6, 35, 1, 1, 1, 0, '2017-07-28 10:22:50', '0000-00-00 00:00:00'),
(102, 7, 36, 1, 1, 1, 0, '2017-07-28 12:51:52', '0000-00-00 00:00:00'),
(103, 1, 37, 1, 1, 1, 0, '2018-03-01 07:51:45', '2018-03-01 13:21:45'),
(104, 2, 37, 1, 1, 1, 0, '2017-07-28 12:52:59', '0000-00-00 00:00:00'),
(105, 1, 38, 1, 1, 1, 0, '2017-08-08 02:21:32', '0000-00-00 00:00:00'),
(106, 1, 39, 1, 1, 1, 0, '2018-02-12 14:11:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `title`, `academic_year_id`, `status`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, 1, 1, 0, '2017-06-24 04:43:28', '2017-06-15 12:11:26'),
(2, 'System Admin', 1, 1, 1, 0, '2017-06-24 04:43:30', '2017-06-15 12:11:41'),
(3, 'Office Admin', 1, 1, 1, 0, '2017-06-24 04:43:33', '2017-06-15 12:12:02'),
(4, 'Staff', 1, 1, 1, 0, '2017-06-24 04:43:36', '2017-06-15 12:12:26'),
(5, 'Student', 1, 1, 1, 0, '2017-06-24 04:43:38', '2017-06-15 12:12:44'),
(6, 'Driver', 1, 1, 1, 0, '2017-06-24 04:43:41', '2017-06-15 12:13:07'),
(7, 'Parent', 1, 1, 1, 0, '2017-06-24 04:43:44', '2017-06-15 12:13:26'),
(8, 'Librarian', 1, 1, 1, 0, '2017-06-24 04:43:47', '2017-06-15 12:13:38'),
(9, 'Accountant', 1, 1, 1, 0, '2017-07-25 13:39:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_type_id` int(11) NOT NULL,
  `vehicle_number` varchar(255) NOT NULL,
  `engine_number` varchar(255) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_number` varchar(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `owner_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `vehicle_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_drivers`
--

CREATE TABLE IF NOT EXISTS `vehicle_drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_routes`
--

CREATE TABLE IF NOT EXISTS `vehicle_routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route_title` varchar(255) NOT NULL,
  `route_from` varchar(255) NOT NULL,
  `route_from_start_time` varchar(255) NOT NULL,
  `route_from_latitude` varchar(255) NOT NULL,
  `route_from_longitude` varchar(255) NOT NULL,
  `route_to` varchar(255) NOT NULL,
  `route_to_start_time` varchar(255) NOT NULL,
  `route_to_latitude` varchar(255) NOT NULL,
  `route_to_longitude` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `route_from_end_time` varchar(255) NOT NULL,
  `route_to_end_time` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE IF NOT EXISTS `vehicle_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `academic_year_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(11) NOT NULL,
  `updated_user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
