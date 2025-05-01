-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2025 at 09:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `updated_at`) VALUES
(153, 1, 6, 'hii', '2025-04-04 07:52:12', '2025-04-04 07:52:12'),
(154, 1, NULL, 'hii', '2025-04-04 07:52:17', '2025-04-04 07:52:17'),
(155, 1, 6, 'hii', '2025-04-04 07:54:07', '2025-04-04 07:54:07'),
(156, 1, NULL, 'hi', '2025-04-04 07:55:31', '2025-04-04 07:55:31'),
(157, 1, 6, 'hii', '2025-04-04 07:55:38', '2025-04-04 07:55:38'),
(158, 6, NULL, 'hii', '2025-04-04 07:55:59', '2025-04-04 07:55:59'),
(159, 6, NULL, 'hii', '2025-04-29 09:49:37', '2025-04-29 09:49:37'),
(160, 1, NULL, 'jii', '2025-04-29 09:50:01', '2025-04-29 09:50:01'),
(161, 1, 6, 'jii', '2025-04-29 09:50:16', '2025-04-29 09:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(16, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(17, '2014_10_12_100000_create_password_resets_table', 1),
(18, '2019_08_19_000000_create_failed_jobs_table', 1),
(19, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(20, '2025_03_05_054339_create_projects_table', 1),
(21, '2025_03_05_054339_create_tasks_table', 1),
(22, '2025_03_11_114247_create_settings_table', 2),
(23, '2025_03_11_155145_drop_settings_table', 3),
(24, '2025_03_18_131501_create_activity_logs_table', 4),
(25, '2025_03_18_154408_create_activity_logs_table', 5),
(26, '2025_03_21_102834_create_updates_table', 6),
(27, '2025_03_24_125913_create_messages_table', 7),
(28, '2025_03_24_131823_create_messages_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed') NOT NULL DEFAULT 'Pending',
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `status`, `assigned_to`, `created_at`, `updated_at`, `user_id`, `start_date`, `end_date`) VALUES
(19, 'Write a blog post', 'A blog post is a web article where you can explore any topic of interest. Aspiring bloggers can create their own blog or contribute to an established one using various free and user-friendly online platforms. Blog posts can be customized in length and style, providing bloggers with the opportunity and freedom to discuss topics they are passionate about and share them with a wider audience.', 'In Progress', NULL, '2025-05-01 05:53:03', '2025-05-01 05:53:03', NULL, '2025-05-01 11:23:03', NULL),
(20, 'Create custom bookmarks', 'Avid readers, or individuals with friends who enjoy reading, may consider creating custom bookmarks. Various bookmarks can be made out of materials like paper, plastic, cardboard, or metal, and personalized with images or quotes that resonate with readers. This project reflects a passion for reading while providing thoughtful gifts for fellow readers.', 'In Progress', NULL, '2025-05-01 05:53:21', '2025-05-01 05:53:21', NULL, '2025-05-01 11:23:21', NULL),
(21, 'Create a flipbook', 'A flipbook refers to a series of sequential drawings on a pad of paper that create the illusion of animation when flipped through. Explore examples of flipbooks to understand different animation techniques. Then, grab a pad of paper and start planning the scene to animate.', 'In Progress', NULL, '2025-05-01 05:53:41', '2025-05-01 05:53:41', NULL, '2025-05-01 11:23:41', NULL),
(22, 'Create a game', 'If you enjoy games, consider designing your own card, board, or video game based on your skills and interests. Focus on the features you enjoy in existing games and incorporate those elements into your creation. Once your game is ready, invite friends or family to test it out and provide feedback.', 'In Progress', NULL, '2025-05-01 05:54:07', '2025-05-01 05:54:07', NULL, '2025-05-01 11:24:07', NULL),
(23, 'Weather forecasting system', 'This project can be appropriate for you if you are new to software development and are looking for simple project themes.\r\n\r\nWeather forecasting systems create precise predictions about the weather at a certain location and time by combining science and technology. Applications and systems for weather forecasting make predictions about the weather based on a variety of factors, including wind speed, humidity, temperature, pressure, and so forth.\r\n\r\nThis online application is part of the weather forecasting project.\r\nUsers can access it using a graphical user interface by entering their password and user ID. Unlike traditional weather forecasting systems that simply require the location, this application allows you to enter the weather.\r\nIn this application, on the other hand, users will manually enter the location\'s current parameters, and the system will use past data contained in the database to anticipate the location\'s weather.\r\nThe administrator enters historical weather data into the database on a regular basis. Since historical data is the system\'s primary source of information, the predictions will be far more precise and trustworthy.\r\nObjectives of the project:\r\n\r\nAccurate data\r\nPrevents mishaps by predicting the weather accurately.\r\nSupports the economy as it helps users plan their business activities.\r\nHealthy safety\r\nPortable\r\nUser-friendly\r\nCompatible with various operating systems such as Android, iOs, etc.\r\nCost-effective\r\nSupports infrastructure safety\r\nIt helps in planning out disaster management.', 'In Progress', NULL, '2025-05-01 05:55:08', '2025-05-01 05:55:08', NULL, '2025-05-01 11:25:08', NULL),
(24, 'Inventory Management System for Small Businesses', 'Problem Statement: Develop a system for small businesses to manage their inventory, sales, and order fulfillment.\r\nType: Desktop Application\r\nIndustry Area: Retail\r\nSoftware Expertise: Desktop application development (e.g., Java Swing, PyQt)\r\nUse Cases: Stock tracking, order processing, sales reporting\r\nOutcomes: Efficient inventory management, improved order fulfillment\r\nBenefits: Gain desktop application development skills, contribute to small businesses\r\nDuration: 2-3 months', 'In Progress', NULL, '2025-05-01 05:55:38', '2025-05-01 06:03:39', NULL, '2025-05-01 11:25:38', '2025-08-01 00:00:00'),
(25, 'Age Calculator Application', 'Problem Statement: Address the need for a convenient and user-friendly solution to calculate age by developing an Age Calculator Application, simplifying the process of determining age based on birthdate.\r\nType: Develop an Age Calculator Application.\r\nIndustry Area: Utility and Personal Productivity.\r\nSoftware Expertise: Mobile App Development (iOS, Android), Frontend Development (e.g., React Native), Date and Time Calculations.\r\nUse Cases: User Input for Birthdate, Age Calculation Algorithm, Display of Calculated Age.\r\nOutcomes: Efficient Age Calculation, User-friendly Interface, Quick Access to Age Information.\r\nBenefits: Convenience in Age Calculation, Time-saving for Users, Utility for Personal and Professional Use.\r\nDuration: 1-2 Months.', 'In Progress', NULL, '2025-05-01 05:56:03', '2025-05-01 06:01:41', NULL, '2025-05-01 11:26:03', '2025-07-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `id` int(11) NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 19, 6, NULL, NULL),
(12, 20, 12, NULL, NULL),
(13, 21, 6, NULL, NULL),
(14, 21, 12, NULL, NULL),
(15, 22, 6, NULL, NULL),
(16, 22, 12, NULL, NULL),
(17, 23, 6, NULL, NULL),
(18, 23, 12, NULL, NULL),
(19, 24, 6, NULL, NULL),
(20, 24, 12, NULL, NULL),
(21, 25, 6, NULL, NULL),
(22, 25, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) NOT NULL DEFAULT 'My Website',
  `site_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `default_user_role` enum('admin','user','manager') NOT NULL DEFAULT 'user',
  `password_reset_expiry` int(11) NOT NULL DEFAULT 60,
  `user_registration` tinyint(1) NOT NULL DEFAULT 1,
  `login_timeout` int(11) NOT NULL DEFAULT 30,
  `default_task_status` enum('Pending','In Progress','Completed') NOT NULL DEFAULT 'Pending',
  `allow_task_reassignment` tinyint(1) NOT NULL DEFAULT 1,
  `enable_email_notifications` tinyint(1) NOT NULL DEFAULT 1,
  `enable_push_notifications` tinyint(1) NOT NULL DEFAULT 1,
  `admin_email` varchar(255) DEFAULT NULL,
  `two_factor_auth` tinyint(1) NOT NULL DEFAULT 0,
  `login_attempt_limit` int(11) NOT NULL DEFAULT 5,
  `session_timeout` int(11) NOT NULL DEFAULT 15,
  `api_key` varchar(255) DEFAULT NULL,
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_email` varchar(255) DEFAULT NULL,
  `company_phone` varchar(50) DEFAULT NULL,
  `email_notifications` tinyint(1) DEFAULT 0,
  `task_reminders` tinyint(1) DEFAULT 0,
  `project_updates` tinyint(1) DEFAULT 0,
  `login_notification` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_logo`, `favicon`, `contact_email`, `contact_phone`, `address`, `default_user_role`, `password_reset_expiry`, `user_registration`, `login_timeout`, `default_task_status`, `allow_task_reassignment`, `enable_email_notifications`, `enable_push_notifications`, `admin_email`, `two_factor_auth`, `login_attempt_limit`, `session_timeout`, `api_key`, `dark_mode`, `created_at`, `updated_at`, `company_name`, `company_email`, `company_phone`, `email_notifications`, `task_reminders`, `project_updates`, `login_notification`) VALUES
(1, 'Admin', NULL, NULL, 'admin@gmail.com', NULL, NULL, 'admin', 60, 0, 30, 'Pending', 1, 1, 1, NULL, 1, 5, 15, NULL, 0, '2025-03-11 07:44:35', '2025-04-29 09:52:55', 'RBL', 'RBL@gmail.com', '+918866545752', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `action` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `task_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Pending','Reviewed','Rejected') NOT NULL DEFAULT 'Pending',
  `other` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `usertype` enum('employee','manager','SEO','frontend developer','backend developer') DEFAULT NULL,
  `frontend_languages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`frontend_languages`)),
  `backend_languages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`backend_languages`)),
  `image` varchar(255) DEFAULT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  `logout_time` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company_name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `dob`, `phone`, `address`, `role`, `usertype`, `frontend_languages`, `backend_languages`, `image`, `login_time`, `logout_time`, `remember_token`, `created_at`, `updated_at`, `company_name`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$12$D7CxIrZmE3J37EVAeJFuW.vOPGVUGdcCkQh85zMX.EK8fB4GCOS3S', '2025-12-12', '9685741425', 'Ahmedabad', 'admin', 'manager', NULL, NULL, 'uploads/users/1743498324.png', '2025-05-01 05:29:45', '2025-04-22 11:25:49', NULL, '2025-03-06 01:56:37', '2025-05-01 05:29:45', ''),
