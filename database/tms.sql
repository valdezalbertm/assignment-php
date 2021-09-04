-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Sep 04, 2021 at 05:18 PM
-- Server version: 5.7.18
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms`
--
CREATE DATABASE IF NOT EXISTS `tms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tms`;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `name`) VALUES
(3, 'article_title1'),
(5, 'article_title2'),
(8, 'article_title3'),
(1, 'main_title'),
(2, 'sub_title');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_ltr` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `iso_code`, `is_ltr`) VALUES
(1, 'English', 'eng', 1),
(2, 'German', 'ger', 1),
(3, 'French', 'fre', 1),
(4, 'Chinese', 'chi', 1),
(5, 'Spanish', 'spa', 1),
(6, 'Latin', 'lat', 1),
(7, 'Japanese', 'jap', 1),
(8, 'Hebrew', 'heb', 0),
(9, 'Arabic', 'ara', 1),
(10, 'Icelandic', 'ice', 1),
(11, 'Syriac', 'syr', 0),
(12, 'Filipino', 'fil', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2021_09_02_120224_create_languages_table', 2),
(3, '2021_09_02_121308_create_keys_table', 2),
(9, '2021_09_02_121312_create_translations_table', 3),
(10, '2021_09_02_161318_create_tokens_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_write_access` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `has_write_access`) VALUES
(1, 'RtjdNTbfafPsNc7EJL6Bxmv7Cehbjnfj', 1),
(2, 'pTQLj5b8Kk2ZjXEEPmG38UeP4pH9rQqA', 0),
(21, '0ee7d977-d0d3-4254-96f5-88c48e50201b', 1),
(25, 'ef64411a-2f59-4d8e-897e-77aeb013de1f', 1),
(135, '764fe083-e86d-4b06-afc6-d72cd0dd9590', 1),
(145, '2d0923b6-9905-4bde-a88c-378a0f84df0a', 1),
(146, 'f34bfa25-e021-456d-aead-d452f5c421bf', 1),
(156, 'e05876e3-0d75-4ba7-a8f4-f98144667f85', 1),
(166, 'a58f35c3-f7e1-482c-9e70-922a15653765', 1),
(167, '5413f1f5-2b89-462b-ac65-aa16db54c6fa', 1),
(168, 'c8a018b3-06be-41cc-bc5a-8a58a8c16bc5', 1),
(178, '0fb9ebf0-97ab-4691-b184-6d4c70dce44d', 1),
(188, '1ec2b3ef-e389-4669-a7fe-383c91cdd3ab', 1),
(189, 'aa8acc34-b774-45a2-811f-55fbf4d7967c', 1),
(199, '64b8df76-d965-4fbb-ab6e-d84a591d8b4d', 1),
(200, 'ae3a9f82-2ef6-401d-9a52-cb1c3e6787ac', 1),
(210, 'ab425183-8195-4f00-8119-04f5b9d60c65', 1),
(211, 'bbd59023-bd75-4833-8794-aa6bad0a566e', 1),
(212, 'ec7f7e7a-7052-45b3-8047-02186d905f9d', 1),
(213, '57537133-e19f-4304-b591-365542128e2d', 1),
(214, 'b6599cfc-164d-4789-9bbc-c6158b4a816c', 1),
(215, 'fe216830-cae9-4f8c-8ee6-6a374339c905', 1),
(216, 'aa9ce183-b79e-414c-a3d5-c19589bec936', 1),
(217, 'ab8b8f04-6ad8-4e6a-91ae-941c7455f17f', 1),
(218, '91d84aa8-c331-4564-b824-f06f0bfac2d2', 1),
(219, 'e8ece157-5d14-4086-a54d-357fea227fac', 1),
(220, '614d9fdb-94df-4117-8775-076a03873213', 1),
(221, '4af464e3-53b9-4d80-8657-0a397de55489', 1),
(222, 'b39d0cd6-07b4-4cd6-b08d-6916067c0f0f', 1),
(223, '15dfb468-d87b-4352-ba67-5c4c3b42b97c', 1),
(224, '414477ca-8ca8-4d3e-a3a7-c3e7a12839ab', 1),
(225, 'd9507357-9e64-4b02-987f-7766b43e702e', 1),
(235, '6ebca77b-9e27-409c-a191-3c5dcbcdd061', 1),
(236, 'a8cde213-bdbe-4419-b184-176382762b9b', 1),
(237, '0d5dcd48-eea5-4e95-bceb-f547f661e095', 1),
(247, '97a6e223-939b-4b9c-9106-b45ae2886997', 1),
(248, 'a6998a0f-8cf0-46ff-8d23-7f5fea9b6063', 1),
(249, 'eaaaca7d-4719-47a2-8ea9-84bcffed2e4e', 1),
(250, 'b3634127-1b44-4f68-9a82-c4947cedf13e', 1),
(260, 'a0699ac8-129d-42a3-9d58-41efe7ed49cb', 1),
(261, 'be44a4d2-8e6f-4e57-85db-2c36847f8643', 1),
(262, 'a1120fe8-036c-4bcb-a7b8-404c0241c7e1', 1),
(272, 'e0e84761-f153-4712-98e7-0d42d66dfe39', 1),
(273, 'ea32bd0b-548f-4d32-ade4-58b3ae3f2cba', 1),
(274, '7bacccf2-e461-4a60-9da6-b05ccbfcc30b', 1),
(284, 'ae463065-f681-4a73-bec9-f391fcd1e481', 1),
(285, 'dbf100e0-0e7d-4cd9-9562-9f6055d7e3d5', 1),
(286, '35e1061a-22e9-43ad-b53e-500ae7b1ba0f', 1),
(296, '912bcecb-ae54-4e62-bdda-c031bab8d361', 1),
(297, '9e8d370a-32d5-4ea3-b1b5-92b7673ef6b8', 1),
(298, '867a7ab1-9f76-498f-8ba8-d264a5bdd1dd', 1),
(308, '5ffa2bec-6966-4f50-beb8-44a25d046e2a', 1),
(309, '8fbb7861-e2ae-4745-8bd1-4ab15e7e8ff7', 1),
(310, '65380f87-30f3-4ea0-ba7c-b7fa38bd8b5e', 1),
(320, '99c784c5-155d-4abf-b786-4d3aac6558b0', 1),
(321, '279284e7-e9a7-49d2-abbd-a076e9d16955', 1),
(322, '2848f041-1a17-4814-9372-7955c2749eb5', 1),
(323, '9121374c-8efc-4839-86ce-e368e7257ff3', 1),
(324, '0121ccf2-3827-401e-839e-96aa33d8a135', 1),
(325, '9633effc-ce88-4ae0-86a3-9316c38c4fde', 1),
(326, '82d91f34-3f66-4c96-b252-4aa7d10116d7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key_id` bigint(20) UNSIGNED NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `key_id`, `language_id`, `value`) VALUES
(4, 1, 1, 'What is Programming Language?'),
(5, 1, 9, 'ما هي لغة البرمجة؟'),
(6, 1, 4, '什么是编程语言？'),
(7, 1, 7, 'プログラミング言語とは何ですか？'),
(8, 1, 3, 'Qu\'est-ce que le langage de programmation ?'),
(9, 1, 12, 'Ano ang programming language?'),
(10, 1, 2, 'Was ist Programmiersprache?'),
(11, 1, 5, '¿Qué es el lenguaje de programación?'),
(12, 2, 1, 'Patience is a virtue'),
(13, 2, 9, 'الصبر فضيلة'),
(14, 2, 4, '耐心是一种美德'),
(15, 2, 7, '忍耐は美徳'),
(16, 2, 3, 'La patience est une vertue'),
(17, 2, 12, 'Ang pasensya ay isang kabutihan'),
(18, 2, 2, 'Geduld ist eine Tugend'),
(19, 2, 5, 'La paciencia es una virtud'),
(20, 3, 1, 'Stay Hungry Stay Foolish'),
(21, 3, 9, 'ابقى فضولي ابقى مغامر'),
(22, 3, 4, '保持饥饿，保持愚蠢'),
(23, 3, 7, '渇望する愚か者であれ'),
(24, 3, 3, 'Rester affamé, rester idiot'),
(25, 3, 12, 'Manatiling Gutom Manatiling Bobo'),
(26, 3, 2, 'Bleibt hungrig, bleibt dumm'),
(27, 3, 5, 'Quédense hambrientos quédense tontos');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `keys_name_unique` (`name`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tokens_token_unique` (`token`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_key_id_language_id_unique` (`key_id`,`language_id`),
  ADD KEY `translations_language_id_foreign` (`language_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `translations`
--
ALTER TABLE `translations`
  ADD CONSTRAINT `translations_key_id_foreign` FOREIGN KEY (`key_id`) REFERENCES `keys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
