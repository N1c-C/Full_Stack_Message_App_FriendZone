-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2021 at 10:06 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `friendZone`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(50) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `date`, `email`, `message_id`, `comment`) VALUES
(10, '2021-10-26 12:19:00', 'clint@movies.com', 2, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(14, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 2, 'Vestibulum auctor justo eu massa facilisis bibendum sit amet nec tellus. Pellentesque at ex nec dui feugiat luctus. \nVivamus ac nibh vehicula, pulvinar massa sit amet, auctor augue.'),
(18, '2021-10-26 12:19:00', 'ann.other@user.com', 2, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(21, '2021-10-26 12:19:00', 'ann.other@user.com', 3, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(26, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 3, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(37, '2021-10-26 12:19:00', 'clint@movies.com', 5, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(44, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 5, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(45, '2021-10-26 12:19:00', 'ann.other@user.com', 5, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(47, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 6, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(48, '2021-10-26 12:19:00', 'ann.other@user.com', 6, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(53, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 6, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(54, '2021-10-26 12:19:00', 'ann.other@user.com', 6, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(55, '2021-10-26 12:19:00', 'clint@movies.com', 7, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(56, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 7, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(60, '2021-10-26 12:19:00', 'ann.other@user.com', 7, 'Vestibulum auctor justo eu massa facilisis bibendum sit amet nec tellus. Pellentesque at ex nec dui feugiat luctus. \nVivamus ac nibh vehicula, pulvinar massa sit amet, auctor augue.'),
(61, '2021-10-26 12:19:00', 'clint@movies.com', 7, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(62, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 7, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(63, '2021-10-26 12:19:00', 'ann.other@user.com', 7, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(72, '2021-10-26 12:19:00', 'ann.other@user.com', 8, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(79, '2021-10-26 12:19:00', 'clint@movies.com', 9, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(80, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 9, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(81, '2021-10-26 12:19:00', 'ann.other@user.com', 9, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(82, '2021-10-26 12:19:00', 'clint@movies.com', 10, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(101, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 12, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(102, '2021-10-26 12:19:00', 'ann.other@user.com', 12, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(106, '2021-10-26 12:19:00', 'clint@movies.com', 12, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(107, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 12, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(138, '2021-10-26 12:19:00', 'ann.other@user.com', 16, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(144, '2021-10-26 12:19:00', 'ann.other@user.com', 16, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(147, '2021-10-26 12:19:00', 'ann.other@user.com', 17, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(151, '2021-10-26 12:19:00', 'clint@movies.com', 17, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(162, '2021-10-26 12:19:00', 'ann.other@user.com', 18, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(163, '2021-10-26 12:19:00', 'clint@movies.com', 19, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(167, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 19, 'Vestibulum auctor justo eu massa facilisis bibendum sit amet nec tellus. Pellentesque at ex nec dui feugiat luctus. \nVivamus ac nibh vehicula, pulvinar massa sit amet, auctor augue.'),
(171, '2021-10-26 12:19:00', 'ann.other@user.com', 19, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(175, '2021-10-26 12:19:00', 'clint@movies.com', 20, 'Vestibulum auctor justo eu massa facilisis bibendum sit amet nec tellus. Pellentesque at ex nec dui feugiat luctus. \nVivamus ac nibh vehicula, pulvinar massa sit amet, auctor augue.'),
(180, '2021-10-26 12:19:00', 'ann.other@user.com', 20, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(183, '2021-10-26 12:19:00', 'ann.other@user.com', 21, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(185, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 21, 'Vestibulum auctor justo eu massa facilisis bibendum sit amet nec tellus. Pellentesque at ex nec dui feugiat luctus. \nVivamus ac nibh vehicula, pulvinar massa sit amet, auctor augue.'),
(192, '2021-10-26 12:19:00', 'ann.other@user.com', 22, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(194, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', 22, 'Vestibulum auctor justo eu massa facilisis bibendum sit amet nec tellus. Pellentesque at ex nec dui feugiat luctus. \nVivamus ac nibh vehicula, pulvinar massa sit amet, auctor augue.'),
(196, '2021-10-26 12:19:00', 'clint@movies.com', 22, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(198, '2021-10-26 12:19:00', 'ann.other@user.com', 22, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(202, '2021-10-26 12:19:00', 'clint@movies.com', 23, 'Vestibulum auctor justo eu massa facilisis bibendum sit amet nec tellus. Pellentesque at ex nec dui feugiat luctus. \nVivamus ac nibh vehicula, pulvinar massa sit amet, auctor augue.'),
(216, '2021-10-26 12:19:00', 'ann.other@user.com', 24, 'Mauris sit amet euismod nisi, ut mollis dolor. Sed eleifend leo lorem, in lacinia ante feugiat non. \nUt eget quam faucibus lectus tincidunt pharetra. Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(219, '2021-10-26 12:19:00', 'ann.other@user.com', 25, 'In nec consectetur turpis. Nulla sed tempor libero.'),
(222, '2021-10-26 12:19:00', 'ann.other@user.com', 25, 'Vestibulum auctor justo eu massa facilisis bibendum sit amet nec tellus. Pellentesque at ex nec dui feugiat luctus. \nVivamus ac nibh vehicula, pulvinar massa sit amet, auctor augue.'),
(251, '2021-10-29 16:01:54', 'chat.to.catherine@gmail.com', 18, 'Test'),
(252, '2021-10-29 16:03:05', 'chat.to.catherine@gmail.com', 18, 'Hello'),
(267, '2021-10-30 21:38:32', 'nic.chant@gmail.com', 27, 'Hello How are you?'),
(270, '2021-10-31 15:20:17', 'nic.chant@gmail.com', 32, 'Thanks for that'),
(271, '2021-10-31 15:21:15', 'nic.chant@gmail.com', 32, 'Something else'),
(272, '2021-10-31 20:56:21', 'chat.to.catherine@gmail.com', 33, 'He acknowledged that the communique, the agreement published at the end of the summit, was vague in its promises because of disagreement among the world\'s biggest economies.\n\nIt promises members will reach net zero carbon emissions \"at or around mid-century\" - an acceptance that some haven\'t committed to 2050, but instead to 2060 - or have made no commitment at all.');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(50) DEFAULT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`message`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `date`, `email`, `message`) VALUES
(2, '2021-10-29 14:58:13', 'sally.smith@gmail.com', '{\"title\":\"1\",\"message\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ornare neque sit amet egestas scelerisque. \\n            Nullam ac maximus sem. Quisque porttitor mi vitae gravida sodales. Maecenas ultricies dolor ut auctor elementum. \\n            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel lacus rhoncus, tempus urna id, malesuada sapien. \\n            Morbi nec diam a tellus pretium commodo. In maximus eget ex sit amet dictum. Mauris viverra consectetur ultricies.\"}'),
(3, '2021-10-29 14:58:32', 'clint@movies.com', '{\"title\":\"2.\",\"message\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ornare neque sit amet egestas scelerisque. \\n            Nullam ac maximus sem. Quisque porttitor mi vitae gravida sodales. Maecenas ultricies dolor ut auctor elementum. \\n            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel lacus rhoncus, tempus urna id, malesuada sapien. \\n            Morbi nec diam a tellus pretium commodo. In maximus eget ex sit amet dictum. Mauris viverra consectetur ultricies.\"}'),
(5, '2021-10-26 12:19:00', 'ann.other@user.com', '{\"title\":\"In sodales hendrerit tincidunt.\",\"message\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ornare neque sit amet egestas scelerisque. \\n            Nullam ac maximus sem. Quisque porttitor mi vitae gravida sodales. Maecenas ultricies dolor ut auctor elementum. \\n            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel lacus rhoncus, tempus urna id, malesuada sapien. \\n            Morbi nec diam a tellus pretium commodo. In maximus eget ex sit amet dictum. Mauris viverra consectetur ultricies.\"}'),
(6, '2021-10-26 12:19:00', 'dave.smith@gmail.com', '{\"title\":\"In sodales hendrerit tincidunt.\",\"message\":\"Sed a auctor elit, a mattis eros. Integer vitae ipsum in est dignissim ultrices quis nec tortor. Quisque nunc ex, \\naccumsan quis magna ac, suscipit iaculis mi. Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac \\nenim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh \\nneque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer \\nconsectetur cursus augue id porta. Curabitur ac placerat ligula. Sed fringilla augue sed leo consectetur feugiat. Donec leo orci, \\nconsequat a imperdiet a, porta non erat.\"}'),
(7, '2021-10-26 12:19:00', 'sally.smith@gmail.com', '{\"title\":\"In sodales hendrerit tincidunt.\",\"message\":\"Sed a auctor elit, a mattis eros. Integer vitae ipsum in est dignissim ultrices quis nec tortor. Quisque nunc ex, \\naccumsan quis magna ac, suscipit iaculis mi. Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac \\nenim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh \\nneque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer \\nconsectetur cursus augue id porta. Curabitur ac placerat ligula. Sed fringilla augue sed leo consectetur feugiat. Donec leo orci, \\nconsequat a imperdiet a, porta non erat.\"}'),
(8, '2021-10-29 14:58:52', 'clint@movies.com', '{\"title\":\"6\",\"message\":\"Sed a auctor elit, a mattis eros. Integer vitae ipsum in est dignissim ultrices quis nec tortor. Quisque nunc ex, \\naccumsan quis magna ac, suscipit iaculis mi. Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac \\nenim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh \\nneque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer \\nconsectetur cursus augue id porta. Curabitur ac placerat ligula. Sed fringilla augue sed leo consectetur feugiat. Donec leo orci, \\nconsequat a imperdiet a, porta non erat.\"}'),
(9, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', '{\"title\":\"In sodales hendrerit tincidunt.\",\"message\":\"Sed a auctor elit, a mattis eros. Integer vitae ipsum in est dignissim ultrices quis nec tortor. Quisque nunc ex, \\naccumsan quis magna ac, suscipit iaculis mi. Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac \\nenim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh \\nneque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer \\nconsectetur cursus augue id porta. Curabitur ac placerat ligula. Sed fringilla augue sed leo consectetur feugiat. Donec leo orci, \\nconsequat a imperdiet a, porta non erat.\"}'),
(10, '2021-10-26 12:19:00', 'ann.other@user.com', '{\"title\":\"In sodales hendrerit tincidunt.\",\"message\":\"Sed a auctor elit, a mattis eros. Integer vitae ipsum in est dignissim ultrices quis nec tortor. Quisque nunc ex, \\naccumsan quis magna ac, suscipit iaculis mi. Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac \\nenim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh \\nneque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer \\nconsectetur cursus augue id porta. Curabitur ac placerat ligula. Sed fringilla augue sed leo consectetur feugiat. Donec leo orci, \\nconsequat a imperdiet a, porta non erat.\"}'),
(11, '2021-10-26 12:19:00', 'dave.smith@gmail.com', '{\"title\":\"In sodales hendrerit tincidunt.\",\"message\":\"Morbi sed porta velit. Pellentesque blandit lacus tortor, auctor semper mi scelerisque et. Duis in bibendum augue, \\nac egestas velit. Maecenas viverra aliquet ante at blandit. \"}'),
(12, '2021-10-29 14:59:13', 'sally.smith@gmail.com', '{\"title\":\"10\",\"message\":\"Morbi sed porta velit. Pellentesque blandit lacus tortor, auctor semper mi scelerisque et. Duis in bibendum augue, \\nac egestas velit. Maecenas viverra aliquet ante at blandit. \"}'),
(16, '2021-10-29 14:52:45', 'dave.smith@gmail.com', '{\"title\":\"Hello there\",\"message\":\"Aenean congue lorem arcu, sit amet faucibus odio pellentesque et. Integer consectetur rutrum dapibus. \\nNam non sodales metus. Fusce luctus dolor eu fringilla feugiat. Proin fermentum nisi in risus posuere hendrerit. \\nSuspendisse rutrum tortor et malesuada pharetra. Morbi elementum porttitor tortor, vitae fringilla augue placerat vel. \\nNunc nec mollis lectus. Sed bibendum dui lacinia tristique eleifend. Quisque lobortis condimentum nulla, vel ultrices ipsum malesuada et. \\nSuspendisse mi magna, vestibulum tincidunt lorem vel, rhoncus tempus justo.\"}'),
(17, '2021-10-26 12:19:00', 'sally.smith@gmail.com', '{\"title\":\"In sodales hendrerit tincidunt.\",\"message\":\"Aenean congue lorem arcu, sit amet faucibus odio pellentesque et. Integer consectetur rutrum dapibus. \\nNam non sodales metus. Fusce luctus dolor eu fringilla feugiat. Proin fermentum nisi in risus posuere hendrerit. \\nSuspendisse rutrum tortor et malesuada pharetra. Morbi elementum porttitor tortor, vitae fringilla augue placerat vel. \\nNunc nec mollis lectus. Sed bibendum dui lacinia tristique eleifend. Quisque lobortis condimentum nulla, vel ultrices ipsum malesuada et. \\nSuspendisse mi magna, vestibulum tincidunt lorem vel, rhoncus tempus justo.\"}'),
(18, '2021-10-29 14:59:32', 'clint@movies.com', '{\"title\":\"13\",\"message\":\"Aenean congue lorem arcu, sit amet faucibus odio pellentesque et. Integer consectetur rutrum dapibus. \\nNam non sodales metus. Fusce luctus dolor eu fringilla feugiat. Proin fermentum nisi in risus posuere hendrerit. \\nSuspendisse rutrum tortor et malesuada pharetra. Morbi elementum porttitor tortor, vitae fringilla augue placerat vel. \\nNunc nec mollis lectus. Sed bibendum dui lacinia tristique eleifend. Quisque lobortis condimentum nulla, vel ultrices ipsum malesuada et. \\nSuspendisse mi magna, vestibulum tincidunt lorem vel, rhoncus tempus justo.\"}'),
(19, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', '{\"title\":\"In sodales hendrerit tincidunt.\",\"message\":\"Aenean congue lorem arcu, sit amet faucibus odio pellentesque et. Integer consectetur rutrum dapibus. \\nNam non sodales metus. Fusce luctus dolor eu fringilla feugiat. Proin fermentum nisi in risus posuere hendrerit. \\nSuspendisse rutrum tortor et malesuada pharetra. Morbi elementum porttitor tortor, vitae fringilla augue placerat vel. \\nNunc nec mollis lectus. Sed bibendum dui lacinia tristique eleifend. Quisque lobortis condimentum nulla, vel ultrices ipsum malesuada et. \\nSuspendisse mi magna, vestibulum tincidunt lorem vel, rhoncus tempus justo.\"}'),
(20, '2021-10-26 12:19:00', 'ann.other@user.com', '{\"title\":\"In sodales hendrerit tincidunt.\",\"message\":\"Aenean congue lorem arcu, sit amet faucibus odio pellentesque et. Integer consectetur rutrum dapibus. \\nNam non sodales metus. Fusce luctus dolor eu fringilla feugiat. Proin fermentum nisi in risus posuere hendrerit. \\nSuspendisse rutrum tortor et malesuada pharetra. Morbi elementum porttitor tortor, vitae fringilla augue placerat vel. \\nNunc nec mollis lectus. Sed bibendum dui lacinia tristique eleifend. Quisque lobortis condimentum nulla, vel ultrices ipsum malesuada et. \\nSuspendisse mi magna, vestibulum tincidunt lorem vel, rhoncus tempus justo.\"}'),
(21, '2021-10-29 14:59:47', 'dave.smith@gmail.com', '{\"title\":\"16.\",\"message\":\"Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac \\nenim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh \\nneque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum.\"}'),
(22, '2021-10-26 12:19:00', 'sally.smith@gmail.com', '{\"title\":\"In sodales hendrerit tincidunt.\",\"message\":\"Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac \\nenim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh \\nneque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum.\"}'),
(23, '2021-10-29 15:00:09', 'clint@movies.com', '{\"title\":\"18\",\"message\":\"Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac \\nenim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh \\nneque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum.\"}'),
(24, '2021-10-26 12:19:00', 'fred.flintstone@dinosaur.com', '{\"title\":\"In sodales hendrerit tincidunt.\",\"message\":\"Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac \\nenim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh \\nneque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum.\"}'),
(25, '2021-10-29 14:55:25', 'ann.other@user.com', '{\"title\":\"Last Message.\",\"message\":\"Donec ut nisi porttitor dui posuere bibendum in vehicula ante. Fusce quis dui ac \\nenim hendrerit tempus quis eget odio. Nullam finibus facilisis dolor, vitae tempus ipsum venenatis et. Aliquam dignissim nibh \\nneque, vitae sollicitudin dui vestibulum a. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum. In sodales hendrerit tincidunt. Vestibulum in tellus ac risus commodo lobortis sit \\namet vel quam. Quisque condimentum, odio sit amet pulvinar lobortis, leo arcu scelerisque diam, id pharetra odio mi et est. \\nSuspendisse venenatis nisi eget diam posuere interdum.\"}'),
(26, '2021-10-30 20:55:40', NULL, '{\"title\":\"Test topic\",\"message\":\"Climate change and Covid are also on the agenda of the summit, which is bringing most leaders together face to face since the start of the pandemic.\\nThe G20 group - made up of 19 countries and the European Union - is short by two leaders, however, with China\'s Xi Jinping and Russia\'s Vladimir Putin choosing to appear via video link, instead.\"}'),
(27, '2021-10-30 20:57:12', 'nic.chant@gmail.com', '{\"title\":\"Climate change\",\"message\":\"Climate change and Covid are also on the agenda of the summit, which is bringing most leaders together face to face since the start of the pandemic.\\nThe G20 group - made up of 19 countries and the European Union - is short by two leaders, however, with China\'s Xi Jinping and Russia\'s Vladimir Putin choosing to appear via video link, instead.\"}'),
(30, '2021-10-30 21:35:04', 'nic.chant@gmail.com', '{\"title\":\"Climate Change\",\"message\":\"Climate change and Covid are also on the agenda of the summit, which is bringing most leaders together face to face since the start of the pandemic.\\nThe G20 group - made up of 19 countries and the European Union - is short by two leaders, however, with China\'s Xi Jinping and Russia\'s Vladimir Putin choosing to appear via video link, instead.\"}'),
(32, '2021-10-31 09:33:10', 'tom@tom.com', '{\"title\":\"COP26\",\"message\":\"The G20 group - made up of 19 countries and the European Union - is short by two, however, with China\'s Xi Jinping and Russia\'s Vladimir Putin choosing to appear via video link.\\n\"}'),
(33, '2021-10-31 14:59:36', 'nic.chant@gmail.com', '{\"title\":\"More Climate\",\"message\":\"Italy\'s Prime Minister Mario Draghi opened the two-day G20 summit with a message of unification, telling world leaders that \\\"going it alone is simply not an option. We must do all we can to overcome our differences\\\".\\n\"}'),
(34, '2021-10-31 20:58:35', 'chat.to.catherine@gmail.com', '{\"title\":\"Use information\",\"message\":\"Around AD700 to 800, wind and weather conditions in the northern hemisphere probably helped settlers from higher latitudes and inhibited those from southern\\u00a0making it easier for people from the north to reach the Azores\\n\"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateJoined` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`profile`)),
  `poster` tinyint(1) DEFAULT 0,
  `session` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userName`, `email`, `password`, `dateJoined`, `profile`, `poster`, `session`) VALUES
('Ann-85', 'ann.other@user.com', '$2y$10$0tHxQf/By1WeV.XxzvltxuyZW6YPWGf2kxcZ/MCmxFRTsdXR8Tp.S', '2021-10-26 12:19:00', NULL, 1, NULL),
('Ben Chat', 'ben.chatter@email.com', '$2y$10$Oad/4rZV7qnwFhGY6LqISeo0C1LsDOoV6WxjYhiARwuPbQTKc0v36', '2021-10-31 09:00:52', NULL, 0, NULL),
('Chatty Cat', 'chat.to.catherine@gmail.com', '$2y$10$h5lT0vAheV9tHx.L9JBXuOfhLL.iUN5i.nfOSBpn25We/BE8qzA4G', '2021-10-31 20:54:52', NULL, 1, 'gENpFNAFKeJtjZyhHpwetFLhr'),
('clint', 'clint@movies.com', '$2y$10$bKqu4WylN8B5UIu3gvAQlew3r/hpkfezFiCL4T4h6ubOSrmpZB0dW', '2021-10-26 12:18:59', NULL, 1, NULL),
('smithy', 'dave.smith@gmail.com', '$2y$10$FU7u4bjmizuH5mOZFo8zNujY4x0T4Deg209HwgXi6RIARY5tnGjoy', '2021-10-26 12:18:59', NULL, 0, NULL),
('flint', 'fred.flintstone@dinosaur.com', '$2y$10$Zu4fEXXgX1YzQ6rsjsmKN.Y91xot31XF4c2u52DpHGpDvXQ9OB1Gy', '2021-10-26 12:18:59', NULL, 1, NULL),
('joe wilson', 'joe.wilson@myemail.co.uk', '$2y$10$FRAs5M2EKdrl/PL3utwHW.LYEqQc2UOXjoTVFm4LdTlsEPGyztEaq', '2021-10-31 09:12:34', NULL, 0, NULL),
('joe wilson1', 'joe1.wilson@myemail.co.uk', '$2y$10$ehW35H264gxVdqExg4KC3e7e7MSRIMrGc/kEgXhOIOgYXqIqw/q8u', '2021-10-31 09:17:33', NULL, 0, NULL),
('Joe 3', 'joe1@tom.com', '$2y$10$NqwU/yKXaSl/Zf6ts.NxNeQhoBtHWvoFQJLUlJC547m2M7IgmNXzG', '2021-10-31 09:20:26', NULL, 0, NULL),
('NicC', 'nic.chant@gmail.com', '$2y$10$BsolGk0M7GpVZ81O7oW7ne/Xsu0ejNZ5xh/CzMkk9pYihYrhogdWS', '2021-10-31 20:54:29', '{\"firstName\":\"Nic\",\"lastName\":\"Chant\",\"phone\":\"01225 567676\",\"bio\":\"Interesting blurb Plus a little more\"}', 1, 'b1PcaSOKQejJCUBVhdBfVaqQO'),
('sal', 'sally.smith@gmail.com', '$2y$10$/4yPgcS4PZK2k8j1bvYPN.6DeW/2uOPieH6ESRyJoYtvdB5RVv5Qy', '2021-10-26 12:18:59', NULL, 0, NULL),
('Tom wilson', 'tom@tom.com', '$2y$10$k0N2q2wbCJQgdhVQHONcO.FjdMEbcODhDkFnfChSdOU2hPp7ixQmC', '2021-10-31 09:36:35', '{\"firstName\":\"Thomas\",\"lastName\":\"Wilson\",\"phone\":\"\",\"bio\":\"It follows concern that multinational companies are re-routing their profits through low tax jurisdictions.\\n\\nThe pact was agreed by all the leaders attending the G20 summit in Rome.\\n\\nClimate change and Covid are also on the agenda of the summit, which is the leaders\' first in-person gathering since the start of the pandemic.\\n\\nThe G20 group - made up of 19 countries and the European Union - is short by two, however, with China\'s Xi Jinping and Russia\'s Vladimir Putin choosing to appear via video link.\\n\\nThe tax deal, which was proposed by the US, is expected to be officially adopted on Sunday, according to Reuters news agency, and will be enforced by 2023.\\n\\nUS Treasury Secretary Janet Yellen said the historic agreement was a \\\"critical moment\\\" for the global economy and will \\\"end the damaging race to the bottom on corporate taxation\\\".\\n\\nShe wrote on Twitter that US businesses and workers would benefit from the deal even though many US-based mega-companies would have to pay more tax.\"}', 0, 'pzCBmTQGHjVqASPCkEKrgkuah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `message_id` (`message_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