(6, 'Ronak Lodhari', 'ronak@gmail.com', '$2y$12$ZYs4vU3DBSD/ryDMfJ07MO8h2cfEP5FEYCK9AW/SCFEsI/IujfOA2', '2003-05-15', '8866545750', 'Haveli, Ahmedabad, Gujarat, IND', 'user', 'backend developer', NULL, '\"[\\\"PHP\\\",\\\"Laravel\\\"]\"', 'uploads/users/1743498291.jpg', '2025-05-01 05:47:42', '2025-05-01 05:47:00', NULL, '2025-03-10 11:02:59', '2025-05-01 05:47:42', ''),
(12, 'Prahlad Chaudhary', 'prahlad@gmail.com', '$2y$12$PkLwgYjtVWgpjcvJnPjO/OS0BuJzbEh56REVYMnCO/vvTpVVIYztW', '2004-01-15', '9602758649', 'Sola', 'user', 'backend developer', NULL, '\"[\\\"PHP\\\",\\\"Laravel\\\",\\\"MySQL\\\"]\"', 'uploads/users/1746077593.jpg', '2025-05-01 05:47:07', '2025-05-01 05:47:35', NULL, '2025-05-01 05:33:13', '2025-05-01 05:47:35', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_assigned_to_foreign` (`assigned_to`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_project` (`project_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`),
  ADD KEY `tasks_assigned_to_foreign` (`assigned_to`),
  ADD KEY `fk_tasks_assigned_user` (`assigned_user_id`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updates_user_id_foreign` (`user_id`),
  ADD KEY `updates_project_id_foreign` (`project_id`),
  ADD KEY `updates_task_id_foreign` (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `fk_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_assigned_user` FOREIGN KEY (`assigned_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `updates`
--
ALTER TABLE `updates`
  ADD CONSTRAINT `updates_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `updates_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `updates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
