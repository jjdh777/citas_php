-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 06:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_citas`
--

-- --------------------------------------------------------

--
-- Table structure for table `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `id_especialista` int(11) NOT NULL,
  `fecha_cita` varchar(20) NOT NULL,
  `hora_cita` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `created_at` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citas`
--

INSERT INTO `citas` (`id`, `descripcion`, `id_paciente`, `id_especialidad`, `id_especialista`, `fecha_cita`, `hora_cita`, `estado`, `created_at`) VALUES
(1, 'aaaaaaa', 3, 1, 1, '2023-09-25', '09:30', 'pendiente', '2023-09-18'),
(2, 'asdasdad', 12, 1, 1, '2023-09-18', '08:30', 'pendiente', '2023-09-18'),
(3, 'asdasdasd', 12, 1, 1, '2023-09-25', '13:45', 'pendiente', '2023-09-19'),
(4, 'sdfdsf', 12, 1, 1, '2023-09-18', '13:45', 'cancelado', '2023-09-19'),
(5, 'test citas', 3, 7, 7, '2023-09-24', '10:00', 'aceptado', '2023-09-21'),
(6, 'descripcion', 12, 7, 7, '2023-09-24', '12:00', 'aceptado', '2023-09-21'),
(7, 'descripción ', 19, 7, 7, '2023-09-24', '09:00', 'aceptado', '2023-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `especialidades`
--

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `especialidades`
--

INSERT INTO `especialidades` (`id`, `nombre`) VALUES
(1, 'Oftalmología'),
(2, 'Ginecología y Obstetricia'),
(3, 'Ortopedia'),
(4, 'Dermatología'),
(5, 'Cardiología'),
(7, 'psicólogos');

-- --------------------------------------------------------

--
-- Table structure for table `especialista`
--

CREATE TABLE `especialista` (
  `id` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `dni` int(8) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `nacimiento` varchar(55) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `nacionalidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `especialista`
--

INSERT INTO `especialista` (`id`, `id_especialidad`, `dni`, `nombres`, `apellidos`, `genero`, `telefono`, `nacimiento`, `correo`, `nacionalidad`) VALUES
(1, 1, 74534334, 'Dr. Carlos ', 'Sánchez', 'Masculino ', '934524223', '2023-09-25', 'adsa@gmail.com', 'Peruana'),
(2, 5, 7896232, 'Dr. Juan ', 'Pérez', 'Masculino ', '934524275', '1995-09-21', 'juan@gmail.com', 'Peruana'),
(3, 4, 73434613, 'Dra. María ', 'Rodríguez', 'Femenino', '993473765', '1998-09-19', 'maria@gmail.com', 'Peruana'),
(4, 3, 7445734, 'Dr. Luis ', 'García', 'Masculino ', '934534333', '1992-09-15', 'luis@gmail.com', 'Peruana'),
(5, 2, 74534334, 'Dra. Ana', 'Martínez', 'Femenino', '934524232', '2000-09-15', 'ana@gmail.com', 'Peruana'),
(6, 5, 74523632, 'lucas mendes', ' paredes ', 'Femenino', '923532532', '2000-09-20', 'lucas.76@gmail.com', 'Peruana'),
(7, 7, 74236243, 'juan', 'reyes montes', 'Masculino ', '932725734', '1997-09-20', 'juan.reyes@gmail.com', 'Peruana');

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `id_especialista` int(11) NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `hora_inicio_m` varchar(55) NOT NULL,
  `hora_fin_m` varchar(55) NOT NULL,
  `hora_inicio_t` varchar(55) NOT NULL,
  `hora_fin_t` varchar(55) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`id`, `id_especialista`, `nombre`, `hora_inicio_m`, `hora_fin_m`, `hora_inicio_t`, `hora_fin_t`, `estado`) VALUES
(1, 1, 'Lunes', '08:30', '12:30', '13:45', '18:45', 1),
(2, 1, 'Martes', '08:45', '12:45', '12:45', '12:45', 0),
(3, 3, 'Lunes', '08:45', '12:45', '14:45', '20:45', 1),
(4, 1, 'Miércoles', '12:45', '15:45', '16:45', '12:45', 1),
(5, 3, 'Martes', '08:00', '12:00', '14:00', '19:00', 0),
(6, 7, 'Domingo', '08:00', '13:00', '14:00', '20:00', 1),
(7, 7, 'Miércoles', '08:00', '12:00', '14:00', '19:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `rol` varchar(100) NOT NULL,
  `dni` int(8) DEFAULT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `contrasenia` text NOT NULL,
  `created_at` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `rol`, `dni`, `nombres`, `apellidos`, `telefono`, `genero`, `email`, `contrasenia`, `created_at`) VALUES
(1, 'Administrador', 0, 'admin', 'sc', '', '', 'admin@gmail.com', '$2y$10$RvcpCs7euvG.qFMBjrNfeeIlehLwc9nsO7nDvWlVz2EpCw6LMdeBa', NULL),
(3, 'Paciente', 8263432, 'andres', 'lopez', 'asdad', 'Mascolino', 'ander@gmail.com', '$2y$10$8uGNFbgpeXTQr2JEhUgMruoHpkffwuO3JEa107MnwLLY6qVisvD6a', NULL),
(12, 'Paciente', 32327633, 'edgar', 'lucas', '934524234', 'Masculino ', 'edgar@gmail.com', '$2y$10$SdLWz22RKm/QozbvtBEEKOIYeIpX1IDmo657E4fgd2et8REB39M6q', '2023-09-18'),
(13, 'Paciente', 73215321, 'adssa', 'asda', '9342423', 'Masculino ', 'sfdsfsdf@gmail.com', '$2y$10$64YMqqJ.ytm3nsEdyXLLJODpNNlVUbvmC2K9OO1aPzaj2h.c3WDfe', '2023-09-19'),
(18, 'Paciente', 52117235, 'luisa', 'montes', '962345241', 'Femenino', 'luisa.8632@gmail.com', '$2y$10$PhBCTZ7rnhS9sbKN3KJnPuzTL4dY7WQ6MjU.CW5IWjo97Ri8cAXfK', '2023-09-21'),
(19, 'Paciente', 43632752, 'luis', 'montes', '89132532', 'Masculino ', 'luis@gmail.com', '$2y$10$DOdMrSk6kYlhqJtUUBC8KuPlbPnU7rlPvrWT/Hok/Sj41i1I9QO4O', '2023-09-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_especialidad` (`id_especialidad`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_psicologo` (`id_especialista`);

--
-- Indexes for table `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `especialista`
--
ALTER TABLE `especialista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_especialidad` (`id_especialidad`);

--
-- Indexes for table `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_psicologo` (`id_especialista`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `especialista`
--
ALTER TABLE `especialista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`id_especialista`) REFERENCES `especialista` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `especialista`
--
ALTER TABLE `especialista`
  ADD CONSTRAINT `especialista_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`id_especialista`) REFERENCES `especialista` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
