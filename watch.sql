-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2014 at 09:07 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `watch`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `content` blob NOT NULL,
  `read` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  PRIMARY KEY (`id_message`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_message`, `subject`, `content`, `read`, `created_at`, `updated_at`, `sender_id`, `receiver_id`) VALUES
(1, 'ceva', 0x73616173646164616461, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2),
(2, 'eceda', 0x6365646164736164616361736361, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 1),
(9, 'aaaaaaaaaaaaaaaa', 0x61616161616161616161616161, 0, '2014-05-26 12:54:18', '0000-00-00 00:00:00', 1, 2),
(10, 'aaaaaaaaaaaaaaaa', 0x61616161616161616161616161, 1, '2014-05-26 12:57:43', '0000-00-00 00:00:00', 1, 2),
(11, 'bla bla', 0x616c6f686120687368736868, 1, '2014-05-27 09:53:20', '0000-00-00 00:00:00', 1, 4),
(12, 'eceda', 0x6365646164736164616361736361, 1, '2014-05-28 10:17:10', '0000-00-00 00:00:00', 1, 4),
(13, 'eceda', 0x6365646164736164616361736361, 1, '2014-05-28 10:58:51', '0000-00-00 00:00:00', 1, 3),
(14, 'eceda', 0x6365646164736164616361736361, 1, '2014-05-28 11:01:50', '0000-00-00 00:00:00', 1, 4),
(15, 'eceda', '', 1, '2014-05-28 11:50:21', '0000-00-00 00:00:00', 1, 3),
(16, 'eceda', '', 1, '2014-05-28 11:54:16', '0000-00-00 00:00:00', 1, 3),
(17, 'eceda', '', 1, '2014-05-28 11:54:42', '0000-00-00 00:00:00', 1, 3),
(18, 'eceda', '', 1, '2014-05-28 11:55:32', '0000-00-00 00:00:00', 1, 3),
(19, 'eceda', '', 1, '2014-05-28 11:56:06', '0000-00-00 00:00:00', 1, 3),
(20, 'eceda', '', 1, '2014-05-28 11:58:44', '0000-00-00 00:00:00', 1, 3),
(21, 'eceda', 0x73646164616473616461646173647361647361, 1, '2014-05-28 11:58:57', '0000-00-00 00:00:00', 1, 3),
(22, 'eceda', 0x6173647361647361, 1, '2014-05-28 12:07:06', '0000-00-00 00:00:00', 1, 3),
(23, 'eceda', 0x73646173647361, 1, '2014-05-28 12:40:30', '0000-00-00 00:00:00', 1, 3),
(24, 'eceda', 0x736120617061726120756e206d6172652053484954, 1, '2014-05-28 12:41:26', '0000-00-00 00:00:00', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `remember_token` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `remember_token`, `email`, `birthday`) VALUES
(1, 'mihai', '$2y$10$SZDjJzT5UrCcj9uDbohZFuk2aAVWbSmxjDGqIjgFFEVVriotSjPyO', 'dTXcpF0akY8h2rF8j6zczuHElSDoAZaGYmSKwdZlPZf8x27UxQd6KLAcDUVp', 'mihai@mih.ro', '0000-00-00'),
(2, 'youtube', '$2y$10$6IXMlDd5cls1PTst1MkJpOpdm7vj9LM2ZMdWg73PAjdePUZ0RC4nm', 'R9Bhd2z9R4Wb3rDAc3H1YYd55T4Hz2geaGuB4cFGEt3tPf4r2hI6SQbFfjIi', 'youtube@youtube.com', '0000-00-00'),
(3, 'katty', '$2y$10$LTXS.sCziWXBBFfjGNxjyeWO2HrOtfduregWBDU0lRDYT8j7.QVtu', '', 'katty@yahoo.com', '0000-00-00'),
(4, 'tabi', '$2y$10$MOCZhYN2PrWa/UG.RCx./ushkAaKSA3wmRmG7ekScPXRcAaec5aUW', 'AO0GFsDcPSkonvSRk0cNL7JIEJ5uUS3wwF8nhG3n5RSapJgQmPro3ckcdAA3', 'tabi@tabi.com', '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
