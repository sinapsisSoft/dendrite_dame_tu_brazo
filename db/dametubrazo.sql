-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-10-2022 a las 14:51:03
-- Versión del servidor: 10.5.12-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u986006711_dametubrazo`
--
CREATE DATABASE IF NOT EXISTS `u986006711_dametubrazo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `u986006711_dametubrazo`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `sp_activity_user`$$
CREATE PROCEDURE `sp_activity_user` (IN `userId` INT)  BEGIN
  SELECT AU.content_id, C.content_name, TC.type_content_id, C.module_id FROM activity_user AU
	INNER JOIN content C ON C.content_id = AU.content_id
	INNER JOIN type_content TC ON TC.type_content_id = C.type_content_id
	INNER JOIN module M ON C.module_id = M.module_id
	WHERE user_id = userId
	ORDER BY AU.activity_user_id DESC;
END$$

DROP PROCEDURE IF EXISTS `sp_content_info_content`$$
CREATE PROCEDURE `sp_content_info_content` (IN `module` INT, IN `type` INT)  BEGIN
  SELECT content_info_id, content_info_title, content_info_img, content_info_element, content_info_detail, content_info.content_id FROM content_info
	JOIN content ON content_info.content_id = content.content_id
	WHERE content.type_content_id = type AND content.module_id = module;
END$$

DROP PROCEDURE IF EXISTS `sp_content_info_quiz`$$
CREATE PROCEDURE `sp_content_info_quiz` (IN `module` INT, IN `type` INT)  BEGIN
  SELECT CQ.content_id, QA.question_answer_id, CQ.question_id, Q.question_text, A.answer_id, A.answer_text, QA.question_answer_correct, Q.question_type, C.module_id FROM content_question CQ
	JOIN content C ON CQ.content_id = C.content_id
	JOIN type_content TC ON C.type_content_id = TC.type_content_id
	JOIN question Q ON CQ.question_id = Q.question_id
	JOIN question_answer QA ON Q.question_id = QA.question_id
	JOIN answer A ON QA.answer_id = A.answer_id
	WHERE C.type_content_id = type AND C.module_id = module;
END$$

DROP PROCEDURE IF EXISTS `sp_create_activity_user`$$
CREATE PROCEDURE `sp_create_activity_user` (IN `userId` INT, IN `contentId` INT, IN `typeContent` INT)  BEGIN
	SET @exist = (SELECT COUNT(content_id) FROM activity_user WHERE content_id = contentId AND user_id = userId);
	IF @exist = 0 THEN
		INSERT INTO activity_user (activity_user_detail, content_id, user_id) VALUES (NULL, contentId, userId);
	END IF;
	SET @currentType = (SELECT C.type_content_id FROM activity_user AU INNER JOIN content C ON C.content_id = AU.content_id WHERE AU.content_id = contentId AND user_id = userId); 
	SET @nextContent = (SELECT contentId + 1);
	SET @nextType = (SELECT C.type_content_id FROM activity_user AU INNER JOIN content C ON C.content_id = AU.content_id WHERE AU.content_id = @nextContent AND user_id = userId);
	IF @currentType = 2 THEN	
		SET @nextContent = (SELECT contentId + 3);
	END IF;
	IF @nextType = 1 THEN
		SET @nextContent = (SELECT contentId + 2);
	END IF;
	SET @nextInsert = (SELECT COUNT(content_id) FROM activity_user WHERE content_id = @nextContent AND user_id = userId);
	IF @nextInsert = 0 AND @nextContent < 37 THEN
		INSERT INTO activity_user (activity_user_detail, content_id, user_id) VALUES (NULL, @nextContent, userId);
	END IF;
END$$

DROP PROCEDURE IF EXISTS `sp_data_user_insert_update`$$
CREATE PROCEDURE `sp_data_user_insert_update` (IN `userId` INT, IN `type_id` INT)  BEGIN
	SET @exist = (SELECT COUNT(user_id) FROM data_user WHERE user_id = userId);	
	IF type_id = 0 THEN
		SET @treatment = 1;
		SET @transfer = 0;
	ELSE
		SET @treatment = 0;
		SET @transfer = 1;
	END IF;
	IF @exist = 0 THEN
		INSERT INTO data_user (data_user_treatment, data_user_transfer, user_id) VALUES (@treatment, @transfer, userId);
	ELSE
		IF type_id = 0 THEN
			UPDATE data_user SET data_user_treatment = @treatment WHERE user_id = userId; 
		ELSE 
			UPDATE data_user SET data_user_transfer = @transfer WHERE user_id = userId;
		END IF;
	END IF;
	SET @sum = (SELECT (data_user_treatment + data_user_transfer) FROM data_user WHERE user_id = userId);
	SELECT @sum AS "sum";
END$$

DROP PROCEDURE IF EXISTS `sp_login`$$
CREATE PROCEDURE `sp_login` (IN `user_email` VARCHAR(200), IN `user_password` VARCHAR(200))  BEGIN
SELECT US.user_id,US.role_id FROM login LG 
INNER JOIN user US ON LG.user_id=US.user_id
WHERE LG.login_email=user_email AND LG.login_password=user_password AND user_state_id = 1;
END$$

DROP PROCEDURE IF EXISTS `sp_user_score`$$
CREATE PROCEDURE `sp_user_score` (IN `contentId` INT, IN `userId` INT, IN `score` VARCHAR(3))  BEGIN
  SET @exist = (SELECT user_score_value FROM user_score WHERE content_id = contentId AND user_id = userId);
	IF @exist = "" OR @exist IS NULL THEN
		INSERT INTO user_score (user_score_value, content_id, user_id) VALUES (score, contentId, userId);		
	ELSE
		IF @exist < score THEN
			UPDATE user_score SET user_score_value = score WHERE content_id = contentId AND user_id = userId; 
		END IF;
	END IF;
	SELECT score AS user_score_value;
END$$

DROP PROCEDURE IF EXISTS `sp_report_average`$$
CREATE PROCEDURE `sp_report_average`()  
BEGIN
  SELECT ROUND(AVG(A.answer_text),2) AS 'Average', QA.question_answer_id,  QA.question_id, UA.user_id, UA.content_id, 
  (
    SELECT content.module_id 
    FROM module 
    INNER JOIN content 
    ON module.module_id = content.module_id 
    WHERE content_id = UA.content_id
  ) AS 'moduleId' 
  FROM user_assessment UA
  LEFT JOIN question_answer QA 
  ON UA.question_answer_id = QA.question_answer_id
  LEFT JOIN answer A 
  ON QA.answer_id = A.answer_id
  GROUP BY QA.question_id, moduleId;
END$$

DELIMITER $$
DROP PROCEDURE IF EXISTS sp_report_module$$
CREATE PROCEDURE sp_report_module(IN finalDate DATE)
BEGIN
	CREATE TEMPORARY TABLE result 
    SELECT AU.user_id, 
    max(C.content_id) AS content_id, 
    (
        SELECT module_id 
        FROM content 
        WHERE content_id = max(C.content_id) LIMIT 1
    ) AS module_id
    FROM activity_user AU 
    JOIN content C ON AU.content_id = C.content_id
    WHERE AU.activity_user_date BETWEEN CONCAT('2022-10-03',' 00:00:00') AND CONCAT(finalDate,' 23:59:59')
    GROUP BY AU.user_id;
    SELECT CONCAT("Módulo ",module_id) AS module_id, COUNT(module_id) AS module_count
    FROM result 
    GROUP BY module_id;
    DROP TEMPORARY TABLE IF EXISTS result;
END$$

DELIMITER $$
DROP PROCEDURE IF EXISTS sp_report_table$$
CREATE PROCEDURE sp_report_table(IN finalDate DATE)
BEGIN
	SELECT U.user_id, U.user_name, L.login_email, 
  (
    SELECT user_score_value FROM user_score US WHERE US.user_id = U.user_id AND US.content_id = 7 LIMIT 1
  ) AS 'mod_1', 
  (
    SELECT user_score_value FROM user_score US WHERE US.user_id = U.user_id AND US.content_id = 16 LIMIT 1
  ) AS 'mod_2', 
  (
    SELECT user_score_value FROM user_score US WHERE US.user_id = U.user_id AND US.content_id = 25 LIMIT 1
  )  AS 'mod_3', 
  (
    SELECT user_score_value FROM user_score US WHERE US.user_id = U.user_id AND US.content_id = 34 LIMIT 1
    ) AS 'mod_4', 
  (
    SELECT C.content_name FROM activity_user AU INNER JOIN content C ON AU.content_id = C.content_id WHERE AU.user_id = U.user_id
ORDER BY AU.activity_user_date DESC LIMIT 1
  ) AS 'activity'
  FROM user U
  INNER JOIN login L
  ON U.user_id = L.user_id
  INNER JOIN activity_user AC
  ON U.user_id = AC.user_id
  WHERE U.role_id = 2 AND AC.activity_user_date BETWEEN CONCAT('2022-10-03',' 00:00:00') AND CONCAT(finalDate,' 23:59:59')
  GROUP BY AC.user_id
  ORDER BY U.user_name ASC;
END$$

DELIMITER $$
DROP PROCEDURE IF EXISTS sp_report_user$$
CREATE PROCEDURE sp_report_user(IN userId INT, IN moduleId INT)
BEGIN
	SELECT Q.question_text, A.answer_text, UA.user_assessment_detail FROM user_assessment UA 
  INNER JOIN question_answer QA ON UA.question_answer_id = QA.question_answer_id
  INNER JOIN question Q ON QA.question_id = Q.question_id
  INNER JOIN answer A ON QA.answer_id = A.answer_id
  INNER JOIN content C ON UA.content_id = C.content_id
  WHERE UA.user_id = userId AND C.module_id = moduleId;
