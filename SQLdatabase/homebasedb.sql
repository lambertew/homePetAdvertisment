-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 31, 2022 at 08:37 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homebasedb`
--

--
-- Table structure for table `dbPersons`
--

-- dbPersons is the admin database
CREATE TABLE `dbPersons` (
  `id` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text,
  `phone` varchar(12) NOT NULL,
  `email` text,
  `password` text
  primary key(id)
  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `dbAdopter` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `phone number` varchar(12) NOT NULL
  `email` text
);

CREATE TABLE `dbPetPost` (
  `id` int NOT NULL,
  `owner_id` int NOT NULL, 
  `petName` text NOT NULL,
  `petType` text NOT NULL,
  `petStory` text NOT NULL,
  `petPicture`
  PRIMARY KEY (`id`),
  FOREIGN KEY (`owner_id`) REFERENCES `dbAdopter`(`id`)
);


--
-- Dumping data for table `dbPersons`
--

--INSERT INTO `dbPersons` (`id`, `start_date`, `venue`, `first_name`, `last_name`, `address`, `city`, `state`, `zip`, `phone1`, `phone1type`, `phone2`, `phone2type`, `birthday`, `email`, `employer`, `position`, `credithours`, `howdidyouhear`, `commitment`, `motivation`, `specialties`, `convictions`, `type`, `screening_type`, `screening_status`, `status`, `availability`, `schedule`, `hours`, `notes`, `password`) VALUES
