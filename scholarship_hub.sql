-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 22, 2025 at 02:57 AM
-- Server version: 8.4.3
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarship_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `scholarship_id` bigint UNSIGNED NOT NULL,
  `motivation_essay` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `scholarship_id`, `motivation_essay`, `resume`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(3, 14, 12, 'Test', 'resumes/8f4UQvSdFzkBLUHBugtp3TEdHRIWquu7v2V1P9i7.docx', '0967776599', 'rwerwer', 'approved', '2025-12-04 02:51:18', '2025-12-10 11:42:03'),
(4, 14, 13, 'Test', NULL, '0967776599', 'Test', 'approved', '2025-12-05 05:32:27', '2025-12-10 23:36:40'),
(5, 14, 13, 'Test', NULL, '0967776599', 'Test', 'approved', '2025-12-05 05:32:28', '2025-12-10 11:51:47'),
(6, 13, 14, 'dfgf', 'resumes/Bdun7xrGPn3kAWI6lLc2tD7LcfgF2fPHD2NWh8IR.docx', '0967776599', 'erdf', 'approved', '2025-12-10 11:58:20', '2025-12-10 23:36:32'),
(7, 13, 14, 'rwer', 'resumes/sCDQ1kvJqH5c8fLl5np9yDKEcC7TlCWh4TbPO40O.docx', '0967776599', 'wer', 'approved', '2025-12-10 12:02:13', '2025-12-10 23:24:02'),
(8, 13, 14, 'Ingvanly', 'resumes/1z18hF6EwPY5rtKzKZBH87UddqCd4Vd9CV6KVj2m.docx', '0967776599', 'Test', 'rejected', '2025-12-11 01:16:32', '2025-12-11 01:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `excerpt`, `content`, `published`, `published_at`, `created_at`, `updated_at`) VALUES
(3, 'How a Rural Student Earned a Full Scholarship to Study Abroad', 'how-a-rural-student-earned-a-full-scholarship-to-study-abroad', 'A young Cambodian student shares her inspiring journey from a small village to earning a full scholarship to Singapore.', 'Growing up in a small farming community in Kampong Cham, Sokha never imagined she would one day study overseas. Her journey began with dedication, late-night study sessions, and a strong passion for learning.\r\n\r\nAfter graduating high school with one of the highest GPAs in her district, she applied for the ASEAN Future Leaders Scholarship. Despite facing strong competition, Sokha stood out due to her academic record, volunteer work, and leadership in community projects.\r\n\r\nToday, she is pursuing her Bachelor’s degree in Computer Science in Singapore. Sokha hopes to return to Cambodia with the skills and experience needed to contribute to the nation’s digital development.\r\n\r\nHer story serves as an inspiration to students across Cambodia who dream of creating a brighter future through education.', 1, '2025-12-03 17:00:00', '2025-12-04 02:48:31', '2025-12-04 02:48:31'),
(4, 'សាកលវិទ្យាល័យបើកកម្មវិធីអាហារូបករណ៍ថ្មីសម្រាប់ឆ្នាំ 2025', '2025', 'កម្មវិធីអាហារូបករណ៍ថ្មីសម្រាប់សិស្សអង់តេប្រទេសកំពុងបើកដំណើរការ។', 'ក្នុងឆ្នាំ 2025 សាកលវិទ្យាល័យជាច្រើនបានបើកកម្មវិធីអាហារូបករណ៍ថ្មីដូចជា STEM, AI, Agriculture, Business Management។\r\nកម្មវិធីទាំងនេះផ្តោតលើការចិញ្ចឹមយុវជនឱ្យក្លាយជាមេដឹកនាំថ្មី។\r\n\r\nសិស្សអាចដាក់ពាក្យតាម Website ផ្លូវការ។', 1, '2025-12-04 17:00:00', '2025-12-05 00:41:51', '2025-12-05 00:41:51'),
(5, '៧ គន្លឹះសំខាន់សម្រាប់ទទួលបានអាហារូបករណ៍ក្រៅប្រទេស  Categories:', 'categories', 'បើអ្នកចង់ទទួលបានអាហារូបករណ៍ អ្នកត្រូវមានការរៀបចំល្អ។ នេះជាគន្លឹះសំខាន់ៗដែលមិនគួររំលង។', 'ការទទួលបានអាហារូបករណ៍នៅបរទេសមិនមែនជារឿងសាមញ្ញទេ តែការរៀបចំល្អអាចធ្វើឱ្យអ្នកលេចធ្លោ។\r\n១. រក្សា GPA ឱ្យខ្ពស់\r\n២. ចូលរួមសកម្មភាពស្ម័គ្រចិត្ត\r\n៣. បង្កើត CV ឱ្យមានគុណភាព\r\n៤. សរសេរ Motivation Letter ឱ្យច្បាស់លាស់\r\n៥. ជ្រើសរើស Recommendation Letter ត្រឹមត្រូវ\r\n៦. សិក្សាព័ត៌មានអាហារូបករណ៍ជាមុន\r\n៧. ដាក់ពាក្យមុនគេ', 1, '2025-12-04 17:00:00', '2025-12-05 00:42:43', '2025-12-05 00:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `id` bigint UNSIGNED NOT NULL,
  `article_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `article_id`, `category_id`, `created_at`, `updated_at`) VALUES
(4, 3, 5, NULL, NULL),
(5, 4, 8, NULL, NULL),
(6, 5, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `footer_text` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `name`, `email`, `phone`, `website`, `address`, `footer_text`, `logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, 'VanlyKhochJit', 'VanlyKhochJit@gmail.com', '0967776599', 'https://www.youtube.com/', 'SiemReap, Cambodia', 'VanlyKhochJit', 'business-settings/JEUyYEpVHhRPbRd6b81IGBx8p9nmfhQkCQNWFKUe.png', 'business-settings/eBl6vVIKNkLzLjTi9mDTc7QgedDJ57q4PXeUgmbb.png', '2025-12-04 09:25:05', '2025-12-11 01:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-50cc23fe01b9112da5a4e61885e68744', 'i:1;', 1765441211),
('laravel-cache-50cc23fe01b9112da5a4e61885e68744:timer', 'i:1765441211;', 1765441211),
('laravel-cache-c525a5357e97fef8d3db25841c86da1a', 'i:1;', 1765422231),
('laravel-cache-c525a5357e97fef8d3db25841c86da1a:timer', 'i:1765422231;', 1765422231);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(5, 'Student Success Stories', 'student-success-stories', 'ប្រើសម្រាប់អត្ថបទដែលពិពណ៌នាពីជោគជ័យរបស់និស្សិត ឬអតីតនិស្សិត។\r\nជំពូកនេះមានប្រយោជន៍សម្រាប់បង្ហាញរឿងពិត និងការលូតលាស់របស់អាហារូបករណ៍និងកម្មវិធីសិក្សា។\r\nវាត្រូវបានបង្ហាញនៅក្នុងផ្ទាំងស្វែងរករបស់ Newsroom និងនៅលើទំព័រអត្ថបទលម្អិត។', '2025-12-04 02:43:52', '2025-12-04 02:43:52'),
(6, 'Scholarship Tips', 'scholarship-tips', 'ប្រើសម្រាប់អត្ថបទណែនាំអំពីវិធីដាក់ពាក្យ អ្វីដែលត្រូវរៀបចំ និងបទពិសោធន៍ទាក់ទងនឹងអាហារូបករណ៍។', '2025-12-05 00:39:32', '2025-12-05 00:39:32'),
(7, 'Student Life', 'student-life', 'ប្រើសម្រាប់អត្ថបទបង្ហាញពីជីវិតសិក្សា ជីវិតក្នុងសាលា កន្លែងសិក្សា និងសកម្មភាពនិស្សិត។', '2025-12-05 00:39:45', '2025-12-05 00:39:45'),
(8, 'Education News', 'education-news', 'ប្រើសម្រាប់ព័ត៌មានថ្មីៗអំពីការអប់រំ អាហារូបករណ៍ថ្មី កម្មវិធីសិក្សា និងព្រឹត្តិការណ៍សិក្សា។', '2025-12-05 00:40:07', '2025-12-05 00:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(5, 'Ingvanly', 'ingvanly168@gmail.com', 'English', 'Hello', 1, '2025-12-11 01:14:15', '2025-12-11 01:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_07_162127_add_two_factor_columns_to_users_table', 1),
(5, '2025_08_07_162226_create_personal_access_tokens_table', 1),
(6, '2025_08_10_123517_add_is_admin_to_users_table', 1),
(7, '2025_08_11_094413_create_scholarships_table', 1),
(8, '2025_08_20_122618_add_status_to_scholarships_table', 2),
(9, '2025_09_25_191500_create_roles_table', 3),
(10, '2025_09_25_191600_create_role_user_table', 3),
(11, '2025_01_19_120000_add_additional_fields_to_users_table', 4),
(12, '2025_10_27_113754_create_applications_table', 5),
(13, '2025_10_27_120059_create_scholarship_images_table', 5),
(14, '2025_11_22_082554_create_categories_table', 6),
(15, '2025_11_22_082703_create_articles_table', 6),
(16, '2025_11_22_082722_create_article_category_table', 6),
(17, '2025_11_23_090000_create_roles_table', 7),
(18, '2025_11_23_090100_add_role_id_to_users_table', 7),
(19, '2025_12_04_075507_create_contacts_table', 8),
(20, '2025_12_04_130000_create_business_settings_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ingvanly168@gmail.com', '$2y$12$HOvynIkraDpEYTTQh0.C/uIiB7ZuNSNCj7RHbo4hssfLoKPXKRlDu', '2025-12-08 05:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', 'Full system access and management permissions.', 1, '2025-12-03 19:30:36', '2025-12-03 19:35:39'),
(3, 'user', 'user', NULL, 0, '2025-12-03 19:47:25', '2025-12-03 19:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `id` bigint UNSIGNED NOT NULL,
  `scholarship_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eligibility_criteria` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `award_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_requirements` json NOT NULL,
  `application_deadline` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`id`, `scholarship_name`, `eligibility_criteria`, `award_amount`, `application_description`, `country`, `application_requirements`, `application_deadline`, `created_at`, `updated_at`, `status`) VALUES
(12, 'ASEAN Future Leaders Scholarship', 'ត្រូវជានិស្សិតបញ្ចប់អនុវិទ្យាល័យ ឬសិស្សថ្នាក់ទី១២\r\n\r\nGPA អប្បបរមា 3.5\r\n\r\nមានជំនាញភាសាអង់គ្លេសល្អ (IELTS 6.0 ឬ TOEFL 70)\r\n\r\nត្រូវមានសិទ្ធិស្នាក់នៅក្នុងប្រទេសអាស៊ាន', '5000', 'អាហារូបករណ៍នេះផ្តល់ឱកាសដល់សិស្សដែលមានលទ្ធភាពខ្ពស់ក្នុងតំបន់អាស៊ាន ដើម្បីសិក្សាថ្នាក់បរិញ្ញាបត្រ នៅសាកលវិទ្យាល័យឈានមុខក្នុងសិង្ហបុរី។\r\nអ្នកដាក់ពាក្យត្រូវត្រៀមឯកសារទាំងអស់ ហើយបំពេញពាក្យសុំតាមប្រព័ន្ធអនឡាញ។\r\nអ្នកឈ្នះអាហារូបករណ៍នឹងទទួលបានថវិកាឧបត្ថម្ភ ការរៀន និងការបណ្តុះបណ្តាលបន្ថែម។', 'Singapore', '[\"ពិន្ទុសិក្សាផ្លូវការ (Official Transcripts)\", \"Curriculum Vitae (CV)\", \"Personal Statement (500–700 words)\", \"Recommendation Letter 2 ប្រភព\", \"Passport Copy (valid for at least 1 year)\"]', '2025-12-25', '2025-12-04 02:41:17', '2025-12-04 23:55:15', 'active'),
(13, 'Global Excellence Scholarship Program', 'Must be an international student applying for an undergraduate program\r\n\r\nMinimum GPA of 3.7\r\n\r\nStrong leadership and community involvement\r\n\r\nMust submit English proficiency test (IELTS 6.5+ or TOEFL 80+)', '10000', 'The Global Excellence Scholarship aims to support outstanding international students who have demonstrated exceptional academic achievements and leadership potential.', 'United States', '[\"Official Transcripts\", \"Personal Statement (500–800 words)\", \"2 Recommendation Letters\", \"Proof of English Proficiency\", \"Passport Copy\"]', '2025-12-25', '2025-12-04 23:39:56', '2025-12-05 00:36:52', 'active'),
(14, 'អាហារូបករណ៍អនាគតភាសាអង់គ្លេស', 'ត្រូវជាសិស្សឬនិស្សិតមានចំណាប់អារម្មណ៍ខាងភាសាអង់គ្លេស\r\n\r\nGPA អប្បបរមា 3.2\r\n\r\nត្រូវមានលទ្ធផល IELTS 5.5 ឬ TOEFL 60\r\n\r\nត្រូវបង្ហាញការចូលរួមសកម្មភាពសហគមន៍', '2500', 'ត្រូវជាសិស្សឬនិស្សិតមានចំណាប់អារម្មណ៍ខាងភាសាអង់គ្លេស\r\n\r\nGPA អប្បបរមា 3.2\r\n\r\nត្រូវមានលទ្ធផល IELTS 5.5 ឬ TOEFL 60\r\n\r\nត្រូវបង្ហាញការចូលរួមសកម្មភាពសហគមន៍', 'United States', '[\"ពិន្ទុសិក្សាផ្លូវការ\", \"Recommendation Letter 1\", \"Passport Copy\", \"Essay 500 ពាក្យ\", \"រូបថត 4x6\"]', '2025-12-17', '2025-12-05 00:27:26', '2025-12-05 00:27:26', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_images`
--

CREATE TABLE `scholarship_images` (
  `id` bigint UNSIGNED NOT NULL,
  `scholarship_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scholarship_images`
--

INSERT INTO `scholarship_images` (`id`, `scholarship_id`, `image_path`, `created_at`, `updated_at`) VALUES
(24, 13, 'scholarship_gallery/RZoKWcvF65fVn2fK5QwDsBKlw7olTsJEVHDMV8mc.png', '2025-12-10 11:29:58', '2025-12-10 11:29:58'),
(27, 14, 'scholarship_gallery/BWtv6e7alKl2gE20CsDq52jAhUfIiB8atikV1zOy.png', '2025-12-10 11:31:36', '2025-12-10 11:31:36'),
(30, 12, 'scholarship_gallery/eDStlIGS4ijpLaFWSbujxUsLqW4L6VgHTr6AOgkc.png', '2025-12-10 11:32:27', '2025-12-10 11:32:27'),
(31, 12, 'scholarship_gallery/PpaChhrr11EgMOMgTanrvwNcCYJIoIMjPiJFD2Xh.png', '2025-12-10 11:32:27', '2025-12-10 11:32:27'),
(32, 14, 'scholarship_gallery/eENDREOfFxlxbe2kCS72J9c8TPG8ct4TnONBxdXV.png', '2025-12-10 11:35:16', '2025-12-10 11:35:16'),
(33, 14, 'scholarship_gallery/mh780GcyM06M2gneldFqqlHiXiDlGxPOD2PthyHI.png', '2025-12-10 11:35:16', '2025-12-10 11:35:16'),
(34, 13, 'scholarship_gallery/bN62h9KQ1w4zdAaPVKAG1CQZccEdlBYryxEZG6ez.png', '2025-12-10 11:35:56', '2025-12-10 11:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kNs7lrvj6BX7mo0FBvjQ6g0sZP2aauJ3PEs0Y2Qs', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSXNFRWFoWXpRUTBqeEM1eVFEejBXWDdOY01iaXRnMWNtTllVekJFTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwNCI7fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNDtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiR1VWY3Ylk4cjF1ZzhVdm15Li94Y3VPQmNqTzVxcDF2LzRleGVNTUlPb2tBOTlCRlJLL1YvYSI7fQ==', 1765443753),
('v4bPsvTpE0VyeGP72T5IU0y8x9eaXSWZEugl3zmo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXJ3dnBVaXZCNVNiSlpKazA5aXNCSFhEN2lPZm9zWjM2dkxRQUFoeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwNCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765443606);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `email`, `phone_number`, `profile_picture`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `is_active`) VALUES
(13, 1, 'Admin', NULL, 'admin@gmail.com', NULL, NULL, '2025-12-03 19:57:57', '$2y$12$OiN6iftL.xRWeqbsnzbDWex5fbhEWP4QQ0I2BnWshVNxslEbe3ZIy', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-03 19:57:57', '2025-12-03 19:57:57', 1),
(14, 3, 'Ing Vanly', NULL, 'ingvanly168@gmail.com', NULL, NULL, NULL, '$2y$12$uUf7bY8r1ug8Uvmy./xcuOBcjO5qp1v/4exeMMIOokA99BFRK/V/a', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-03 23:23:08', '2025-12-03 23:24:18', 1),
(15, NULL, 'Eng Vanly', NULL, 'engvanly@gmail.com', NULL, NULL, NULL, '$2y$12$FssetbSLGeEpucxUW9oUU.1R545zmuuLWrvSrKt0eHbrWEF/KAtuK', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 04:47:42', '2025-12-04 04:47:42', 1),
(16, 1, 'Nat Kimsreng', NULL, 'natkimsreng@gmail.com', NULL, NULL, NULL, '$2y$12$88kVyS/NQayuQhdkjSrYVO.99TNfNugGM/LNwd3tRvXKeMI595pBG', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-04 05:00:53', '2025-12-10 11:48:28', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_user_id_foreign` (`user_id`),
  ADD KEY `applications_scholarship_id_foreign` (`scholarship_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_category_article_id_foreign` (`article_id`),
  ADD KEY `article_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scholarship_images`
--
ALTER TABLE `scholarship_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scholarship_images_scholarship_id_foreign` (`scholarship_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `article_category`
--
ALTER TABLE `article_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `scholarship_images`
--
ALTER TABLE `scholarship_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_scholarship_id_foreign` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarships` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `article_category_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scholarship_images`
--
ALTER TABLE `scholarship_images`
  ADD CONSTRAINT `scholarship_images_scholarship_id_foreign` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarships` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
