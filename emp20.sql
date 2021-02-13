-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 13 فبراير 2021 الساعة 08:08
-- إصدار الخادم: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp20`
--

-- --------------------------------------------------------

--
-- بنية الجدول `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `administrations`
--

DROP TABLE IF EXISTS `administrations`;
CREATE TABLE IF NOT EXISTS `administrations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `administration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publicAdmin_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `administrations_publicadmin_id_foreign` (`publicAdmin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_profile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  KEY `admins_group_id_foreign` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `photo_profile`, `password`, `group_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'test@test.com', NULL, '123456', NULL, NULL, '2021-02-13 04:58:44', '2021-02-13 04:58:44');

-- --------------------------------------------------------

--
-- بنية الجدول `admin_groups`
--

DROP TABLE IF EXISTS `admin_groups`;
CREATE TABLE IF NOT EXISTS `admin_groups` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `attendances`
--

DROP TABLE IF EXISTS `attendances`;
CREATE TABLE IF NOT EXISTS `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `att_days` bigint(20) DEFAULT NULL,
  `absent_days` bigint(20) DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `adate` date NOT NULL,
  `ayear` bigint(20) NOT NULL,
  `month` bigint(20) NOT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attendances_emp_id_foreign` (`emp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `attendances`
--

INSERT INTO `attendances` (`id`, `att_days`, `absent_days`, `note`, `emp_id`, `adate`, `ayear`, `month`, `updating_reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 22, 0, NULL, 1, '2021-02-01', 2021, 2, NULL, NULL, '2021-02-13 05:07:51', '2021-02-13 05:07:51');

-- --------------------------------------------------------

--
-- بنية الجدول `attendance_official`
--

