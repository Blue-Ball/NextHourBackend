-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 30, 2021 at 03:30 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexthour`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8mb4_unicode_ci,
  `place_of_birth` text COLLATE utf8mb4_unicode_ci,
  `DOB` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int NOT NULL,
  `ad_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ad_image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ad_video` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ad_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ad_target` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_hold` int DEFAULT NULL,
  `time` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endtime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adsenses`
--

CREATE TABLE `adsenses` (
  `id` int NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ishome` tinyint(1) NOT NULL,
  `isviewall` tinyint(1) NOT NULL,
  `issearch` tinyint(1) NOT NULL,
  `iswishlist` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adsenses`
--

INSERT INTO `adsenses` (`id`, `code`, `status`, `ishome`, `isviewall`, `issearch`, `iswishlist`, `created_at`, `updated_at`) VALUES
(1, '<script type=\"text/javascript\">\r\ngoogle_ad_client = \"\";  \r\ngoogle_ad_slot = \"99*****99\"; \r\ngoogle_ad_width = 728;\r\ngoogle_ad_height =  90; \r\n\r\n</script>', 0, 0, 0, 0, 0, '2019-09-09 12:43:44', '2020-02-11 11:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `app_configs`
--

CREATE TABLE `app_configs` (
  `id` bigint UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_payment` tinyint(1) NOT NULL DEFAULT '0',
  `paypal_payment` tinyint(1) NOT NULL DEFAULT '0',
  `razorpay_payment` tinyint(1) NOT NULL DEFAULT '0',
  `brainetree_payment` tinyint(1) NOT NULL DEFAULT '0',
  `paystack_payment` tinyint(1) NOT NULL DEFAULT '0',
  `bankdetails` tinyint(1) NOT NULL DEFAULT '0',
  `fb_check` tinyint(1) NOT NULL DEFAULT '0',
  `google_login` tinyint(1) NOT NULL DEFAULT '0',
  `git_lab_check` tinyint(1) NOT NULL DEFAULT '0',
  `ADMOB_APP_KEY` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_admob` tinyint(1) NOT NULL DEFAULT '0',
  `banner_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interstitial_admob` tinyint(1) NOT NULL DEFAULT '0',
  `interstitial_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rewarded_admob` tinyint(1) NOT NULL DEFAULT '0',
  `rewarded_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `native_admob` tinyint(1) NOT NULL DEFAULT '0',
  `native_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inapp_payment` tinyint(1) NOT NULL DEFAULT '0',
  `push_key` tinyint(1) NOT NULL DEFAULT '0',
  `remove_ads` tinyint(1) NOT NULL DEFAULT '0',
  `paytm_payment` tinyint(1) NOT NULL DEFAULT '0',
  `amazon_login` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_configs`
--

INSERT INTO `app_configs` (`id`, `logo`, `title`, `stripe_payment`, `paypal_payment`, `razorpay_payment`, `brainetree_payment`, `paystack_payment`, `bankdetails`, `fb_check`, `google_login`, `git_lab_check`, `ADMOB_APP_KEY`, `banner_admob`, `banner_id`, `interstitial_admob`, `interstitial_id`, `rewarded_admob`, `rewarded_id`, `native_admob`, `native_id`, `created_at`, `updated_at`, `inapp_payment`, `push_key`, `remove_ads`, `paytm_payment`, `amazon_login`) VALUES
(1, 'applogo_1606642921logo.png', 'Nexthour', 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, NULL, '2020-11-29 15:12:01', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `app_sliders`
--

CREATE TABLE `app_sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `movie_id` int UNSIGNED DEFAULT NULL,
  `tv_series_id` int UNSIGNED DEFAULT NULL,
  `slide_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `position` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_sliders`
--

INSERT INTO `app_sliders` (`id`, `movie_id`, `tv_series_id`, `slide_image`, `active`, `position`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'app_slide_1606642528movie.jpg', 1, 1, '2020-11-29 14:47:00', '2020-11-29 15:05:28'),
(2, NULL, NULL, 'app_slide_1606642578tvshow.jpg', 1, 2, '2020-11-29 15:06:18', '2020-11-29 15:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE `audio` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poster` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double(8,2) DEFAULT NULL,
  `maturity_rating` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_audio` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `is_protect` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audiourl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audio_languages`
--

CREATE TABLE `audio_languages` (
  `id` int UNSIGNED NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audio_languages`
--

INSERT INTO `audio_languages` (`id`, `language`, `created_at`, `updated_at`, `image`, `status`) VALUES
(1, '{\"en\":\"Arabic\"}', '2021-08-26 20:52:59', '2021-08-26 20:52:59', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `auth_customizes`
--

CREATE TABLE `auth_customizes` (
  `id` int UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auth_customizes`
--

INSERT INTO `auth_customizes` (`id`, `image`, `detail`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"auth_page1604309119login.jpg\"}', '{\"en\":\"<p>Welcome to<br>\\nAl Enwan<\\/p>\\n\\n<p>Are you ready to join us?<\\/p>\"}', NULL, '2021-08-26 21:14:28');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_menu`
--

CREATE TABLE `blog_menu` (
  `id` int UNSIGNED NOT NULL,
  `menu_id` int NOT NULL,
  `blog_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buttons`
--

CREATE TABLE `buttons` (
  `id` int UNSIGNED NOT NULL,
  `rightclick` tinyint(1) NOT NULL DEFAULT '1',
  `inspect` tinyint(1) DEFAULT NULL,
  `goto` tinyint(1) NOT NULL DEFAULT '1',
  `color` tinyint(1) NOT NULL DEFAULT '1',
  `uc_browser` tinyint(1) NOT NULL DEFAULT '1',
  `comming_soon` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commingsoon_enabled_ip` longtext COLLATE utf8mb4_unicode_ci,
  `ip_block` tinyint(1) NOT NULL DEFAULT '1',
  `block_ips` longtext COLLATE utf8mb4_unicode_ci,
  `maintenance` tinyint(1) NOT NULL DEFAULT '1',
  `comming_soon_text` longtext COLLATE utf8mb4_unicode_ci,
  `remove_subscription` tinyint(1) NOT NULL DEFAULT '0',
  `protip` tinyint(1) NOT NULL DEFAULT '1',
  `multiplescreen` tinyint(1) NOT NULL DEFAULT '0',
  `two_factor` tinyint(1) NOT NULL DEFAULT '0',
  `countviews` tinyint(1) NOT NULL DEFAULT '0',
  `remove_ads` tinyint(1) NOT NULL DEFAULT '0',
  `is_toprated` tinyint(1) NOT NULL DEFAULT '0',
  `toprated_count` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buttons`
--

INSERT INTO `buttons` (`id`, `rightclick`, `inspect`, `goto`, `color`, `uc_browser`, `comming_soon`, `created_at`, `updated_at`, `commingsoon_enabled_ip`, `ip_block`, `block_ips`, `maintenance`, `comming_soon_text`, `remove_subscription`, `protip`, `multiplescreen`, `two_factor`, `countviews`, `remove_ads`, `is_toprated`, `toprated_count`) VALUES
(1, 1, 1, 1, 0, 1, 0, '2018-07-31 11:30:00', '2020-11-02 12:05:14', NULL, 0, NULL, 1, NULL, 0, 1, 0, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_settings`
--

CREATE TABLE `chat_settings` (
  `id` int UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable_messanger` tinyint(1) NOT NULL DEFAULT '0',
  `script` longtext COLLATE utf8mb4_unicode_ci,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int DEFAULT NULL,
  `enable_whatsapp` tinyint(1) NOT NULL DEFAULT '0',
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'right',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_settings`
--

INSERT INTO `chat_settings` (`id`, `key`, `enable_messanger`, `script`, `mobile`, `text`, `header`, `color`, `size`, `enable_whatsapp`, `position`, `created_at`, `updated_at`) VALUES
(1, 'messanger', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '0', NULL, NULL),
(2, 'whatsapp', 0, NULL, '9999999999', 'Hey! We can help you?', 'Chat with us', '#111', 30, 0, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `color_schemes`
--

CREATE TABLE `color_schemes` (
  `id` bigint UNSIGNED NOT NULL,
  `color_scheme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_navigation_color` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_navigation_color` text COLLATE utf8mb4_unicode_ci,
  `default_text_color` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_text_color` text COLLATE utf8mb4_unicode_ci,
  `default_text_on_color` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_text_on_color` text COLLATE utf8mb4_unicode_ci,
  `default_back_to_top_color` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_back_to_top_color` text COLLATE utf8mb4_unicode_ci,
  `default_back_to_top_bgcolor` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_back_to_top_bgcolor` text COLLATE utf8mb4_unicode_ci,
  `default_back_to_top_bgcolor_on_hover` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_back_to_top_bgcolor_on_hover` text COLLATE utf8mb4_unicode_ci,
  `default_back_to_top_color_on_hover` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_back_to_top_color_on_hover` text COLLATE utf8mb4_unicode_ci,
  `default_footer_background_color` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_footer_background_color` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color_schemes`
--

INSERT INTO `color_schemes` (`id`, `color_scheme`, `default_navigation_color`, `custom_navigation_color`, `default_text_color`, `custom_text_color`, `default_text_on_color`, `custom_text_on_color`, `default_back_to_top_color`, `custom_back_to_top_color`, `default_back_to_top_bgcolor`, `custom_back_to_top_bgcolor`, `default_back_to_top_bgcolor_on_hover`, `custom_back_to_top_bgcolor_on_hover`, `default_back_to_top_color_on_hover`, `custom_back_to_top_color_on_hover`, `default_footer_background_color`, `custom_footer_background_color`, `created_at`, `updated_at`) VALUES
(1, 'dark', '#111111FA', NULL, '#48A3C6', '#ba0621', '#90DFFE', '#eb7586', '#111', NULL, '#FFF', NULL, '#48A3C6', '#ba0621', '#FFF', NULL, '#111', NULL, NULL, '2021-08-26 22:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_id` int NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` int UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `livetvicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `w_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_email` int NOT NULL,
  `download` int DEFAULT '0',
  `free_sub` int NOT NULL DEFAULT '0',
  `free_days` int DEFAULT NULL,
  `stripe_pub_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_secret_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_mar_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_add` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prime_main_slider` tinyint(1) NOT NULL DEFAULT '1',
  `catlog` tinyint(1) NOT NULL,
  `withlogin` tinyint(1) NOT NULL,
  `prime_genre_slider` tinyint(1) NOT NULL DEFAULT '1',
  `donation` tinyint(1) DEFAULT NULL,
  `donation_link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prime_footer` tinyint(1) NOT NULL DEFAULT '1',
  `prime_movie_single` tinyint(1) NOT NULL DEFAULT '1',
  `terms_condition` text COLLATE utf8mb4_unicode_ci,
  `privacy_pol` text COLLATE utf8mb4_unicode_ci,
  `refund_pol` text COLLATE utf8mb4_unicode_ci,
  `copyright` text COLLATE utf8mb4_unicode_ci,
  `stripe_payment` tinyint(1) NOT NULL DEFAULT '1',
  `paypal_payment` tinyint(1) NOT NULL DEFAULT '1',
  `razorpay_payment` tinyint(1) NOT NULL DEFAULT '1',
  `age_restriction` tinyint(1) DEFAULT '0',
  `payu_payment` tinyint(1) NOT NULL DEFAULT '1',
  `bankdetails` tinyint(1) NOT NULL,
  `account_no` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(111) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paytm_payment` int UNSIGNED DEFAULT '0',
  `paytm_test` tinyint(1) DEFAULT NULL,
  `preloader` tinyint(1) NOT NULL DEFAULT '1',
  `fb_login` tinyint(1) NOT NULL,
  `gitlab_login` tinyint(1) NOT NULL,
  `google_login` tinyint(1) NOT NULL,
  `wel_eml` tinyint(1) DEFAULT NULL,
  `blog` tinyint(1) NOT NULL DEFAULT '0',
  `is_playstore` tinyint(1) NOT NULL DEFAULT '0',
  `is_appstore` tinyint(1) NOT NULL DEFAULT '0',
  `playstore` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appstore` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_rating` tinyint(1) NOT NULL DEFAULT '0',
  `comments` tinyint(1) NOT NULL DEFAULT '0',
  `braintree` tinyint(1) NOT NULL DEFAULT '0',
  `paystack` tinyint(1) NOT NULL DEFAULT '0',
  `remove_landing_page` tinyint(1) NOT NULL DEFAULT '0',
  `coinpay` tinyint(1) NOT NULL DEFAULT '0',
  `captcha` tinyint(1) NOT NULL DEFAULT '0',
  `amazon_login` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mollie_payment` tinyint(1) NOT NULL DEFAULT '0',
  `cashfree_payment` tinyint(1) NOT NULL DEFAULT '0',
  `aws` tinyint(1) NOT NULL DEFAULT '0',
  `omise_payment` tinyint(1) NOT NULL DEFAULT '0',
  `flutterrave_payment` tinyint(1) NOT NULL DEFAULT '0',
  `instamojo_payment` tinyint(1) NOT NULL DEFAULT '0',
  `comments_approval` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `logo`, `favicon`, `livetvicon`, `title`, `w_email`, `verify_email`, `download`, `free_sub`, `free_days`, `stripe_pub_key`, `stripe_secret_key`, `paypal_mar_email`, `currency_code`, `currency_symbol`, `invoice_add`, `prime_main_slider`, `catlog`, `withlogin`, `prime_genre_slider`, `donation`, `donation_link`, `prime_footer`, `prime_movie_single`, `terms_condition`, `privacy_pol`, `refund_pol`, `copyright`, `stripe_payment`, `paypal_payment`, `razorpay_payment`, `age_restriction`, `payu_payment`, `bankdetails`, `account_no`, `branch`, `account_name`, `ifsc_code`, `bank_name`, `paytm_payment`, `paytm_test`, `preloader`, `fb_login`, `gitlab_login`, `google_login`, `wel_eml`, `blog`, `is_playstore`, `is_appstore`, `playstore`, `appstore`, `user_rating`, `comments`, `braintree`, `paystack`, `remove_landing_page`, `coinpay`, `captcha`, `amazon_login`, `created_at`, `updated_at`, `mollie_payment`, `cashfree_payment`, `aws`, `omise_payment`, `flutterrave_payment`, `instamojo_payment`, `comments_approval`) VALUES
(1, 'logo_1629874698A1.png', 'favicon.png', 'livetvicon_1584525047liveicon4.png', '{\"en\":\"Alenwan\",\"Spanish\":\"Nexthour\",\"spanish\":\"Nexthour\",\"FR\":\"Nexthour\",\"EN\":\"Nexthour\"}', 'contact@alenwanplatform.com', 0, 0, 0, 40, '', '', '', 'AED', 'fa fa-money', '{\"en\":\"United Arab Emirates\"}', 0, 1, 1, 1, 0, NULL, 1, 1, '{\"en\":\"<p>new goodes<\\/p>\",\"nl\":\"<p>newvious&nbsp;goodesioanos<\\/p>\"}', NULL, '{\"en\":\"<p>Refund<\\/p>\"}', '{\"en\":\"<p>Al Enwan | All Rights Reserved.<\\/p>\"}', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'https://www.youtube.com/upload', 'https://www.youtube.com/upload', 0, 0, 0, 0, 0, 0, 0, 0, NULL, '2021-08-26 21:16:31', 0, 0, 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_applies`
--

CREATE TABLE `coupon_applies` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `coupon_id` int NOT NULL,
  `redeem` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_codes`
--

CREATE TABLE `coupon_codes` (
  `id` int UNSIGNED NOT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percent_off` double(8,2) DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_off` double(8,2) DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'once',
  `max_redemptions` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redeem_by` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `in_stripe` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_codes`
--

INSERT INTO `coupon_codes` (`id`, `coupon_code`, `percent_off`, `currency`, `amount_off`, `duration`, `max_redemptions`, `redeem_by`, `created_at`, `updated_at`, `in_stripe`) VALUES
(2, '1234', NULL, 'AED', 10.00, 'repeating', '999', '2021-08-31 00:00:00', '2021-08-26 22:23:09', '2021-08-26 22:23:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cps_cpp`
--

CREATE TABLE `cps_cpp` (
  `userid` int NOT NULL,
  `expire` int NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cp_callback_addresses`
--

CREATE TABLE `cp_callback_addresses` (
  `id` int UNSIGNED NOT NULL,
  `address` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pubkey` text COLLATE utf8mb4_unicode_ci,
  `ipn_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cp_conversions`
--

CREATE TABLE `cp_conversions` (
  `id` int UNSIGNED NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_id` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cp_deposits`
--

CREATE TABLE `cp_deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `address` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txn_id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `status_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirms` tinyint UNSIGNED NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amounti` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feei` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cp_ipns`
--

CREATE TABLE `cp_ipns` (
  `id` bigint UNSIGNED NOT NULL,
  `ipn_version` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ipn_id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipn_mode` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ipn_type` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txn_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint DEFAULT NULL,
  `status_text` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency1` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency2` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirms` tinyint UNSIGNED DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amounti` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount1` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount2` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feei` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom` text COLLATE utf8mb4_unicode_ci,
  `send_tx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_confirms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cp_log`
--

CREATE TABLE `cp_log` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cp_mass_withdrawals`
--

CREATE TABLE `cp_mass_withdrawals` (
  `id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cp_transactions`
--

CREATE TABLE `cp_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `amount1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency1` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency2` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buyer_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom` text COLLATE utf8mb4_unicode_ci,
  `ipn_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txn_id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirms_needed` tinyint UNSIGNED NOT NULL,
  `timeout` int UNSIGNED NOT NULL,
  `status_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qrcode_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` smallint DEFAULT NULL,
  `status_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_confirms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cp_transfers`
--

CREATE TABLE `cp_transfers` (
  `id` bigint UNSIGNED NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pbntag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auto_confirm` tinyint(1) NOT NULL DEFAULT '0',
  `ref_id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cp_withdrawals`
--

CREATE TABLE `cp_withdrawals` (
  `id` bigint UNSIGNED NOT NULL,
  `mass_withdrawal_id` int UNSIGNED DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amounti` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency2` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pbntag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipn_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auto_confirm` tinyint(1) NOT NULL DEFAULT '0',
  `note` text COLLATE utf8mb4_unicode_ci,
  `ref_id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint NOT NULL,
  `status_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `txn_id` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_pages`
--

CREATE TABLE `custom_pages` (
  `id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_show_menu` tinyint(1) DEFAULT NULL,
  `detail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8mb4_unicode_ci,
  `place_of_birth` text COLLATE utf8mb4_unicode_ci,
  `DOB` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`id`, `name`, `image`, `biography`, `place_of_birth`, `DOB`, `created_at`, `updated_at`) VALUES
(1, 'nasser', NULL, 'details about the director', NULL, NULL, '2021-08-26 22:46:21', '2021-08-26 22:46:21');

-- --------------------------------------------------------

--
-- Table structure for table `donater_lists`
--

CREATE TABLE `donater_lists` (
  `id` int NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donor_msg` text COLLATE utf8mb4_unicode_ci,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` int UNSIGNED NOT NULL,
  `seasons_id` int UNSIGNED NOT NULL,
  `tmdb_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `episode_no` int DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmdb` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `a_language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` tinyint(1) DEFAULT NULL,
  `released` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'E',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`id`, `seasons_id`, `tmdb_id`, `thumbnail`, `episode_no`, `title`, `tmdb`, `duration`, `detail`, `a_language`, `subtitle`, `released`, `type`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, 'thumb_1629993177Screen Shot 2021-08-26 at 7.52.46 PM.png', 1, 'S01E1', 'N', '15', '{\"en\":\"First episode\"}', '1', 0, '2021-05-04', 'E', '2021-08-26 20:55:49', '2021-08-26 21:22:57'),
(3, 2, NULL, 'thumb_1629993220Screen Shot 2021-08-26 at 7.53.21 PM.png', 2, 'S01E2', 'N', '18', '{\"en\":\"Second Episode\"}', '1', 0, '2021-05-04', 'E', '2021-08-26 20:56:30', '2021-08-26 21:23:40'),
(4, 2, NULL, 'thumb_1629993257Screen Shot 2021-08-26 at 7.54.05 PM.png', 3, 'S01E3', 'N', '10', '{\"en\":\"3rd episode\"}', '1', 0, '2021-08-04', 'E', '2021-08-26 20:57:06', '2021-08-26 21:24:17'),
(5, 3, NULL, '1629993663Screen Shot 2021-08-26 at 8.00.24 PM.png', 1, 'S01E1', 'N', '26', '{\"en\":\"first episode\"}', '1', 0, '2021-05-01', 'E', '2021-08-26 21:31:03', '2021-08-26 21:31:03'),
(6, 3, NULL, '1629993747Screen Shot 2021-08-26 at 8.01.55 PM.png', 2, 'S01E2', 'N', '25', '{\"en\":\"2nd episode\"}', '1', 0, '2021-08-01', 'E', '2021-08-26 21:32:27', '2021-08-26 21:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `front_slider_updates`
--

CREATE TABLE `front_slider_updates` (
  `id` int UNSIGNED NOT NULL,
  `item_show` int UNSIGNED DEFAULT NULL,
  `orderby` int DEFAULT '1',
  `sliderview` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `image`, `position`, `created_at`, `updated_at`) VALUES
(2, '{\"en\":\"Comedy\"}', 'genre_1629993106Screen Shot 2021-08-26 at 7.51.35 PM.png', 2, '2021-08-26 21:08:30', '2021-08-26 21:21:46'),
(3, '{\"en\":\"Food\"}', 'genre_1629993370Screen Shot 2021-08-26 at 7.56.02 PM.png', 2, '2021-08-26 21:26:10', '2021-08-26 21:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `google_ads`
--

CREATE TABLE `google_ads` (
  `id` bigint UNSIGNED NOT NULL,
  `google_ad_client` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_ad_slot` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_ad_width` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_ad_height` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_ad_starttime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_ad_endtime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_blocks`
--

CREATE TABLE `home_blocks` (
  `id` int NOT NULL,
  `movie_id` int DEFAULT NULL,
  `tv_series_id` int DEFAULT NULL,
  `is_active` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_sliders`
--

CREATE TABLE `home_sliders` (
  `id` int UNSIGNED NOT NULL,
  `movie_id` int UNSIGNED DEFAULT NULL,
  `tv_series_id` int UNSIGNED DEFAULT NULL,
  `slide_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `position` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_sliders`
--

INSERT INTO `home_sliders` (`id`, `movie_id`, `tv_series_id`, `slide_image`, `active`, `position`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 'slide_1629994722Screen Shot 2021-08-26 at 8.18.27 PM.png', 1, 1, '2020-11-02 14:51:21', '2021-08-26 21:48:42'),
(2, NULL, 3, 'slide_1629994652Screen Shot 2021-08-26 at 8.16.46 PM.png', 1, 2, '2020-11-02 14:52:07', '2021-08-26 21:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `home_translations`
--

CREATE TABLE `home_translations` (
  `id` int UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(1) NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_pages`
--

CREATE TABLE `landing_pages` (
  `id` int UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `button` tinyint(1) NOT NULL DEFAULT '1',
  `button_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `left` tinyint(1) NOT NULL DEFAULT '1',
  `position` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landing_pages`
--

INSERT INTO `landing_pages` (`id`, `image`, `heading`, `detail`, `button`, `button_text`, `button_link`, `left`, `position`, `created_at`, `updated_at`) VALUES
(1, 'landing_page_1604308741home_1.jpg', '{\"en\":\"Welcome!  Join The Al Enwan Platform\"}', '{\"en\":\"Join Al Enwan to watch the most recent motion pictures, elite TV appears and grant winning.\"}', 1, '{\"en\":\"Join Next Hour\"}', 'login', 0, 1, '2020-11-02 14:29:21', '2021-08-26 21:12:17'),
(2, 'landing_page_1604308752home_2.jpg', '{\"en\":\"Don\'t Miss TV Shows\"}', '{\"en\":\"With your Al Enwan membership, you approach select UAE and all TV shows, grant winning Al Enwan Original Series and kids and children shows.\"}', 1, '{\"en\":\"Register Now\"}', 'register', 1, 2, '2020-11-02 14:29:39', '2021-08-26 21:12:49'),
(3, 'landing_page_1604308763home_3.jpg', '{\"en\":\"Membership for Movies & TV shows\"}', '{\"en\":\"Notwithstanding boundless gushing, your Al Enwan membership incorporates elite films, and all TV shows, grant winning Al Enwan Series and kids shows.\"}', 1, '{\"en\":\"Login Now\"}', 'login', 0, 3, '2020-11-02 14:30:01', '2021-08-26 21:13:21'),
(4, 'landing_page_1604308776home_4.jpg', '{\"en\":\"Kids Special\"}', '{\"en\":\"With simple to utilize parental controls and a committed children page, you can appreciate secure, advertisement free children and kids diversion. Children and kids can appreciate famous TV shows.\"}', 1, '{\"en\":\"Get Now\"}', 'register', 0, 4, '2020-11-02 14:30:18', '2020-11-02 14:49:36');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int UNSIGNED NOT NULL,
  `local` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `def` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `local`, `name`, `def`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 1, '2020-11-02 14:19:55', '2020-11-02 14:19:55'),
(2, 'ar', 'Arabic', 0, '2021-08-25 12:50:13', '2021-08-25 12:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `blog_id` int NOT NULL,
  `added` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_events`
--

CREATE TABLE `live_events` (
  `id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iframeurl` text COLLATE utf8mb4_unicode_ci,
  `ready_url` text COLLATE utf8mb4_unicode_ci,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `thumbnail` text COLLATE utf8mb4_unicode_ci,
  `poster` text COLLATE utf8mb4_unicode_ci,
  `genre_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` longtext COLLATE utf8mb4_unicode_ci,
  `organized_by` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manual_payments`
--

CREATE TABLE `manual_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `payment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_id` int DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_from` datetime DEFAULT NULL,
  `subscription_to` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manual_payment_methods`
--

CREATE TABLE `manual_payment_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `payment_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `position`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"TV\"}', 'tv', 1, '2021-08-26 12:50:30', '2021-08-26 21:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `menu_genre_shows`
--

CREATE TABLE `menu_genre_shows` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_id` int UNSIGNED NOT NULL,
  `menu_section_id` int UNSIGNED NOT NULL,
  `genre_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_genre_shows`
--

INSERT INTO `menu_genre_shows` (`id`, `menu_id`, `menu_section_id`, `genre_id`) VALUES
(10, 1, 2, 2),
(11, 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `menu_sections`
--

CREATE TABLE `menu_sections` (
  `id` int UNSIGNED NOT NULL,
  `menu_id` int UNSIGNED DEFAULT NULL,
  `section_id` int UNSIGNED DEFAULT NULL,
  `item_limit` int UNSIGNED DEFAULT NULL,
  `view` int UNSIGNED NOT NULL DEFAULT '1',
  `order` int UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_sections`
--

INSERT INTO `menu_sections` (`id`, `menu_id`, `section_id`, `item_limit`, `view`, `order`) VALUES
(9, 1, 2, 15, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_videos`
--

CREATE TABLE `menu_videos` (
  `id` int UNSIGNED NOT NULL,
  `menu_id` int UNSIGNED NOT NULL,
  `movie_id` int UNSIGNED DEFAULT NULL,
  `tv_series_id` int UNSIGNED DEFAULT NULL,
  `live_event_id` int DEFAULT NULL,
  `audio_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_videos`
--

INSERT INTO `menu_videos` (`id`, `menu_id`, `movie_id`, `tv_series_id`, `live_event_id`, `audio_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, NULL, NULL, '2021-08-26 20:31:16', '2021-08-26 20:31:16'),
(3, 1, NULL, 2, NULL, NULL, '2021-08-26 21:20:43', '2021-08-26 21:20:43'),
(5, 1, NULL, 3, NULL, NULL, '2021-08-26 21:41:36', '2021-08-26 21:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2017_09_15_051156_setup_coinpayment_tables', 1),
(7, '2018_03_24_032432_create_callback_address_table', 1),
(8, '2018_05_07_123123_fix_transactions_table', 1),
(9, '2018_05_08_037214_cp_create_mass_withdrawal', 1),
(10, '2018_07_01_112608_add_column_dest_tag_to_transactions_table', 1),
(11, '2018_08_29_205156_create_translations_table', 1),
(12, '2019_05_03_000002_create_subscriptions_table', 1),
(13, '2019_05_03_000003_create_subscription_items_table', 1),
(14, '2020_06_14_180448_create_actors_table', 1),
(15, '2020_06_14_180448_create_ads_table', 1),
(16, '2020_06_14_180448_create_adsenses_table', 1),
(17, '2020_06_14_180448_create_audio_languages_table', 1),
(18, '2020_06_14_180448_create_auth_customizes_table', 1),
(19, '2020_06_14_180448_create_blog_menu_table', 1),
(20, '2020_06_14_180448_create_blogs_table', 1),
(21, '2020_06_14_180448_create_buttons_table', 1),
(22, '2020_06_14_180448_create_comments_table', 1),
(23, '2020_06_14_180448_create_configs_table', 1),
(24, '2020_06_14_180448_create_coupon_codes_table', 1),
(25, '2020_06_14_180448_create_cps_cpp_table', 1),
(26, '2020_06_14_180448_create_custom_pages_table', 1),
(27, '2020_06_14_180448_create_directors_table', 1),
(28, '2020_06_14_180448_create_donater_lists_table', 1),
(29, '2020_06_14_180448_create_episodes_table', 1),
(30, '2020_06_14_180448_create_faqs_table', 1),
(31, '2020_06_14_180448_create_front_slider_updates_table', 1),
(32, '2020_06_14_180448_create_genres_table', 1),
(33, '2020_06_14_180448_create_home_blocks_table', 1),
(34, '2020_06_14_180448_create_home_sliders_table', 1),
(35, '2020_06_14_180448_create_home_translations_table', 1),
(36, '2020_06_14_180448_create_jobs_table', 1),
(37, '2020_06_14_180448_create_landing_pages_table', 1),
(38, '2020_06_14_180448_create_languages_table', 1),
(39, '2020_06_14_180448_create_likes_table', 1),
(40, '2020_06_14_180448_create_live_events_table', 1),
(41, '2020_06_14_180448_create_menu_sections_table', 1),
(42, '2020_06_14_180448_create_menu_videos_table', 1),
(43, '2020_06_14_180448_create_menus_table', 1),
(44, '2020_06_14_180448_create_movie_comments_table', 1),
(45, '2020_06_14_180448_create_movie_series_table', 1),
(46, '2020_06_14_180448_create_movie_subcomments_table', 1),
(47, '2020_06_14_180448_create_movies_table', 1),
(48, '2020_06_14_180448_create_multiple_links_table', 1),
(49, '2020_06_14_180448_create_multiplescreens_table', 1),
(50, '2020_06_14_180448_create_notifications_table', 1),
(51, '2020_06_14_180448_create_package_menu_table', 1),
(52, '2020_06_14_180448_create_packages_table', 1),
(53, '2020_06_14_180448_create_password_resets_table', 1),
(54, '2020_06_14_180448_create_paypal_subscriptions_table', 1),
(55, '2020_06_14_180448_create_permissions_table', 1),
(56, '2020_06_14_180448_create_plans_table', 1),
(57, '2020_06_14_180448_create_player_settings_table', 1),
(58, '2020_06_14_180448_create_pricing_texts_table', 1),
(59, '2020_06_14_180448_create_seasons_table', 1),
(60, '2020_06_14_180448_create_seos_table', 1),
(61, '2020_06_14_180448_create_sessions_table', 1),
(62, '2020_06_14_180448_create_social_icons_table', 1),
(63, '2020_06_14_180448_create_subcomments_table', 1),
(64, '2020_06_14_180448_create_subtitles_table', 1),
(65, '2020_06_14_180448_create_tv_series_table', 1),
(66, '2020_06_14_180448_create_user_ratings_table', 1),
(67, '2020_06_14_180448_create_users_table', 1),
(68, '2020_06_14_180448_create_videolinks_table', 1),
(69, '2020_06_14_180448_create_views_table', 1),
(70, '2020_06_14_180448_create_watch_histories_table', 1),
(71, '2020_06_14_180448_create_wishlists_table', 1),
(72, '2020_06_14_180452_add_foreign_keys_to_episodes_table', 1),
(73, '2020_06_14_180452_add_foreign_keys_to_home_sliders_table', 1),
(74, '2020_06_22_122007_create_audio_table', 1),
(75, '2020_06_24_150735_create_manual_payments_table', 1),
(76, '2020_06_25_115048_create_app_configs_table', 1),
(77, '2020_06_25_132738_create_splash_screens_table', 1),
(78, '2020_06_25_180556_create_app_sliders_table', 1),
(79, '2020_06_29_102308_commingsoon_enabled_ip_to_buttons_table', 1),
(80, '2020_10_31_114942_add_column_to_player_settings_table', 1),
(81, '2020_11_02_113133_add_columns', 1),
(82, '2020_11_02_114440_create_reminder_mails_table', 1),
(83, '2020_11_07_135552_create_chat_setting_table', 1),
(84, '2021_06_05_112917_add_columns_in_users_table_custom', 1),
(85, '2021_06_05_130920_add_columns_existing', 1),
(86, '2020_11_06_114837_create_table', 2),
(87, '2020_11_06_115740_add_column_table', 2),
(88, '2020_12_03_153005_add_column_update_31_table', 3),
(89, '2020_12_24_121353_add_column_update_v3_2', 4),
(90, '2021_03_07_162535_create_coupon_applies_table', 4),
(91, '2021_03_22_112446_create_menu_genre_shows_table', 5),
(92, '2021_04_17_131827_create_google_ads_table', 5),
(93, '2021_05_03_144635_add_column_update_v3_3', 5),
(94, '2020_12_02_123844_create_manual_payment_methods_table', 6),
(95, '2021_06_13_182042_remove_column_update_v3_4', 6),
(96, '2021_06_13_185438_add_column_update_v3_4', 6),
(97, '2021_06_12_145328_create_package_features_table', 7),
(98, '2021_06_18_112730_add_column_update_v4_0', 7),
(99, '2021_07_03_084019_create_color_schemes_table', 7),
(100, '2021_07_20_094823_create_labels_table', 7),
(101, '2021_08_20_183347_remove_column_v4_0', 7);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int UNSIGNED NOT NULL,
  `tmdb_id` int DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poster` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmdb` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fetch_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `director_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actor_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `rating` double(8,2) DEFAULT NULL,
  `maturity_rating` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` tinyint(1) DEFAULT NULL,
  `publish_year` int DEFAULT NULL,
  `released` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_video` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `series` tinyint(1) DEFAULT NULL,
  `a_language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audio_files` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'M',
  `live` tinyint(1) DEFAULT '0',
  `livetvicon` tinyint(1) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `is_protect` int NOT NULL DEFAULT '0',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_upcoming` tinyint(1) NOT NULL DEFAULT '0',
  `is_custom_label` tinyint(1) NOT NULL DEFAULT '0',
  `label_id` int DEFAULT NULL,
  `upcoming_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movie_comments`
--

CREATE TABLE `movie_comments` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `movie_id` int DEFAULT NULL,
  `tv_series_id` int DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movie_series`
--

CREATE TABLE `movie_series` (
  `id` int UNSIGNED NOT NULL,
  `movie_id` int UNSIGNED NOT NULL,
  `series_movie_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movie_subcomments`
--

CREATE TABLE `movie_subcomments` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `comment_id` int DEFAULT NULL,
  `reply` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `multiplescreens`
--

CREATE TABLE `multiplescreens` (
  `id` int UNSIGNED NOT NULL,
  `screen1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `screen2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `screen3` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `screen4` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `activescreen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `screen_1_used` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO',
  `screen_2_used` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO',
  `screen_3_used` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO',
  `screen_4_used` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO',
  `device_mac_1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_mac_2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_mac_3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_mac_4` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_1` int DEFAULT NULL,
  `download_2` int DEFAULT NULL,
  `download_3` int DEFAULT NULL,
  `download_4` int DEFAULT NULL,
  `pkg_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `multiple_links`
--

CREATE TABLE `multiple_links` (
  `id` int NOT NULL,
  `movie_id` int DEFAULT NULL,
  `episode_id` int DEFAULT NULL,
  `download` tinyint(1) NOT NULL,
  `quality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clicks` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `movie_id` int DEFAULT NULL,
  `tv_id` int DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('569ad959f942546f9da66edd156245e10c829bcd96ba413daa5a4b611adef4666dfa80445e0a9ca2', 2, 2, NULL, '[]', 0, '2021-08-25 10:30:26', '2021-08-25 10:30:26', '2022-08-25 10:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Nexthour Personal Access Client', 'Z9kvpHyT5nzRQrGKvLoKxXces8bxDzexeqZVP5sA', NULL, 'http://localhost', 1, 0, 0, '2019-12-09 09:59:26', '2019-12-09 09:59:26'),
(2, NULL, 'Nexthour Password Grant Client', 'C2VrZuB5yr78fKGJcbPMtS4k6U1DAWePGhNu4Uq8', NULL, 'http://localhost', 0, 1, 0, '2019-12-09 09:59:27', '2019-12-09 09:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-12-09 09:59:27', '2019-12-09 09:59:27');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('453876f141aba92094aa0aa8d02c1666ba4ce2865f9cd2b39938336b8c70130217530c91bde98134', '569ad959f942546f9da66edd156245e10c829bcd96ba413daa5a4b611adef4666dfa80445e0a9ca2', 0, '2022-08-25 10:30:26');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int UNSIGNED NOT NULL,
  `plan_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_symbol` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `interval` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interval_count` int DEFAULT NULL,
  `trial_period_days` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `screens` int UNSIGNED NOT NULL DEFAULT '1',
  `download` tinyint(1) NOT NULL DEFAULT '0',
  `downloadlimit` int DEFAULT NULL,
  `delete_status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `free` tinyint(1) NOT NULL DEFAULT '0',
  `feature` longtext COLLATE utf8mb4_unicode_ci,
  `ads_in_web` tinyint(1) NOT NULL DEFAULT '0',
  `ads_in_app` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `plan_id`, `name`, `currency`, `currency_symbol`, `amount`, `interval`, `interval_count`, `trial_period_days`, `status`, `screens`, `download`, `downloadlimit`, `delete_status`, `created_at`, `updated_at`, `free`, `feature`, `ads_in_web`, `ads_in_app`) VALUES
(1, 'monthly', '{\"en\":\"Monthly\"}', 'AED', 'fa fa-dollar', '20.00', '{\"en\":\"month\"}', 1, NULL, 'active', 1, 0, NULL, 1, '2021-08-26 20:44:04', '2021-08-26 20:44:04', 0, NULL, 0, 0),
(2, '6months', '{\"en\":\"6 months\"}', 'AED', 'fa fa-dollar', '120.00', '{\"en\":\"month\"}', 6, NULL, 'active', 1, 0, NULL, 1, '2021-08-26 20:48:16', '2021-08-26 22:20:42', 0, '[\"2\"]', 0, 0),
(3, 'year', '{\"en\":\"yearly\"}', 'AED', 'fa fa-money', '200.00', '{\"en\":\"year\"}', 1, NULL, 'active', 1, 0, NULL, 1, '2021-08-26 22:19:19', '2021-08-26 22:20:23', 0, '[\"2\",\"3\",\"4\"]', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `package_features`
--

CREATE TABLE `package_features` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_features`
--

INSERT INTO `package_features` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'test', '2021-08-26 20:47:14', '2021-08-26 20:47:14'),
(2, 'Full access', '2021-08-26 22:19:49', '2021-08-26 22:19:49'),
(3, '4 screens', '2021-08-26 22:19:55', '2021-08-26 22:19:55'),
(4, 'Full HD', '2021-08-26 22:20:01', '2021-08-26 22:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `package_menu`
--

CREATE TABLE `package_menu` (
  `id` int UNSIGNED NOT NULL,
  `menu_id` int NOT NULL,
  `pkg_id` int NOT NULL,
  `package_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_menu`
--

INSERT INTO `package_menu` (`id`, `menu_id`, `pkg_id`, `package_id`, `created_at`, `updated_at`) VALUES
(3, 1, 3, 'year', NULL, '2021-08-26 10:20:23'),
(4, 1, 2, '6months', NULL, '2021-08-26 10:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paypal_subscriptions`
--

CREATE TABLE `paypal_subscriptions` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `payment_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_id` int DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription_from` datetime DEFAULT NULL,
  `subscription_to` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paypal_subscriptions`
--

INSERT INTO `paypal_subscriptions` (`id`, `user_id`, `payment_id`, `user_name`, `package_id`, `price`, `status`, `method`, `subscription_from`, `subscription_to`, `created_at`, `updated_at`) VALUES
(1, 5, 'by admin', 'test', 2, 120.00, 1, 'by Admin', '2021-08-26 22:14:33', '2022-02-26 22:14:33', '2021-08-26 22:14:33', '2021-08-26 22:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` datetime DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `player_settings`
--

CREATE TABLE `player_settings` (
  `id` int UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_enable` tinyint(1) DEFAULT NULL,
  `cpy_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `share_opt` tinyint(1) DEFAULT NULL,
  `auto_play` tinyint(1) DEFAULT NULL,
  `speed` tinyint(1) DEFAULT NULL,
  `thumbnail` tinyint(1) DEFAULT NULL,
  `info_window` tinyint(1) DEFAULT NULL,
  `skin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loop_video` tinyint(1) DEFAULT NULL,
  `is_resume` tinyint(1) DEFAULT '0',
  `player_google_analytics_id` varchar(199) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_font_size` int DEFAULT NULL,
  `subtitle_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chromecast` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `player_settings`
--

INSERT INTO `player_settings` (`id`, `logo`, `logo_enable`, `cpy_text`, `share_opt`, `auto_play`, `speed`, `thumbnail`, `info_window`, `skin`, `loop_video`, `is_resume`, `player_google_analytics_id`, `subtitle_font_size`, `subtitle_color`, `chromecast`, `created_at`, `updated_at`) VALUES
(1, 'logo.png', NULL, '2021 Al Enwan', 1, 1, 1, NULL, NULL, 'minimal_skin_dark', NULL, 1, NULL, 12, '#f01919', 1, NULL, '2021-08-26 21:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_texts`
--

CREATE TABLE `pricing_texts` (
  `id` int NOT NULL,
  `package_id` int NOT NULL,
  `title1` text COLLATE utf8mb4_unicode_ci,
  `title2` text COLLATE utf8mb4_unicode_ci,
  `title3` text COLLATE utf8mb4_unicode_ci,
  `title4` text COLLATE utf8mb4_unicode_ci,
  `title5` text COLLATE utf8mb4_unicode_ci,
  `title6` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminder_mails`
--

CREATE TABLE `reminder_mails` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `subscription_id` int UNSIGNED NOT NULL,
  `today` int DEFAULT NULL,
  `before_7day` int DEFAULT NULL,
  `after_7day` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` int UNSIGNED NOT NULL,
  `tv_series_id` int UNSIGNED NOT NULL,
  `tmdb_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `season_no` bigint NOT NULL,
  `season_slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmdb` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poster` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actor_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a_language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `type` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S',
  `is_protect` int NOT NULL DEFAULT '0',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trailer_url` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `tv_series_id`, `tmdb_id`, `season_no`, `season_slug`, `tmdb`, `publish_year`, `thumbnail`, `poster`, `actor_id`, `a_language`, `detail`, `featured`, `type`, `is_protect`, `password`, `trailer_url`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, 1, 'first season', 'N', '2020', NULL, NULL, NULL, '1', '{\"en\":\"first season\"}', 0, 'S', 0, NULL, NULL, '2021-08-26 20:54:04', '2021-08-26 20:54:04'),
(3, 3, NULL, 1, 'first season of food', 'N', '2021', NULL, NULL, NULL, '1', '{\"en\":\"first season\"}', 0, 'S', 0, NULL, NULL, '2021-08-26 21:29:57', '2021-08-26 21:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` int UNSIGNED NOT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb` text COLLATE utf8mb4_unicode_ci,
  `google` text COLLATE utf8mb4_unicode_ci,
  `metadata` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `author`, `fb`, `google`, `metadata`, `description`, `keyword`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Nexthour\"}', NULL, NULL, '{\"en\":\"this ts a next hour\"}', '{\"en\":null}', '{\"en\":null}', NULL, '2020-11-02 12:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('07F6T2GOgensGWfWCci3MTESTzBOp8nypOfU0rZS', NULL, '49.36.45.39', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVzlrWUVHNldKY2c2ODZZb3N5MjgxcjB0YlI5YjRDeHZCV0Y1RTZYQyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630292905),
('0LQ0LNPfNJopL8ls3xHrDtGsj7UyBmTiFGoBt5JM', NULL, '197.210.54.16', 'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYk40dk5sQTNaR2dvcVJTYk1paHRkNURQVGM1WDE4VHRiVXZkdnMyZSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280390),
('0XAddAPTfcBCZwYO1NcesMXpj6lshhCqVVKCXE85', NULL, '178.90.30.47', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUnI5N25vV2YxUmtENmJuMEtKWWo0bXZ3VFlWb1AxcUo5U1Bza01uYiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630282910),
('1I5g2DseJEIbPGdILopScUtZIAyXlSpZbmrLMh0J', NULL, '52.149.33.149', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid21pT2FCcTJHMjlydDV2WWgyVWRjYmFlMXRobXZ0VnVJc1lEcW9vMSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzE5Mi4yNDEuMTMyLjEzNy8uZW52Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvLmVudiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1630274863),
('1pYPLEImUVyuE42JgYDz1LWoPFjjTcMyuhBeLPlL', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaVVXMU44eFNTS3FEcWZiRFJISVhKRkF2UlVZUnhxVHlQNTNXcjNzMSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280582),
('2wdWB43KR3wgFffSfOKeXuqgitGKGNu8l0GRzhv6', NULL, '88.198.15.244', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicm5pSnlISkFyeU44YWZ6ZFphUEhwRTJVVWxpNGV3aXI1Q1R5RTl6QyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280882),
('3wCXAtSSFAhkis6L8DzI2vZrCWshydHvBqNqyp6D', NULL, '195.201.245.32', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidFFDeDZYTnA1bDc4Qmo5SUpWdlVpbG5ESWF0ZnhUZU1LcmpXM25BbCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280731),
('3WUVhJ6JxWRsQPLHDaXMTnx9Apk7cVf7c5WeIxai', NULL, '88.99.144.157', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZXIxMERtcVE4ZlNKMjdZOHJPbjRCRjBzVkR6RHlHcXlmU1Q3UVlxaiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280712),
('46ODqE1zCWwK3xsF6U4ClSxSGf7qmjwQ3jypX0WI', NULL, '14.239.97.150', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWldOT05uVXNOVVNFZFdxODEzQTAxdExvUFI2cVdxcjFncEdTbVhDNiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630285180),
('4OzLbqFMgvtbEcEApovSKVsbAMaJX7QorkVhJAAp', NULL, '88.99.144.143', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkZBYzRJSkpZTG1QQzJiclc3WU0yQU1KRGdqUEJrTFZBMnZXT3pVaiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280434),
('4sIXR305fLh2E3kgdxJo6WqgpHMBZcoRllKlUpjO', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZnd3OXNQaklESGhVZlZOWDdyMUdSb2pBVkRIQzZVNlBBeHozSlVMNiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280339),
('514354OIlnlOlDsDyzIB9llvE898tYi2t2w122oB', NULL, '78.46.86.135', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiem5YdVliZ2l3SnFBSmF5VzMxQ3h1ZEVNNHUyTTBiU0FaOE16dW1VeSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280418),
('57nFPtKiLQz4KTlpjt3CQ757nokNfaMde3xugTPI', NULL, '77.37.252.132', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVmtwUUs5YlVLMWpmSW0zcFViS1VaMXpLZExnTlFxQTZMMXVkYjgyVSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvcmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630309984),
('5RhCRTg3waFXK1uqNr4fU8LWFuAy1voxy4pSshUc', NULL, '159.69.60.36', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDFCeXhKNHNKNEJEUUN4NUF3ZGVqR1J3bDhSWmVFV3BwZGtaUVQ5diI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280547),
('6IQTUq6aOHj7egRuBZLj9cvRi6djpBuYsseneGTC', NULL, '88.99.144.159', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaEoxNUpGOGlKTWJzVUNPQmRieUQ2SUc1dUtNT04ySmMxbTRRY2g0RSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280629),
('6siVSTkBxEFHuXy1eW2UZFaYeTp1PMvA8Cinon7M', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic2JhVEVZcUdJb2lqTlFybGdRNTRGelhrZXZ3R1g3RXo2bXFMMkt6UCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280693),
('6T85XrA4nEF1Y5w3eL9t9yfLYOYvlZ8fgE8mfBLV', 6, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia3FpMkhqM2drQ1hYTEprUm53SlFFeHJhYjFtc3RLVjRCNVByRDlFTyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvZ3Vlc3QvdHYiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1630280739),
('7IOef9P15Ygl0LJKqiEyBnQAwe75LpjzvW5TZDN7', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWU1BZnFFVU5SSE5rY1NGVDZnR0lDSVJDTHBTT3N0b0V1czRVckRyciI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280724),
('7tJM3g3H0J1lK2ARlJHmv9WxSTgL7KAinenpZfaL', NULL, '138.201.205.93', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzFkRUVWZmxwNElDTGxrRDAyejNaNUE4QVdVTVJZYkZqV1Q3Z0xLUyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280628),
('9MNnHILFh0r1wDLi7Wp3yFjueZapeXTbE93qqmZr', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMDhTTG15SGxvVkdiZ0Z4Q0h6eFE4ZHk2RzdMZXVvQUR1WURydW03WCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630293549),
('a3KvSFuyh8k9mxgXH6oSHAGOTe63TYLrjsou4hpW', NULL, '195.201.245.126', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUWwxSnpKUEhxSUdCaE1Cb2ZQajdrb3JpSTdDR2tLMXkzbDZYb1hBUiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280790),
('B0Nngc7KQTOw7m15zfaEYGhe3R2dqfrqcbLEgc7j', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV3h4eGV5aU8wSnR1a3o5YmJjNWR3NlRicEFIYklndTBNbWJ2WGpYZiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvcmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280494),
('bay4pjiKuryXBgKefVvgm8qqHDwSHff8klMVl3Ev', NULL, '45.146.164.110', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWXRtZkhkMmdja0FkeGZGajVlMXJoYmtuY1UwWWs1NEdJNlRYbWFyZyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvP1hERUJVR19TRVNTSU9OX1NUQVJUPXBocHN0b3JtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630332490),
('BF97Yxl4q6s1fTWGh6mabA5Jb4dNcPEyMtNcjaTN', NULL, '195.201.245.31', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTXpGRnRrdFRmb3pReTRMYkRnME5KU3dSZ1VXTmUycWlJWk1yQnZiSyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280850),
('BkuwPvVW7kpGy886f9T5zLPX0vtCWdDxSi11JZoU', NULL, '36.74.43.164', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiakUyeUFWb21IM0txZld2WDVLZXF4M2xON1d4V201aWNaYmdvNHVoRiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzE5Mi4yNDEuMTMyLjEzNy8uZW52Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvLmVudiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1630306310),
('bLs1KjBE0g31SgqNdhMK4qofJHzEaUXgtwfNBXK5', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVFZhQnhnN05zamtia1gxVFB5VjlEYkppSE8waGpOQVdXakhIdENTbCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280810),
('bnMtfs45F8CSKSwTZgzsv7YRYHjpjADxOTG1EL9S', NULL, '144.76.94.115', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1VNQ1Fnd1ZuRG5SZmYyZlhwdnJGVEZ6cFFHOTh0Um1VcTVyaTE4TSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280419),
('BvUVDsm7h72nIthtXNIt0Pvh1yoNBslvminGTEpd', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTDlqSUxnSEJveGllRE9Pc3ZvcjRSc3hhM1R5a3kxUzd2c1ZGYjdpQSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630313859),
('cavWzF5HNhSJy2wpfXLqbxaFDnq95f6e7Bgk2lw4', NULL, '45.146.164.110', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVkV2U1kwM0lsT0t1eXg1UXF1YjNyVFZaZnhyaWd6a3k0UlpLWXlCdCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMDoiaHR0cDovLzE5Mi4yNDEuMTMyLjEzNy9jb25zb2xlIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvY29uc29sZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1630332493),
('cSx9Ikeccb9effetjoTGzysd37li7qW1rPM64cj1', NULL, '51.81.98.65', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:77.0) Gecko/20100101 Firefox/77.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ282azdMQVAzN0o0bzhGaHFRN2ZrN2RzVEoxR0JDem16TEd4QmhZRSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzE5Mi4yNDEuMTMyLjEzNy8uZW52Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE2OiJjaGFuZ2VkX2xhbmd1YWdlIjtzOjI6ImVuIjt9', 1630321384),
('CtIhCXrFzZcBoNpoTh58UWuSQqwZthgLy27iPVYA', NULL, '138.201.205.93', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWjBqYXFVTUIxTVhSNWYwcmxWUDBndGdBVXVZb2Z1WU5xUDNSSXF2NSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280628),
('Ctk4XBXF4qWM9qCwWDgQGxKt0OwgQXKXvkAblNor', NULL, '88.99.64.214', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3hrOFA4MXRTanNDNDRreThEMGJCbmJCOFpSZFlyWG13bWY0SlN1biI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630281046),
('Dfd9EtF8A9sj2lqVsBApYhcOUKVzIP5hKFTgro4d', NULL, '45.146.164.110', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMEp6ejNGY2Z5V0E1OHdXbXBTNWRBUnFIUWxsNEl6MDU0eHAyczRlSiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvP2E9ZmV0Y2gmY29udGVudD0lM0NwaHAlM0VkaWUlMjglNDBtZDUlMjhIZWxsb1RoaW5rQ01GJTI5JTI5JTNDJTJGcGhwJTNFIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630332490),
('dVkk2Dx2EJnTmVpIzUqRnLNhB1v0wDxYycSERHP8', NULL, '103.36.120.92', 'Mozilla/5.0 (Linux; Android 10; motorola one fusion+) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZkQ4d2l6TW80ek9DZFdIR0dJVGNhN1N5OXVPRHZuVzJmWGdyTGhKUSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630283601),
('EIIbELrHfLgrnojvkuOYrmJHScb6i4NnZ48AWHei', NULL, '45.170.223.219', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU2taRWZiV0RmSlUzMDdRcXU0MGFRbThPZmFvd29wRktoTzVRR1YyYSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630321841),
('elkycnV5HMpfDwCz4CxwtOubjkxxx7pvPczdvAb6', NULL, '41.92.32.194', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM3JwYmtEMFphV3pQVUFsanFIcW1FRUFiZDlaekxqTXhPWEQ1N1lFMyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280327),
('f1JKDXNmkuWNXbOhpBdDBZHx2DfblRgViOv48vyK', NULL, '156.206.149.15', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSXJ2UTR6Y2ZRbUlYUjF2MGJFVmJTVjU5ZjB4WFA0UWh4WjMwYmwyViI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280307),
('fAziBmyAAEDhvn5cbe53ZpqeteRxRrEUXIcWBL0M', NULL, '81.192.190.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ3puTEQ2anVwZDF1dWUxU3lqdWhnS1lEaTU1SEtoeHAyNFVDSzJDcCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280328),
('FDAER6gCQH3wCzGr6CbOIQEXZS1Hs5sFpfQ5H14K', NULL, '144.76.94.109', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibGM2RWd4NWFmSGhCTEV3TmVxUU1GS3VsRWxyS1VnMUJiSmxuZGJxZiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280843),
('fgTw1Faf5FbymeIg8thHgc1Sw7G1vt5UJBReINCv', NULL, '88.198.16.182', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT3pWM3NqbWpJamQ3SXh0WDJIQ0gyWElndko5ZFdTcUNmRHh1N0FKbCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280652),
('fhmfRAbdsrnHV7xLupwEOLUgktqzRyBhKfsuJGnC', NULL, '188.43.235.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWGNkMmMzeU9LVndXOEd1cFlMRFVEak1WY0dEUjVQVkYySkNMaEtIWiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvc2hvdy9ndWVzdC9kZXRhaWwvZmlyc3QlMjBzZWFzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630281782),
('GiTgDggAgiFGwHjRiTUElWpGFkoyJmsVWKdh64F8', NULL, '144.76.94.109', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWdQa282UVlHN0w0alBoVEZORWZzeUJXN2pSWVdqM1ZSRm1MYkF0OCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280842),
('GjQfoia6AEP3kZ1nuuoFwCbc6KdHl3W1GEGXlWXW', NULL, '45.70.178.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.164 Safari/537.36 OPR/77.0.4054.277', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic25ZMThBOWRvcDd1RmVYRjd6eUFsVEMwYTZFb09DS0lQUjMwSFBXTyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630283306),
('GNHxtDWgXi3QRQp4sIhZzNkgFsre9BQTLaEuQ169', NULL, '103.147.102.10', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/601.7.7 (KHTML, like Gecko) Version/9.1.2 Safari/601.7.7', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR09tY3dkOFJ2WHBxRFM4d1NUczlaWFJGN1dIUnhrMG4wbFRCSzRrUSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630293221),
('gsJLZhBgzCYGtaS7w8va6xP5rSHkNRExuFkKLLaj', NULL, '88.99.148.111', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiemdncldRczRnMnBWUWg2S1hnaWI2cHV1SEY4dzBGRVhJTW9hdG1OdyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280619),
('GSXE2jU0baqvRcFhRCnXdpmTrUEobpMZ0PxoNdFl', 3, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiQ21pcUpwWHFCNWJxcVhaRFhNOWxwNWh1Q2tSTEFTdE50ODl6cFNQayI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvc2hvdy9kZXRhaWwvZmlyc3QlMjBzZWFzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6NDoidXNlciI7YToyOntzOjU6ImVtYWlsIjtzOjE1OiJhZG1pbkBhZG1pbi5jb20iO3M6NDoibmFtZSI7czo1OiJBZG1pbiI7fX0=', 1630319501),
('GuiLqIUjcjMTkVjikM0RGvFAG6iFVfMsRS976UNq', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibzVGR2d6bFRMRzlkbHp6ME1INTFvQWF6bjBzalRMZnJRUUhhM1FTNCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630283446),
('haeGwTzWSdIGpQWMw9R5X3hgrBRc1BqrezxsXj9J', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMXdUNUFRelNBTDR4Tk5GZEo0SWdxS2gzWThQMDF2d3ZIdDUxRzR0RCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvZ3Vlc3QvdHYiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280506),
('hEZejhwMh9FTgGyUaU25MYpTeTZ1KrSnffFTrTys', NULL, '144.76.94.115', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNHBmaFJkRmdSWXZia2lPUlI2VUFhenZ2UjlBR09Ic01Ud0VHa1lFNiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280419),
('hWsL90m11TumwqZ3CNwn4WNXdDyCdf8pOD2XdmDh', NULL, '195.201.245.31', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGhCNnB4U05nV2kyZFMzVXlFb0pqTFBMQm1nNTJzbTlYQmNsYzBHSyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280850),
('I2l9yESaYW9oC71IQTrMceg879HF8i8xsaLHu1By', NULL, '135.125.217.54', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSklFdDZLQWpWejhCNmJ0bnlrVFNaQ1pacjdCM1lkZVRVN0taejFPcSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzE5Mi4yNDEuMTMyLjEzNy8uZW52Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvLmVudiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1630332714),
('iA3MDfTkc2OOp9JkQEv6VKlFwNBL8KFcliTeOINJ', NULL, '54.196.61.211', 'masscan/1.3 (https://github.com/robertdavidgraham/masscan)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieU5VVGt2QlgxNjQ3MG9oMHZMSjZBWXRGZ0pYUTk4QlV4VzBjbEI1NCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly8xMjcuMC4xLjEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630278034),
('icslQc2idqbKF9mCnEUP7XpGTJ0SjmirkRD9x31X', NULL, '138.201.31.160', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia2NYcG5taGRweVpTRVNrOU1lRXJhMjZ1NTVJeGRJSDRLaGVHcW5BSyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280548),
('IGqFTvg02w8ZFZcmLDIKIxi6BuuzkjfaZYud9Zwk', NULL, '196.70.248.109', 'Mozilla/5.0 (Linux; U; Android 4.4.2; en-US; HM NOTE 1W Build/KOT49H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/11.0.5.850 U3/0.8.0 Mobile Safari/534.30', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidjZDVjJWTlpyZE5JYmhZZkJVa1VOWWV1dWpuVThNTUxVQTBHZnlWOCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzE5Mi4yNDEuMTMyLjEzNy8uZW52Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvLmVudiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1630320254),
('Ir4diuDnPAhrw3iu4XSIn9izW6PLCifoleQoA2Do', NULL, '88.198.16.187', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWmowcHVuQXo1ekEzR0w3UFZiUHFLN0FxSURCTjRWTkJRS0xWYlAxMCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280491),
('j1iZzlmN7VazCWeZJfMH0t7rPVoj0qG682oxqTpU', NULL, '88.99.144.159', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTUlkMnBmem43dzRkSFROVXBKWWVaY0p5ZkVBYnRXQzNaQ003UkFaRSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280629),
('jHqpgAudomD6sLHPzRUgEOVgpU9LOCKg3M8tPa2g', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieWtzakhybHNFWDk2NWRGSGFOaXNvaFF3eHhvMjlJNmhZS3JYR3dZTyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630314015),
('JlCkYMR4Vo49n81h0N0p0zIPnAnTICsE4oAyvhHd', NULL, '88.99.148.110', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieFBaTjNOZ2ZnVWl6ZHdYd09kM3ZLalJMMnl6WDJoRmF3bmk0QzVMeCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280937),
('jNqfePO9SsL990ZuzPX6V8DeyqgCEPUXllV8xMu6', NULL, '88.198.15.244', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNUtUd2x2S2J1RGtKU1JsODZqUUYydFJ4Uk8yTlh4UzM2SEpZVWI0VyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280882),
('k7YM0bcA6FUq5dXLonh3JIrDNLsGPqhniMXKNDQV', NULL, '78.46.86.135', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibXZpN05xQXM3S1A0dFlLNUlOcVg2MExsRkJHc2FnYU5SdTFxMG1CUCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280418),
('KeY9sQmffjjWOlDq6fwnBRx0AR99UY6XkE7h7P3x', NULL, '138.201.223.94', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3ZUc3RMTFU4WlFmb3FZRjdiMTlJeEtzOHN6bGQ5Z1EwSzBaZVJtUyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280999),
('LEvTpQmuV53n3WI0Ij2vpCACtI5RP4GyY8THQVsI', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibjZqbVJ2a1U0ZVowMFlGYk1Ca2ZSZGoxN2tTdU12bXZFakVKT1FtNiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280368),
('lGMiFmKMTvC5FnZTdLOyvlcFngBmIbssCZFb2oAY', NULL, '162.142.125.193', '', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidHlzVWY4R3FEbW9kR0lrZHZKUmpDaWZuUnpCc2ZhdG9pNWo4cFNpSCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630322826),
('LQU6EvlmiaAzm3DVCXfD1YJzM4Xm2MpAx9fg9YtE', NULL, '54.196.61.211', 'masscan/1.3 (https://github.com/robertdavidgraham/masscan)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibmg3ZFBFT3kyR2NtOEpnQ0RSRExLYk1RdnB4czF2cDlHSGJ3OVlkTiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly8xMjcuMC4xLjEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630276617),
('M21fuSCSKJ44twAEuiOVAXzkYI1ttUdFl4JKdKDb', NULL, '217.165.22.134', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYWZ6SFEwSUw1aWFGRWdQVEhsejRseEkyUG5qcHgwN2ZjQjY2S2kxZiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630293067),
('mbZObZGHUzxzAUfKjlCtXEdP5I0vq5AxVxIwWrgk', NULL, '52.149.33.149', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicjB2THdBanM0QkdsQzZ4MmQ4RjZMUEJrUngzd25NUGtMbjJVd3FLNiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzE5Mi4yNDEuMTMyLjEzNy8uZW52Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvLmVudiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1630319167),
('nCxh1FDZDFNwtiWBBpEztevKJUNsjIvd6394dQmM', NULL, '88.99.144.143', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUXl2TGZYSlFVazVVZ0VSeGtzS044VUdjbVNld3p3eThySFl3ZHVLQSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280434),
('NvCPlH5m63RKeQxV7Kzy0oU2yeUsgFZVLrBVHWci', NULL, '138.201.223.94', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVHB0REU4akxqWUFzbjhrclpIam82OHBhTUVtaGMxeTMwcjVZQ2xnQyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280999),
('nZ8emikv86ljSqsVX6lLbCfHGiACnzFp1BrIeZtx', NULL, '45.146.164.110', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNHBVSVpyNnRvRzR6a0ZZZGp1RlJsSU9FRVlxT2Uxamk1R3BnYjVZZyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630332493),
('O4uHHyKC90x276LqXPTfkYIuY35O7S0Ry3ef4nqA', NULL, '51.255.3.2', 'Mozilla/5.0 (Linux; U; Android 4.4.2; en-US; HM NOTE 1W Build/KOT49H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/11.0.5.850 U3/0.8.0 Mobile Safari/534.30', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid3dlTG5qM1pxSkptVHNsTUZYMUZDV0hKcmVERW1iRzdBWFZ3Z3BVTiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzE5Mi4yNDEuMTMyLjEzNy8uZW52Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvLmVudiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1630274421),
('o6y5eIlON1ZFwPMoSktZTMO9swPd9oY7RJi7ipTE', NULL, '183.136.225.14', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:47.0) Gecko/20100101 Firefox/47.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU3RlTDZhUjkxQWRuUEtYY1FpbnRTSW55S29XVjFNRVhaNzFtZENhcyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630282467),
('odRPEsZ1AdGbtT4uA4FMPvrZyres8qcIqs8GRAPd', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRHVzOEhKWm91WWozQkxkQ1E5SEpSNU5HNkExaXlWN3JxUEFvTXhrbyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280355),
('OpiCMbjC7BVrq5mmcU0E1iUZ1JmSn978zDMbw9PC', NULL, '94.130.67.180', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3BkVmtiZVoxZGtiRk5oczNCRUZhRFpSVVRYUVZkbWhqTzhTbTJBcCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280732),
('OxoMEyueJjwmUGo3vzsi4Cqf2w7Srw8XVLsxehCl', NULL, '196.200.129.5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiajUwNmdnMmhXdmxmS2llWU8zVUFDenpWRzRDeGdMZUcydGFrQkRZYiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280330),
('PbSKUfkDqfC13jhmCtRdVChW432xzX1pNbqkpdQq', NULL, '217.165.22.134', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV05DaTJpeG1Nb2I4bG9kN3pZUWg4Rm1NRXUwZmdvbER4Ukd4c3hkeSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvc2hvdy9ndWVzdC9kZXRhaWwvZmlyc3QlMjBzZWFzb24iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630282051),
('PExsDVj1w1cIolri30uk6ZgeIeUzNH3cezJBP093', NULL, '135.125.217.54', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVmJpYnJrYkdaWGpvTXFiMXFQTm9KamJ5RFdTVmdwdkxTcWJ0VGw5RiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzE5Mi4yNDEuMTMyLjEzNy8uZW52Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvLmVudiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1630307488),
('PrWLLcXfWl0io4oBJdltQN8YBaCIffEvl1GsEAlF', NULL, '46.103.141.252', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibDVFb0Z3OFJTUlhMREJMamZwdnV5Z2VvMmdyeEVCRnhucFRUTlJ6ciI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630290284),
('PZmAbzlsA666J4HmUpy87IN7QORcTBrWxpsmQMuH', NULL, '178.20.40.115', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid1p3YlM5eDh5ZnBpbVFQWUxqU0F4WXNuSHpkcjVSa3Y3SXNTWWc3RSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280700),
('q2DZPvOFnLhD298HkBKvkeFgxa30Bl05ElXYgI1M', NULL, '162.142.125.193', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOVE2Q3RpMXE0dm01VmRJVjZVSTgzS2VJRE11eXAzYWZVczlmUkZhVSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630322826),
('q2lRQXV0QOGGLbRCg4aQ7KiHKGJuAhvmq1GhYSzS', NULL, '45.146.164.110', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaTdGaVNLSHR3VFYxTHUzR2VBZENPQ3JLTTJQSkJDaFJLU2hzb3BrQiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTU4OiJodHRwOi8vMTkyLjI0MS4xMzIuMTM3L2luZGV4LnBocD9mdW5jdGlvbj1jYWxsX3VzZXJfZnVuY19hcnJheSZzPSUyRkluZGV4JTJGJTVDdGhpbmslNUNhcHAlMkZpbnZva2VmdW5jdGlvbiZ2YXJzJTVCMCU1RD1tZDUmdmFycyU1QjElNUQlNUIwJTVEPUhlbGxvVGhpbmtQSFAyMSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1630332492),
('Q4dH3Gea3DfO4DAUR7h9ltczWgWYm7bg4MiUA8Wp', NULL, '51.254.59.113', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY3U3am1iWWRZa2FtVU8xbnpMMzNsRHllUDdSNWM2QTA3YlBGWXo2RSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630328753),
('QDebfsLjVOFbjzuitxLEpX0vtNdXKiM8rU1bYcSv', NULL, '217.165.22.134', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicnRvWGpxMUg3bHN2eFpMdmk4azBiQ3NWNGZoT2NsZU9xVWk4V2xtRiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630331342),
('QHbi625LemK7riVVy05gNqsXiRf2Frs4PUg2yu16', NULL, '88.99.64.214', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRVVkc2lwWURrM2pic0FFTFhWUmcxdzJlZVY3Q3lnd2g5TTF4VVZ6NiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630281046),
('qZvoMfD4ZjzzhUGCNSty0T9t4Dpr4in5fvgZJXTu', NULL, '88.99.148.111', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRGc4VzNKSFNTVldKdTJaeVVEYXNzV2REMXRHamxsb1dzUGh2djFyOSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280619),
('rcrD2PCPdTU8nLLsD5moYkFE6RnIGXpSIovAQ1bU', NULL, '3.239.1.59', 'Slackbot-LinkExpanding 1.0 (+https://api.slack.com/robots)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTjRoZk5YUWNwQnJudk9xSUxnWmpVdXM3WnBWR3lVczhONWM4ZTlXQSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280296),
('Rk51HCQl0O7wfmizzkP213NLbKc9HOXgvWpTCYof', NULL, '88.198.16.182', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaW5ZTW1icjN6VTlrNElMcjR3NDJCYnZ6N1NReURta1NNMGZxWmxxcSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280652),
('rS8gYyOuoD4nnnw5VpDBooOl6GYExOzEqu09usAA', NULL, '190.74.86.37', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSEdtZ2VKOG81NWxIeG5TYXN4MlVRTTJUb3hLNWRvSTFGcTdLNnpoTiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630288952),
('ruGPnw5Ju3FdhBlzVornUTXrnaSSkKJvnhpdw8Vm', NULL, '94.130.67.180', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVTBFYnNVOVFaeW9JaHJtSkplczdPOXRUSDJ6V3NESkdaVWt0dk9RcCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280733),
('SFlCXsXMUo7p1ArGQstLsd5vm3W6XnMz0EE9wufB', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicHJkUlhjdTRPbVpRSkxHODMweWkwWnY0eWdrRUpvS3lkQTMwT2dYWiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280443),
('Sm0I8e0Bqp4S729tjt1z235TbqdokYQdlA5HzF1x', NULL, '195.201.245.126', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzRRMkdLRXhTT2VOa0s0Ym00Y2pNUEYwTllQQVNxWjNuNExqTzI5NiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280790),
('sp1me0432bi8Lf8t5zkzHrnTzxQgHs1jgHk4uZnX', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicjZUbU5Oc0k0NmRoOW1zZnE1Y0lFR0RLNzg0b3JBNnVUdE11UDByQyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280328),
('Sv8J4HirhMTovFV6c7HiytpGrjle7LEyYiPaIY4c', NULL, '88.198.16.187', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUpZQ2dDT2tBWFpabHpuSll1YzFvTTlHajB1NHlRNHpNNEF3enFadCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280491),
('SVzCovHaPa56z4WhyoXS2cnrVZ2pQSLsAbbYzBVp', NULL, '185.53.90.24', 'Go-http-client/1.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS1FLSm5vTWFDWUFxeDVqMUJodndmekw0Y3dJMG9wUEtXVlU2YTNrMSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9pY2FuaGF6aXAuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630297289),
('T5NuaVfwem9gWbBoZFvmCr8jPUNYsTEeSKLZ5nng', NULL, '102.39.109.58', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/601.7.7 (KHTML, like Gecko) Version/9.1.2 Safari/601.7.7', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOTd3WHppNGx2WjZsZnhYNnkwdks1dERBNFY5dHdqRnFKY012UzJZTyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630297848),
('tc3xOt0Dq7wzXsMa632HuPguhe5smUfrdIY6C2u5', NULL, '88.99.144.161', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN2xwSmI3MXlrcWxYM2YwS3hBOENiZjFSQVIxMUt4VG4xMUptc0RRbCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630281273),
('THt52VwaOg2LwTkZsZkjpXm2sltV2zqBz7cXrDcF', NULL, '52.204.27.85', 'Mozilla/5.0 (compatible)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOGlFQWViMzlZa2luWWFIWU5CS0tSUHNhTjRtM1cwY1dBdDA0ZmNCaiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630281267),
('toWQJfgTHDIs4kkeGK9vGxRBZ8ZlFaqtApiZ6sKU', NULL, '178.72.70.189', 'Hello, world', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMnA0NGU4aGlGYk9RRmpXR1FXYjBHcmhacXVWa1VXR0ZoQWZ6WmxQWiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNTY6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvc2hlbGw/Y2QlMjAlMkZ0bXAlM0JybSUyMC1yZiUyMCUyQSUzQndnZXQlMjBodHRwJTNBJTJGJTJGMTkyLjE2OC4xLjElM0E4MDg4JTJGTW96aS5hJTNCY2htb2QlMjA3NzclMjBNb3ppLmElM0IlMkZ0bXAlMkZNb3ppLmElMjBqYXdzPSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjE1NjoiaHR0cDovLzE5Mi4yNDEuMTMyLjEzNy9zaGVsbD9jZCUyMCUyRnRtcCUzQnJtJTIwLXJmJTIwJTJBJTNCd2dldCUyMGh0dHAlM0ElMkYlMkYxOTIuMTY4LjEuMSUzQTgwODglMkZNb3ppLmElM0JjaG1vZCUyMDc3NyUyME1vemkuYSUzQiUyRnRtcCUyRk1vemkuYSUyMGphd3M9Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630292057),
('TV1oNg80YjUquWsM3cKwougWrdyoxKbdDKQKYVLj', NULL, '159.69.60.36', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZUExdXdvNkp1YlE1RlRZWGVrVDlMd1Z2ek55b0tLdDNxVmhpbjhhaCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280547),
('usJrDADIYxCj6Cs2E5Gkz2Exwmt29Fr4y9lrTCTJ', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid3dHYmVKMkJJcU5tdXk0TDVXeTdhc21GWHZidU4wckFLc0RPZUJHRyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280990),
('uvdufqp0Lt0kxjcPNT2YvpujYfjMyjqbKWTm8KFo', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRjVLeG1PYjd1ajNHZkREb25DYVRYNnJGQ01tZmtVWW52N252dmUyViI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630313866),
('vAVU5nG3lBoxLlYlK1gO0Wjj8SzwjvCjWdC1WBeP', NULL, '138.201.31.160', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTG1JdlpBNGxvOUhhMVd2ZWpDb3g2eXNmQ3dwOWFMUmV4RHlKRHZVZSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280549);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vOLXndWAZ5SU0GNfgKGFjcgVG42UWMvbj6hlIUy8', NULL, '124.248.166.13', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRU9YTXF5enBrcnFpZE91eFBsVTFFa1BiOGxNeGxpMjBzMjdqTDN5TyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630308539),
('VSSSYj9zOMB1ct94xdg9JY7RSFfEFjgO0K4ddFU6', NULL, '105.157.72.234', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieTQ5YTJLMTdyTWhpQllteXF2YWRhZkxLYVdrYlRMS3V2Z20wMzFjMyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630282058),
('WfAM2ytJVnOsJS47SdkljHXNlO5w1mRi9Nntd1QM', NULL, '88.99.144.161', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkp6bjFuQXBxSUhzY2FBeTF5bWlSSDQxdEtrdHBEYXBQbGFXZTJmWSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630281273),
('WGIKI9pSobA5wFtKbMZwB5aKN6HGolLdUrUz1hRF', NULL, '124.253.99.20', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:92.0) Gecko/20100101 Firefox/92.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ2djcks2UWp6TzJraFF2c0pTZFpCWkJvTEVIbWlhd1Z6WW1XYjFjNiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630288220),
('X2iQq99Taw15iW3LlMb8tgtJE9bsyPoSvMnsz6T7', NULL, '195.201.245.32', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY016N0VUYjFLbmp4RGIyV3NWZ2FnMWNHdFQ2OGFZMlNad2hrVEY4diI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280730),
('XgOMXFIf4HCUX0nS0kdHLuPOhhhBT9FyZ5rsJ25O', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiczNId3JpclBQTW1aVVlKdmtWZTdCNXVKSjlBZ1dVdjdvcnh5d2t6byI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280821),
('xGpObVedr5bQ7ul8KTaqndGIo1eoi9uhKwpUumqP', NULL, '188.43.235.177', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiakxBNkpVSXMyZER0NnV4bnJMOVhWNjViV2pVemhDVDlZWUNjbHJtSCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvZ3Vlc3QvdHYiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280984),
('XGrZN8W4m1I9dhT0xy9fOw24tR07SdBplQFB0kUm', NULL, '154.177.222.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic0ZSdlMzQ3JhV0Q2Rkw1WXMya1BuV3VPM2RoSzNwM3Q3MndrVkxlaSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280564),
('Y4t9Gb5ahyPsFaYWlupUf84CBRciw242QfDTJHlM', NULL, '184.105.247.194', '', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidTB2VW5qWkxXUG40RzFtY2paVHRyU09UZ2kwNzAwMGhkTkg0QnFyZiI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630336606),
('ydjl4OiacYFbBPcsTANKqyxxDXMmCkDkxTrAB4wQ', NULL, '54.196.61.211', 'masscan/1.3 (https://github.com/robertdavidgraham/masscan)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVGhDNjZaM0hrYlR3a3dHN0NSOWpiQXNUdXVwR0wydjBubTNUdjBhOSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly8xMjcuMC4xLjEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630279436),
('yE4RGGBojAkdllzbPv1O8y8SVVchauF7s2vzTuf1', NULL, '72.255.51.144', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVDZSM1hkRTF0NWl2NFZzZllUU2pmTVR3U2NKamtQUEMwRVdOTXViTSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630280783),
('yEAcRAcy0gWsFyuXtT776UnF1MfUqWHP08cpEFnc', NULL, '88.99.148.110', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlBhNklGN3dLVnNhUUQyZ1FrSUliSEZaM3ZzWjNCZnRNakZ3TlRRMCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280936),
('yFGilQi8MHGGEprwrnThEEiQQnOQ0Lu5HcEDEZDX', NULL, '2.57.122.112', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVWlGRHYxNGdObmNPS1dnZkJ2eVF5ZmdsWUdoN1BzSE04bVY5RVhRMCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzE5Mi4yNDEuMTMyLjEzNy8uZW52Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvLmVudiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1630331648),
('YRYvLdmJoNmb8Ot4zAX9j1eQi3AyFwfZJxSfXjxv', NULL, '188.43.136.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUFZYVnp3UXJLbmlVemFPN01NMEZCeFZqT0N5UldjZDZQR0dJTExCMCI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630281097),
('z4EEEcvlvthOtaZ85KsgPiqBZRHC2miVUu8dqc7V', NULL, '192.161.60.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM2xRTmlXenFqQlpCU1BuNE9Kamlja2xHTkd0SjJPWUV4Y1ozZ2gxQSI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xOTIuMjQxLjEzMi4xMzcvcmVnaXN0ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1630282939),
('za0J8L6Dymx3pCXH7bss8zi1JbotyiKGv0NLxTrd', NULL, '88.99.144.157', 'Mozilla/5.0 (compatible; um-LN/1.0; mailto: techinfo@ubermetrics-technologies.com; Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmRoT1g4MkEwQjVsb2dVOHdBa0Q3c1FKYnZBUnN1NTVJYmVrTUhxSyI7czoxNjoiY2hhbmdlZF9sYW5ndWFnZSI7czoyOiJlbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1630280711);

-- --------------------------------------------------------

--
-- Table structure for table `social_icons`
--

CREATE TABLE `social_icons` (
  `id` int NOT NULL,
  `url1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_icons`
--

INSERT INTO `social_icons` (`id`, `url1`, `url2`, `url3`, `created_at`, `updated_at`) VALUES
(1, '#', '#', '#', '2020-11-02 09:09:08', '2020-11-02 09:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `splash_screens`
--

CREATE TABLE `splash_screens` (
  `id` int UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_enable` tinyint(1) NOT NULL DEFAULT '1',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `splash_screens`
--

INSERT INTO `splash_screens` (`id`, `image`, `logo_enable`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'splashscreen_1606805126image.jpg', 0, 'splashscreen_1606805126logo.png', NULL, '2021-08-25 00:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `subcomments`
--

CREATE TABLE `subcomments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `blog_id` int NOT NULL,
  `comment_id` int NOT NULL,
  `reply` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `subscription_from` timestamp NULL DEFAULT NULL,
  `subscription_to` timestamp NULL DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint UNSIGNED NOT NULL,
  `subscription_id` bigint UNSIGNED NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subtitles`
--

CREATE TABLE `subtitles` (
  `id` int UNSIGNED NOT NULL,
  `sub_lang` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_t` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_t_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ep_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int UNSIGNED NOT NULL,
  `language_id` int UNSIGNED NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tv_series`
--

CREATE TABLE `tv_series` (
  `id` int UNSIGNED NOT NULL,
  `keyword` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmdb_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmdb` char(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fetch_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poster` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `rating` double(8,2) DEFAULT NULL,
  `episode_runtime` double(8,2) DEFAULT NULL,
  `maturity_rating` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `type` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'T',
  `status` int UNSIGNED NOT NULL DEFAULT '1',
  `created_by` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_custom_label` tinyint(1) NOT NULL DEFAULT '0',
  `label_id` int DEFAULT NULL,
  `is_upcoming` tinyint(1) NOT NULL DEFAULT '0',
  `upcoming_date` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tv_series`
--

INSERT INTO `tv_series` (`id`, `keyword`, `description`, `title`, `tmdb_id`, `tmdb`, `fetch_by`, `thumbnail`, `poster`, `genre_id`, `detail`, `rating`, `episode_runtime`, `maturity_rating`, `featured`, `type`, `status`, `created_by`, `created_at`, `updated_at`, `is_custom_label`, `label_id`, `is_upcoming`, `upcoming_date`) VALUES
(2, '{\"en\":null}', '{\"en\":null}', 'برنامج الجنرال - الكاميرا الخفيه', NULL, 'N', NULL, 'thumb_1629991341Screen Shot 2021-08-26 at 7.21.47 PM.png', 'poster_1629991341Screen Shot 2021-08-26 at 7.21.10 PM.png', '2', '{\"en\":\"Camera Prank Show\"}', 10.00, NULL, 'all age', 1, 'T', 1, 3, '2021-08-26 20:52:21', '2021-08-26 21:20:43', 0, NULL, 0, NULL),
(3, '{\"en\":null}', '{\"en\":null}', 'برنامج مستر شيف', NULL, 'N', NULL, 'thumb_1629994296Screen Shot 2021-08-26 at 7.58.26 PM.png', 'poster_1629994236Screen Shot 2021-08-26 at 7.57.39 PM.png', '3', '{\"en\":\"Healthy food easy to make for everyone\"}', 10.00, NULL, 'all age', 1, 'T', 1, 3, '2021-08-26 21:29:10', '2021-08-26 21:41:36', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifyToken` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gitlab_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` int DEFAULT '0',
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `braintree_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_assistant` int UNSIGNED NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_blocked` tinyint(1) DEFAULT '0',
  `amazon_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `google2fa_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google2fa_enable` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `verifyToken`, `status`, `password`, `google_id`, `facebook_id`, `gitlab_id`, `dob`, `age`, `mobile`, `braintree_id`, `code`, `is_admin`, `is_assistant`, `remember_token`, `is_blocked`, `amazon_id`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`, `google2fa_secret`, `google2fa_enable`) VALUES
(1, 'Admin', NULL, 'admin@aeq.ae', NULL, 1, '$2y$10$71qyeo3xrdtTeGF.y7z0yeY2V1HKQ4flJltxyt.rhQWEvw/ebQ9Xy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 0, NULL, '2020-11-02 14:15:56', '2021-08-26 20:24:47', NULL, NULL, NULL, NULL, NULL, 0),
(2, 'user test', NULL, 'testuser@gmail.com', 'ARSfy', 1, '$2y$10$bdINcuUHozPERrBMHq5rbeL4M.Kzn4xAhLVwfM/E15ddpSlyGVf6i', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, '2021-08-25 10:30:26', '2021-08-25 10:30:26', NULL, NULL, NULL, NULL, NULL, 0),
(3, 'Admin', NULL, 'admin@admin.com', NULL, 1, '$2y$10$FS61AA7Pq8Of4MyNROIET.xlg7s87Qd32/xC8hhNxsVHgkCqqCiFi', NULL, NULL, NULL, '1980-01-01', 41, NULL, NULL, NULL, 1, 0, NULL, 0, NULL, '2021-08-26 20:21:54', '2021-08-26 20:21:54', NULL, NULL, NULL, NULL, NULL, 0),
(4, 'nasser', NULL, 'nasser@aeq.ae', 'DjeA3ppuYT1FDTg3SEMFvaQXTYwdqSeOPn7QIqXZ', 1, '$2y$10$2LqQ2PWGyFt4LXwhJ2JTNu.ybo/HKr9VmVBCyuEZa9LGfIBd/2iMi', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, '2021-08-26 20:22:33', '2021-08-26 20:22:33', NULL, NULL, NULL, NULL, NULL, 0),
(5, 'test', NULL, 'test@test.com', 'vHQfJ2LIBE0mjbbyAjJy1c6RMcgO5VRJzN7RFcPf', 1, '$2y$10$yFaW1pU7pmNyU8yTtP/PduwUzpUilcefMzCnin6fNrvpli2ceBTgK', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, '2021-08-26 22:11:51', '2021-08-26 22:11:51', NULL, NULL, NULL, NULL, NULL, 0),
(6, 'Daniel', NULL, 'linodeBp18@gmail.com', 'Jeamp8mszlmoE0lboG52oMAZEfGSOrTnaLynwIzi', 1, '$2y$10$c3IepYIjwhtbyXd/V7lb.OVpuRClsQlLEgOJQlvduWnWHPl94iIwW', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, '2021-08-30 05:14:42', '2021-08-30 05:14:42', NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

CREATE TABLE `user_ratings` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `tv_id` int DEFAULT NULL,
  `movie_id` int DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videolinks`
--

CREATE TABLE `videolinks` (
  `id` int UNSIGNED NOT NULL,
  `movie_id` int UNSIGNED DEFAULT NULL,
  `episode_id` int UNSIGNED DEFAULT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iframeurl` text COLLATE utf8mb4_unicode_ci,
  `ready_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_360` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_480` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_720` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_1080` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `upload_video` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videolinks`
--

INSERT INTO `videolinks` (`id`, `movie_id`, `episode_id`, `type`, `iframeurl`, `ready_url`, `url_360`, `url_480`, `url_720`, `url_1080`, `created_at`, `updated_at`, `upload_video`) VALUES
(2, NULL, 2, 'readyurl', NULL, 'https://alenwan.fra1.cdn.digitaloceanspaces.com/test/Screen%20Recording%202021-02-03%20at%203.11.07%20AM.mov', NULL, NULL, NULL, NULL, '2021-08-26 20:55:49', '2021-08-26 22:39:07', NULL),
(3, NULL, 3, 'readyurl', NULL, 'https://www.youtube.com/embed/9b2v8wwB8Pg', NULL, NULL, NULL, NULL, '2021-08-26 20:56:30', '2021-08-26 21:01:32', NULL),
(4, NULL, 4, 'iframeurl', 'https://www.youtube.com/embed/4qBLDOe4uAk', NULL, NULL, NULL, NULL, NULL, '2021-08-26 20:57:06', '2021-08-26 21:02:03', NULL),
(5, NULL, 5, 'readyurl', NULL, 'https://www.youtube.com/embed/cpBvb1mrp8A', NULL, NULL, NULL, NULL, '2021-08-26 21:31:03', '2021-08-26 21:31:03', NULL),
(6, NULL, 6, 'readyurl', NULL, 'https://www.youtube.com/embed/Deadbh8r6W4', NULL, NULL, NULL, NULL, '2021-08-26 21:32:27', '2021-08-26 21:42:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int UNSIGNED NOT NULL,
  `viewable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewable_id` bigint UNSIGNED NOT NULL,
  `visitor` text COLLATE utf8mb4_unicode_ci,
  `collection` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `viewable_type`, `viewable_id`, `visitor`, `collection`, `viewed_at`) VALUES
(13, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:04:52'),
(14, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:06:15'),
(15, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:06:37'),
(16, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:17:03'),
(17, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:18:39'),
(18, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:24:31'),
(19, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:32:50'),
(20, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:33:19'),
(21, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:35:09'),
(22, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:36:00'),
(23, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:36:56'),
(24, 'App\\Season', 3, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:38:01'),
(25, 'App\\Season', 3, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:38:32'),
(26, 'App\\Season', 3, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:39:20'),
(27, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:39:24'),
(28, 'App\\Season', 3, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:40:47'),
(29, 'App\\Season', 3, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:41:06'),
(30, 'App\\Season', 3, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:41:39'),
(31, 'App\\Season', 3, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 21:45:47'),
(32, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 22:29:59'),
(33, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 22:32:55'),
(34, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 22:35:43'),
(35, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 22:39:15'),
(36, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 22:43:47'),
(37, 'App\\Season', 3, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 22:48:01'),
(38, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-26 22:52:31'),
(39, 'App\\Season', 2, 'wZ92ou7MUUfQ9gQicg79GoAhXz59EvS4X27KB25nuMD4ZkEgdcHnjjeTmywet4K8KCOc9qznzNKtTGA2', NULL, '2021-08-30 05:33:02'),
(40, 'App\\Season', 2, 'EGGpSEEitQYaaVUxeeM6W5xoUZsaKKQUBelWQzp5K0abpRYlZEWKbep8uxcGblx9DwznFR9OmHR71MK6', NULL, '2021-08-30 05:37:31'),
(41, 'App\\Season', 2, '8Ob7pAcBPuLUhG5xJqeSCya4GT9XPLLeSnheChzQwWFtnPyvKsLBrEf9m8CppzYRCQMkpPq7f4uGncus', NULL, '2021-08-30 15:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `watch_histories`
--

CREATE TABLE `watch_histories` (
  `id` int NOT NULL,
  `movie_id` int DEFAULT NULL,
  `tv_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `watch_histories`
--

INSERT INTO `watch_histories` (`id`, `movie_id`, `tv_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, NULL, 2, 3, '2021-08-26 21:05:05', '2021-08-26 21:05:05'),
(4, NULL, 3, 3, '2021-08-26 21:41:54', '2021-08-26 21:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `movie_id` int DEFAULT NULL,
  `season_id` int DEFAULT NULL,
  `added` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `movie_id`, `season_id`, `added`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 2, 1, '2021-08-26 22:33:44', '2021-08-26 22:33:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adsenses`
--
ALTER TABLE `adsenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_configs`
--
ALTER TABLE `app_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_sliders`
--
ALTER TABLE `app_sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_sliders_movie_id_foreign` (`movie_id`),
  ADD KEY `app_sliders_tv_series_id_foreign` (`tv_series_id`);

--
-- Indexes for table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audio_languages`
--
ALTER TABLE `audio_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_customizes`
--
ALTER TABLE `auth_customizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_menu`
--
ALTER TABLE `blog_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buttons`
--
ALTER TABLE `buttons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_settings`
--
ALTER TABLE `chat_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_schemes`
--
ALTER TABLE `color_schemes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_applies`
--
ALTER TABLE `coupon_applies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_callback_addresses`
--
ALTER TABLE `cp_callback_addresses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cp_callback_addresses_address_currency_unique` (`address`,`currency`);

--
-- Indexes for table `cp_conversions`
--
ALTER TABLE `cp_conversions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cp_conversions_ref_id_unique` (`ref_id`),
  ADD KEY `cp_conversions_from_index` (`from`),
  ADD KEY `cp_conversions_to_index` (`to`);

--
-- Indexes for table `cp_deposits`
--
ALTER TABLE `cp_deposits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cp_deposits_txn_id_unique` (`txn_id`),
  ADD KEY `cp_deposits_address_index` (`address`);

--
-- Indexes for table `cp_ipns`
--
ALTER TABLE `cp_ipns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cp_ipns_ipn_id_unique` (`ipn_id`),
  ADD KEY `cp_ipns_address_index` (`address`);

--
-- Indexes for table `cp_log`
--
ALTER TABLE `cp_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_mass_withdrawals`
--
ALTER TABLE `cp_mass_withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_transactions`
--
ALTER TABLE `cp_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cp_transactions_txn_id_unique` (`txn_id`);

--
-- Indexes for table `cp_transfers`
--
ALTER TABLE `cp_transfers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cp_transfers_ref_id_unique` (`ref_id`),
  ADD KEY `cp_transfers_status_index` (`status`);

--
-- Indexes for table `cp_withdrawals`
--
ALTER TABLE `cp_withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cp_withdrawals_ref_id_unique` (`ref_id`),
  ADD UNIQUE KEY `cp_withdrawals_txn_id_unique` (`txn_id`),
  ADD KEY `cp_withdrawals_mass_withdrawal_id_index` (`mass_withdrawal_id`);

--
-- Indexes for table `custom_pages`
--
ALTER TABLE `custom_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donater_lists`
--
ALTER TABLE `donater_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episodes_seasons_id_foreign` (`seasons_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_slider_updates`
--
ALTER TABLE `front_slider_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `google_ads`
--
ALTER TABLE `google_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_blocks`
--
ALTER TABLE `home_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_sliders`
--
ALTER TABLE `home_sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `home_sliders_movie_id_foreign` (`movie_id`),
  ADD KEY `home_sliders_tv_series_id_foreign` (`tv_series_id`);

--
-- Indexes for table `home_translations`
--
ALTER TABLE `home_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landing_pages`
--
ALTER TABLE `landing_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_events`
--
ALTER TABLE `live_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_payments`
--
ALTER TABLE `manual_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_payment_methods`
--
ALTER TABLE `manual_payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `manual_payment_methods_payment_name_unique` (`payment_name`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_genre_shows`
--
ALTER TABLE `menu_genre_shows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_sections`
--
ALTER TABLE `menu_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_videos`
--
ALTER TABLE `menu_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_videos_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_videos_movie_id_foreign` (`movie_id`),
  ADD KEY `menu_videos_tv_series_id_foreign` (`tv_series_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_comments`
--
ALTER TABLE `movie_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_series`
--
ALTER TABLE `movie_series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_series_movie_id_foreign` (`movie_id`);

--
-- Indexes for table `movie_subcomments`
--
ALTER TABLE `movie_subcomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multiplescreens`
--
ALTER TABLE `multiplescreens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multiple_links`
--
ALTER TABLE `multiple_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_features`
--
ALTER TABLE `package_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_menu`
--
ALTER TABLE `package_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paypal_subscriptions`
--
ALTER TABLE `paypal_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plans_email_unique` (`email`);

--
-- Indexes for table `player_settings`
--
ALTER TABLE `player_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing_texts`
--
ALTER TABLE `pricing_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminder_mails`
--
ALTER TABLE `reminder_mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seasons_tv_series_id_foreign` (`tv_series_id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `social_icons`
--
ALTER TABLE `social_icons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `splash_screens`
--
ALTER TABLE `splash_screens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcomments`
--
ALTER TABLE `subcomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_subscription_id_stripe_plan_unique` (`subscription_id`,`stripe_plan`),
  ADD KEY `subscription_items_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `subtitles`
--
ALTER TABLE `subtitles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tv_series`
--
ALTER TABLE `tv_series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `google_id` (`google_id`),
  ADD UNIQUE KEY `facebook_id` (`facebook_id`),
  ADD UNIQUE KEY `gitlab_id` (`gitlab_id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `amazon_id` (`amazon_id`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videolinks`
--
ALTER TABLE `videolinks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videolinks_movie_id_foreign` (`movie_id`),
  ADD KEY `videolinks_episode_id_foreign` (`episode_id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `views_viewable_type_viewable_id_index` (`viewable_type`,`viewable_id`);

--
-- Indexes for table `watch_histories`
--
ALTER TABLE `watch_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adsenses`
--
ALTER TABLE `adsenses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_configs`
--
ALTER TABLE `app_configs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_sliders`
--
ALTER TABLE `app_sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audio`
--
ALTER TABLE `audio`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audio_languages`
--
ALTER TABLE `audio_languages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_customizes`
--
ALTER TABLE `auth_customizes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_menu`
--
ALTER TABLE `blog_menu`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buttons`
--
ALTER TABLE `buttons`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat_settings`
--
ALTER TABLE `chat_settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `color_schemes`
--
ALTER TABLE `color_schemes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon_applies`
--
ALTER TABLE `coupon_applies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cp_callback_addresses`
--
ALTER TABLE `cp_callback_addresses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cp_conversions`
--
ALTER TABLE `cp_conversions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cp_deposits`
--
ALTER TABLE `cp_deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cp_ipns`
--
ALTER TABLE `cp_ipns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cp_log`
--
ALTER TABLE `cp_log`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cp_mass_withdrawals`
--
ALTER TABLE `cp_mass_withdrawals`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cp_transactions`
--
ALTER TABLE `cp_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cp_transfers`
--
ALTER TABLE `cp_transfers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cp_withdrawals`
--
ALTER TABLE `cp_withdrawals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_pages`
--
ALTER TABLE `custom_pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donater_lists`
--
ALTER TABLE `donater_lists`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `front_slider_updates`
--
ALTER TABLE `front_slider_updates`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `google_ads`
--
ALTER TABLE `google_ads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_blocks`
--
ALTER TABLE `home_blocks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_sliders`
--
ALTER TABLE `home_sliders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_translations`
--
ALTER TABLE `home_translations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing_pages`
--
ALTER TABLE `landing_pages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_events`
--
ALTER TABLE `live_events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manual_payments`
--
ALTER TABLE `manual_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manual_payment_methods`
--
ALTER TABLE `manual_payment_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_genre_shows`
--
ALTER TABLE `menu_genre_shows`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menu_sections`
--
ALTER TABLE `menu_sections`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu_videos`
--
ALTER TABLE `menu_videos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie_comments`
--
ALTER TABLE `movie_comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie_series`
--
ALTER TABLE `movie_series`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie_subcomments`
--
ALTER TABLE `movie_subcomments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `multiplescreens`
--
ALTER TABLE `multiplescreens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `multiple_links`
--
ALTER TABLE `multiple_links`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package_features`
--
ALTER TABLE `package_features`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package_menu`
--
ALTER TABLE `package_menu`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paypal_subscriptions`
--
ALTER TABLE `paypal_subscriptions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `player_settings`
--
ALTER TABLE `player_settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pricing_texts`
--
ALTER TABLE `pricing_texts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminder_mails`
--
ALTER TABLE `reminder_mails`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_icons`
--
ALTER TABLE `social_icons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `splash_screens`
--
ALTER TABLE `splash_screens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcomments`
--
ALTER TABLE `subcomments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subtitles`
--
ALTER TABLE `subtitles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tv_series`
--
ALTER TABLE `tv_series`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_ratings`
--
ALTER TABLE `user_ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videolinks`
--
ALTER TABLE `videolinks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `watch_histories`
--
ALTER TABLE `watch_histories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cp_deposits`
--
ALTER TABLE `cp_deposits`
  ADD CONSTRAINT `cp_deposits_address_foreign` FOREIGN KEY (`address`) REFERENCES `cp_callback_addresses` (`address`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `cp_withdrawals`
--
ALTER TABLE `cp_withdrawals`
  ADD CONSTRAINT `cp_withdrawals_mass_withdrawal_id_foreign` FOREIGN KEY (`mass_withdrawal_id`) REFERENCES `cp_mass_withdrawals` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
