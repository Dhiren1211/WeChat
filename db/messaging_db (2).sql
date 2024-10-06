-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 05:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messaging_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `convo_list`
--

CREATE TABLE `convo_list` (
  `id` int(30) NOT NULL,
  `from_user` int(30) NOT NULL,
  `to_user` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(30) NOT NULL,
  `from_user` int(30) NOT NULL,
  `to_user` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = text , 2 = photos,3 = videos, 4 = documents, 5 = audio',
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `popped` tinyint(1) NOT NULL DEFAULT 0,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `request` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user`, `to_user`, `type`, `message`, `status`, `popped`, `delete_flag`, `date_created`, `date_updated`, `request`) VALUES
(160, 58, 60, 1, 'hello', 0, 0, 0, '2023-12-31 09:36:30', NULL, 0),
(161, 58, 60, 1, 'k xa kbr', 0, 0, 0, '2023-12-31 09:36:51', NULL, 0),
(162, 58, 60, 4, 'Chemistry II.docx', 0, 0, 0, '2023-12-31 09:37:11', NULL, 0),
(163, 58, 60, 1, 'hello', 0, 0, 0, '2023-12-31 09:37:27', NULL, 0),
(164, 58, 60, 1, 'k xa kbr', 0, 0, 0, '2023-12-31 09:37:42', NULL, 0),
(165, 58, 59, 1, 'hello bruh', 1, 1, 0, '2023-12-31 09:40:48', '2024-01-07 15:42:36', 0),
(166, 58, 59, 1, 'k xa', 1, 1, 0, '2023-12-31 09:41:15', '2024-01-07 15:42:36', 0),
(167, 58, 59, 4, 'Chemistry II.docx', 1, 1, 1, '2023-12-31 09:41:27', '2024-01-07 15:42:36', 0),
(168, 61, 58, 1, 'hi', 1, 1, 0, '2024-01-01 10:36:58', '2024-01-01 10:37:00', 0),
(169, 61, 58, 4, 'Chapter 1.docx', 1, 1, 0, '2024-01-01 10:37:20', '2024-01-01 10:37:41', 0),
(170, 58, 61, 1, 'hello', 1, 1, 0, '2024-01-01 10:37:31', '2024-01-01 10:42:56', 0),
(171, 61, 58, 1, 'hi', 1, 1, 0, '2024-01-01 10:37:40', '2024-01-01 10:37:41', 0),
(172, 61, 58, 4, 'Document.docx', 1, 1, 0, '2024-01-01 10:40:33', '2024-01-04 21:52:53', 0),
(173, 61, 58, 1, 'how are you?', 1, 1, 0, '2024-01-01 10:43:15', '2024-01-04 21:52:53', 0),
(174, 58, 61, 1, 'I am file. and what about you?', 1, 1, 0, '2024-01-01 10:43:37', '2024-01-01 10:50:41', 0),
(175, 61, 58, 1, 'hello', 1, 1, 0, '2024-01-01 10:50:08', '2024-01-04 21:52:53', 0),
(176, 58, 61, 1, 'hello\r\n', 1, 1, 0, '2024-01-01 10:50:21', '2024-01-01 10:50:41', 0),
(177, 61, 58, 1, 'hii', 1, 1, 0, '2024-01-02 16:49:28', '2024-01-05 10:44:56', 0),
(178, 61, 58, 1, 'help', 1, 1, 0, '2024-01-02 16:49:50', '2024-01-05 10:44:56', 0),
(179, 61, 58, 1, 'test', 1, 1, 0, '2024-01-02 16:50:32', '2024-01-05 10:44:56', 0),
(180, 61, 58, 4, 'COMPUTER NETWORK Lab1.docx', 1, 1, 0, '2024-01-04 21:44:48', '2024-01-05 10:44:56', 0),
(181, 61, 58, 4, 'Document.docx', 1, 1, 0, '2024-01-04 21:47:53', '2024-01-05 10:44:56', 0),
(182, 61, 58, 4, 'CN question solution.docx', 1, 1, 0, '2024-01-04 21:50:06', '2024-01-05 10:44:56', 0),
(183, 58, 61, 4, 'databaseschema.txt', 1, 1, 0, '2024-01-05 18:42:08', '2024-01-06 06:50:22', 0),
(184, 58, 61, 1, 'hii', 1, 1, 0, '2024-01-05 18:42:15', '2024-01-06 06:50:22', 0),
(185, 58, 59, 1, 'hello', 1, 1, 0, '2024-01-07 15:46:16', '2024-01-07 15:46:47', 0),
(186, 59, 58, 1, 'yes please', 1, 1, 0, '2024-01-07 15:46:52', '2024-01-07 15:46:56', 0),
(187, 61, 59, 1, 'hi', 1, 1, 0, '2024-01-07 15:47:36', '2024-01-07 15:48:39', 0),
(188, 58, 61, 1, 'yes', 1, 1, 0, '2024-01-07 15:47:47', '2024-01-07 15:47:57', 0),
(189, 61, 59, 1, 'hello', 1, 1, 0, '2024-01-07 15:48:18', '2024-01-07 15:48:39', 0),
(190, 59, 61, 1, 'hello', 1, 1, 0, '2024-01-07 15:48:48', '2024-01-09 12:58:48', 0),
(191, 61, 59, 1, 'how are you', 1, 1, 0, '2024-01-07 15:48:57', '2024-01-07 15:48:58', 0),
(192, 59, 61, 1, 'i am fine', 1, 1, 0, '2024-01-07 15:49:20', '2024-01-09 12:58:48', 0),
(193, 59, 61, 1, 'what about you?', 1, 1, 0, '2024-01-07 15:49:32', '2024-01-09 12:58:48', 0),
(194, 61, 59, 1, 'i am also fine . what r u doing', 1, 1, 0, '2024-01-07 15:49:58', '2024-01-07 15:49:58', 0),
(195, 58, 61, 1, 'hii', 1, 1, 0, '2024-01-09 12:40:52', '2024-01-09 13:00:15', 0),
(196, 61, 58, 1, 'yes', 1, 1, 0, '2024-01-09 13:00:22', '2024-01-09 13:00:37', 0),
(197, 61, 58, 1, 'hi', 1, 1, 0, '2024-01-09 13:00:36', '2024-01-09 13:00:37', 0),
(198, 61, 58, 1, 'yes', 1, 1, 0, '2024-01-09 13:00:42', '2024-01-09 13:01:06', 0),
(199, 61, 58, 1, 'h3', 1, 1, 0, '2024-01-09 13:00:49', '2024-01-09 13:01:06', 0),
(200, 61, 58, 1, 'hello', 1, 1, 0, '2024-01-09 13:44:19', '2024-01-09 13:47:21', 1),
(201, 61, 58, 1, 'hii', 1, 1, 0, '2024-01-09 13:44:56', '2024-01-09 13:47:21', 1),
(202, 61, 58, 1, 'hey', 1, 1, 0, '2024-01-09 13:45:57', '2024-01-09 13:47:21', 1),
(203, 58, 61, 1, 'hey', 1, 1, 0, '2024-01-09 13:47:26', '2024-01-09 13:54:50', 1),
(204, 61, 58, 1, 'hello', 1, 1, 0, '2024-01-09 13:48:58', '2024-01-09 13:52:57', 1),
(205, 61, 58, 1, 'hello', 1, 1, 0, '2024-01-09 13:54:59', '2024-01-09 14:06:07', 1),
(206, 61, 58, 1, 'how are you', 1, 1, 0, '2024-01-09 13:59:33', '2024-01-09 14:06:07', 0),
(207, 61, 58, 1, 'are you ok', 1, 1, 0, '2024-01-09 14:00:43', '2024-01-09 14:06:07', 0),
(208, 61, 58, 1, 'bruh', 1, 1, 0, '2024-01-09 14:02:04', '2024-01-09 14:06:07', 1),
(209, 58, 60, 1, 'hey', 0, 0, 0, '2024-01-09 14:06:18', NULL, 1),
(210, 58, 61, 5, 'audioFile/user_%0D%0AInvalid request._recording_2024-01-09T08-53-43.wav', 1, 1, 0, '2024-01-09 14:38:43', '2024-01-09 15:22:41', 0),
(211, 58, 61, 5, 'audioFile/user_%0D%0AInvalid request._recording_2024-01-09T09-01-57.wav', 1, 1, 0, '2024-01-09 14:46:57', '2024-01-09 15:22:41', 0),
(212, 58, 61, 5, 'audioFile/user_%0D%0AInvalid request. Received request data: Array%0A(%0A    [a] => getUserName%0A)%0A_recording_2024-01-09T09-07-35.wav', 1, 1, 0, '2024-01-09 14:52:35', '2024-01-09 15:22:41', 0),
(213, 61, 58, 5, 'audioFile/user_%0D%0AInvalid request. Received request data: Array%0A(%0A    [a] => getUserName%0A)%0A_recording_2024-01-09T09-10-53.wav', 1, 1, 0, '2024-01-09 14:55:54', '2024-01-09 15:15:42', 0),
(214, 61, 58, 5, 'audioFile/user_%0D%0AInvalid request. Received request data: Array%0A(%0A    [a] => getUserName%0A)%0A_recording_2024-01-09T09-11-36.wav', 1, 1, 0, '2024-01-09 14:56:36', '2024-01-09 15:15:42', 0),
(215, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-16-19.wav', 1, 1, 0, '2024-01-09 15:01:19', '2024-01-09 15:22:41', 0),
(216, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-19-37.wav', 1, 1, 0, '2024-01-09 15:04:37', '2024-01-09 15:22:41', 0),
(217, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-21-02.wav', 1, 1, 0, '2024-01-09 15:06:02', '2024-01-09 15:22:41', 0),
(218, 58, 61, 4, 'Applied telecommunication.txt', 1, 1, 0, '2024-01-09 15:07:05', '2024-01-09 15:22:41', 0),
(219, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-22-15.wav', 1, 1, 0, '2024-01-09 15:07:15', '2024-01-09 15:22:41', 0),
(220, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-24-12.wav', 1, 1, 0, '2024-01-09 15:09:12', '2024-01-09 15:22:41', 0),
(221, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-28-37.wav', 1, 1, 0, '2024-01-09 15:13:37', '2024-01-09 15:22:41', 0),
(222, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-30-54.wav', 1, 1, 0, '2024-01-09 15:15:54', '2024-01-09 15:22:41', 0),
(223, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-39-05.wav', 1, 1, 0, '2024-01-09 15:24:05', '2024-01-09 15:40:43', 0),
(224, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-42-29.wav', 1, 1, 0, '2024-01-09 15:27:29', '2024-01-09 15:40:43', 0),
(225, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-48-14.wav', 1, 1, 0, '2024-01-09 15:33:14', '2024-01-09 15:40:43', 0),
(226, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-50-25.wav', 1, 1, 0, '2024-01-09 15:35:26', '2024-01-09 15:40:43', 0),
(227, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-51-02.wav', 1, 1, 0, '2024-01-09 15:36:02', '2024-01-09 15:40:43', 0),
(228, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-54-18.wav', 1, 1, 0, '2024-01-09 15:39:18', '2024-01-09 15:40:43', 0),
(229, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-54-46.wav', 1, 1, 0, '2024-01-09 15:39:46', '2024-01-09 15:40:43', 0),
(230, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-54-58.wav', 1, 1, 0, '2024-01-09 15:39:58', '2024-01-09 15:40:43', 0),
(231, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-56-07.wav', 1, 1, 0, '2024-01-09 15:41:07', '2024-01-17 12:44:21', 0),
(232, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-58-30.wav', 1, 1, 0, '2024-01-09 15:43:30', '2024-01-17 12:44:21', 0),
(233, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T09-59-16.wav', 1, 1, 0, '2024-01-09 15:44:16', '2024-01-17 12:44:21', 0),
(234, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T10-05-10.wav', 1, 1, 0, '2024-01-09 15:50:10', '2024-01-17 12:44:21', 0),
(235, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T10-06-26.wav', 1, 1, 0, '2024-01-09 15:51:26', '2024-01-17 12:44:21', 0),
(236, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T10-08-04.wav', 1, 1, 0, '2024-01-09 15:53:04', '2024-01-17 12:44:21', 0),
(237, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T10-09-11.wav', 1, 1, 0, '2024-01-09 15:54:11', '2024-01-17 12:44:21', 0),
(238, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T10-19-05.wav', 1, 1, 0, '2024-01-09 16:04:05', '2024-01-17 12:44:21', 0),
(239, 58, 61, 4, 'doshima.txt', 1, 1, 0, '2024-01-09 16:46:57', '2024-01-17 12:44:21', 0),
(240, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T11-02-26.wav', 1, 1, 0, '2024-01-09 16:47:26', '2024-01-17 12:44:21', 0),
(241, 58, 61, 4, 'Chapter 1.docx', 1, 1, 0, '2024-01-09 16:50:27', '2024-01-17 12:44:21', 0),
(242, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-09T15-53-08.wav', 1, 1, 0, '2024-01-09 21:38:08', '2024-01-17 12:44:21', 0),
(243, 58, 60, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-13T13-07-05.wav', 0, 0, 1, '2024-01-13 18:52:06', '2024-01-13 18:57:56', 0),
(244, 58, 60, 4, 'CN question solution.docx', 0, 0, 0, '2024-01-13 18:55:37', NULL, 0),
(245, 58, 61, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-14T12-27-03.wav', 1, 1, 0, '2024-01-14 18:12:03', '2024-01-17 12:44:21', 0),
(246, 58, 61, 1, 'hello', 1, 1, 0, '2024-01-14 18:14:29', '2024-01-17 12:44:21', 0),
(247, 58, 60, 1, 'hey', 0, 0, 0, '2024-01-14 18:15:49', NULL, 0),
(248, 58, 59, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-14T12-41-54.wav', 1, 1, 0, '2024-01-14 18:26:54', '2024-01-19 11:48:17', 0),
(249, 58, 59, 1, 'hi', 1, 1, 0, '2024-01-14 18:31:11', '2024-01-19 11:48:17', 0),
(250, 58, 60, 4, 'COMPUTER NETWORK Lab1.docx', 0, 0, 0, '2024-01-14 18:50:57', NULL, 0),
(251, 58, 61, 1, 'heel', 1, 1, 0, '2024-01-17 11:58:57', '2024-01-17 12:44:21', 0),
(252, 58, 61, 1, 'hey', 0, 0, 0, '2024-01-18 11:02:11', NULL, 0),
(253, 59, 58, 5, 'audioFile/user_%0D%0ADhiraj_recording_2024-01-19T06-03-47.wav', 1, 1, 0, '2024-01-19 11:48:47', '2024-01-19 11:49:29', 0),
(254, 59, 61, 5, 'audioFile/user_%0D%0ADhiraj_recording_2024-01-19T06-04-24.wav', 0, 0, 0, '2024-01-19 11:49:24', NULL, 0),
(255, 58, 59, 4, '4.png', 1, 1, 0, '2024-01-20 14:04:10', '2024-01-20 14:33:59', 0),
(256, 58, 59, 4, '4.png', 1, 1, 0, '2024-01-20 14:06:31', '2024-01-20 14:33:59', 0),
(257, 58, 59, 4, 'out.mp4', 1, 1, 0, '2024-01-20 14:06:54', '2024-01-20 14:33:59', 0),
(258, 58, 59, 3, 'out.mp4', 1, 1, 0, '2024-01-20 14:08:33', '2024-01-20 14:33:59', 0),
(259, 58, 59, 3, 'production_id_3981739 (2160p).mp4', 1, 1, 0, '2024-01-20 14:23:42', '2024-01-20 14:33:59', 0),
(260, 58, 59, 3, '4.png', 1, 1, 0, '2024-01-20 14:31:53', '2024-01-20 14:33:59', 0),
(261, 59, 58, 4, 'dineshcv.pdf', 1, 1, 0, '2024-01-20 14:34:38', '2024-01-20 14:34:45', 0),
(262, 59, 58, 3, '350303024_809018834264458_3965619435988080959_n.jpg', 1, 1, 0, '2024-01-20 14:35:10', '2024-01-20 14:36:00', 0),
(263, 59, 58, 5, 'user_%0D%0ADhiraj_recording_2024-01-20T08-54-31.wav', 1, 1, 0, '2024-01-20 14:39:31', '2024-01-20 14:43:22', 0),
(264, 58, 59, 5, 'user_%0D%0ADhirendra_recording_2024-01-20T08-58-45.wav', 1, 1, 0, '2024-01-20 14:43:45', '2024-02-27 08:15:15', 0),
(265, 58, 59, 3, 'Settings 2023-12-07 20-23-27.mp4', 1, 1, 0, '2024-01-20 14:57:22', '2024-02-27 08:15:15', 0),
(266, 58, 59, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-25T08-23-47.ogg', 1, 1, 0, '2024-01-25 14:08:48', '2024-02-27 08:15:15', 0),
(267, 58, 59, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-25T08-24-40.mp3', 1, 1, 0, '2024-01-25 14:09:40', '2024-02-27 08:15:15', 0),
(268, 58, 59, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-25T08-30-26.mp3', 1, 1, 0, '2024-01-25 14:15:26', '2024-02-27 08:15:15', 0),
(269, 58, 59, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-25T08-40-37.mp3', 1, 1, 0, '2024-01-25 14:25:37', '2024-02-27 08:15:15', 0),
(270, 58, 59, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-25T08-44-13.mp3', 1, 1, 0, '2024-01-25 14:29:13', '2024-02-27 08:15:15', 0),
(271, 58, 59, 5, 'audioFile/user_%0D%0ADhirendra_recording_2024-01-25T08-49-05.mp3', 1, 1, 0, '2024-01-25 14:34:05', '2024-02-27 08:15:15', 0),
(272, 58, 61, 5, 'audioFile/recording_2024-01-26T06-58-59.mp3', 0, 0, 0, '2024-01-26 12:43:59', NULL, 0),
(273, 58, 59, 5, 'audioFile/recording_2024-01-26T07-00-15.mp3', 1, 1, 0, '2024-01-26 12:45:15', '2024-02-27 08:15:15', 0),
(274, 58, 59, 3, 'screen record shortcut windows 11 - Brave Search - Brave 2023-06-29 11-10-32.mp4', 1, 1, 0, '2024-01-26 13:09:12', '2024-02-27 08:15:15', 0),
(275, 58, 59, 4, 'Chapter 1.docx', 1, 1, 0, '2024-01-26 13:09:40', '2024-02-27 08:15:15', 0),
(276, 58, 59, 1, 'hello', 1, 1, 0, '2024-01-26 13:16:14', '2024-02-27 08:15:15', 0),
(277, 58, 59, 1, 'hey', 1, 1, 0, '2024-02-25 21:18:45', '2024-02-27 08:15:15', 0),
(278, 58, 59, 5, 'audioFile/recording_2024-02-25T15-34-12.mp3', 1, 1, 0, '2024-02-25 21:19:12', '2024-02-27 08:15:15', 0),
(279, 58, 59, 4, 'Major Project Documentation.docx', 1, 1, 0, '2024-02-25 21:19:29', '2024-02-27 08:15:15', 0),
(280, 58, 59, 3, 'pexels-pixabay-36717.jpg', 1, 1, 0, '2024-02-25 21:19:48', '2024-02-27 08:15:15', 0),
(281, 59, 58, 1, 'hello', 1, 1, 0, '2024-02-27 09:42:24', '2024-02-27 10:01:08', 0),
(282, 59, 58, 1, 'how are you', 1, 1, 0, '2024-02-27 09:42:36', '2024-02-27 10:01:08', 0),
(283, 59, 58, 4, 'Major Project Documentation.docx', 1, 1, 0, '2024-02-27 09:42:46', '2024-02-27 10:01:08', 0),
(284, 59, 58, 1, 'hello', 1, 0, 0, '2024-02-27 10:03:49', '2024-02-27 10:03:49', 0),
(285, 59, 58, 3, 'Screenshot 2023-07-09 012229.png', 1, 0, 0, '2024-02-27 10:04:06', '2024-02-27 10:04:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `contact` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` int(11) DEFAULT 0,
  `image_link` varchar(500) DEFAULT NULL,
  `Notif` tinyint(4) DEFAULT 0,
  `last_seen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `dob`, `email`, `password`, `date_created`, `date_updated`, `status`, `image_link`, `Notif`, `last_seen`) VALUES
(58, 'Dhirendra', '', 'Kathayat', '9848524455', 'Male', '2010-10-10', 'toxicdhiren3497@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2023-12-22 16:11:11', '2024-02-27 10:02:44', 1, 'Profiles/350303024_809018834264458_3965619435988080959_n.jpg', 0, '2024-02-27 04:17:44'),
(59, 'Dhiraj', 'Kumar', 'Kathayat', '9876565432', 'Male', '2010-10-10', 'dhiraj@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2023-12-22 16:47:45', '2024-02-27 10:02:32', 1, 'Profiles/Cartoon-Avatar-PNG-Image-Background.png', 0, '2024-02-27 04:17:32'),
(60, 'Rohan', '', 'Ghimire', '9878675667', 'Male', '2010-10-10', 'rohanghimire@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2023-12-22 21:52:09', '2024-01-19 11:57:10', 0, 'Profiles/Cartoon-Avatar-PNG-Image-Background.png', 0, '2024-01-19 06:12:10'),
(61, 'Mithlesh', 'Kumar', 'Mahato', '9803121295', 'Male', '2002-04-17', 'mithleshdemo@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2024-01-01 10:35:07', '2024-02-27 10:02:20', 1, 'Profiles/4.png', 0, '2024-02-27 04:17:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `convo_list`
--
ALTER TABLE `convo_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `convo_list`
--
ALTER TABLE `convo_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