DROP TABLE IF EXISTS `attendance_official`;
CREATE TABLE IF NOT EXISTS `attendance_official` (
  `attendance_id` int(10) UNSIGNED NOT NULL,
  `official_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`attendance_id`,`official_id`),
  KEY `attendance_official_official_id_foreign` (`official_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `audits`
--

DROP TABLE IF EXISTS `audits`;
CREATE TABLE IF NOT EXISTS `audits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) UNSIGNED NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci,
  `new_values` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `audits`
--

INSERT INTO `audits` (`id`, `user_type`, `user_id`, `event`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `url`, `ip_address`, `user_agent`, `tags`, `created_at`, `updated_at`) VALUES
(1, 'App\\Model\\user', 1, 'created', 'App\\Model\\emp', 1, '[]', '{\"emp_name\":\"\\u0627\\u064a\\u0645\\u0627\\u0646\",\"second_name\":\"\\u0645\\u062d\\u0645\\u062f\",\"third_name\":\"\\u0645\\u0637\\u0647\\u0631\",\"last_name\":\"\\u0627\\u0644\\u0644\\u0648\\u0646\\u062f\\u064a\",\"major\":null,\"qulification\":null,\"department_id\":null,\"job_id\":null,\"user_id\":null,\"gender\":null,\"salary\":\"50000\",\"motivation\":\"30000\",\"status\":\"\\u0645\\u062a\\u0639\\u0627\\u0642\\u062f\",\"start_date\":null,\"phone_number\":\"777789403\",\"emergency_number\":null,\"emergency_person\":null,\"email\":null,\"social\":null,\"nationality\":null,\"snn\":null,\"passport\":null,\"birth_date\":null,\"birth_place\":null,\"sons\":null,\"employment_number\":null,\"updated_at\":\"2021-02-13 07:59:47\",\"created_at\":\"2021-02-13 07:59:47\",\"id\":1}', 'http://127.0.0.1:8000/admin/emps', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36', NULL, '2021-02-13 04:59:47', '2021-02-13 04:59:47'),
(2, 'App\\Model\\user', 1, 'created', 'App\\Model\\attendance', 1, '[]', '{\"emp_id\":\"1\",\"att_days\":\"22\",\"absent_days\":\"0\",\"note\":null,\"adate\":\"2021-02-01 00:00:00\",\"ayear\":\"2021\",\"month\":\"02\",\"updated_at\":\"2021-02-13 08:07:51\",\"created_at\":\"2021-02-13 08:07:51\",\"id\":1}', 'http://127.0.0.1:8000/admin/attendancestore', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.150 Safari/537.36', NULL, '2021-02-13 05:07:51', '2021-02-13 05:07:51');

-- --------------------------------------------------------

--
-- بنية الجدول `behaviors`
--

DROP TABLE IF EXISTS `behaviors`;
CREATE TABLE IF NOT EXISTS `behaviors` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `behavior` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bedate` date DEFAULT NULL,
  `beyear` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `month` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `behaviors_emp_id_foreign` (`emp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `closedyears`
--

DROP TABLE IF EXISTS `closedyears`;
CREATE TABLE IF NOT EXISTS `closedyears` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `closedyear` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_desc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `administration_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_admin_id_foreign` (`admin_id`),
  KEY `departments_administration_id_foreign` (`administration_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `emps`
--

DROP TABLE IF EXISTS `emps`;
CREATE TABLE IF NOT EXISTS `emps` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `third_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motivation` bigint(20) NOT NULL DEFAULT '0',
  `salary` bigint(20) NOT NULL DEFAULT '0',
  `work_nature` bigint(20) NOT NULL DEFAULT '0',
  `level` text COLLATE utf8mb4_unicode_ci,
  `transportation` bigint(20) NOT NULL DEFAULT '0',
  `degree` bigint(20) NOT NULL DEFAULT '0',
  `activity` text COLLATE utf8mb4_unicode_ci,
  `major` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qulification` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `administration_id` bigint(20) UNSIGNED DEFAULT NULL,
  `publicadmin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sector_id` bigint(20) UNSIGNED DEFAULT NULL,
  `job_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `photo_profile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `emergency_number` bigint(20) DEFAULT NULL,
  `emergency_person` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snn` bigint(20) DEFAULT NULL,
  `fingerprint` bigint(20) DEFAULT NULL,
  `account_num` bigint(20) DEFAULT NULL,
  `passport` bigint(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sons` bigint(20) DEFAULT NULL,
  `employment_number` bigint(20) DEFAULT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emps_admin_id_foreign` (`admin_id`),
  KEY `emps_department_id_foreign` (`department_id`),
  KEY `emps_job_id_foreign` (`job_id`),
  KEY `emps_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `emps`
--

INSERT INTO `emps` (`id`, `admin_id`, `emp_name`, `second_name`, `third_name`, `last_name`, `motivation`, `salary`, `work_nature`, `level`, `transportation`, `degree`, `activity`, `major`, `qulification`, `department_id`, `administration_id`, `publicadmin_id`, `sector_id`, `job_id`, `user_id`, `photo_profile`, `contract`, `gender`, `status`, `start_date`, `phone_number`, `emergency_number`, `emergency_person`, `email`, `cv`, `social`, `nationality`, `snn`, `fingerprint`, `account_num`, `passport`, `birth_date`, `birth_place`, `sons`, `employment_number`, `updating_reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'ايمان', 'محمد', 'مطهر', 'اللوندي', 30000, 50000, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'متعاقد', NULL, 777789403, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-13 04:59:47', '2021-02-13 04:59:47');

-- --------------------------------------------------------

--
-- بنية الجدول `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_bytes` bigint(20) NOT NULL,
  `mimtype` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `files_admin_id_foreign` (`admin_id`),
  KEY `files_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `holidaies`
--

DROP TABLE IF EXISTS `holidaies`;
CREATE TABLE IF NOT EXISTS `holidaies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `holiday_desc` longtext COLLATE utf8mb4_unicode_ci,
  `holidays_days` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `holidaytype_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_id` bigint(20) UNSIGNED NOT NULL,
  `hdate` date NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `hyear` bigint(20) NOT NULL,
  `month` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `holidaies_holidaytype_id_foreign` (`holidaytype_id`),
  KEY `holidaies_emp_id_foreign` (`emp_id`),
  KEY `holidaies_attendance_id_foreign` (`attendance_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `holidaytypes`
--

DROP TABLE IF EXISTS `holidaytypes`;
CREATE TABLE IF NOT EXISTS `holidaytypes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `holidaytype` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_days` bigint(20) NOT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `holiday_palances`
--

DROP TABLE IF EXISTS `holiday_palances`;
CREATE TABLE IF NOT EXISTS `holiday_palances` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `holidayPalance` bigint(20) DEFAULT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `holidaytype_id` bigint(20) UNSIGNED NOT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `palyear` bigint(20) NOT NULL,
  `month` bigint(20) NOT NULL,
  `paldate` date NOT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `holiday_palances_emp_id_foreign` (`emp_id`),
  KEY `holiday_palances_holidaytype_id_foreign` (`holidaytype_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `imgs`
--

DROP TABLE IF EXISTS `imgs`;
CREATE TABLE IF NOT EXISTS `imgs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_desc` longtext COLLATE utf8mb4_unicode_ci,
  `job_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_admin_id_foreign` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_09_22_192348_create_messages_table', 1),
(4, '2019_10_16_211433_create_favorites_table', 1),
(5, '2019_10_19_094109_create_admin_groups_table', 1),
(6, '2019_10_19_094109_create_admins_table', 1),
(7, '2019_10_19_102130_create_files_table', 1),
(8, '2019_10_19_985759_create_settings_table', 1),
(9, '2020_07_04_685502_create_jobs_table', 1),
(10, '2020_07_04_905195_create_departments_table', 1),
(11, '2020_07_05_064813_laratrust_setup_tables', 1),
(12, '2020_07_06_657435_create_emps_table', 1),
(13, '2020_07_06_830719_create_tasks_table', 1),
(14, '2020_07_09_689520_create_users_table', 1),
(15, '2020_07_10_22007_create_tests_table', 1),
(16, '2020_07_10_697582_create_pers_table', 1),
(17, '2020_07_10_769723_create_holidaies_table', 1),
(18, '2020_07_19_24131_create_attendances_table', 1),
(19, '2020_07_22_20697_create_official_holidaies_table', 1),
(20, '2020_07_22_516996_create_holidaytypes_table', 1),
(21, '2020_07_24_143322_create_attendance_official_holiday_table', 1),
(22, '2020_07_28_817773_create_ratings_table', 1),
(23, '2020_08_14_134202_create_audits_table', 1),
(24, '2020_08_15_881370_create_imgs_table', 1),
(25, '2020_08_18_958335_create_holiday_palances_table', 1),
(26, '2020_08_28_52516_create_public_admins_table', 1),
(27, '2020_08_30_66176_create_sectors_table', 1),
(28, '2020_09_06_356322_create_closedyears_table', 1),
(29, '2020_10_26_072732_create_activity_log_table', 1),
(30, '2020_11_02_739767_create_administrations_table', 1),
(31, '2020_12_17_183400_create_notifications_table', 1),
(32, '2020_12_23_622502_create_behaviors_table', 1),
(33, '2020_12_23_885607_create_trainings_table', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `official_holidaies`
--

DROP TABLE IF EXISTS `official_holidaies`;
CREATE TABLE IF NOT EXISTS `official_holidaies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holiday_month` date DEFAULT NULL,
  `holiday_month_end` date DEFAULT NULL,
  `off_days` bigint(20) DEFAULT NULL,
  `odate` date NOT NULL,
  `oyear` bigint(20) NOT NULL,
  `month` bigint(20) NOT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create_users', 'Create Users', 'Create Users', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(2, 'read_users', 'Read Users', 'Read Users', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(3, 'update_users', 'Update Users', 'Update Users', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(4, 'delete_users', 'Delete Users', 'Delete Users', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(5, 'create_departments', 'Create Departments', 'Create Departments', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(6, 'read_departments', 'Read Departments', 'Read Departments', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(7, 'update_departments', 'Update Departments', 'Update Departments', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(8, 'delete_departments', 'Delete Departments', 'Delete Departments', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(9, 'create_administrations', 'Create Administrations', 'Create Administrations', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(10, 'read_administrations', 'Read Administrations', 'Read Administrations', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(11, 'update_administrations', 'Update Administrations', 'Update Administrations', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(12, 'delete_administrations', 'Delete Administrations', 'Delete Administrations', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(13, 'create_behaviors', 'Create Behaviors', 'Create Behaviors', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(14, 'read_behaviors', 'Read Behaviors', 'Read Behaviors', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(15, 'update_behaviors', 'Update Behaviors', 'Update Behaviors', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(16, 'delete_behaviors', 'Delete Behaviors', 'Delete Behaviors', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(17, 'create_holiday_palances', 'Create Holiday_palances', 'Create Holiday_palances', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(18, 'read_holiday_palances', 'Read Holiday_palances', 'Read Holiday_palances', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(19, 'update_holiday_palances', 'Update Holiday_palances', 'Update Holiday_palances', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(20, 'delete_holiday_palances', 'Delete Holiday_palances', 'Delete Holiday_palances', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(21, 'create_jobs', 'Create Jobs', 'Create Jobs', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(22, 'read_jobs', 'Read Jobs', 'Read Jobs', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(23, 'update_jobs', 'Update Jobs', 'Update Jobs', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(24, 'delete_jobs', 'Delete Jobs', 'Delete Jobs', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(25, 'create_roles', 'Create Roles', 'Create Roles', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(26, 'read_roles', 'Read Roles', 'Read Roles', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(27, 'update_roles', 'Update Roles', 'Update Roles', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(28, 'delete_roles', 'Delete Roles', 'Delete Roles', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(29, 'create_sectors', 'Create Sectors', 'Create Sectors', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(30, 'read_sectors', 'Read Sectors', 'Read Sectors', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(31, 'update_sectors', 'Update Sectors', 'Update Sectors', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(32, 'delete_sectors', 'Delete Sectors', 'Delete Sectors', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(33, 'create_trainings', 'Create Trainings', 'Create Trainings', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(34, 'read_trainings', 'Read Trainings', 'Read Trainings', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(35, 'update_trainings', 'Update Trainings', 'Update Trainings', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(36, 'delete_trainings', 'Delete Trainings', 'Delete Trainings', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(37, 'create_holidaies', 'Create Holidaies', 'Create Holidaies', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(38, 'read_holidaies', 'Read Holidaies', 'Read Holidaies', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(39, 'update_holidaies', 'Update Holidaies', 'Update Holidaies', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(40, 'delete_holidaies', 'Delete Holidaies', 'Delete Holidaies', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(41, 'create_official_holidaies', 'Create Official_holidaies', 'Create Official_holidaies', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(42, 'read_official_holidaies', 'Read Official_holidaies', 'Read Official_holidaies', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(43, 'update_official_holidaies', 'Update Official_holidaies', 'Update Official_holidaies', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(44, 'delete_official_holidaies', 'Delete Official_holidaies', 'Delete Official_holidaies', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(45, 'create_tasks', 'Create Tasks', 'Create Tasks', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(46, 'read_tasks', 'Read Tasks', 'Read Tasks', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(47, 'update_tasks', 'Update Tasks', 'Update Tasks', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(48, 'delete_tasks', 'Delete Tasks', 'Delete Tasks', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(49, 'create_pers', 'Create Pers', 'Create Pers', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(50, 'read_pers', 'Read Pers', 'Read Pers', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(51, 'update_pers', 'Update Pers', 'Update Pers', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(52, 'delete_pers', 'Delete Pers', 'Delete Pers', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(53, 'create_emps', 'Create Emps', 'Create Emps', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(54, 'read_emps', 'Read Emps', 'Read Emps', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(55, 'update_emps', 'Update Emps', 'Update Emps', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(56, 'delete_emps', 'Delete Emps', 'Delete Emps', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(57, 'create_attendances', 'Create Attendances', 'Create Attendances', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(58, 'read_attendances', 'Read Attendances', 'Read Attendances', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(59, 'update_attendances', 'Update Attendances', 'Update Attendances', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(60, 'delete_attendances', 'Delete Attendances', 'Delete Attendances', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(61, 'create_holidaytypes', 'Create Holidaytypes', 'Create Holidaytypes', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(62, 'read_holidaytypes', 'Read Holidaytypes', 'Read Holidaytypes', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(63, 'update_holidaytypes', 'Update Holidaytypes', 'Update Holidaytypes', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(64, 'delete_holidaytypes', 'Delete Holidaytypes', 'Delete Holidaytypes', '2021-02-13 04:58:44', '2021-02-13 04:58:44');

-- --------------------------------------------------------

--
-- بنية الجدول `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE IF NOT EXISTS `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `pers`
--

DROP TABLE IF EXISTS `pers`;
CREATE TABLE IF NOT EXISTS `pers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `per_cause` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` time DEFAULT NULL,
  `to` time DEFAULT NULL,
  `pdate` date NOT NULL,
  `pyear` bigint(20) NOT NULL,
  `month` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_pic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pers_emp_id_foreign` (`emp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `public_admins`
--

DROP TABLE IF EXISTS `public_admins`;
CREATE TABLE IF NOT EXISTS `public_admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `publicAdmin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `public_admins_sector_id_foreign` (`sector_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rating` bigint(20) DEFAULT NULL,
  `task_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ratings_admin_id_foreign` (`admin_id`),
  KEY `ratings_task_id_foreign` (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'Super Admin', 'Super Admin', '2021-02-13 04:58:44', '2021-02-13 04:58:44'),
(2, 'admin', 'Admin', 'Admin', '2021-02-13 04:58:44', '2021-02-13 04:58:44');

-- --------------------------------------------------------

--
-- بنية الجدول `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Model\\user');

-- --------------------------------------------------------

--
-- بنية الجدول `sectors`
--

DROP TABLE IF EXISTS `sectors`;
CREATE TABLE IF NOT EXISTS `sectors` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sector` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sitename_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sitename_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sitename_fr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_status` enum('open','close') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `system_message` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `settings`
--

INSERT INTO `settings` (`id`, `sitename_ar`, `sitename_en`, `sitename_fr`, `email`, `logo`, `icon`, `system_status`, `system_message`, `created_at`, `updated_at`) VALUES
(1, '', '', '', NULL, NULL, NULL, 'open', NULL, '2021-02-13 04:58:59', '2021-02-13 04:58:59');

-- --------------------------------------------------------

--
-- بنية الجدول `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_desc` longtext COLLATE utf8mb4_unicode_ci,
  `days` bigint(20) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_rate` bigint(20) DEFAULT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `tdate` date NOT NULL,
  `tyear` bigint(20) NOT NULL,
  `month` bigint(20) NOT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_admin_id_foreign` (`admin_id`),
  KEY `tasks_emp_id_foreign` (`emp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `test_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tests_department_id_foreign` (`department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `trainings`
--

DROP TABLE IF EXISTS `trainings`;
CREATE TABLE IF NOT EXISTS `trainings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `coursenum` bigint(20) DEFAULT NULL,
  `tradate` date DEFAULT NULL,
  `trayear` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` bigint(20) NOT NULL,
  `emp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trainings_emp_id_foreign` (`emp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middel_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_profile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `messenger_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `emp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `updating_reason` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_sign_in_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_emp_id_foreign` (`emp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `first_name`, `middel_name`, `last_name`, `email`, `email_verified_at`, `password`, `photo_profile`, `avatar`, `messenger_color`, `dark_mode`, `active_status`, `emp_id`, `updating_reason`, `last_sign_in_at`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'eman', 'mohammed', 'lowndi', 'eman@test.com', NULL, '$2y$10$jWcjXwZpUEjMhXVqQHMZreM6ktg8pVKD453xh3VXROfgYWNoWZJta', NULL, 'avatar.png', '#2180f3', 0, 0, NULL, NULL, NULL, NULL, NULL, '2021-02-13 04:58:44', '2021-02-13 04:58:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
