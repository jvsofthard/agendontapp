-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2025 a las 22:04:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica_dental`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL,
  `accion` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id`, `usuario`, `rol`, `accion`, `fecha`) VALUES
(1, 'usuario1', 'recepcionista', 'Registró un nuevo usuario', '2024-12-21 21:42:13'),
(2, 'usuario1', 'recepcionista', 'Registró un nuevo usuario', '2024-12-21 21:42:22'),
(3, 'usuario1', 'recepcionista', 'Eliminó la cita con ID 11', '2024-12-21 21:44:44'),
(4, 'usuario1', 'recepcionista', 'Edito la cita ID 4', '2024-12-21 21:48:32'),
(5, 'usuario1', 'recepcionista', 'Registro Cita ', '2024-12-21 21:58:13'),
(6, 'usuario1', 'recepcionista', 'Registró un nuevo usuario', '2024-12-21 21:58:57'),
(7, 'usuario1', 'recepcionista', 'Registró un nuevo usuario', '2024-12-21 21:59:17'),
(8, 'usuario1', 'recepcionista', 'Registró un nuevo usuario', '2024-12-21 22:00:39'),
(9, 'usuario1', 'recepcionista', 'Registró un nuevo usuario', '2024-12-21 22:01:25'),
(10, 'usuario1', 'recepcionista', 'Registró un nuevo usuario', '2024-12-21 22:01:47'),
(11, 'usuario1', 'recepcionista', 'Registró una nueva cita', '2024-12-21 22:03:13'),
(12, 'usuario1', 'recepcionista', 'Eliminó Documento del usuario ID 27', '2024-12-21 22:07:14'),
(13, 'usuario1', 'recepcionista', 'Creo Especialista ', '2024-12-21 22:20:24'),
(14, 'usuario1', 'recepcionista', 'Creo Especialista ', '2024-12-21 22:21:02'),
(15, 'usuario1', 'recepcionista', 'Creo Especialista ', '2024-12-21 22:21:03'),
(16, 'usuario1', 'recepcionista', 'Edito la cita ID 3', '2024-12-21 22:22:09'),
(17, 'carmen', 'recepcionista', 'Registró un nuevo usuario', '2024-12-21 22:31:53'),
(18, 'carmen', 'recepcionista', 'Registró un nuevo usuario', '2024-12-21 22:32:17'),
(19, 'carmen', 'recepcionista', 'Edito la cita ID 8', '2024-12-21 22:35:25'),
(20, 'carmen', 'recepcionista', 'Edito el paciente con ID 12', '2024-12-21 22:35:56'),
(21, 'carmen', 'recepcionista', 'Edito el paciente con ID 12', '2024-12-21 22:36:22'),
(22, 'carmen', 'recepcionista', 'Edito el paciente con ID 12', '2024-12-21 22:36:40'),
(23, 'carmen', 'recepcionista', 'Edito el paciente con ID 12', '2024-12-21 22:36:44'),
(24, 'carmen', 'recepcionista', 'Eliminó la paciente con ID 15', '2024-12-21 22:37:56'),
(25, 'victor', 'recepcionista', 'Registró una nueva cita', '2024-12-21 22:45:41'),
(26, 'admin', 'admin', 'Edito el paciente con ID 3', '2024-12-21 23:38:21'),
(27, 'admin', 'admin', 'Edito el paciente con ID 3', '2024-12-21 23:38:52'),
(28, 'admin', 'admin', 'Eliminó Documento del usuario ID 30', '2024-12-21 23:44:02'),
(29, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 19:12:55'),
(30, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 19:15:17'),
(31, 'usuario1', 'recepcionista', 'Registró una nueva cita', '2024-12-28 22:27:08'),
(32, 'usuario1', 'recepcionista', 'Registró un nuevo usuario', '2024-12-28 22:27:11'),
(33, 'usuario1', 'recepcionista', 'Eliminó Documento del usuario ID 32', '2024-12-28 22:27:39'),
(34, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:29:10'),
(35, 'admin', 'admin', 'Eliminó la cita con ID 22', '2024-12-28 22:29:16'),
(36, 'admin', 'admin', 'Eliminó la cita con ID 24', '2024-12-28 22:29:19'),
(37, 'admin', 'admin', 'Eliminó la cita con ID 21', '2024-12-28 22:29:21'),
(38, 'admin', 'admin', 'Eliminó la cita con ID 20', '2024-12-28 22:29:23'),
(39, 'admin', 'admin', 'Eliminó la cita con ID 23', '2024-12-28 22:29:25'),
(40, 'admin', 'admin', 'Eliminó la cita con ID 19', '2024-12-28 22:29:27'),
(41, 'admin', 'admin', 'Eliminó la cita con ID 18', '2024-12-28 22:29:30'),
(42, 'admin', 'admin', 'Eliminó la cita con ID 17', '2024-12-28 22:29:32'),
(43, 'admin', 'admin', 'Eliminó la cita con ID 5', '2024-12-28 22:29:34'),
(44, 'admin', 'admin', 'Eliminó la cita con ID 3', '2024-12-28 22:29:36'),
(45, 'admin', 'admin', 'Eliminó la cita con ID 14', '2024-12-28 22:29:38'),
(46, 'admin', 'admin', 'Eliminó la cita con ID 2', '2024-12-28 22:29:39'),
(47, 'admin', 'admin', 'Eliminó la cita con ID 15', '2024-12-28 22:29:41'),
(48, 'admin', 'admin', 'Eliminó la cita con ID 10', '2024-12-28 22:29:42'),
(49, 'admin', 'admin', 'Eliminó la cita con ID 4', '2024-12-28 22:29:43'),
(50, 'admin', 'admin', 'Eliminó la cita con ID 9', '2024-12-28 22:29:45'),
(51, 'admin', 'admin', 'Eliminó la cita con ID 8', '2024-12-28 22:29:46'),
(52, 'admin', 'admin', 'Eliminó la cita con ID 16', '2024-12-28 22:29:48'),
(53, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:29:49'),
(54, 'admin', 'admin', 'Edito Especialista con ID 1', '2024-12-28 22:30:12'),
(55, 'admin', 'admin', 'Edito Especialista con ID 1', '2024-12-28 22:30:24'),
(56, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:31:28'),
(57, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:32:08'),
(58, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:32:46'),
(59, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:33:21'),
(60, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:34:00'),
(61, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:36:09'),
(62, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:36:43'),
(63, 'admin', 'admin', 'Registró un nuevo usuario', '2024-12-28 22:37:09'),
(64, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:37:11'),
(65, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:37:33'),
(66, 'admin', 'admin', 'Registró una nueva cita', '2024-12-28 22:38:09'),
(67, 'admin', 'admin', 'Edito Especialista con ID 1', '2024-12-28 22:39:06'),
(68, 'admin', 'admin', 'Registró una nueva cita', '2024-12-31 12:40:13'),
(69, 'admin', 'admin', 'Registró una nueva cita', '2024-12-31 12:51:19'),
(70, 'admin', 'admin', 'Registró una nueva cita', '2024-12-31 12:52:05'),
(71, 'admin', 'admin', 'Cambio contraseña', '2024-12-31 16:14:28'),
(72, 'admin', 'admin', 'Cambio contraseña', '2024-12-31 16:14:34'),
(73, 'admin', 'admin', 'edito usuario ID ', '2024-12-31 16:18:01'),
(74, 'admin', 'admin', 'edito usuario ID', '2024-12-31 16:18:14'),
(75, 'admin', 'admin', 'Cambio contraseña', '2024-12-31 16:18:20'),
(76, 'admin', 'admin', 'Cambio contraseña a usuario', '2024-12-31 16:18:56'),
(77, 'admin', 'admin', 'Cambio contraseña a usuario', '2024-12-31 16:19:02'),
(78, 'admin', 'admin', 'Cambio contraseña a usuario', '2024-12-31 16:20:13'),
(79, 'admin', 'admin', 'Cambio contraseña a usuario', '2024-12-31 16:20:17'),
(80, 'admin', 'admin', 'Cambio contraseña a usuario', '2024-12-31 17:48:05'),
(81, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 17:50:37'),
(82, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 17:50:41'),
(83, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 17:50:53'),
(84, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 17:50:56'),
(85, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 18:09:05'),
(86, 'carmen', 'recepcionista', 'Eliminó la cita con ID 34', '2024-12-31 19:21:54'),
(87, 'admin', 'admin', 'Registró un nuevo usuario', '2024-12-31 19:39:13'),
(88, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 19:53:19'),
(89, 'admin', 'admin', 'Cambio contraseña a usuario', '2024-12-31 19:53:27'),
(90, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 19:53:36'),
(91, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 19:53:39'),
(92, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 19:53:44'),
(93, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 19:53:45'),
(94, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 19:53:46'),
(95, 'admin', 'admin', 'Cambio Status usuario', '2024-12-31 19:54:19'),
(96, 'admin', 'admin', 'Registró una nueva cita', '2025-01-02 20:07:07'),
(97, 'admin', 'admin', 'Edito la cita ID 38', '2025-01-02 20:07:48'),
(98, 'admin', 'admin', 'Registró un nuevo usuario', '2025-01-02 20:08:08'),
(99, 'admin', 'admin', 'Registró una nueva cita', '2025-01-02 20:27:53'),
(100, 'admin', 'admin', 'Registró una nueva cita', '2025-01-02 21:06:30'),
(101, 'admin', 'admin', 'Registró una nueva cita', '2025-01-02 21:37:02'),
(102, 'admin', 'admin', 'Registró una nueva cita', '2025-01-02 21:41:46'),
(103, 'admin', 'admin', 'Registró una nueva cita', '2025-01-02 21:41:55'),
(104, 'admin', 'admin', 'Registró una nueva cita', '2025-01-02 22:32:37'),
(105, 'admin', 'admin', 'Eliminó la cita con ID 38', '2025-01-02 22:41:25'),
(106, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 13:09:21'),
(107, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 13:09:51'),
(108, 'admin', 'admin', 'Eliminó la cita con ID 45', '2025-01-04 13:12:06'),
(109, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 13:18:00'),
(110, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 13:20:27'),
(111, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 13:20:47'),
(112, 'admin', 'admin', 'Eliminó la cita con ID 48', '2025-01-04 13:21:16'),
(113, 'admin', 'admin', 'Eliminó la cita con ID 47', '2025-01-04 13:21:18'),
(114, 'admin', 'admin', 'Eliminó la cita con ID 46', '2025-01-04 13:21:20'),
(115, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 13:28:01'),
(116, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 13:38:59'),
(117, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 19:03:08'),
(118, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 19:08:38'),
(119, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 19:16:48'),
(120, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 19:19:29'),
(121, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 19:22:12'),
(122, 'admin', 'admin', 'Eliminó la cita con ID 55', '2025-01-04 19:23:01'),
(123, 'admin', 'admin', 'Eliminó la cita con ID 54', '2025-01-04 19:23:03'),
(124, 'admin', 'admin', 'Eliminó la cita con ID 53', '2025-01-04 19:23:05'),
(125, 'admin', 'admin', 'Eliminó la cita con ID 52', '2025-01-04 19:23:08'),
(126, 'admin', 'admin', 'Eliminó la cita con ID 51', '2025-01-04 19:23:10'),
(127, 'admin', 'admin', 'Eliminó la cita con ID 50', '2025-01-04 19:23:12'),
(128, 'admin', 'admin', 'Eliminó la cita con ID 49', '2025-01-04 19:23:15'),
(129, 'admin', 'admin', 'Eliminó la cita con ID 44', '2025-01-04 19:23:21'),
(130, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 19:24:42'),
(131, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 19:27:42'),
(132, 'admin', 'admin', 'Eliminó la cita con ID 56', '2025-01-04 19:39:45'),
(133, 'admin', 'admin', 'Eliminó la cita con ID 57', '2025-01-04 19:39:48'),
(134, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 19:45:56'),
(135, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 19:52:19'),
(136, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 19:52:37'),
(137, 'admin', 'admin', 'Eliminó la cita con ID 59', '2025-01-04 19:52:43'),
(138, 'admin', 'admin', 'Eliminó la cita con ID 58', '2025-01-04 19:52:45'),
(139, 'admin', 'admin', 'Registró una nueva cita', '2025-01-04 19:55:23'),
(140, 'admin', 'admin', 'Eliminó la cita con ID 60', '2025-01-04 19:57:07'),
(141, 'admin', 'admin', 'Edito la cita ID 43', '2025-01-04 19:57:56'),
(142, 'admin', 'admin', 'Edito la cita ID 43', '2025-01-04 20:29:32'),
(143, 'admin', 'admin', 'Edito la cita ID 43', '2025-01-04 20:29:53'),
(144, 'admin', 'admin', 'Edito la cita ID 43', '2025-01-05 10:17:36'),
(145, 'admin', 'admin', 'Edito la cita ID 43', '2025-01-05 10:18:31'),
(146, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 10:18:38'),
(147, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 10:22:37'),
(148, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 10:22:58'),
(149, 'admin', 'admin', 'Edito la cita ID 63', '2025-01-05 10:27:05'),
(150, 'admin', 'admin', 'Eliminó la cita con ID 63', '2025-01-05 10:27:28'),
(151, 'admin', 'admin', 'Eliminó la cita con ID 61', '2025-01-05 10:27:30'),
(152, 'admin', 'admin', 'Edito la cita ID 43', '2025-01-05 10:27:32'),
(153, 'admin', 'admin', 'Edito la cita ID 62', '2025-01-05 10:27:50'),
(154, 'admin', 'admin', 'Eliminó la cita con ID 43', '2025-01-05 10:28:19'),
(155, 'admin', 'admin', 'Eliminó la cita con ID 62', '2025-01-05 10:28:21'),
(156, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 10:28:23'),
(157, 'admin', 'admin', 'Registró un nuevo usuario', '2025-01-05 10:28:36'),
(158, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 10:28:39'),
(159, 'admin', 'admin', 'Registró un nuevo usuario', '2025-01-05 10:28:50'),
(160, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 10:28:54'),
(161, 'admin', 'admin', 'Edito la cita ID 66', '2025-01-05 10:29:17'),
(162, 'admin', 'admin', 'Edito la cita ID 66', '2025-01-05 10:29:27'),
(163, 'admin', 'admin', 'Edito la cita ID 66', '2025-01-05 10:30:05'),
(164, 'admin', 'admin', 'Edito la cita ID 66', '2025-01-05 10:30:19'),
(165, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 10:51:21'),
(166, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 10:52:41'),
(167, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 10:53:01'),
(168, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 10:53:23'),
(169, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 11:16:35'),
(170, 'admin', 'admin', 'Edito la cita ID 66', '2025-01-05 11:21:41'),
(171, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 11:22:50'),
(172, 'admin', 'admin', 'Edito la cita ID 66', '2025-01-05 11:23:18'),
(173, 'admin', 'admin', 'Eliminó la cita con ID 66', '2025-01-05 11:23:23'),
(174, 'admin', 'admin', 'Eliminó la cita con ID 68', '2025-01-05 11:23:25'),
(175, 'admin', 'admin', 'Eliminó la cita con ID 67', '2025-01-05 11:23:29'),
(176, 'admin', 'admin', 'Eliminó la cita con ID 64', '2025-01-05 11:23:32'),
(177, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 11:25:26'),
(178, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 11:26:07'),
(179, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 11:27:42'),
(180, 'admin', 'admin', 'Edito la cita ID 72', '2025-01-05 11:29:19'),
(181, 'admin', 'admin', 'Edito la cita ID 72', '2025-01-05 11:31:57'),
(182, 'admin', 'admin', 'Edito la cita ID 72', '2025-01-05 11:33:06'),
(183, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 11:45:27'),
(184, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 16:36:51'),
(185, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 16:37:31'),
(186, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 16:38:01'),
(187, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 16:39:49'),
(188, 'admin', 'admin', 'Edito la cita ID 73', '2025-01-05 16:40:40'),
(189, 'admin', 'admin', 'Eliminó la cita con ID 74', '2025-01-05 16:40:55'),
(190, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 16:40:59'),
(191, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 16:51:27'),
(192, 'admin', 'admin', 'Eliminó la cita con ID 75', '2025-01-05 16:55:10'),
(193, 'admin', 'admin', 'Edito la cita ID 76', '2025-01-05 16:55:18'),
(194, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 17:14:08'),
(195, 'admin', 'admin', 'Edito la cita ID 77', '2025-01-05 17:17:07'),
(196, 'admin', 'admin', 'Edito Especialista con ID 6', '2025-01-05 18:13:56'),
(197, 'admin', 'admin', 'Edito Especialista con ID 6', '2025-01-05 18:14:03'),
(198, 'admin', 'admin', 'Edito Especialista con ID 6', '2025-01-05 18:19:13'),
(199, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 18:19:37'),
(200, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 18:20:12'),
(201, 'admin', 'admin', 'Edito Especialista con ID 4', '2025-01-05 18:20:18'),
(202, 'admin', 'admin', 'Edito Especialista con ID 4', '2025-01-05 18:20:39'),
(203, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 18:20:41'),
(204, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 18:20:45'),
(205, 'admin', 'admin', 'Edito Especialista con ID 1', '2025-01-05 18:20:46'),
(206, 'admin', 'admin', 'Edito Especialista con ID 1', '2025-01-05 18:20:50'),
(207, 'admin', 'admin', 'Edito Especialista con ID 5', '2025-01-05 18:20:52'),
(208, 'admin', 'admin', 'Edito Especialista con ID 5', '2025-01-05 18:21:22'),
(209, 'admin', 'admin', 'Edito Especialista con ID 3', '2025-01-05 18:22:51'),
(210, 'admin', 'admin', 'Edito Especialista con ID 5', '2025-01-05 18:22:58'),
(211, 'admin', 'admin', 'Edito Especialista con ID 3', '2025-01-05 18:23:02'),
(212, 'admin', 'admin', 'Edito Especialista con ID 3', '2025-01-05 18:23:05'),
(213, 'admin', 'admin', 'Edito Especialista con ID 1', '2025-01-05 18:38:50'),
(214, 'admin', 'admin', 'Edito Especialista con ID 1', '2025-01-05 18:50:28'),
(215, 'admin', 'admin', 'Edito Especialista con ID 1', '2025-01-05 18:50:50'),
(216, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:03:59'),
(217, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:04:25'),
(218, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:04:47'),
(219, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:04:59'),
(220, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:05:10'),
(221, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:10:17'),
(222, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:10:25'),
(223, 'admin', 'admin', 'Edito Especialista con ID ', '2025-01-05 19:10:33'),
(224, 'admin', 'admin', 'Edito Especialista con ID ', '2025-01-05 19:10:36'),
(225, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:17:53'),
(226, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:18:09'),
(227, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:18:51'),
(228, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:21:06'),
(229, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:21:30'),
(230, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:28:23'),
(231, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:28:30'),
(232, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:28:42'),
(233, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:28:51'),
(234, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:28:59'),
(235, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:29:17'),
(236, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:29:19'),
(237, 'admin', 'admin', 'Edito Especialista con ID 2', '2025-01-05 19:29:28'),
(238, 'admin', 'admin', 'Edito Especialista con ID 4', '2025-01-05 19:32:17'),
(239, 'admin', 'admin', 'Edito Especialista con ID 4', '2025-01-05 19:32:29'),
(240, 'admin', 'admin', 'Edito Especialista con ID 5', '2025-01-05 19:32:46'),
(241, 'admin', 'admin', 'Edito Especialista con ID 5', '2025-01-05 19:33:02'),
(242, 'admin', 'admin', 'Edito Especialista con ID 3', '2025-01-05 19:33:10'),
(243, 'admin', 'admin', 'Edito Especialista con ID 3', '2025-01-05 19:33:23'),
(244, 'admin', 'admin', 'Edito Especialista con ID 4', '2025-01-05 19:34:09'),
(245, 'admin', 'admin', 'Edito Especialista con ID 4', '2025-01-05 19:34:13'),
(246, 'admin', 'admin', 'Edito Especialista con ID 4', '2025-01-05 19:34:17'),
(247, 'admin', 'admin', 'Edito Especialista con ID 4', '2025-01-05 19:34:20'),
(248, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 19:35:20'),
(249, 'admin', 'admin', 'Registró un nuevo paciente y una cita', '2025-01-05 19:54:03'),
(250, 'admin', 'admin', 'Registró un nuevo usuario', '2025-01-05 19:55:03'),
(251, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 19:55:15'),
(252, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 19:57:50'),
(253, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 19:57:55'),
(254, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 19:58:06'),
(255, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 19:58:07'),
(256, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 19:58:34'),
(257, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 19:58:38'),
(258, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 20:00:31'),
(259, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 20:00:39'),
(260, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 20:01:19'),
(261, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 21:09:59'),
(262, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 21:11:04'),
(263, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 21:11:34'),
(264, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 21:11:35'),
(265, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 21:35:30'),
(266, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 21:36:16'),
(267, 'admin', 'admin', 'Registró una nueva cita', '2025-01-05 21:37:40'),
(268, 'admin', 'admin', 'Registró una nueva cita', '2025-01-06 13:00:55'),
(269, 'admin', 'admin', 'Registró una nueva cita', '2025-01-06 13:16:29'),
(270, 'admin', 'admin', 'Registró una nueva cita', '2025-01-06 13:27:42'),
(271, 'admin', 'admin', 'Registró una nueva cita', '2025-01-06 13:28:05'),
(272, 'admin', 'admin', 'Registró una nueva cita', '2025-01-06 13:28:39'),
(273, 'admin', 'admin', 'Edito la cita ID 82', '2025-01-06 15:21:15'),
(274, 'admin', 'admin', 'Editó la cita ID 82', '2025-01-06 15:33:34'),
(275, 'admin', 'admin', 'Editó la cita ID 82', '2025-01-06 15:33:53'),
(276, 'admin', 'admin', 'Editó la cita ID 82', '2025-01-06 15:34:03'),
(277, 'admin', 'admin', 'Editó la cita ID 82', '2025-01-06 15:34:06'),
(278, 'admin', 'admin', 'Editó la cita ID 82', '2025-01-06 15:34:07'),
(279, 'admin', 'admin', 'Editó la cita ID 82', '2025-01-06 15:34:32'),
(280, 'admin', 'admin', 'Editó la cita ID 82', '2025-01-06 15:34:35'),
(281, 'admin', 'admin', 'Editó la cita ID 82', '2025-01-06 15:34:39'),
(282, 'admin', 'admin', 'Registró un nuevo usuario', '2025-01-06 15:43:25'),
(283, 'admin', 'admin', 'Registró una nueva cita', '2025-01-06 15:44:56'),
(284, 'admin', 'admin', 'Cambio contraseña a usuario', '2025-01-06 15:46:04'),
(285, 'admin', 'admin', 'Cambio Status usuario', '2025-01-06 15:46:12'),
(286, 'admin', 'admin', 'Registró un nuevo usuario', '2025-01-06 15:57:41'),
(287, 'admin', 'admin', 'Registró una nueva cita', '2025-01-06 15:57:44'),
(288, 'admin', 'admin', 'Registró una nueva cita', '2025-01-21 10:58:42'),
(289, 'admin', 'admin', 'Registró una nueva cita', '2025-01-21 10:59:09'),
(290, 'admin', 'admin', 'Registró un nuevo usuario', '2025-01-21 11:36:33'),
(291, 'admin', 'admin', 'Registró una nueva cita', '2025-01-21 11:36:42'),
(292, 'admin', 'admin', 'Registró una nueva cita', '2025-01-21 11:36:45'),
(293, 'admin', 'admin', 'Registró un nuevo usuario', '2025-01-21 11:36:48'),
(294, 'admin', 'admin', 'Registró una nueva cita', '2025-01-21 11:36:51'),
(295, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 15:21:08'),
(296, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 15:21:35'),
(297, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 15:21:52'),
(298, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 15:22:03'),
(299, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 15:27:31'),
(300, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 15:29:21'),
(301, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 15:30:01'),
(302, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 15:31:18'),
(303, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 15:32:36'),
(304, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 15:32:56'),
(305, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 16:17:34'),
(306, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 16:23:45'),
(307, 'admin', 'admin', 'Cambio contraseña a usuario', '2025-01-21 16:36:44'),
(308, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 16:36:50'),
(309, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 16:36:59'),
(310, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 16:37:05'),
(311, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 16:37:11'),
(312, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 16:37:12'),
(313, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 16:37:20'),
(314, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 16:37:26'),
(315, 'admin', 'admin', 'Cambio Status usuario', '2025-01-21 16:37:30'),
(316, 'admin', 'admin', 'Cambio contraseña a usuario', '2025-01-21 16:37:35'),
(317, 'admin', 'admin', 'Cambio contraseña a usuario', '2025-01-21 16:37:41'),
(318, 'admin', 'admin', 'Cambio contraseña a usuario', '2025-01-21 16:37:46'),
(319, 'admin', 'admin', 'Cambio contraseña a usuario', '2025-01-21 16:48:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_especialista` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `motivo` text NOT NULL,
  `tipo_tratamiento` varchar(50) NOT NULL,
  `hora` time DEFAULT '00:00:00',
  `estado` enum('Pendiente','Confirmada','Anulada') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_paciente`, `id_especialista`, `fecha`, `motivo`, `tipo_tratamiento`, `hora`, `estado`) VALUES
(25, 2, 1, '2024-12-28 08:00:00', 'Seguimiento, tratamiento #1', 'Otros', '00:00:00', 'Pendiente'),
(26, 7, 5, '2024-12-28 18:30:00', 'Cirugia Nervios inferior', 'Otros', '00:00:00', 'Pendiente'),
(27, 17, 2, '2024-12-29 16:00:00', 'Limpieza Profunda', 'Blanqueamiento', '00:00:00', 'Pendiente'),
(28, 20, 4, '2024-12-28 11:20:00', 'Extracion Mueldas Inferior', 'Ortodoncia', '00:00:00', 'Pendiente'),
(29, 26, 4, '2024-12-29 13:35:00', 'Montura Bracket', 'Ortodoncia', '00:00:00', 'Pendiente'),
(30, 13, 3, '2024-12-28 15:00:00', 'Seguimiento Bracket', 'Ortodoncia', '00:00:00', 'Pendiente'),
(31, 24, 1, '2024-12-28 11:35:00', 'Limpieza completa', 'Blanqueamiento', '00:00:00', 'Pendiente'),
(32, 4, 2, '2024-12-30 15:40:00', 'Blanqueamiento Profundo', 'Blanqueamiento', '00:00:00', 'Pendiente'),
(33, 25, 4, '2024-12-29 20:38:00', 'Extracion Diente Inferior delantero.', 'Tratamiento de conductos', '00:00:00', 'Pendiente'),
(35, 17, 3, '2024-12-31 12:45:00', 'seguimiento', 'Consulta general', '00:00:00', 'Pendiente'),
(36, 20, 1, '2024-12-30 12:51:00', 'tratamiento', 'Consulta general', '00:00:00', 'Pendiente'),
(37, 24, 1, '2024-11-29 18:52:00', 'Blanquiamiento dental', 'Blanqueamiento', '00:00:00', 'Pendiente'),
(39, 2, 1, '2025-01-02 21:27:00', 'prueba', 'Consulta general', '00:00:00', 'Pendiente'),
(40, 5, 2, '2025-01-02 21:10:00', '11', 'Consulta general', '00:00:00', 'Pendiente'),
(41, 27, 4, '2025-01-02 21:40:00', '0', 'Consulta general', '00:00:00', 'Pendiente'),
(42, 3, 2, '2025-01-02 21:45:00', '1', 'Consulta general', '00:00:00', 'Pendiente'),
(65, 11, 3, '2025-01-05 10:31:00', '1', 'Consulta general', '00:00:00', 'Pendiente'),
(69, 2, 1, '2025-01-05 11:23:00', 'a', 'Consulta general', '00:00:00', 'Pendiente'),
(70, 2, 1, '2025-01-05 11:26:00', 'a', 'Consulta general', '00:00:00', 'Pendiente'),
(71, 3, 2, '2025-01-05 11:27:00', 'aa', 'Consulta general', '00:00:00', 'Pendiente'),
(72, 27, 1, '2025-01-05 11:34:00', 'q1111', 'Consulta general', '00:00:00', 'Pendiente'),
(73, 3, 1, '2025-01-05 11:46:00', 'a', 'Consulta general', '00:00:00', 'Pendiente'),
(76, 5, 5, '2025-01-05 16:56:00', 'q', 'Consulta general', '00:00:00', 'Pendiente'),
(77, 3, 5, '2025-01-06 17:17:00', '12340', 'Consulta general', '00:00:00', 'Pendiente'),
(78, 2, 1, '2025-01-06 08:43:00', '7:43 pm', 'Consulta general', '00:00:00', 'Pendiente'),
(79, 2, 1, '2025-01-05 23:00:00', 'q', 'Consulta general', '00:00:00', 'Pendiente'),
(81, 3, 1, '2025-01-05 21:36:00', 'a', 'Consulta general', '00:00:00', 'Pendiente'),
(82, 2, 1, '2025-01-06 22:30:00', 'prueba1', 'Consulta general', '00:00:00', 'Pendiente'),
(83, 27, 6, '2025-01-06 18:30:00', 'probando 1234 6/01/2024', 'Otros', '00:00:00', 'Pendiente'),
(84, 2, 4, '2025-01-21 13:15:00', 'Seguimiento', 'Consulta general', '00:00:00', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `id_paciente`, `nombre_archivo`, `ruta`, `fecha_subida`) VALUES
(1, 16, '01.jpg', 'uploads/01.jpg', '2024-12-02 01:45:26'),
(3, 16, '01.jpg', 'uploads/01.jpg', '2024-12-02 02:09:46'),
(4, 4, '01.jpg', 'uploads/01.jpg', '2024-12-02 02:18:47'),
(8, 2, '01.jpg', 'uploads/01.jpg', '2024-12-08 19:39:56'),
(9, 16, '02.jpg', 'uploads/02.jpg', '2024-12-08 19:48:17'),
(12, 17, '01.jpg', 'uploads/01.jpg', '2024-12-08 21:06:33'),
(13, 17, '02.jpg', 'uploads/02.jpg', '2024-12-08 21:06:45'),
(14, 17, '02.jpg', 'uploads/02.jpg', '2024-12-08 21:11:31'),
(16, 18, '01.jpg', 'uploads/01.jpg', '2024-12-08 21:29:48'),
(20, 21, 'prueba.txt', 'uploads/prueba.txt', '2024-12-09 02:47:35'),
(21, 23, 'IMAGEN2.PNG', 'uploads/IMAGEN2.PNG', '2024-12-21 20:37:57'),
(22, 23, 'prueba.pdf', 'uploads/prueba.pdf', '2024-12-21 20:38:58'),
(24, 24, 'IMAGEN2.PNG', 'uploads/IMAGEN2.PNG', '2024-12-21 23:43:47'),
(26, 10, 'IMAGEN2.PNG', 'uploads/IMAGEN2.PNG', '2024-12-22 02:06:56'),
(28, 20, 'IMAGEN2.PNG', 'uploads/IMAGEN2.PNG', '2024-12-22 03:40:57'),
(29, 14, 'IMAGEN2.PNG', 'uploads/IMAGEN2.PNG', '2024-12-22 03:42:24'),
(31, 7, 'IMAGEN2.PNG', 'uploads/IMAGEN2.PNG', '2024-12-22 03:45:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialistas`
--

CREATE TABLE `especialistas` (
  `id_especialista` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `horario` text DEFAULT NULL,
  `tanda` varchar(20) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialistas`
--

INSERT INTO `especialistas` (`id_especialista`, `nombre`, `especialidad`, `telefono`, `correo`, `horario`, `tanda`, `hora_inicio`, `hora_fin`) VALUES
(1, 'Juan Perez', 'Estética Dental', '123-456-7890', 'admin@clinica.com', '8:00 Am  a 12:00 Pm', 'Mañana', '08:00:00', '12:00:00'),
(2, 'Ana Verenice', 'Ortodoncia', '123-456-7890', 'especialistas02@local.com', '8:00 Am  a 12:00 Pm', 'Mañana', '08:00:00', '12:00:00'),
(3, 'Segio Galvam', 'Ortodoncia', '123-456-7890', 'prueba@local.com', '8:00 Am a 6:00 Pm', 'Completo', '08:00:00', '18:00:00'),
(4, 'Carlos Quiñones', 'Estética Dental', '01234567891', 'especialistas03@local.com', '1:00 Pm a 5:00 Pm', 'Tarde', '13:00:00', '17:00:00'),
(5, 'Karla Dominguez', 'Cirugía Maxilofacial', '0-123-4564', 'especialistas04@local.com', '8:00 Am a 6:00 Pm', 'Completo', '08:00:00', '18:00:00'),
(6, 'Wanda Rodriguez', 'Cirugía Maxilofacial', '12345678900', 'especialistas05@local.com', NULL, 'Noche', '18:00:00', '21:00:00'),
(7, 'Pablo Espinal', 'Prostodoncia', '01230456089', 'especialistas6@local.com', NULL, 'Tarde', '12:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `titulo`, `fecha_vencimiento`, `color`) VALUES
(1, 'a', NULL, 'bg-primary'),
(2, 'lo mejor', '2025-01-06', 'bg-primary'),
(3, 'a', NULL, 'bg-primary'),
(4, 'otra nota', '2025-01-07', 'bg-success'),
(5, 'lo mejor', '2025-01-22', 'bg-primary');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` enum('Masculino','Femenino','Otro') NOT NULL,
  `seguro_medico` varchar(50) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nombre`, `telefono`, `correo`, `direccion`, `fecha_nacimiento`, `sexo`, `seguro_medico`, `edad`) VALUES
(2, 'Mario Gomez', '123-456-7890', 'admin@clinica.com', 'Calle Sin Salida', '2002-12-08', 'Masculino', '0123-123', NULL),
(3, 'Mario Bermudez', '8091234567', 'prueba@local.com', 'una calle', '2015-02-02', 'Masculino', 'PS-5011565-01', NULL),
(4, 'Carlos Miraflores hen', '1234567891', 'admin@clinica.com', 'calle 1', '2024-11-27', 'Masculino', '123456789-0', 0),
(5, 'Sergio wi', '1234567890', 'prueba@local.com', 'una calle random', '1991-09-19', 'Masculino', '', NULL),
(6, 'Juliana Maldonado', '1234567891', 'admin@clinica.com', '', NULL, 'Masculino', NULL, NULL),
(7, 'Carlos Miraflores', '1024567801', 'prueba@local.com', 'unconrreo@local.com', '2024-11-27', 'Masculino', '123456789-0', 0),
(8, 'Claudia sosa', '1234567890', 'prueba@local.com', '', NULL, 'Masculino', NULL, NULL),
(9, 'Carme luna', '7894561231', 'admin@clinica.com', '', NULL, 'Masculino', NULL, NULL),
(10, 'Coral Soza', '0123456789', 'prueba@local.com', '', NULL, 'Masculino', NULL, NULL),
(11, 'Julio Bonilla', '0123456789', 'prueba@local.com', '', NULL, 'Masculino', NULL, NULL),
(12, 'Sami rodriguez', '7894561201', 'mperez@clinica.com', 'Calle Sin Salidad', '1985-09-09', 'Masculino', 'PS-01546464-0111', NULL),
(13, 'Mario Bermudez', '1234567890', 'prueba@local.com', 'una calle', '1981-08-06', 'Masculino', 'PS-50000-00', NULL),
(14, 'Silvia Mendez', '1234567891', 'prueba@local.com', 'Calle 1', '1998-12-23', 'Femenino', '123456789-0', 23),
(16, 'Rosa marie', '23189657', 'paciente01@local.com', 'Calle cualquiera. esquina una', '1992-07-02', 'Femenino', '123456450', 32),
(17, 'Camila Castro', '012301234', 'prueba@local.com', 'Una calle #3, Esquina sol', '2024-12-02', 'Femenino', '0123-123', 0),
(18, 'Guillermina Sanchez', '1025458770', 'usuario@prueba.com', 'Una calle mas del mundo', '1990-08-10', 'Femenino', 'PS-12345678900-1', 34),
(19, 'Rosio Valdez', '180912345678', 'usuario@prueba.com', 'Avenida llegaste', '2010-06-26', 'Masculino', 'PS-154878', 14),
(20, 'Paulo Montas', '0231656589', 'usuario@prueba.com', 'Otra calle sin salida', '2000-07-24', 'Masculino', 'PS-50000-01', 24),
(21, 'Sol Maria guzman', '18548498', 'usuario@prueba.com', 'calle prueba', '1979-06-15', 'Femenino', 'PS-50020-02', 44),
(22, 'Carolina German', '1321654645', 'usuario@prueba.com', 'Calle orion', '1991-05-01', 'Masculino', 'PS-12388888-01', NULL),
(23, 'Santiago Romero', '526595465', 'usuario@prueba.com', 'ubanicacion, cerrada', '1990-08-01', 'Masculino', 'PS-154878-0', NULL),
(24, 'karla santana', '25654845', 'usuario@prueba.com', 'un lugar seguro', '2000-06-05', 'Femenino', 'PU-0145200-01', NULL),
(25, 'Benjamin Sosa', '1234567890', 'usuario@prueba.com', 'una direccion, No. 1234', '2002-11-02', 'Masculino', 'PS-124654-0025', NULL),
(26, 'Luis Montaner', '0123-002554-2', 'usuario@prueba.com', 'Calle Exterior, Esquina 1234', '2006-08-10', 'Masculino', 'MD-0135289-0', NULL),
(27, 'Wilton Sosa', '123456789021', 'usuario@prueba.com', 'una calle mas', '2000-08-05', 'Masculino', 'ps-889898989-0', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','recepcionista','especialista') DEFAULT 'recepcionista',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `rol`, `created_at`, `estado`) VALUES
(1, 'admin', '$2y$10$ypipXyQWKH8wcAt8KBcM/eW582hHwvImAm9wU.ay1CJsoJCFFEEUm', 'admin', '2024-12-21 22:13:01', 'activo'),
(4, 'Carmen', '$2y$10$fEOyK0v/aVCnhpZcvd2TiuhSExGQ59yHGYXH5GASba6V9BXdsPai2', 'recepcionista', '2024-12-22 02:27:52', 'activo'),
(16, 'doctor', '$2y$10$/5tHjdyuB5.l/Li6YiBqhuRtD.1V4FAaacHZr3QvUsIZbQFf/Ckj2', 'especialista', '2024-12-31 23:54:13', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_especialista` (`id_especialista`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `especialistas`
--
ALTER TABLE `especialistas`
  ADD PRIMARY KEY (`id_especialista`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=320;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `especialistas`
--
ALTER TABLE `especialistas`
  MODIFY `id_especialista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_especialista`) REFERENCES `especialistas` (`id_especialista`) ON DELETE CASCADE;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