END$$
  
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_user`
--

DROP TABLE IF EXISTS `activity_user`;
CREATE TABLE IF NOT EXISTS `activity_user` (
  `activity_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_user_date` datetime DEFAULT current_timestamp(),
  `activity_user_detail` varchar(600) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`activity_user_id`),
  KEY `user_id` (`user_id`),
  KEY `content_id` (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `activity_user`
--

TRUNCATE TABLE `activity_user`;
--
-- Volcado de datos para la tabla `activity_user`
--

INSERT INTO `activity_user` (`activity_user_id`, `activity_user_date`, `activity_user_detail`, `content_id`, `user_id`) VALUES
(1, '2022-10-03 06:43:40', NULL, 2, 26),
(2, '2022-10-03 06:43:40', NULL, 5, 26),
(3, '2022-10-03 06:45:36', NULL, 6, 26),
(4, '2022-10-03 12:11:38', NULL, 2, 110),
(5, '2022-10-03 12:11:38', NULL, 5, 110),
(6, '2022-10-03 12:39:17', NULL, 6, 110),
(7, '2022-10-03 12:42:27', NULL, 2, 101),
(8, '2022-10-03 12:42:27', NULL, 5, 101),
(9, '2022-10-03 12:43:01', NULL, 7, 110),
(10, '2022-10-03 12:47:07', NULL, 6, 101),
(11, '2022-10-03 12:50:25', NULL, 7, 101),
(12, '2022-10-03 13:19:01', NULL, 2, 86),
(13, '2022-10-03 13:19:01', NULL, 5, 86),
(14, '2022-10-03 13:39:15', NULL, 2, 59),
(15, '2022-10-03 13:39:15', NULL, 5, 59),
(16, '2022-10-03 13:39:38', NULL, 6, 59),
(17, '2022-10-03 14:02:02', NULL, 2, 95),
(18, '2022-10-03 14:02:02', NULL, 5, 95),
(19, '2022-10-03 14:19:39', NULL, 8, 110),
(20, '2022-10-03 14:32:48', NULL, 2, 111),
(21, '2022-10-03 14:32:48', NULL, 5, 111),
(22, '2022-10-03 14:34:03', NULL, 6, 111),
(23, '2022-10-03 14:34:19', NULL, 7, 111),
(24, '2022-10-03 14:35:00', NULL, 8, 111),
(25, '2022-10-03 14:35:21', NULL, 9, 111),
(26, '2022-10-03 14:35:30', NULL, 10, 111),
(27, '2022-10-03 14:50:40', NULL, 9, 110),
(28, '2022-10-03 15:17:49', NULL, 2, 28),
(29, '2022-10-03 15:17:49', NULL, 5, 28),
(30, '2022-10-03 15:18:58', NULL, 6, 28),
(31, '2022-10-03 15:23:42', NULL, 7, 28),
(32, '2022-10-03 15:39:52', NULL, 8, 28),
(33, '2022-10-03 15:40:26', NULL, 9, 28),
(34, '2022-10-03 15:53:14', NULL, 2, 90),
(35, '2022-10-03 15:53:14', NULL, 5, 90),
(36, '2022-10-03 15:56:57', NULL, 2, 34),
(37, '2022-10-03 15:56:57', NULL, 5, 34),
(38, '2022-10-03 16:37:30', NULL, 10, 28),
(39, '2022-10-03 16:38:31', NULL, 11, 28),
(40, '2022-10-03 16:38:31', NULL, 14, 28),
(41, '2022-10-03 19:20:07', NULL, 2, 71),
(42, '2022-10-03 19:20:07', NULL, 5, 71),
(43, '2022-10-03 19:37:44', NULL, 10, 110),
(44, '2022-10-03 19:47:34', NULL, 6, 71),
(45, '2022-10-03 19:51:18', NULL, 7, 71),
(46, '2022-10-03 20:04:10', NULL, 11, 110),
(47, '2022-10-03 20:05:44', NULL, 8, 71),
(48, '2022-10-03 20:06:43', NULL, 9, 71),
(49, '2022-10-03 20:06:53', NULL, 10, 71),
(50, '2022-10-03 20:27:07', NULL, 15, 28),
(51, '2022-10-03 20:27:29', NULL, 16, 28),
(52, '2022-10-03 21:00:33', NULL, 2, 20),
(53, '2022-10-03 21:00:33', NULL, 5, 20),
(54, '2022-10-03 21:43:01', NULL, 2, 2),
(55, '2022-10-03 21:43:01', NULL, 5, 2),
(56, '2022-10-03 21:43:46', NULL, 6, 2),
(57, '2022-10-03 21:44:18', NULL, 7, 2),
(58, '2022-10-03 23:24:13', NULL, 2, 5),
(59, '2022-10-03 23:24:13', NULL, 5, 5),
(60, '2022-10-03 23:33:31', NULL, 6, 5),
(61, '2022-10-03 23:41:16', NULL, 2, 62),
(62, '2022-10-03 23:41:16', NULL, 5, 62),
(63, '2022-10-03 23:47:28', NULL, 7, 5),
(64, '2022-10-04 00:09:13', NULL, 2, 63),
(65, '2022-10-04 00:09:13', NULL, 5, 63),
(66, '2022-10-04 00:11:12', NULL, 6, 62),
(67, '2022-10-04 00:17:49', NULL, 2, 8),
(68, '2022-10-04 00:17:49', NULL, 5, 8),
(69, '2022-10-04 00:19:19', NULL, 2, 54),
(70, '2022-10-04 00:19:19', NULL, 5, 54),
(71, '2022-10-04 00:20:14', NULL, 6, 54),
(72, '2022-10-04 00:21:38', NULL, 2, 48),
(73, '2022-10-04 00:21:38', NULL, 5, 48),
(74, '2022-10-04 00:24:00', NULL, 6, 8),
(75, '2022-10-04 00:24:00', NULL, 7, 54),
(76, '2022-10-04 00:29:30', NULL, 7, 8),
(77, '2022-10-04 00:30:30', NULL, 8, 5),
(78, '2022-10-04 00:32:08', NULL, 9, 5),
(79, '2022-10-04 00:32:15', NULL, 10, 5),
(80, '2022-10-04 00:32:23', NULL, 2, 64),
(81, '2022-10-04 00:32:23', NULL, 5, 64),
(82, '2022-10-04 00:34:38', NULL, 7, 62),
(83, '2022-10-04 00:36:39', NULL, 8, 8),
(84, '2022-10-04 00:37:04', NULL, 9, 8),
(85, '2022-10-04 00:37:12', NULL, 10, 8),
(86, '2022-10-04 00:39:28', NULL, 8, 54),
(87, '2022-10-04 00:40:03', NULL, 8, 62),
(88, '2022-10-04 00:40:19', NULL, 9, 54),
(89, '2022-10-04 00:40:31', NULL, 10, 54),
(90, '2022-10-04 00:40:38', NULL, 9, 62),
(91, '2022-10-04 00:40:43', NULL, 10, 62),
(92, '2022-10-04 00:43:08', NULL, 11, 62),
(93, '2022-10-04 00:43:08', NULL, 14, 62),
(94, '2022-10-04 00:43:33', NULL, 6, 64),
(95, '2022-10-04 00:47:13', NULL, 7, 64),
(96, '2022-10-04 00:51:26', NULL, 11, 5),
(97, '2022-10-04 00:51:26', NULL, 14, 5),
(98, '2022-10-04 00:51:47', NULL, 15, 5),
(99, '2022-10-04 01:02:46', NULL, 8, 64),
(100, '2022-10-04 01:12:13', NULL, 2, 15),
(101, '2022-10-04 01:12:13', NULL, 5, 15),
(102, '2022-10-04 01:34:31', NULL, 16, 5),
(103, '2022-10-04 01:42:06', NULL, 2, 56),
(104, '2022-10-04 01:42:06', NULL, 5, 56),
(105, '2022-10-04 01:49:11', NULL, 6, 48),
(106, '2022-10-04 01:58:34', NULL, 2, 100),
(107, '2022-10-04 01:58:34', NULL, 5, 100),
(108, '2022-10-04 02:08:25', NULL, 7, 48),
(109, '2022-10-04 02:14:27', NULL, 2, 30),
(110, '2022-10-04 02:14:27', NULL, 5, 30),
(111, '2022-10-04 02:19:04', NULL, 6, 100),
(112, '2022-10-04 02:19:33', NULL, 6, 30),
(113, '2022-10-04 02:20:22', NULL, 8, 48),
(114, '2022-10-04 02:21:41', NULL, 7, 30),
(115, '2022-10-04 02:21:58', NULL, 7, 100),
(116, '2022-10-04 02:27:39', NULL, 8, 30),
(117, '2022-10-04 02:29:13', NULL, 8, 100),
(118, '2022-10-04 02:30:37', NULL, 9, 100),
(119, '2022-10-04 02:30:43', NULL, 10, 100),
(120, '2022-10-04 03:55:05', NULL, 2, 99),
(121, '2022-10-04 03:55:05', NULL, 5, 99),
(122, '2022-10-04 03:59:18', NULL, 6, 99),
(123, '2022-10-04 04:03:32', NULL, 7, 99),
(124, '2022-10-04 05:11:31', NULL, 6, 63),
(125, '2022-10-04 05:15:51', NULL, 7, 63),
(126, '2022-10-04 06:11:27', NULL, 2, 31),
(127, '2022-10-04 06:11:27', NULL, 5, 31),
(128, '2022-10-04 10:42:12', NULL, 8, 99),
(129, '2022-10-04 12:32:27', NULL, 2, 80),
(130, '2022-10-04 12:32:27', NULL, 5, 80),
(131, '2022-10-04 12:36:00', NULL, 6, 80),
(132, '2022-10-04 12:38:50', NULL, 7, 80),
(133, '2022-10-04 12:51:05', NULL, 2, 92),
(134, '2022-10-04 12:51:05', NULL, 5, 92),
(135, '2022-10-04 12:52:14', NULL, 6, 92),
(136, '2022-10-04 12:58:31', NULL, 8, 80),
(137, '2022-10-04 12:59:09', NULL, 9, 80),
(138, '2022-10-04 12:59:15', NULL, 10, 80),
(139, '2022-10-04 13:07:12', NULL, 2, 73),
(140, '2022-10-04 13:07:12', NULL, 5, 73),
(141, '2022-10-04 13:42:52', NULL, 6, 73),
(142, '2022-10-04 14:07:07', NULL, 2, 39),
(143, '2022-10-04 14:07:07', NULL, 5, 39),
(144, '2022-10-04 14:11:10', NULL, 6, 39),
(145, '2022-10-04 14:11:45', NULL, 7, 39),
(146, '2022-10-04 14:14:49', NULL, 8, 39),
(147, '2022-10-04 14:15:39', NULL, 9, 39),
(148, '2022-10-04 14:15:46', NULL, 10, 39),
(153, '2022-10-04 14:30:30', NULL, 9, 48),
(154, '2022-10-04 16:09:46', NULL, 2, 6),
(155, '2022-10-04 16:09:46', NULL, 5, 6),
(156, '2022-10-04 16:13:37', NULL, 2, 47),
(157, '2022-10-04 16:13:37', NULL, 5, 47),
(158, '2022-10-04 16:18:02', NULL, 6, 6),
(159, '2022-10-04 16:18:36', NULL, 7, 6),
(160, '2022-10-04 16:48:06', NULL, 2, 44),
(161, '2022-10-04 16:48:06', NULL, 5, 44),
(162, '2022-10-04 16:53:28', NULL, 2, 40),
(163, '2022-10-04 16:53:28', NULL, 5, 40),
(164, '2022-10-04 17:19:43', NULL, 2, 66),
(165, '2022-10-04 17:19:43', NULL, 5, 66),
(166, '2022-10-04 17:20:37', NULL, 6, 66),
(167, '2022-10-04 17:25:39', NULL, 7, 66),
(168, '2022-10-04 18:48:53', NULL, 2, 51),
(169, '2022-10-04 18:48:53', NULL, 5, 51),
(170, '2022-10-04 18:57:36', NULL, 2, 33),
(171, '2022-10-04 18:57:36', NULL, 5, 33),
(172, '2022-10-04 19:22:19', NULL, 2, 45),
(173, '2022-10-04 19:22:19', NULL, 5, 45),
(174, '2022-10-04 19:35:53', NULL, 6, 45),
(175, '2022-10-04 19:36:35', NULL, 7, 45),
(176, '2022-10-04 19:43:19', NULL, 2, 114),
(177, '2022-10-04 19:43:19', NULL, 5, 114),
(178, '2022-10-04 19:46:47', NULL, 7, 73),
(179, '2022-10-04 19:54:13', NULL, 8, 45),
(180, '2022-10-04 20:01:54', NULL, 2, 58),
(181, '2022-10-04 20:01:54', NULL, 5, 58),
(182, '2022-10-04 20:09:10', NULL, 2, 35),
(183, '2022-10-04 20:09:10', NULL, 5, 35),
(184, '2022-10-04 20:22:03', NULL, 6, 95),
(185, '2022-10-04 20:22:34', NULL, 7, 95),
(186, '2022-10-04 20:26:15', NULL, 2, 98),
(187, '2022-10-04 20:26:15', NULL, 5, 98),
(188, '2022-10-04 20:31:40', NULL, 6, 98),
(189, '2022-10-04 20:32:01', NULL, 7, 98),
(190, '2022-10-04 20:35:57', NULL, 8, 73),
(191, '2022-10-04 20:37:35', NULL, 9, 73),
(192, '2022-10-04 20:37:58', NULL, 10, 73),
(193, '2022-10-04 21:39:06', NULL, 2, 81),
(194, '2022-10-04 21:39:06', NULL, 5, 81),
(195, '2022-10-04 21:41:05', NULL, 6, 81),
(196, '2022-10-04 21:43:50', NULL, 7, 81),
(197, '2022-10-04 21:59:48', NULL, 2, 57),
(198, '2022-10-04 21:59:48', NULL, 5, 57),
(199, '2022-10-04 22:00:38', NULL, 6, 57),
(200, '2022-10-04 22:00:50', NULL, 7, 57),
(201, '2022-10-04 23:53:54', NULL, 2, 43),
(202, '2022-10-04 23:53:54', NULL, 5, 43),
(203, '2022-10-05 00:03:53', NULL, 6, 43),
(204, '2022-10-05 00:07:42', NULL, 7, 43),
(205, '2022-10-05 00:44:38', NULL, 2, 12),
(206, '2022-10-05 00:44:38', NULL, 5, 12),
(207, '2022-10-05 00:45:30', NULL, 6, 12),
(208, '2022-10-05 00:49:03', NULL, 7, 12),
(209, '2022-10-05 00:54:56', NULL, 8, 12),
(210, '2022-10-05 01:00:09', NULL, 9, 12),
(211, '2022-10-05 01:00:15', NULL, 10, 12),
(212, '2022-10-05 01:00:46', NULL, 11, 12),
(213, '2022-10-05 01:01:53', NULL, 14, 12),
(214, '2022-10-05 01:02:41', NULL, 15, 12),
(215, '2022-10-05 01:05:02', NULL, 16, 12),
(216, '2022-10-05 01:11:42', NULL, 17, 12),
(217, '2022-10-05 01:27:49', NULL, 18, 12),
(218, '2022-10-05 01:27:56', NULL, 19, 12),
(219, '2022-10-05 01:48:23', NULL, 2, 4),
(220, '2022-10-05 01:48:23', NULL, 5, 4),
(221, '2022-10-05 02:03:43', NULL, 6, 4),
(222, '2022-10-05 02:08:14', NULL, 7, 4),
(223, '2022-10-05 02:23:40', NULL, 8, 4),
(224, '2022-10-05 02:30:39', NULL, 9, 4),
(225, '2022-10-05 02:30:48', NULL, 10, 4),
(226, '2022-10-05 03:07:49', NULL, 2, 69),
(227, '2022-10-05 03:07:49', NULL, 5, 69),
(228, '2022-10-05 03:08:19', NULL, 6, 69),
(229, '2022-10-05 03:11:47', NULL, 7, 69),
(230, '2022-10-05 03:15:57', NULL, 8, 69),
(231, '2022-10-05 03:16:47', NULL, 9, 69),
(232, '2022-10-05 03:16:55', NULL, 10, 69),
(233, '2022-10-05 03:31:38', NULL, 2, 65),
(234, '2022-10-05 03:31:38', NULL, 5, 65),
(235, '2022-10-05 14:07:34', NULL, 2, 25),
(236, '2022-10-05 14:07:34', NULL, 5, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_text` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `answer`
--

