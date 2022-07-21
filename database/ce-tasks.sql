-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 05:22 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ce-tasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'Admin', 'admin', 'admin@email.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `added_on`) VALUES
(2, 'Tech Team', 1, '2022-07-21 13:56:29'),
(4, 'Graphics', 1, '2022-07-21 09:59:09'),
(8, 'Content ', 1, '2022-07-21 13:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `department_id` int(11) NOT NULL,
  `team_members_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `department_id`, `team_members_id`, `due_date`, `status`, `added_on`) VALUES
(6, 'Please Make Coders Evoke Official Site', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sed sem purus. Maecenas dolor mi, facilisis ac egestas et, pretium eu diam. Integer porta consectetur tellus quis finibus. Donec arcu justo, tincidunt eu porttitor in, porttitor in enim. Aliquam ante lorem, mattis ac tempus vel, suscipit fermentum magna. Ut semper in nunc at condimentum. Donec a maximus metus, vitae dapibus quam. In congue tortor imperdiet volutpat convallis. Etiam id scelerisque lectus. Nam eu consectetur purus, vitae convallis enim. Vivamus finibus ultrices facilisis.</p><p><br>&nbsp;</p>', 2, 6, '2022-08-06', 1, '2022-07-21 13:55:47'),
(7, 'TASK @', '<p>https://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rjihttps://meet.google.com/xbe-khjh-rji</p>', 2, 7, '2022-07-28', 0, '2022-07-21 15:20:16'),
(8, 'DEMO', '<p>hjbfjrebfhjergyuferbfjyergf</p>', 2, 6, '2022-07-30', 0, '2022-07-21 15:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `department_id` int(11) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` enum('M','F','0') NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `firstname`, `lastname`, `username`, `department_id`, `emp_id`, `phone`, `email`, `password`, `gender`, `status`, `added_on`) VALUES
(6, 'Avnish ', 'Bharadva', 'avnishbharadva', 4, 'CE1673', '9265438919', 'krupesh123vithlani@gmail.com', '123', 'M', 1, '2022-07-21 15:03:00'),
(7, 'Krupesh', 'Vithlani', 'krupeshvithlani', 4, 'CE6042', '9265438919', 'krupesh123vithlani@gmail.com', '1234', 'M', 1, '2022-07-21 14:58:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
