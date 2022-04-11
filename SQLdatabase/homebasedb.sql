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

-- ---------------------------------------------------

--
-- Table structure for table `dbPersons`
--

-- dbPersons is the admin database
DROP TABLE IF EXISTS `dbPetPost`;
DROP TABLE IF EXISTS `dbAdopter`;
DROP TABLE IF EXISTS `dbPersons`;

CREATE TABLE `dbPersons` (
  `id` varchar(255) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text,
  `phone` varchar(12) NOT NULL,
  `email` text,
  `password` text,
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `dbAdopter` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `dbPetPost` (
  `id` int NOT NULL,
  `owner_id` int NOT NULL, 
  `petName` text NOT NULL,
  `petType` text NOT NULL,
  `petStory` text NOT NULL,
  `petPicture` text NOT NULL,
  `approved` int NOT NULL,
  'curHighlight' int NOT NULL,
  'numHighlight' int NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`owner_id`) REFERENCES `dbAdopter`(`id`)
) Engine = InnoDB;


--
-- Dumping data for table `dbPersons`
--

INSERT INTO `dbPersons` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`) VALUES
('Bob8888888888', 'Bob', 'Robertson', '8888888888', 'wackpassword@fake.com', 'bogus_pass'),
('Ethan5407355011', 'Ethan', 'Lambert', '5407355011', 'lambertew@yahoo.com', '5409d8ac4d6e3eddc773e841a3182562'),
('Admin7037806282', 'Admin', 'Jones', '7037806282', 'admin@yahoo.com', 'be6bef2c7a57bead38826deed4077d03');

INSERT INTO `dbAdopter` (`id`,`name`, `phone`, `email`) VALUES
('0','Adopter Adopterson', '1234567890', "adopterson@fake.com"),
('1', 'Paul Narkinsky', '55555555555', 'jnarkins@umw.edu'),
('2', 'Jacob Weisbeck', '1111111111', 'chivalryisdead@umw.edu');

INSERT INTO `dbPetPost` (`id`,`owner_id`, `petName`, `petType`, `petStory`, `petPicture`, `approved`, 'curHighlight', 'numHighlight') VALUES
('0', '1', 'Emma', 'Dog', 'Gigantic stinker terrorizes every nearby entity', 'images/emma.jpg', 0, 0, 0),
('1', '0', 'Bagel', 'Cat', 'Nova scotian badass', 'images/bagel.jpg', 0, 0, 0),
('2', '1', 'Ladybug', 'Dog', 'Scared of bikes and parked cars', 'images/ladybug02.jpg', 0, 0, 0),
('3', '2', 'Charles', 'Other', 'Where is his teeth', 'images/charles03.jpg', 0, 0, 0),
('4', '2', 'Gimli', 'Other', 'Who?', 'images/gimli04.jpg', 0, 0, 0);
