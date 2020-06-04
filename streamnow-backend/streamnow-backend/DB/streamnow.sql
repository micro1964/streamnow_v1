-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 08, 2020 at 05:12 PM
-- Server version: 5.7.28-0ubuntu0.16.04.2
-- PHP Version: 7.1.32-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `streamnow`
--

-- --------------------------------------------------------

--
-- Table structure for table `abuses`
--

CREATE TABLE `abuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `live_streaming_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('male','female','others') COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `unique_id`, `name`, `email`, `password`, `picture`, `gender`, `mobile`, `address`, `description`, `token`, `token_expiry`, `status`, `timezone`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `admin_type`) VALUES
(1, '', 'Admin', 'admin@streamnow.com', '$2y$10$dNOhtC/h0CxinjU6PNDFD.Qa86zYljUyusXQ9rpvdHSwotik6dGv6', 'https://live.appswamy.com/images/default-profile.jpg', 'male', '', '', '', '2y10IYH3qXtFBAhpNgSlCsS64lKy7gtw9CGFqYrrlpQWrcizkWbaxyy', '1581165725', 0, 'Asia/Kolkata', NULL, NULL, '2020-02-08 06:10:32', '2020-02-08 06:12:05', 0),
(2, '', 'Test', 'test@streamnow.com', '$2y$10$F58pgAko/hw7cnQ2PlFY/OBQzjILHCNE6TQSvIyxgbbUxVA4fjrx6', 'https://live.appswamy.com/images/default-profile.jpg', 'male', '', '', '', '', '', 0, NULL, NULL, NULL, '2020-02-08 06:10:32', '2020-02-08 06:10:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `block_lists`
--

CREATE TABLE `block_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `block_user_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_four` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_holder_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `live_video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `live_video_viewer_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('uv','vu') COLLATE utf8_unicode_ci NOT NULL COMMENT 'uv - User To Viewer , pu - Viewer to User',
  `delivered` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `no_of_users_limit` smallint(6) NOT NULL,
  `per_users_limit` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_live_videos`
--

CREATE TABLE `custom_live_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `rtmp_video_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hls_video_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Login User ID',
  `follower` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `folder_name` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `folder_name`, `language`, `status`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 1, '2020-02-08 06:10:35', '2020-02-08 06:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `live_groups`
--

CREATE TABLE `live_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_group_members`
--

CREATE TABLE `live_group_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `live_group_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `added_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_videos`
--

CREATE TABLE `live_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `live_group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `virtual_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Public, Private',
  `payment_status` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `browser_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Store Streamer Browser Name',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `is_streaming` int(11) NOT NULL DEFAULT '0',
  `snapshot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_url` text COLLATE utf8_unicode_ci NOT NULL,
  `viewer_cnt` int(11) NOT NULL DEFAULT '0',
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `no_of_minutes` int(11) DEFAULT '0',
  `port_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_video_payments`
--

CREATE TABLE `live_video_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `live_video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `live_video_viewer_id` int(11) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `admin_amount` double(8,2) NOT NULL,
  `user_amount` double(8,2) NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `is_coupon_applied` tinyint(4) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_amount` double NOT NULL,
  `live_video_amount` double NOT NULL,
  `coupon_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_08_25_172600_create_settings_table', 1),
('2016_08_07_122712_create_pages_table', 1),
('2016_08_29_073204_create_mobile_registers_table', 1),
('2016_08_29_082431_create_page_counters_table', 1),
('2017_04_18_124126_create_admins_table', 1),
('2017_04_18_124141_create_followers_table', 1),
('2017_04_18_124318_create_chat_messages_table', 1),
('2017_04_18_124350_create_subscriptions_table', 1),
('2017_04_18_124358_create_user_subscriptions_table', 1),
('2017_04_18_124413_create_block_lists_table', 1),
('2017_04_18_124518_create_abuses_table', 1),
('2017_04_18_132556_create_live_videos_table', 1),
('2017_04_18_132653_create_live_video_payments_table', 1),
('2017_04_24_075337_added_timezone_in_admin_table', 1),
('2017_04_26_072137_added_device_token_field_in_users_table', 1),
('2017_04_26_120638_added_popular_video_status_in_subscription_plans_table', 1),
('2017_04_26_140405_added_video_title_in_live_videos_table', 1),
('2017_04_28_134507_add_cover_field_to_users_table', 1),
('2017_04_30_064702_create_viewers_table', 1),
('2017_04_30_073834_add_viewers_cnt_in_videos_table', 1),
('2017_05_02_133307_added_snapshot_field_in_live_videos_table', 1),
('2017_05_03_131033_add_subscription_fields_in_users_table', 1),
('2017_05_04_103643_add_paypal_email_to_users_table', 1),
('2017_05_04_104803_add_video_payment_amount_to_users_table', 1),
('2017_05_04_111315_add_commission_amount_fields_to_live_video_payments', 1),
('2017_05_09_125658_added_start_end_time_in_live_videos', 1),
('2017_05_09_131233_add_email_verification_fields_to_users_table', 1),
('2017_05_09_161238_create_jobs_table', 1),
('2017_05_09_161244_create_failed_jobs_table', 1),
('2017_05_09_165015_added_chat_picture_in_users_table', 1),
('2017_05_10_135002_added_one_time_payment_key_in_users_table', 1),
('2017_05_24_151437_create_redeems_table', 1),
('2017_05_24_161212_create_redeem_requests_table', 1),
('2017_06_09_115828_create_user_notification_table', 1),
('2017_08_10_065300_added_field_in_user_table', 1),
('2017_08_11_064032_added_port_no_in_live_videos', 1),
('2017_08_28_142408_added_video_url_in_live_videos', 1),
('2017_09_18_064132_create_notification_templates_table', 1),
('2017_10_09_073405_create_card_table', 1),
('2017_11_23_142547_update_description_datatype_in_users', 1),
('2018_01_07_135716_added_enu_values_pages', 1),
('2018_01_24_105545_added_login_status_field_users', 1),
('2018_02_19_071800_added_browser_type_in_live_videos', 1),
('2018_03_17_104409_create_coupons_table', 1),
('2018_05_02_104338_added_payment_mode_in_user_subscriptions', 1),
('2018_05_05_064436_added_enum_values_in_pages', 1),
('2018_05_16_083821_create_live_groups_table', 1),
('2018_05_16_083837_create_live_group_members_table', 1),
('2018_05_16_084203_add_group_fields_to_live_videos_table', 1),
('2018_06_04_093749_create_pay_per_views_table', 1),
('2018_07_03_073919_added_cancel_subscription_status', 1),
('2018_07_03_105545_added_content_creator_field_users', 1),
('2018_07_04_065658_create_vod_videos_table', 1),
('2018_07_04_072714_add_reason_in_user_subscriptions_table', 1),
('2018_07_05_052853_add_publish_time_in_vod_videos_table', 1),
('2018_07_06_064216_create_streamer_galleries_table', 1),
('2018_07_07_103833_add_coupon_fields_in_coupons_table', 1),
('2018_07_07_103907_add_coupon_fields_in_payments_table', 1),
('2018_07_07_103929_add_coupon_fields_in_live_video_payments_table', 1),
('2018_07_07_103947_add_coupon_fields_in_ppv_payments_table', 1),
('2018_07_07_114047_create_user_coupons_table', 1),
('2018_08_01_133331_add_payment_mode_to_redeem_requests_table', 1),
('2018_08_21_160650_add_gallery_fields_in_users', 1),
('2018_08_28_094553_create_custom_live_videos_table', 1),
('2018_09_07_124341_alter_table_fields_in_user_subscriptions', 1),
('2018_09_07_124422_alter_table_fields_in_live_video_payments', 1),
('2018_09_07_124448_alter_table_fields_in_pay_per_views', 1),
('2018_09_25_115241_add_fields_in_admins_table', 1),
('2019_01_21_062616_add_notified_user_id_to_user_notifications_table', 1),
('2019_01_21_183355_add_fields_to_cards_table', 1),
('2019_04_03_083821_create_languages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_registers`
--

CREATE TABLE `mobile_registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mobile_registers`
--

INSERT INTO `mobile_registers` (`id`, `type`, `count`, `created_at`, `updated_at`) VALUES
(1, 'android', 0, NULL, NULL),
(2, 'ios', 0, NULL, NULL),
(3, 'web', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `type`, `subject`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'LIVE_STREAM_STARTED', 'Live Stream Started', 'Started a new live video. Watch it before it ends!', 1, NULL, NULL),
(2, 'USER_FOLLOW', 'User following request', 'New user started following you', 1, NULL, NULL),
(3, 'USER_JOIN_VIDEO', 'User joined a video', 'New user has entered your room..!', 1, NULL, NULL),
(4, 'USER_GROUP_ADD', 'You are added in a new group', 'You are added in a new group', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('about','privacy','terms','help','others','contact','faq') COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_counters`
--

CREATE TABLE `page_counters` (
  `id` int(10) UNSIGNED NOT NULL,
  `page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_per_views`
--

CREATE TABLE `pay_per_views` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key, It is an unique key',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'User table Primary key given as Foreign Key',
  `video_id` int(10) UNSIGNED NOT NULL COMMENT 'VOD Video table Primary key given as Foreign Key',
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_of_subscription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_of_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `admin_amount` double(8,2) NOT NULL,
  `user_amount` double(8,2) NOT NULL,
  `payment_mode` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `expiry_date` datetime NOT NULL,
  `ppv_date` datetime NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `is_watched` tinyint(4) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Status of the per_per_view table',
  `is_coupon_applied` tinyint(4) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_amount` double NOT NULL,
  `ppv_amount` double NOT NULL,
  `coupon_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redeems`
--

CREATE TABLE `redeems` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `total` double(8,2) NOT NULL,
  `paid` double(8,2) NOT NULL,
  `remaining` double(8,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redeem_requests`
--

CREATE TABLE `redeem_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_amount` double(8,2) NOT NULL,
  `paid_amount` double(8,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'StreamNow', NULL, NULL),
(2, 'site_logo', 'https://live.appswamy.com/site_logo.png', NULL, NULL),
(3, 'site_icon', 'https://live.appswamy.com/site_icon.png', NULL, NULL),
(4, 'browser_key', '', NULL, NULL),
(5, 'default_lang', 'en', NULL, NULL),
(6, 'currency', '$', NULL, NULL),
(7, 'admin_take_count', '12', NULL, NULL),
(8, 'google_analytics', '', NULL, NULL),
(9, 'ios_certificate', '', NULL, NULL),
(10, 'admin_delete_control', '0', NULL, NULL),
(11, 'is_subscription', '1', NULL, NULL),
(12, 'push_notification', '1', NULL, NULL),
(13, 'admin_demo_email', 'admin@streamnow.com', NULL, NULL),
(14, 'admin_demo_password', '123456', NULL, NULL),
(15, 'email_verify_control', '1', NULL, NULL),
(16, 'ANGULAR_URL', '', NULL, NULL),
(17, 'email_notification', '1', NULL, NULL),
(18, 'SOCKET_URL', '', NULL, NULL),
(19, 'BASE_URL', '/', NULL, NULL),
(20, 'admin_commission', '10', NULL, NULL),
(21, 'user_commission', '90', NULL, NULL),
(22, 'header_scripts', '', NULL, NULL),
(23, 'body_scripts', '', NULL, NULL),
(24, 'home_bg_image', 'https://live.appswamy.com/live-now.webm', NULL, NULL),
(25, 'common_bg_image', 'https://live.appswamy.com/background_picture.jpg', NULL, NULL),
(26, 'kurento_socket_url', 'livetest.streamhash.info:8443', NULL, NULL),
(27, 'wowza_server_url', 'https://104.236.1.170:8087', NULL, NULL),
(28, 'cross_platform_url', '104.236.1.170:1935', NULL, NULL),
(29, 'mobile_rtmp', '', NULL, NULL),
(30, 'chat_socket_url', '', NULL, NULL),
(31, 'delete_video_hour', '2', NULL, NULL),
(32, 'wowza_ip_address', '', NULL, NULL),
(33, 'facebook_link', '', NULL, NULL),
(34, 'linkedin_link', '', NULL, NULL),
(35, 'twitter_link', '', NULL, NULL),
(36, 'google_plus_link', '', NULL, NULL),
(37, 'pinterest_link', '', NULL, NULL),
(38, 'minimum_redeem', '1', NULL, NULL),
(39, 'token_expiry_hour', '1', NULL, NULL),
(40, 'jwplayer_key', '', NULL, NULL),
(41, 'MAILGUN_PUBLIC_KEY', 'pubkey-7dc021cf4689a81a4afb340d1a055021', NULL, NULL),
(42, 'MAILGUN_PRIVATE_KEY', '', NULL, NULL),
(43, 'appstore', '', NULL, NULL),
(44, 'playstore', '', NULL, NULL),
(45, 'ios_payment_subscription_status', '0', NULL, NULL),
(46, 'stripe_publishable_key', 'pk_test_uDYrTXzzAuGRwDYtu7dkhaF3', NULL, NULL),
(47, 'stripe_secret_key', 'sk_test_lRUbYflDyRP3L2UbnsehTUHW', NULL, NULL),
(48, 'no_of_static_pages', '8', NULL, NULL),
(49, 'RTMP_STREAMING_URL', '', NULL, NULL),
(50, 'HLS_STREAMING_URL', '', NULL, NULL),
(51, 'RTMP_SECURE_VIDEO_URL', '', NULL, NULL),
(52, 'HLS_SECURE_VIDEO_URL', '', NULL, NULL),
(53, 'VIDEO_SMIL_URL', '', NULL, NULL),
(54, 'meta_title', 'STREAMNOW', '2020-02-08 06:10:34', '2020-02-08 06:10:34'),
(55, 'meta_description', 'STREAMNOW', '2020-02-08 06:10:34', '2020-02-08 06:10:34'),
(56, 'meta_author', 'STREAMNOW', '2020-02-08 06:10:34', '2020-02-08 06:10:34'),
(57, 'meta_keywords', 'STREAMNOW', '2020-02-08 06:10:34', '2020-02-08 06:10:34'),
(58, 'delete_video', '0', NULL, NULL),
(59, 'admin_vod_commission', '10', NULL, NULL),
(60, 'user_vod_commission', '90', NULL, NULL),
(61, 'wowza_port_number', '1935', NULL, NULL),
(62, 'wowza_app_name', 'live', NULL, NULL),
(63, 'wowza_username', 'streamnow', NULL, NULL),
(64, 'wowza_password', 'streamnow', NULL, NULL),
(65, 'wowza_license_key', 'GOSK-8F45-010C-C962-ABB0-264A', NULL, NULL),
(66, 'is_wowza_configured', '0', NULL, NULL),
(67, 'live_url', 'https://streamnow.botfingers.com/', NULL, NULL),
(68, 'demo_users', 'user@streamnow.com,viewer@streamnow.com,streamer@streamnow.com', NULL, NULL),
(69, 'is_multilanguage_enabled', '1', NULL, NULL),
(70, 'wowza_is_ssl', '1', NULL, NULL),
(71, 'user_fcm_sender_id', '865212328189', '2020-02-08 06:10:35', '2020-02-08 06:10:35'),
(72, 'user_fcm_server_key', 'AAAASJFloB0:APA91bHBe54g5RP63U3EMTRClOVIXV3R8dwQ0xdwGTimGIWuKklipnpn3a7ASHDmEIuZ_OHTUDpWPYIzsXLTXXPE_UEJOz0BR1GgZ7s_gF41DKZjmJVsO3qfUOpZT2SqVMInOcL1Z55e', '2020-02-08 06:10:35', '2020-02-08 06:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `streamer_galleries`
--

CREATE TABLE `streamer_galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `subscription_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'month,year,days',
  `plan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `total_subscription` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `popular_status` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` int(11) NOT NULL COMMENT '0 - UnPaid User, 1 - Paid User',
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chat_picture` text COLLATE utf8_unicode_ci,
  `cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `social_unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('male','female','others') COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `gallery_description` text COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double(15,8) NOT NULL,
  `longitude` double(15,8) NOT NULL,
  `device_type` enum('web','android','ios') COLLATE utf8_unicode_ci NOT NULL,
  `register_type` enum('web','android','ios') COLLATE utf8_unicode_ci NOT NULL,
  `login_by` enum('manual','facebook','google','twitter','linkedin','others') COLLATE utf8_unicode_ci NOT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `card_id` int(11) NOT NULL,
  `is_verified` int(11) NOT NULL COMMENT '1 - verified , 0 - No',
  `status` int(11) NOT NULL COMMENT '1 - Approve , 0 - decline',
  `login_status` int(11) NOT NULL,
  `is_content_creator` tinyint(4) NOT NULL,
  `push_status` int(11) NOT NULL,
  `one_time_subscription` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Not Subscribed , 1 - Subscribed',
  `verification_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verification_code_expiry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` double(8,2) NOT NULL,
  `total_admin_amount` double(8,2) NOT NULL,
  `total_user_amount` double(8,2) NOT NULL,
  `paid_amount` double(8,2) NOT NULL,
  `remaining_amount` double(8,2) NOT NULL,
  `role` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_token` text COLLATE utf8_unicode_ci,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amount_paid` double(8,2) NOT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `no_of_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `name`, `email`, `password`, `token`, `token_expiry`, `user_type`, `paypal_email`, `picture`, `chat_picture`, `cover`, `social_unique_id`, `gender`, `description`, `gallery_description`, `mobile`, `dob`, `age`, `address`, `latitude`, `longitude`, `device_type`, `register_type`, `login_by`, `payment_mode`, `card_id`, `is_verified`, `status`, `login_status`, `is_content_creator`, `push_status`, `one_time_subscription`, `verification_code`, `verification_code_expiry`, `total`, `total_admin_amount`, `total_user_amount`, `paid_amount`, `remaining_amount`, `role`, `device_token`, `timezone`, `deleted_at`, `remember_token`, `created_at`, `updated_at`, `amount_paid`, `expiry_date`, `no_of_days`) VALUES
(1, '', 'User', 'user@streamnow.com', '$2y$10$WEM3NKdCmKltZw1NsqRoJelBOHK1sy9zd6s.3Tksxg4A6bn0RIl/S', '2y10M9wQu1tb7uzSSEKsP6VLeI1S9v2oxWXzLbOg0v1opm2I1ERxI', '1581162033', 1, '', 'https://live.appswamy.com/images/default-profile.jpg', 'https://live.appswamy.com/images/default-profile.jpg', '', '', 'male', '', '', '', '', 0, '', 0.00000000, 0.00000000, 'web', 'web', 'manual', '', 0, 1, 1, 0, 1, 1, 0, '', '', 0.00, 0.00, 0.00, 0.00, 0.00, 'model', NULL, '', NULL, NULL, '2020-02-08 06:10:33', '2020-02-08 06:10:33', 0.00, NULL, 0),
(2, '', 'TEST', 'test@streamnow.com', '$2y$10$VUaRQ/Gy98hlsulMfoyV/uE.HQMdlNFYaQx9HZchJtiZkoYPnFn8e', '2y10drvXo84Suh3YvSu59eCeQSQ6CQVQ5SzyWNeB9ao7ntqQpQ0q', '1581162033', 1, '', 'https://live.appswamy.com/images/default-profile.jpg', 'https://live.appswamy.com/images/default-profile.jpg', '', '', 'male', '', '', '', '', 0, '', 0.00000000, 0.00000000, 'web', 'web', 'manual', '', 0, 1, 1, 0, 0, 1, 0, '', '', 0.00, 0.00, 0.00, 0.00, 0.00, 'model', NULL, '', NULL, NULL, '2020-02-08 06:10:33', '2020-02-08 06:10:33', 0.00, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_coupons`
--

CREATE TABLE `user_coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_times_used` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_id` int(11) NOT NULL,
  `notifier_user_id` int(11) NOT NULL COMMENT 'EX: User A Followed USER B. This column will store USER A ID ( USER B ID = user_id)',
  `notification` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `payment_mode` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `expiry_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `is_coupon_applied` tinyint(4) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_amount` double NOT NULL,
  `subscription_amount` double NOT NULL,
  `coupon_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `is_cancelled` tinyint(4) NOT NULL,
  `cancel_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `viewers`
--

CREATE TABLE `viewers` (
  `id` int(10) UNSIGNED NOT NULL,
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vod_videos`
--

CREATE TABLE `vod_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_pay_per_view` tinyint(4) NOT NULL,
  `type_of_user` tinyint(4) NOT NULL DEFAULT '0',
  `type_of_subscription` tinyint(4) NOT NULL DEFAULT '0',
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `admin_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `user_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `publish_time` datetime NOT NULL,
  `publish_status` tinyint(4) NOT NULL,
  `viewer_count` tinyint(4) NOT NULL DEFAULT '0',
  `admin_status` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abuses`
--
ALTER TABLE `abuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `block_lists`
--
ALTER TABLE `block_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`);

--
-- Indexes for table `custom_live_videos`
--
ALTER TABLE `custom_live_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_groups`
--
ALTER TABLE `live_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_group_members`
--
ALTER TABLE `live_group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_videos`
--
ALTER TABLE `live_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_video_payments`
--
ALTER TABLE `live_video_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_registers`
--
ALTER TABLE `mobile_registers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_counters`
--
ALTER TABLE `page_counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pay_per_views`
--
ALTER TABLE `pay_per_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeems`
--
ALTER TABLE `redeems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeem_requests`
--
ALTER TABLE `redeem_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_key_index` (`key`);

--
-- Indexes for table `streamer_galleries`
--
ALTER TABLE `streamer_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `viewers`
--
ALTER TABLE `viewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vod_videos`
--
ALTER TABLE `vod_videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abuses`
--
ALTER TABLE `abuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `block_lists`
--
ALTER TABLE `block_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_live_videos`
--
ALTER TABLE `custom_live_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `live_groups`
--
ALTER TABLE `live_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `live_group_members`
--
ALTER TABLE `live_group_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `live_videos`
--
ALTER TABLE `live_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `live_video_payments`
--
ALTER TABLE `live_video_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mobile_registers`
--
ALTER TABLE `mobile_registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `page_counters`
--
ALTER TABLE `page_counters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pay_per_views`
--
ALTER TABLE `pay_per_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key, It is an unique key';
--
-- AUTO_INCREMENT for table `redeems`
--
ALTER TABLE `redeems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `redeem_requests`
--
ALTER TABLE `redeem_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `streamer_galleries`
--
ALTER TABLE `streamer_galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `viewers`
--
ALTER TABLE `viewers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vod_videos`
--
ALTER TABLE `vod_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