TRUNCATE TABLE `answer`;
--
-- Volcado de datos para la tabla `answer`
--

INSERT INTO `answer` (`answer_id`, `answer_text`) VALUES
(1, '6,7%'),
(2, '11,7%'),
(3, '19,3%'),
(4, '16,5%'),
(5, 'Ninguna de las anteriores'),
(6, 'Adolescentes mejoran sus conocimientos y actitudes relacionadas con salud sexual y reproductiva.'),
(7, 'Los prestadores se fortalecen conocimientos y habilidades específicas para la atención diferenciada a adolescentes y jóvenes.'),
(8, 'Adolescentes evitan relaciones con sus pares y se abstienen de iniciar relaciones sexuales.'),
(9, 'Adolescentes reconocen y resignifican representaciones sociales de los roles de género asignados a hombres y mujeres y previenen embarazos no intencionales.'),
(10, 'Todas las anteriores son ciertas.'),
(11, 'Los implantes subdérmicos en adolescentes tienen una excelente continuación a 1 año después del parto.'),
(12, 'El inicio inmediato de los implantes anticonceptivos en el posparto tiene un efecto perjudicial sobre el crecimiento del lactante o el inicio o la continuación de la lactancia materna	'),
(13, 'Ofrecer métodos de larga duración tipo implante subdérmico en el post parto inmediato, a las madres adolescentes es rentable'),
(14, 'Usar métodos anticonceptivos en el post parto inmediato reduce la necesidad de abortos inseguros'),
(15, 'Posibilita la autonomía y autodeterminación reproductiva de las mujeres'),
(16, 'Evita los embarazos no intencionales'),
(17, 'Previene la mortalidad materna'),
(18, 'Ayuda a prevenir embarazos subsiguientes en la adolescencia'),
(19, 'Todas las anteriores son beneficios'),
(20, 'La igualdad de género concreta la posibilidad de la autodeterminación y autonomía corporal de las niñas y adolescentes'),
(21, 'Tener acceso a educación sexual integral dota a niños, niñas y adolescentes de conocimientos, habilidades para disfrutar de salud, bienestar y dignidad'),
(22, 'Acceso a amplia gama de métodos anticonceptivos, de preferencia de larga duración, que sean accesibles de forma gratuita en el lugar donde se realiza la consulta, de manera inmediata'),
(23, 'Todas son correctas'),
(24, 'Ninguna es correcta'),
(25, '1'),
(26, '2'),
(27, '3'),
(28, '4'),
(29, '5'),
(30, 'Puede llevar a clasificar a las personas de tal forma que subvalora a unas personas y a otras no.'),
(31, 'Está relacionado con la identidad social y personal asociada con la asignación del sexo al nacer, la identidad y la expresión de género y la orientación sexual. '),
(32, 'El género es inherente a los derechos humanos y a la dignidad humana. '),
(33, 'Todas las anteriores.'),
(34, 'El derecho a solicitar al profesional de la salud el no reporte del caso en el Sistema de Vigilancia en Salud Pública. '),
(35, 'El derecho a la orientación e interrupción voluntaria del embarazo. '),
(36, 'El derecho a decidir si se quiere ser atendido por un médico o médica. '),
(37, 'El derecho a solicitar que el agresor pague por los servicios de salud prestados.'),
(38, 'La explotación sexual.'),
(39, 'El acceso carnal.'),
(40, 'Los matrimonios infantiles y las uniones tempranas.'),
(41, 'El embarazo forzado.'),
(42, 'Es muy agresivo.'),
(43, 'Porque no tienen a dónde ir.'),
(44, 'Porque su familia y/o comunidad no la apoyan.'),
(45, 'Todas las anteriores.'),
(46, 'El enfoque de género y territorial.'),
(47, 'El enfoque diferencial.'),
(48, 'En enfoque intersectorial.'),
(49, 'El enfoque basado en el trauma y las necesidades de la víctima.'),
(50, NULL),
(51, 'Algunos estudios han demostrado una disminución significativa del riesgo de cáncer de ovario y endometrio con el uso de anticonceptivos hormonales'),
(52, 'El riesgo de cáncer de pulmón se incrementa con el uso de anticonceptivos hormonales'),
(53, 'No se ha demostrado una asociación entre el uso de anticonceptivos hormonales y un mayor riesgo de cáncer de cuello uterino'),
(54, 'El riesgo de mortalidad asociado a embarazo duplica el riesgo de cáncer de mama'),
(55, 'Iniciar el uso de dispositivo intrauterino de cobre'),
(56, 'Iniciar el uso de dispositivo intrauterino con liberación hormonal'),
(57, 'Contraindicar el uso de cualquier método de larga duración'),
(58, 'Iniciar el uso de los implantes anticonceptivos de levonorgestrel'),
(59, 'Uso de métodos de barrera'),
(60, 'Utilizar dispositivo intrauterino de cobre'),
(61, 'Utilizar algún método hormonal que contenga levonorgestrel'),
(62, 'Utilizar, de acuerdo a las posibilidades, método quirúrgico para esterilización'),
(63, 'Ofrecer asesoría y educación al paciente sobre reproducción e infecciones de transmisión sexual'),
(64, 'Recomendar el uso de anticonceptivos inyectables mensuales'),
(65, 'Brindar asesoría y educación al paciente con respecto a los diferentes métodos anticonceptivos disponibles, su uso, implementación y costo'),
(66, 'Recomendar el uso de anticonceptivos implantables de larga duración'),
(67, 'Monitoreo expectante y asesoría con parte de tranquilidad a la paciente'),
(68, 'Uso de antiinflamatorio no esteroideo por cinco días'),
(69, 'Uso de anticonceptivo oral combinado de dosis baja, por 21 días'),
(70, 'Todas las anteriores'),
(71, 'Número y género de las parejas sexuales'),
(72, 'Antecedentes de otras ITS'),
(73, 'Tipos de prácticas sexuales'),
(74, 'Medicamentos prescritos para comorbilidades'),
(75, 'Bacterias'),
(76, 'Virus'),
(77, 'Priones'),
(78, 'Parásitos'),
(79, 'La vaginosis bacteriana no se considera estrictamente una ITS; sin embargo está asociada con la actividad sexual'),
(80, 'La infección parasitaria por Trichomonas vaginalis no se transmite por vía sexual'),
(81, 'Aproximadamente en el 60% de las mujeres se presenta colonización por Candida sin que ello implique presencia de síntomas'),
(82, 'Otras condiciones, diferentes a las infecciosas, podrían conllevar flujo vaginal anormal'),
(83, 'Se ha demostrado que la depresión no interfiere con el éxito de las intervenciones terapéuticas para las ITS'),
(84, 'Emociones como la vergüenza y la culpa juegan un papel importante al influir en las decisiones de las personas de buscar tratamiento para las ITS'),
(85, 'Los jóvenes, especialmente, suelen experimentar vergüenza cuando hablan con los profesionales de la salud sobre su comportamiento sexual'),
(86, 'Las consecuencias de la depresión en pacientes con ITS pueden incluir una alta comorbilidad con trastornos de ansiedad, aumento de conductas de riesgo, abuso de sustancias y suicidio'),
(87, 'Evaluación del riesgo, educación y asesoramiento sobre los comportamientos sexuales y los mecanismos de prevención'),
(88, 'Vacunación previa a la exposición'),
(89, 'Evaluación y manejo de las parejas sexuales de personas infectadas'),
(90, 'Todas las anteriores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_name` varchar(100) DEFAULT NULL,
  `type_content_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `type_content_id` (`type_content_id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `content`
--

TRUNCATE TABLE `content`;
--
-- Volcado de datos para la tabla `content`
--

INSERT INTO `content` (`content_id`, `content_name`, `type_content_id`, `module_id`) VALUES
(1, 'Home módulo 1', 1, 1),
(2, 'Infografía1 módulo 1', 2, 1),
(3, 'Infografía2 módulo 1', 2, 1),
(4, 'Infografía3 módulo 1', 2, 1),
(5, 'Video módulo 1', 3, 1),
(6, 'Podcast módulo 1', 4, 1),
(7, 'Cuestionario módulo 1', 5, 1),
(8, 'Evaluación módulo 1', 6, 1),
(9, 'Encuentro con el experto módulo 1', 7, 1),
(10, 'Home módulo 2', 1, 2),
(11, 'Infografía1 módulo 2', 2, 2),
(12, 'Infografía2 módulo 2', 2, 2),
(13, 'Infografía3 módulo 2', 2, 2),
(14, 'Video módulo 2', 3, 2),
(15, 'Podcast módulo 2', 4, 2),
(16, 'Cuestionario módulo 2', 5, 2),
(17, 'Evaluación módulo 2', 6, 2),
(18, 'Encuentro con el experto módulo 2', 7, 2),
(19, 'Home módulo 3', 1, 3),
(20, 'Infografía1 módulo 3', 2, 3),
(21, 'Infografía2 módulo 3', 2, 3),
(22, 'Infografía3 módulo 3', 2, 3),
(23, 'Video módulo 3', 3, 3),
(24, 'Podcast módulo 3', 4, 3),
(25, 'Cuestionario módulo 3', 5, 3),
(26, 'Evaluación módulo 3', 6, 3),
(27, 'Encuentro con el experto módulo 3', 7, 3),
(28, 'Home módulo 4', 1, 4),
(29, 'Infografía1 módulo 4', 2, 4),
(30, 'Infografía2 módulo 4', 2, 4),
(31, 'Infografía3 módulo 4', 2, 4),
(32, 'Video módulo 4', 3, 4),
(33, 'Podcast módulo 4', 4, 4),
(34, 'Cuestionario módulo 4', 5, 4),
(35, 'Evaluación módulo 4', 6, 4),
(36, 'Encuentro con el experto módulo 4', 7, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `content_info`
--

DROP TABLE IF EXISTS `content_info`;
CREATE TABLE IF NOT EXISTS `content_info` (
  `content_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_info_title` varchar(1000) DEFAULT NULL,
  `content_info_img` varchar(600) DEFAULT NULL,
  `content_info_element` varchar(600) DEFAULT NULL,
  `content_info_detail` varchar(1000) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`content_info_id`),
  KEY `content_id` (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `content_info`
--

TRUNCATE TABLE `content_info`;
--
-- Volcado de datos para la tabla `content_info`
--

INSERT INTO `content_info` (`content_info_id`, `content_info_title`, `content_info_img`, `content_info_element`, `content_info_detail`, `content_id`) VALUES
(1, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-1\"><strong>ADOLESCENCIA Y POSPARTO:</strong></p><p class=\"fw-normal fs-2 txt-color-1\">DOS ESCENARIOS CON NECESIDADES ESPECIALES</p>', 'bg-m1.jpg', NULL, NULL, 1),
(2, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-2\"><strong>NECESIDADES\nINSATISFECHAS</strong></p><p class=\"fw-normal fs-2 txt-color-2\">DE SALUD SEXUAL Y\nREPRODUCTIVA EN\nLOS ADOLESCENTES Y\nJÓVENES COLOMBIANOS</p>', '../assets/img/infographic/m1i1.jpg', '../assets/pdf/M1I1.pdf', NULL, 2),
(3, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-2\"><strong>CLAVES DE LA CONSEJERÍA EN SALUD SEXUAL Y REPRODUCTIVA EN</strong></p><p class=\"fw-normal fs-2 txt-color-2\">EL POSPARTO O POST EVENTO OBSTÉTRICO</p>', '../assets/img/infographic/m1i2.jpg', '../assets/pdf/M1I2.pdf', NULL, 3),
(4, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-2\"><strong>BENEFICIOS DE LA ANTICONCEPCIÓN EN LA ADOLESCENCIA</strong></p><p class=\"fw-normal fs-2 txt-color-2\">Y DESPUÉS DE UN EVENTO OBSTÉTRICO</p>', '../assets/img/infographic/m1i3.jpg', '../assets/pdf/M1I3.pdf', NULL, 4),
(5, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-white\"><strong>¿POR QUÉ IMPLEMENTAR SERVICIOS</strong></p><p class=\"fw-normal fs-2 txt-white\">DE SALUD AMIGABLES PARA JÓVENES Y ADOLESCENTES?</p>\n', '../assets/img/video/m1.jpg', '../assets/video/m1.mp4', NULL, 5),
(6, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-2\"><strong>COACHING DE SALUD SEXUAL Y  REPRODUCTIVA:</strong></p><p class=\"fw-normal fs-2 txt-color-2\">ESTRATEGIAS QUE CAMBIAN VIDAS</p>', '../assets/img/podcast/m1.jpg', '../assets/podcast/m1.mp3', NULL, 6),
(7, '¿Cuáles son las necesidades de salud sexual y reproductiva en la adolescencia y el periodo posparto y cómo abordarlas?', '../assets/img/webinar/m1.png', 'https://connect.abbott/calendario-de-charlas/cuales-son-las-necesidades-de-salud-sexual-y-reproductiva-en-la-adolescencia-y-el-periodo-posparto-y-como-abordarlas/?utm_source=whatsapp&utm_medium=visitadores&utm_campaign=charlas-virtuales&utm_content=cuales-son-las-necesidades-de-salud-sexual-y-reproductiva-en-la-adolescencia-y-el-periodo-posparto-y-como-abordarlas&utm_term=charla-virtual', '<label class=\"txt-white fs-3\">DRA. DIANA PATRICIA HENAO</label><p class=\"txt-white fs-txt\">Especialista en Medicina Familiar U. Valle</p><p class=\"txt-white fs-txt\">Sexóloga clínica y Educadora Sexual IMSEX, Certificada por FLASSES.</p><p class=\"txt-white fs-txt\">Investigadora en Salud Sexual y Reproductiva Profesora Asistente de Medicina y Medicina Familiar PUJ y de la Especialización en Ginecología y Obstetricia U. Libre de Cali.</p><p class=\"txt-white fs-txt\">Miembro fundador de la Asociación Colombiana de Salud Sexual ACSEX</p>', 9),
(8, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-2\"><strong>CUERPO Y GÉNERO:</strong></p><p class=\"fw-normal fs-2 txt-color-2\">DECISIONES LIBRES DE VIOLENCIAS</p>', 'bg-m2.jpg', NULL, NULL, 10),
(9, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-1\"><strong>MITOS SOBRE LA VIOLENCIA DE GÉNERO:</strong></p><p class=\"fw-normal fs-2 txt-color-1\">ACLARANDO CONCEPTOS</p>', '../assets/img/infographic/m2i1.jpg', '../assets/pdf/M2I1.pdf', NULL, 11),
(10, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-1\"><strong>PAPEL DE LOS PROFESIONALES DE LA SALUD EN</strong></p><p class=\"fw-normal fs-2 txt-color-1\">LA PREVENCIÓN DE LAS VIOLENCIAS CONTRA LAS MUJERES</p>', '../assets/img/infographic/m2i2.jpg', '../assets/pdf/M2I2.pdf', NULL, 12),
(11, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-1\"><strong>LA CONSULTA:</strong></p><p class=\"fw-normal fs-2 txt-color-1\">UN TERRITORIO LIBRE DE VIOLENCIA, ¿CÓMO  DETECTAR CASOS DE VIOLENCIA SEXUAL?</p>', '../assets/img/infographic/m2i3.jpg', '../assets/pdf/M2I3.pdf', NULL, 13),
(12, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-white\"><strong>RUTA DE ATENCIÓN INTEGRAL</strong></p><p class=\"fw-normal fs-2 txt-white\">PARA\nVÍCTIMAS DE VIOLENCIAS DE GÉNERO</p>\n', '../assets/img/video/m2.jpg', '../assets/video/m2.mp4', NULL, 14),
(13, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-1\"><strong>INTERRUPCIÓN VOLUNTARIA DEL EMBARAZO,</strong></p><p class=\"fw-normal fs-2 txt-color-1\">¿QUÉ PAPEL DEBE ASUMIR EL PROFESIONAL DE LA SALUD?</p>', '../assets/img/podcast/m2.jpg', '../assets/podcast/m2.mp3', NULL, 15),
(14, '¿Qué se entiende por enfoque\nde género, cuáles son los\nconceptos que se deben tener\nclaros y cómo aplicar este\nenfoque en la práctica?', '../assets/img/webinar/m1.png', 'https://connect.abbott/calendario-de-charlas/que-se-entiende-por-enfoque-de-genero-cuales-son-los-conceptos-que-se-deben-tener-claros-y-como-aplicar-este-enfoque-en-la-practica/?utm_source=whatsapp&utm_medium=visitadores&utm_campaign=charlas-virtuales&utm_content=que-se-entiende-por-enfoque-de-genero-cuales-son-los-conceptos-que-se-deben-tener-claros-y-como-aplicar-este-enfoque-en-la-practica&utm_term=charla-virtual', '<label class=\"txt-white fs-3\">DRA. DIANA PATRICIA HENAO</label><p class=\"txt-white fs-txt\">Especialista en Medicina Familiar U. Valle</p><p class=\"txt-white fs-txt\">Sexóloga clínica y Educadora Sexual IMSEX, Certificada por FLASSES.</p><p class=\"txt-white fs-txt\">Investigadora en Salud Sexual y Reproductiva Profesora Asistente de Medicina y Medicina Familiar PUJ y de la Especialización en Ginecología y Obstetricia U. Libre de Cali.</p><p class=\"txt-white fs-txt\">Miembro fundador de la Asociación Colombiana de Salud Sexual ACSEX</p>', 18),
(15, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-1\"><strong>ANTICONCEPCIÓN DE LARGA DURACIÓN:</strong></p><p class=\"fw-normal fs-2 txt-color-1\">UNA ESTRATEGIA\nPARA APROPIARSE DEL FUTURO</p>', 'bg-m3.jpg', NULL, NULL, 19),
(16, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-2\"><strong>USO DE\nANTICONCEPTIVOS\nDE LARGA DURACIÓN</strong></p><p class=\"fw-normal fs-2 txt-color-2\">EN PRESENCIA DE\nCOMORBILIDADES</p>', '../assets/img/infographic/m3i1.jpg', '../assets/pdf/M3I1.pdf', NULL, 20),
(17, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-2\"><strong>INTERACCIONES\nDE LOS MÉTODOS</strong></p><p class=\"fw-normal fs-2 txt-color-2\">DE LARGA DURACIÓN</p>', '../assets/img/infographic/m3i2.jpg', '../assets/pdf/M3I2.pdf', NULL, 21),
(18, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-2\"><strong>BARRERAS DE ACCESO</strong></p><p class=\"fw-normal fs-2 txt-color-2\">A LOS MÉTODOS\nDE LARGA DURACIÓN</p>', '../assets/img/infographic/m3i3.jpg', '../assets/pdf/M3I3.pdf', NULL, 22),
(19, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-white\"><strong>ESTRATEGIAS PARA\nDESMITIFICAR EL\nTEMOR DE LAS MUJERES</strong></p><p class=\"fw-normal fs-2 txt-white\">A LOS MÉTODOS\nANTICONCEPTIVOS\nHORMONALES</p>\n', '../assets/img/video/m3.jpg', '../assets/video/m3.mp4', NULL, 23),
(20, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-2\"><strong>MANEJO DE\nPATRONES DE SANGRADO\nIRREGULAR DERIVADOS</strong></p><p class=\"fw-normal fs-2 txt-color-2\">DEL USO DE UN MÉTODO\nDE LARGA DURACIÓN</p>', '../assets/img/podcast/m3.jpg', '../assets/podcast/m3.mp3', NULL, 24),
(21, '¿Cuáles son las necesidades de salud sexual y reproductiva en la adolescencia y el periodo posparto y cómo abordarlas?', '../assets/img/webinar/m1.png', NULL, '<label class=\"txt-white fs-3\">DRA. DIANA PATRICIA HENAO</label><p class=\"txt-white fs-txt\">Especialista en Medicina Familiar U. Valle</p><p class=\"txt-white fs-txt\">Sexóloga clínica y Educadora Sexual IMSEX, Certificada por FLASSES.</p><p class=\"txt-white fs-txt\">Investigadora en Salud Sexual y Reproductiva Profesora Asistente de Medicina y Medicina Familiar PUJ y de la Especialización en Ginecología y Obstetricia U. Libre de Cali.</p><p class=\"txt-white fs-txt\">Miembro fundador de la Asociación Colombiana de Salud Sexual ACSEX</p>', 27),
(22, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-2\"><strong>INFECCIONES DE TRANSMISIÓN SEXUAL:</strong></p><p class=\"fw-normal fs-2 txt-color-2\">LA PREVENCIÓN\nASEGURA EL FUTURO</p>', 'bg-m4.jpg', NULL, NULL, 28),
(23, '<p class=\"lh-sm font-txt-subtitle fs-1 txt-color-1\"><strong>CONCEPTOS GENERALES SOBRE</strong></p><p class=\"fw-normal fs-2 txt-color-1\">LAS INFECCIONES\nDE TRANSMISIÓN SEXUAL</p>', '../assets/img/infographic/m4i1.jpg', '../assets/pdf/M4I1.pdf', NULL, 29),
(24, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-1\"><strong>FLUJOS VAGINALES,</strong></p><p class=\"fw-normal fs-2 txt-color-1\">¿QUÉ RELACIÓN\nTIENEN CON LAS ITS?</p>', '../assets/img/infographic/m4i2.jpg', '../assets/pdf/M4I2.pdf', NULL, 30),
(25, '<p class=\"lh-sm font-txt-subtitle fs-1 txt-color-1\"><strong>IMPACTO EMOCIONAL</strong></p><p class=\"fw-normal fs-2 txt-color-1\">DE LAS ITS</p>', '../assets/img/infographic/m4i3.jpg', '../assets/pdf/M4I3.pdf', NULL, 31),
(26, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-white\"><strong>TIPOS\nDE INFECCIONES</strong></p><p class=\"fw-normal fs-2 txt-white\">DE TRANSMISIÓN SEXUAL</p>\n', '../assets/img/video/m4.jpg', '../assets/video/m4.mp4', NULL, 32),
(27, '<p class=\"lh-sm font-txt-subtitle fs-1  txt-color-2\"><strong>PREVENCIÓN</strong></p><p class=\"fw-normal fs-2 txt-color-2\">DE ITS</p>', '../assets/img/podcast/m4.jpg', '../assets/podcast/m4.mp3', NULL, 33),
(28, '¿Cuáles son las necesidades de salud sexual y reproductiva en la adolescencia y el periodo posparto y cómo abordarlas?', '../assets/img/webinar/m1.png', NULL, '<label class=\"txt-white fs-3\">DRA. DIANA PATRICIA HENAO</label><p class=\"txt-white fs-txt\">Especialista en Medicina Familiar U. Valle</p><p class=\"txt-white fs-txt\">Sexóloga clínica y Educadora Sexual IMSEX, Certificada por FLASSES.</p><p class=\"txt-white fs-txt\">Investigadora en Salud Sexual y Reproductiva Profesora Asistente de Medicina y Medicina Familiar PUJ y de la Especialización en Ginecología y Obstetricia U. Libre de Cali.</p><p class=\"txt-white fs-txt\">Miembro fundador de la Asociación Colombiana de Salud Sexual ACSEX</p>', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `content_question`
--

DROP TABLE IF EXISTS `content_question`;
CREATE TABLE IF NOT EXISTS `content_question` (
  `content_question_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`content_question_id`),
  KEY `content_id` (`content_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `content_question`
--

TRUNCATE TABLE `content_question`;
--
-- Volcado de datos para la tabla `content_question`
--

INSERT INTO `content_question` (`content_question_id`, `content_id`, `question_id`) VALUES
(1, 7, 1),
(2, 7, 2),
(3, 7, 3),
(4, 7, 4),
(5, 7, 5),
(6, 8, 6),
(7, 8, 7),
(8, 8, 8),
(9, 8, 9),
(10, 8, 10),
(11, 16, 12),
(12, 16, 13),
(13, 16, 14),
(14, 16, 15),
(15, 16, 16),
(16, 17, 6),
(17, 17, 7),
(18, 17, 8),
(19, 17, 9),
(20, 17, 10),
(21, 35, 11),
(22, 25, 17),
(23, 25, 18),
(24, 25, 19),
(25, 25, 20),
(26, 25, 21),
(27, 26, 6),
(28, 26, 7),
(29, 26, 8),
(30, 26, 9),
(31, 26, 10),
(32, 34, 22),
(33, 34, 23),
(34, 34, 24),
(35, 34, 25),
(36, 34, 26),
(37, 35, 6),
(38, 35, 7),
(39, 35, 8),
(40, 35, 9),
(41, 35, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_user`
--

DROP TABLE IF EXISTS `data_user`;
CREATE TABLE IF NOT EXISTS `data_user` (
  `data_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `data_user_treatment` bit(1) NOT NULL,
  `data_user_transfer` bit(1) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`data_user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `data_user`
--

TRUNCATE TABLE `data_user`;
--
-- Volcado de datos para la tabla `data_user`
--

INSERT INTO `data_user` (`data_user_id`, `data_user_treatment`, `data_user_transfer`, `user_id`) VALUES
(1, b'1', b'1', 26),
(2, b'1', b'1', 110),
(3, b'1', b'1', 102),
(4, b'1', b'1', 48),
(5, b'1', b'1', 101),
(6, b'1', b'1', 67),
(7, b'1', b'1', 74),
(8, b'1', b'1', 80),
(9, b'1', b'1', 86),
(10, b'1', b'1', 93),
(11, b'1', b'1', 59),
(12, b'1', b'1', 29),
(13, b'1', b'1', 28),
(14, b'1', b'1', 95),
(15, b'1', b'1', 92),
(16, b'1', b'1', 111),
(17, b'1', b'1', 58),
(18, b'1', b'1', 90),
(19, b'1', b'1', 34),
(20, b'1', b'1', 64),
(22, b'1', b'1', 71),
(23, b'1', b'1', 20),
(24, b'1', b'1', 2),
(25, b'1', b'1', 6),
(26, b'1', b'1', 5),
(27, b'1', b'1', 62),
(28, b'1', b'1', 54),
(29, b'1', b'1', 63),
(30, b'1', b'1', 8),
(31, b'1', b'1', 15),
(32, b'1', b'1', 56),
(33, b'1', b'1', 100),
(34, b'1', b'1', 30),
(35, b'1', b'1', 99),
(36, b'1', b'1', 69),
(37, b'1', b'1', 31),
(38, b'1', b'1', 73),
(39, b'1', b'1', 39),
(40, b'1', b'1', 106),
(41, b'1', b'1', 47),
(42, b'1', b'1', 13),
(43, b'1', b'1', 35),
(44, b'1', b'1', 44),
(45, b'1', b'1', 40),
(46, b'1', b'0', 104),
(47, b'1', b'1', 66),
(48, b'1', b'1', 51),
(49, b'1', b'1', 33),
(50, b'1', b'1', 45),
(51, b'1', b'1', 114),
(52, b'1', b'1', 98),
(53, b'1', b'1', 81),
(54, b'1', b'1', 57),
(55, b'1', b'1', 41),
(56, b'1', b'1', 43),
(57, b'1', b'1', 12),
(58, b'1', b'1', 4),
(59, b'1', b'1', 65),
(60, b'1', b'1', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_email` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `login_password` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`login_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `login`
--

TRUNCATE TABLE `login`;
--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`login_id`, `login_email`, `login_password`, `user_id`) VALUES
(1, '1111111111', '066fc77285b1e58327bd8045ae94d4d0', 1),
(2, '1022938063', '0e86788c2b97a6737b727929e1a0d3ac', 2),
(3, '1075651474', 'edf0501068a278431103765e27ca65c7', 3),
(4, '39624211', '513d100c9ae5d6912dc3cf20ea62adce', 4),
(5, '1030546339', '487d34fe8644321e68f9be0889e93ff3', 5),
(6, '52970158', '17734a5981133e6fd9575d8730aac415', 6),
(7, '1014284518', 'c489914d9b97af75cc7f6c11b2de8383', 7),
(8, '1101691566', 'f3433fede2cadd600fe1e4b5d89e547a', 8),
(9, '46458020', 'b5417a2e6258e7cfadae1308ed8f6358', 9),
(10, '53032589', '5ebb1e6a7ba0d60a20b40e19238c221e', 10),
(11, '52302072', '414b8a6e151e9479df782d21c2c560c2', 11),
(12, '1233900951', '072870fb0cf72a6ab75c2ff11b0f3506', 12),
(13, '65750654', '9e806d345a8457e177cea1a121dc7ab6', 13),
(14, '1013650316', 'a7200fa8f7f75469f8cff6ba740eeeb0', 14),
(15, '52754856', '0740dbc8e1374eaca027d8e7c4359d7f', 15),
(16, '39648483', 'c90f2b5d573f089dd04242429fff3496', 16),
(17, '51890764', '287840d08d32aaf1fc49e92cfe827fa8', 17),
(18, '1001274572', 'a39f3656c040c0fb286b24bd7b1aee4e', 18),
(19, '1013597118', 'ec21b6c77ad003033003c1db425829d5', 19),
(20, '52908103', '63384304b6949b15cbf2738cc8a0df4e', 20),
(21, '1013590139', '6d198f2e41e2898514f9f2a323c67c95', 21),
(22, '1022381414', 'b6b21fff99f13986488631446f63bce7', 22),
(23, '36178081', '661d86cc517ea1e2dd6cd2f00e188584', 23),
(24, '36313831', 'e5861a36586d021a48dfede0b0a3883f', 24),
(25, '53015767', 'd8ce95da8955bc700052c0d320bc87ea', 25),
(26, '1030552221', '692017542a405aa58f74214cbe812e5c', 26),
(27, '64722241', '8e1a4900e8f1177031b78fc28b69aa55', 27),
(28, '40393093', '59c105607b01e839e08a538643d56bd1', 28),
(29, '1118539560', 'e2270c25675f30e2bf7ab38037ecbda3', 29),
(30, '30391592', '41336cc510ed9a9742816cbbf1cf8e4e', 30),
(31, '1013603639', '28716e60e5154ff0e17558c5cac08603', 31),
(32, '1082776768', '159916ada0d2af18a23b1204399f6519', 32),
(33, '79764515', '076716aeb4b53a3215183375ff8dbbbb', 33),
(34, '52977377', 'd54612f32ad5b5d2843acf3a375db5ca', 34),
(35, '52540784', '6799c1bab89f347bca79f9f4b8da760f', 35),
(37, '49790233', '8448e63fca2c264491288c6bcef046c9', 37),
(38, '43540573', '6ba612fbfd7ca2d11294082b928c4f3e', 38),
(39, '43620363', '021bdee3c963b68685e732b64787ac00', 39),
(40, '1036780744', '7c1306e25555ba9620e573b603140dc8', 40),
(41, '1094956093', '276538770f685eca090a24b5d560d337', 41),
(42, '32181993', 'a2feadc7d283b4037caf7fefe71875f1', 42),
(43, '1077420404', 'f8fb0c98fc17089ae601d800f6a2e951', 43),
(44, '43119221', 'c14bb4e2100253e004161dee241dc394', 44),
(45, '1036652287', 'e87a8f70011b0d0479b746d496e52450', 45),
(46, '1077437710', 'e36a42533118573185156146c33ec24b', 46),
(47, '1152686917', '051a242f032caf99ec3117d9f551e921', 47),
(48, '64742201', '02b4851e419b34bc2d8dcdb7b8442a5a', 48),
(49, '1043842286', '1d54b1572251759af997d461b5a4835e', 49),
(50, '1045711396', '8f828d2939b72af956d9acaa0613b717', 50),
(51, '1143335232', '826548886e5d707bcb4d021a7acfb581', 51),
(52, '1083467060', '86fe4ebba72199c9060b211e5037879b', 52),
(53, '1140853840', 'c69c31b70b42fc2f20caad13a18addf5', 53),
(54, '1051357478', 'f23477a175460608bcd11950e26d2ff9', 54),
(55, '1128187343', '4eea875f7ab57b470423dc383e301d2c', 55),
(56, '45560622', 'ae4034e6e34b12a055e762ce5a5accdd', 56),
(57, '1065626068', 'a370223d8a586ff5f6c2c4e33d56eec8', 57),
(58, '1140821894', '875f6c7153f0a7738967a3a02eec369a', 58),
(59, '1064306650', 'ed76c5399ee4e31fd67513d2f4e68883', 59),
(60, '1065627708', '6388e6cf237cfddf1eb03422549ebd57', 60),
(61, '22742443', 'e01c87cbc54a1bf747bb72a1712626dc', 61),
(62, '29661167', '9359443e7e2124f761c2d47d77461caf', 62),
(63, '1143941189', '93d207a892a573f85a7a76dde76eb999', 63),
(64, '36753978', '1b98193efb24c34d93e25903259a5201', 64),
(65, '1061700059', '57b0adad6a9664d62eb62416384b84c4', 65),
(66, '1113517177', 'c5b4b5425e34e82a797f5b190437f76a', 66),
(67, '1060103464', '0acacaf5351d1098bf080e17cd68db3b', 67),
(68, '34326819', 'e9d7bc7c9b26c31cabd20eb2209f0804', 68),
(69, '29507321', '647b9b3df0f6012b47c101952c822c9f', 69),
(70, '1061748849', 'b9f68b8f876d74a652ca45b3c7dbbfb3', 70),
(71, '1061740453', '55c61b9543ade7a110e319e92132cdd7', 71),
(72, '67026341', 'b73cbed4f56bef6bc27ee3299153ec7d', 72),
(73, '25453250', 'f41042315986cdebdcf9982ddf4f6288', 73),
(74, '31305644', '30cc2d64eba6a55943a8c5f699cce0fd', 74),
(75, '37864898', 'f1e5930024cb7f62eacc28c90875a9ae', 75),
(76, '37861944', 'c7fc15c03ec615ad02a5b4ac557b28bb', 76),
(77, '63546325', 'c0bdcfe73d83275bd986ee62c3c04c2c', 77),
(78, '37327461', 'f558282b0d5e3a2d1f1b5bda9deb0308', 78),
(79, '1095923791', 'f290273d0ac7f126610422684a5b4027', 79),
(80, '1095829481', '4ed0c406705e91134f2b8aaf8dc1264b', 80),
(81, '1096213424', '37e209c9d20aa491e47a8ae2875798e4', 81),
(82, '37580567', 'b3a8c6f99e1111c53d9aab2ba918bddd', 82),
(83, '63468544', '1597f6172dbe2f5bf8317e504b7a9460', 83),
(84, '63561138', '99d9295fc4e62095620fb33026a87dae', 84),
(85, '1100952345', 'dc5e353340f0c32fe7c287fbc013f796', 85),
(86, '1100954326', '159fb489b5be4e35c735cf7eb8c46e9e', 86),
(87, '28411408', 'f95ed843d156f2eb9e348a79a1151811', 87),
(88, '37949827', '5d62ef66b578550d2b5e2ee3848db237', 88),
(89, '63539548', 'bd3c0b7a038fc2177e524462966b9b76', 89),
(90, '49729103', '631b5317500eeca4b35d3f3271769055', 90),
(91, '1065985827', '400d2282cf38ce8da1864f682479eeb9', 91),
(92, '30358879', '4f4b276ad47394592d6eb36d98f8f031', 92),
(93, '34000940', '1f49c2bb9c4715797f6249399eba2319', 93),
(94, '1088274248', '62ae5d64d38f239d64675260abcf5c0d', 94),
(95, '30279948', 'cedf835ff2789c62d721be44709d803b', 95),
(96, '41950957', 'cfc0aecca88e50b4311eb69a940164bf', 96),
(97, '1039464139', '4895950b9eb5961e7b6ff195d674b586', 97),
(98, '66999377', 'fb14fcb674367f085e99cbf07a5c8268', 98),
(99, '42018544', '38069bd0088a173de9185e970787708f', 99),
(100, '1053771871', '516f8ed172c0d33adddfa39feb6edb8f', 100),
(101, '65631905', 'd2c216478c9f4c87cdbcb522cc292a47', 101),
(102, '1032359400', '335ff48bd6b20f3879230fe431e84d22', 102),
(103, '8666233', 'e5e46f7f43de4d39170413c1157531f0', 103),
(104, '75079679', '192ff82cde7f5cfb2d7a926edc64c4aa', 104),
(105, '66982838', '2afe4b68c73c93783e9eda30e502f23c', 105),
(106, '44155391', 'dc1da112e88b634a2d9fb1ae6cc555a5', 106),
(107, '91271352', '188f22a56984ebb3cc58f061882553b3', 107),
(108, '63512483', '0087b2f7f632a82e36bd679530d5a0e8', 108),
(109, '4176073', '2f1796f4e6784aca8ddd7b73511419b0', 109),
(110, '52023637', '9a7dee61ddb90ca3be0112755ccb9d7f', 110),
(111, '1010247923', '0c019c494e90fa93690c8e8476d76916', 111),
(112, '52412105', 'fbc7fbea89454dd040f3cbc7c84a7a9d', 112),
(113, '901153487', 'e4738a35fa6bfab9408e435c71702b81', 113),
(114, '1110498504', 'f73cb31c081dd41b368138051ccc9a34', 114);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(80) DEFAULT NULL,
  `module_rute` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `module`
--

TRUNCATE TABLE `module`;
--
-- Volcado de datos para la tabla `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `module_rute`) VALUES
(1, 'Módulo 1', NULL),
(2, 'Módulo 2', NULL),
(3, 'Módulo 3', NULL),
(4, 'Módulo 4', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(50) DEFAULT NULL,
  `permission_description` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `permission`
--

TRUNCATE TABLE `permission`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_text` varchar(600) DEFAULT NULL,
  `question_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `question`
--

TRUNCATE TABLE `question`;
--
-- Volcado de datos para la tabla `question`
--

INSERT INTO `question` (`question_id`, `question_text`, `question_type`) VALUES
(1, 'La necesidad insatisfecha de anticoncepción para adolescentes sexualmente activas de 15 a 19 años en Colombia, según la ENDS 2015 es:', 'radio'),
(2, 'Estos son los beneficios esperados por la implementación de los servicios de salud amigables para adolescentes y jóvenes excepto:', 'radio'),
(3, 'Uno de los siguientes postulados sobre las consejerías postevento obstétrico para adolescentes es falso. Identifique cuál es:', 'radio'),
(4, 'Cuál de las siguientes NO se considera un beneficio de la anticoncepción en la adolescencia', 'radio'),
(5, 'Los siguientes son estrategias que salvan vidas excepto', 'radio'),
(6, '¿La accesibilidad a la plataforma fue fácil, intuitiva y generó una buena experiencia?', 'radio'),
(7, '¿Los recursos por medio de los cuales se presentaron los contenidos (infografía, video, podcast y videoconferencia) facilitaron su aprendizaje?', 'radio'),
(8, '¿El material bibliográfico fue de su interés?', 'radio'),
(9, '¿Las actividades y contenidos propuestos cumplieron con sus expectativas?', 'radio'),
(10, '¿Su experiencia de aprendizaje fue enriquecedora y le aportó valor a su quehacer profesional?', 'radio'),
(11, 'Si tuviera la oportunidad de realizar otro curso académico como este, ¿sobre qué temáticas le gustaría aprender o profundizar?', 'textarea'),
(12, 'El género es una categoría social que explica las violencias de género porque:', 'radio'),
(13, 'Uno de los siguientes es un derecho de las víctimas de violencia sexual ', 'radio'),
(14, '¿Cuál de estas formas de violencia NO es una forma de violencia sexual?', 'radio'),
(15, 'Cuando una víctima no denuncia a su agresor, especialmente cuando es su pareja, lo hace porque:', 'radio'),
(16, 'Cuando se realiza la atención a las víctimas de violencias de género, el profesional debe realizar la valoración, incluyendo los enfoques de:', 'radio'),
(17, 'Paciente de 23 años quien consulta por asesoría sobre métodos anticonceptivos de larga duración. Asegura no querer utilizar el implante de levonorgestrel debido a que teme sufrir de cáncer debido al implante. Usted le podría asegurar a su paciente todo lo siguiente, EXCEPTO:', 'radio'),
(18, 'Una paciente de 32 años consulta por asesoría en anticoncepción con método de larga duración. La paciente se encuentra actualmente en espera de tratamiento para cáncer de cuello uterino. Usted recomendaría:', 'radio'),
(19, 'Paciente de 35 años con antecedente de epilepsia actualmente en tratamiento con fenitoína. Consulta por asesoría en anticoncepción. Usted podría recomendar lo siguiente, EXCEPTO:', 'radio'),
(20, 'Paciente de 25 años quien consulta por asesoría en anticoncepción, sin antecedentes ginecobstétricos de importancia. La paciente es procedente de zona rural con nivel de escolaridad básica primaria, y manifiesta dificultades marcadas para trasladarse a zonas urbanas o con acceso a los servicios de salud. Usted debería recomendar lo siguiente, EXCEPTO:', 'radio'),
(21, 'Paciente de 22 años quien ha utilizado implante de levonorgestrel desde hace 3 meses y consulta por irregularidad del periodo menstrual con sangrados prolongados. Usted podría recomendar:', 'radio'),
(22, 'En la evaluación de conductas y antecedentes de riesgo para infecciones de transmisión sexual (ITS), los siguientes podrían constituir tópicos clave de la anamnesis, EXCEPTO:', 'radio'),
(23, 'Dentro de la clasificación etiológica de las ITS conocidas, se encuentran los siguientes grupos de microorganismos, EXCEPTO:', 'radio'),
(24, 'Sobre las infecciones que producen cambios en el flujo vaginal, se podría afirmar todo lo siguiente, EXCEPTO:', 'radio'),
(25, 'Con respecto al impacto emocional que conllevan las ITS, se puede asegurar lo siguiente, EXCEPTO:', 'radio'),
(26, 'De acuerdo con el Centro para el Control y Prevención de Enfermedades de Los Estados Unidos (CDC), los mecanismos para la prevención y el control de las ITS deben incluir lo siguiente:', 'radio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `question_answer`
--

DROP TABLE IF EXISTS `question_answer`;
CREATE TABLE IF NOT EXISTS `question_answer` (
  `question_answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `question_answer_correct` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`question_answer_id`),
  KEY `question_id` (`question_id`),
  KEY `answer_id` (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `question_answer`
--

TRUNCATE TABLE `question_answer`;
--
-- Volcado de datos para la tabla `question_answer`
--

INSERT INTO `question_answer` (`question_answer_id`, `question_id`, `answer_id`, `question_answer_correct`) VALUES
(1, 1, 1, NULL),
(2, 1, 2, NULL),
(3, 1, 3, NULL),
(4, 1, 4, 'true'),
(5, 1, 5, NULL),
(6, 2, 6, NULL),
(7, 2, 7, NULL),
(8, 2, 8, 'true'),
(9, 2, 9, NULL),
(10, 2, 10, NULL),
(11, 3, 11, NULL),
(12, 3, 12, 'true'),
(13, 3, 13, NULL),
(14, 3, 14, NULL),
(15, 4, 15, NULL),
(16, 4, 16, NULL),
(17, 4, 17, NULL),
(18, 4, 18, NULL),
(19, 4, 19, 'true'),
(20, 5, 20, NULL),
(21, 5, 21, NULL),
(22, 5, 22, NULL),
(23, 5, 23, 'true'),
(24, 5, 24, NULL),
(25, 6, 25, NULL),
(26, 6, 26, NULL),
(27, 6, 27, NULL),
(28, 6, 28, NULL),
(29, 6, 29, NULL),
(30, 7, 25, NULL),
(31, 7, 26, NULL),
(32, 7, 27, NULL),
(33, 7, 28, NULL),
(34, 7, 29, NULL),
(35, 8, 25, NULL),
(36, 8, 26, NULL),
(37, 8, 27, NULL),
(38, 8, 28, NULL),
(39, 8, 29, NULL),
(40, 9, 25, NULL),
(41, 9, 26, NULL),
(42, 9, 27, NULL),
(43, 9, 28, NULL),
(44, 9, 29, NULL),
(45, 10, 25, NULL),
(46, 10, 26, NULL),
(47, 10, 27, NULL),
(48, 10, 28, NULL),
(49, 10, 29, NULL),
(50, 12, 30, NULL),
(51, 12, 31, NULL),
(52, 12, 32, NULL),
(53, 12, 33, 'true'),
(54, 13, 34, 'true'),
(55, 13, 35, NULL),
(56, 13, 36, NULL),
(57, 13, 37, NULL),
(58, 14, 38, NULL),
(59, 14, 39, NULL),
(60, 14, 40, 'true'),
(61, 14, 41, NULL),
(62, 15, 42, NULL),
(63, 15, 43, NULL),
(64, 15, 44, NULL),
(65, 15, 45, 'true'),
(66, 16, 46, NULL),
(67, 16, 47, NULL),
(68, 16, 48, NULL),
(69, 16, 49, 'true'),
(70, 11, 50, NULL),
(71, 17, 51, NULL),
(72, 17, 52, 'true'),
(73, 17, 53, NULL),
(74, 17, 54, NULL),
(75, 18, 55, NULL),
(76, 18, 56, NULL),
(77, 18, 57, NULL),
(78, 18, 58, 'true'),
(79, 19, 59, NULL),
(80, 19, 60, NULL),
(81, 19, 61, 'true'),
(82, 19, 62, NULL),
(83, 20, 63, NULL),
(84, 20, 64, 'true'),
(85, 20, 65, NULL),
(86, 20, 66, NULL),
(87, 21, 67, NULL),
(88, 21, 68, NULL),
(89, 21, 69, NULL),
(90, 21, 70, 'true'),
(91, 22, 71, NULL),
(92, 22, 72, NULL),
(93, 22, 73, NULL),
(94, 22, 74, 'true'),
(95, 23, 75, NULL),
(96, 23, 76, NULL),
(97, 23, 77, 'true'),
(98, 23, 78, NULL),
(99, 24, 79, NULL),
(100, 24, 80, 'true'),
(101, 24, 81, NULL),
(102, 24, 82, NULL),
(103, 25, 83, 'true'),
(104, 25, 84, NULL),
(105, 25, 85, NULL),
(106, 25, 86, NULL),
(107, 26, 87, NULL),
(108, 26, 88, NULL),
(109, 26, 89, NULL),
(110, 26, 90, 'true');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) DEFAULT NULL,
  `role_description` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `role`
--

TRUNCATE TABLE `role`;
--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_description`) VALUES
(1, 'Admin', 'Role de usuario administrador que puede ver el progreso y estádisticas de los alumnos'),
(2, 'Alumno', 'Role alumno que puede ver los módulos y contenidos del curso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_module`
--

DROP TABLE IF EXISTS `role_module`;
CREATE TABLE IF NOT EXISTS `role_module` (
  `role_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_module_id`),
  KEY `module_id` (`module_id`),
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `role_module`
--

TRUNCATE TABLE `role_module`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_content`
--

DROP TABLE IF EXISTS `type_content`;
CREATE TABLE IF NOT EXISTS `type_content` (
  `type_content_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_content_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`type_content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `type_content`
--

TRUNCATE TABLE `type_content`;
--
-- Volcado de datos para la tabla `type_content`
--

INSERT INTO `type_content` (`type_content_id`, `type_content_name`) VALUES
(1, 'Menú principal módulo'),
(2, 'Infografía'),
(3, 'Video'),
(4, 'Podcast'),
(5, 'Cuestionario'),
(6, 'Evaluación'),
(7, 'Webinar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `user_image` varchar(200) DEFAULT NULL,
  `user_state_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_state_id` (`user_state_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `user`
--

TRUNCATE TABLE `user`;
--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_image`, `user_state_id`, `role_id`) VALUES
(1, 'Admin Sinapsis', NULL, 1, 1),
(2, 'LESLY CATHERINE LOPEZ MEZA', NULL, 1, 2),
(3, 'CLAUDIA MARCELA ORDUY FORERO', NULL, 1, 2),
(4, 'NANCY STELLA ROCHA MORENO', NULL, 1, 2),
(5, 'JENNY CLAVIJO ENCIZO ', NULL, 1, 2),
(6, 'ROSMERY ANDREA GALVAN PACHECO', NULL, 1, 2),
(7, 'LAURA GABRIELA RAMIREZ DIAZ', NULL, 1, 2),
(8, 'NATALIA MARIA MORENO CRUZ', NULL, 1, 2),
(9, 'OLGA LUCIA MARTINEZ CAMARGO', NULL, 1, 2),
(10, 'VALBUENA MOJICA JEIMY JULIETH', NULL, 1, 2),
(11, 'MARTHA YANETH CHIRIVI MARTINEZ', NULL, 1, 2),
(12, 'MARIA PAULA MORALES QUIROGA', NULL, 1, 2),
(13, 'DORIS ADRIANA GUZMAN REMIZO', NULL, 1, 2),
(14, 'SINDY LORENA MARTINEZ MATEUS', NULL, 1, 2),
(15, 'JENNY MARCELA GONZALEZ ALVAREZ', NULL, 1, 2),
(16, 'GLADYS JANETH MORA PINZON', NULL, 1, 2),
(17, 'CLARA BARBOSA HERNANDEZ ', NULL, 1, 2),
(18, 'NICOL ESTEFANIA ROSERO GOMEZ', NULL, 1, 2),
(19, 'CYNTHIA CATALINA ROCHA TORRES', NULL, 1, 2),
(20, 'ANDREA PAOLA VILLAMIZAR MONRROY', NULL, 1, 2),
(21, 'ANDREA MARTINEZ CASAS', NULL, 1, 2),
(22, 'YESICA JOHANA RIOS VARGAS', NULL, 1, 2),
(23, 'DIANA RIVERA MOYA', NULL, 1, 2),
(24, 'FALLENNE MONTENEGRO RANGEL', NULL, 1, 2),
(25, 'SANDRA LILIANA LEAÑO RUEDA', NULL, 1, 2),
(26, 'DIANA CAROLINA RODRIGUEZ VANEGAS', NULL, 1, 2),
(27, 'KAREN SOFIA ANAYA MARTELO', NULL, 1, 2),
(28, 'NANCY STELLA OLAYA REY', NULL, 1, 2),
(29, 'YESICA TABACO', NULL, 1, 2),
(30, 'ANA MARIA BETANCUR HENAO', NULL, 1, 2),
(31, 'LIGIA MARITZA RINCON COCA', NULL, 1, 2),
(32, 'WAGNER HUMBERTO GUTIERREZ G', NULL, 1, 2),
(33, 'CARLOS FERNANDO VALERA', NULL, 1, 2),
(34, 'GLORIA DEL PILAR LEON RAMIREZ', NULL, 1, 2),
(35, 'LIGIA ESPERANZA ALVAREZ CASTIBLANCO', NULL, 1, 2),
(37, 'MARTHA LICETH TOLOZA DIAZ', NULL, 1, 2),
(38, 'Lina Maria Lizarralde Bonilla', NULL, 1, 2),
(39, 'Ckriste Madellin Carcamo', NULL, 1, 2),
(40, 'Caroll Lopez Lopez', NULL, 1, 2),
(41, 'Laura Giraldo Ariza', NULL, 1, 2),
(42, 'Stepany Andrea Preston Velasquez', NULL, 1, 2),
(43, 'Daily Yurany Maturana Blandon', NULL, 1, 2),
(44, 'Luz Enith Gutierrez Ortega', NULL, 1, 2),
(45, 'Leidy johana Angel Restrepo', NULL, 1, 2),
(46, 'Yussy Lorena Pino Palacios ', NULL, 1, 2),
(47, 'Erika Zabala Mendez', NULL, 1, 2),
(48, 'Maria Elena Sarmiento Bertel', NULL, 1, 2),
(49, 'Sindy Marenco Escamilla', NULL, 1, 2),
(50, 'Carlos Andres Orozco Perez', NULL, 1, 2),
(51, 'Nery Del Rosario Hernandez Barrios', NULL, 1, 2),
(52, 'Eliana Ortiz Corro', NULL, 1, 2),
(53, 'Jalennys Loraine Barreto Novoa', NULL, 1, 2),
(54, 'Viviana Catalan Buelvas', NULL, 1, 2),
(55, 'Katherine Araujo Gomez', NULL, 1, 2),
(56, 'Yennis Perez Arrieta', NULL, 1, 2),
(57, 'Skarlis Ariza Gomez', NULL, 1, 2),
(58, 'Maria Teresa Orjuela Arias', NULL, 1, 2),
(59, 'Sandy Perez Portillo', NULL, 1, 2),
(60, 'Diana Lucia Abril Sinning', NULL, 1, 2),
(61, 'Eduviges Salgado Torres', NULL, 1, 2),
(62, 'Leidy Marllery Hurtado Castellanos', NULL, 1, 2),
(63, 'Diana Marcela Palacios Ortega', NULL, 1, 2),
(64, 'Juliana Andrea Gonzalez Obando', NULL, 1, 2),
(65, 'Jessica Lizeth Valencia Rodriguez', NULL, 1, 2),
(66, 'Marlen Tatiana Quiñonez Pernia', NULL, 1, 2),
(67, 'Diego Mauricio Alban Muñoz', NULL, 1, 2),
(68, 'Diana Patricia Fernandez Huertas', NULL, 1, 2),
(69, 'Lorena Ramirez Ojeda', NULL, 1, 2),
(70, 'Gloria Janeth Londoño Varela', NULL, 1, 2),
(71, 'Andrea Ceron Chique', NULL, 1, 2),
(72, 'Carolina Restrepo Guevara', NULL, 1, 2),
(73, 'Fidelina Gonzalez Peña', NULL, 1, 2),
(74, 'Ibeth Congo Lopez', NULL, 1, 2),
(75, 'Myriam Figueroa', NULL, 1, 2),
(76, 'Monica Mantilla', NULL, 1, 2),
(77, 'Liliana  Buitrago', NULL, 1, 2),
(78, 'Irma Ruth Alvarez A', NULL, 1, 2),
(79, 'Katherine Rueda', NULL, 1, 2),
(80, 'Laura Daniela Orejarena', NULL, 1, 2),
(81, 'Angelica Angarita', NULL, 1, 2),
(82, 'Karen Camargo Sarmiento', NULL, 1, 2),
(83, 'Eloina Rincon Campos', NULL, 1, 2),
(84, 'Karen Urrutia', NULL, 1, 2),
(85, 'Silvia Juliana Santamaria', NULL, 1, 2),
(86, 'Helena Martinez  Caceres', NULL, 1, 2),
(87, 'Claudia Patricia Naranjo', NULL, 1, 2),
(88, 'Lady Diana Navarro Celis', NULL, 1, 2),
(89, 'Liseth Carolina Gonzales A', NULL, 1, 2),
(90, 'Elizabeth Gomez Mercado', NULL, 1, 2),
(91, 'Lilibeth Meza Jimenez', NULL, 1, 2),
(92, 'Sandra Milena Alvarez Murillo', NULL, 1, 2),
(93, 'Paola Andrea Sanchez Escobar', NULL, 1, 2),
(94, 'Diana Carolina Rodas', NULL, 1, 2),
(95, 'Rosa Amparo Ramirez Aristizabal', NULL, 1, 2),
(96, 'Johana Pardo Briceño', NULL, 1, 2),
(97, 'Karen Alejandra Montoya Vargas', NULL, 1, 2),
(98, 'Liz Xiomary Arias', NULL, 1, 2),
(99, 'Diana Patricia Mappe Gomez', NULL, 1, 2),
(100, 'Luz Aide Garcia Naranjo', NULL, 1, 2),
(101, 'Karol Tatiana Colorado Barrios', NULL, 1, 2),
(102, 'DIANA PAOLA CASTELLANOS TORRES', NULL, 1, 2),
(103, 'SONIA MILENA SANCHEZ HERNANDEZ', NULL, 1, 2),
(104, 'GERMAN RUDA CORDOBA', NULL, 1, 2),
(105, 'BEATRIZ EUGENIA PERAFAN ROJAS', NULL, 1, 2),
(106, 'ERIKA SOFIA DIAZ ROMERO', NULL, 1, 2),
(107, 'WILLIAM CABALLERO HERNANDEZ', NULL, 1, 2),
(108, 'Edith Contreras', NULL, 1, 2),
(109, 'Yesenia Lopera', NULL, 1, 2),
(110, 'Juliet Garces', NULL, 1, 2),
(111, 'Hellen Reyes', NULL, 1, 2),
(112, 'Marcela Toro', NULL, 1, 2),
(113, 'Market Support', NULL, 1, 1),
(114, ' Cesar Augusto Holguin Holguin', '', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_assessment`
--

DROP TABLE IF EXISTS `user_assessment`;
CREATE TABLE IF NOT EXISTS `user_assessment` (
  `user_assessment_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_answer_id` int(11) NOT NULL,
  `user_assessment_detail` varchar(3000) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_assessment_id`),
  KEY `question_answer_id` (`question_answer_id`),
  KEY `content_id` (`content_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `user_assessment`
--

TRUNCATE TABLE `user_assessment`;
--
-- Volcado de datos para la tabla `user_assessment`
--

INSERT INTO `user_assessment` (`user_assessment_id`, `question_answer_id`, `user_assessment_detail`, `content_id`, `user_id`) VALUES
(1, 29, NULL, 8, 111),
(2, 34, NULL, 8, 111),
(3, 39, NULL, 8, 111),
(4, 44, NULL, 8, 111),
(5, 49, NULL, 8, 111),
(6, 29, NULL, 8, 110),
(7, 34, NULL, 8, 110),
(8, 39, NULL, 8, 110),
(9, 44, NULL, 8, 110),
(10, 49, NULL, 8, 110),
(11, 29, NULL, 8, 28),
(12, 34, NULL, 8, 28),
(13, 39, NULL, 8, 28),
(14, 44, NULL, 8, 28),
(15, 49, NULL, 8, 28),
(16, 29, NULL, 8, 71),
(17, 33, NULL, 8, 71),
(18, 38, NULL, 8, 71),
(19, 43, NULL, 8, 71),
(20, 48, NULL, 8, 71),
(21, 29, NULL, 8, 5),
(22, 34, NULL, 8, 5),
(23, 39, NULL, 8, 5),
(24, 44, NULL, 8, 5),
(25, 49, NULL, 8, 5),
(26, 29, NULL, 8, 8),
(27, 34, NULL, 8, 8),
(28, 39, NULL, 8, 8),
(29, 44, NULL, 8, 8),
(30, 49, NULL, 8, 8),
(31, 29, NULL, 8, 54),
(32, 34, NULL, 8, 54),
(33, 39, NULL, 8, 54),
(34, 44, NULL, 8, 54),
(35, 49, NULL, 8, 54),
(36, 29, NULL, 8, 62),
(37, 34, NULL, 8, 62),
(38, 39, NULL, 8, 62),
(39, 44, NULL, 8, 62),
(40, 49, NULL, 8, 62),
(41, 29, NULL, 8, 100),
(42, 34, NULL, 8, 100),
(43, 38, NULL, 8, 100),
(44, 44, NULL, 8, 100),
(45, 49, NULL, 8, 100),
(46, 28, NULL, 8, 80),
(47, 33, NULL, 8, 80),
(48, 39, NULL, 8, 80),
(49, 44, NULL, 8, 80),
(50, 49, NULL, 8, 80),
(51, 29, NULL, 8, 39),
(52, 34, NULL, 8, 39),
(53, 39, NULL, 8, 39),
(54, 44, NULL, 8, 39),
(55, 49, NULL, 8, 39),
(56, 29, NULL, 8, 48),
(57, 34, NULL, 8, 48),
(58, 39, NULL, 8, 48),
(59, 44, NULL, 8, 48),
(60, 49, NULL, 8, 48),
(61, 28, NULL, 8, 73),
(62, 34, NULL, 8, 73),
(63, 39, NULL, 8, 73),
(64, 43, NULL, 8, 73),
(65, 49, NULL, 8, 73),
(66, 29, NULL, 8, 12),
(67, 34, NULL, 8, 12),
(68, 39, NULL, 8, 12),
(69, 44, NULL, 8, 12),
(70, 49, NULL, 8, 12),
(71, 29, NULL, 17, 12),
(72, 33, NULL, 17, 12),
(73, 39, NULL, 17, 12),
(74, 44, NULL, 17, 12),
(75, 49, NULL, 17, 12),
(76, 27, NULL, 8, 4),
(77, 32, NULL, 8, 4),
(78, 38, NULL, 8, 4),
(79, 43, NULL, 8, 4),
(80, 48, NULL, 8, 4),
(81, 29, NULL, 8, 69),
(82, 34, NULL, 8, 69),
(83, 39, NULL, 8, 69),
(84, 44, NULL, 8, 69),
(85, 49, NULL, 8, 69);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_score`
--

DROP TABLE IF EXISTS `user_score`;
CREATE TABLE IF NOT EXISTS `user_score` (
  `user_score_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_score_value` varchar(3) NOT NULL,
  `content_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_score_id`),
  KEY `content_id` (`content_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `user_score`
--

TRUNCATE TABLE `user_score`;
--
-- Volcado de datos para la tabla `user_score`
--

INSERT INTO `user_score` (`user_score_id`, `user_score_value`, `content_id`, `user_id`) VALUES
(1, '5', 7, 110),
(2, '4', 7, 111),
(3, '3', 7, 28),
(4, '3', 7, 71),
(5, '1', 7, 2),
(6, '1', 7, 5),
(7, '3', 7, 8),
(8, '4', 7, 54),
(9, '5', 7, 62),
(10, '4', 7, 64),
(11, '2', 7, 48),
(12, '4', 7, 30),
(13, '4', 7, 100),
(14, '4', 7, 99),
(15, '3', 7, 80),
(16, '3', 7, 39),
(17, '4', 7, 45),
(18, '2', 7, 73),
(19, '1', 7, 43),
(20, '5', 7, 12),
(21, '2', 16, 12),
(22, '2', 7, 4),
(23, '1', 7, 69);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_state`
--

DROP TABLE IF EXISTS `user_state`;
CREATE TABLE IF NOT EXISTS `user_state` (
  `user_state_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_state_name` varchar(50) DEFAULT NULL,
  `user_state_description` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`user_state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `user_state`
--

TRUNCATE TABLE `user_state`;
--
-- Volcado de datos para la tabla `user_state`
--

INSERT INTO `user_state` (`user_state_id`, `user_state_name`, `user_state_description`) VALUES
(1, 'Activo', 'Usuario que está autorizado a ingresar al sistema');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activity_user`
--
ALTER TABLE `activity_user`
  ADD CONSTRAINT `activity_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `activity_user_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`);

--
-- Filtros para la tabla `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`type_content_id`) REFERENCES `type_content` (`type_content_id`),
  ADD CONSTRAINT `content_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`);

--
-- Filtros para la tabla `content_info`
--
ALTER TABLE `content_info`
  ADD CONSTRAINT `content_info_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`);

--
-- Filtros para la tabla `content_question`
--
ALTER TABLE `content_question`
  ADD CONSTRAINT `content_question_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`),
  ADD CONSTRAINT `content_question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Filtros para la tabla `data_user`
--
ALTER TABLE `data_user`
  ADD CONSTRAINT `data_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `question_answer`
--
ALTER TABLE `question_answer`
  ADD CONSTRAINT `question_answer_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`),
  ADD CONSTRAINT `question_answer_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`answer_id`);

--
-- Filtros para la tabla `role_module`
--
ALTER TABLE `role_module`
  ADD CONSTRAINT `role_module_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`),
  ADD CONSTRAINT `role_module_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `role_module_ibfk_3` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_state_id`) REFERENCES `user_state` (`user_state_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Filtros para la tabla `user_assessment`
--
ALTER TABLE `user_assessment`
  ADD CONSTRAINT `user_assessment_ibfk_1` FOREIGN KEY (`question_answer_id`) REFERENCES `question_answer` (`question_answer_id`),
  ADD CONSTRAINT `user_assessment_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`),
  ADD CONSTRAINT `user_assessment_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Filtros para la tabla `user_score`
--
ALTER TABLE `user_score`
  ADD CONSTRAINT `user_score_ibfk_1` FOREIGN KEY (`content_id`) REFERENCES `content` (`content_id`),
  ADD CONSTRAINT `user_score_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
