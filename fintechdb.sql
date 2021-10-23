--
-- Database: `fintechdb`
--
CREATE DATABASE IF NOT EXISTS `fintechdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `fintechdb`;

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'emmanuel', 'emmanuelpassword'),
(2, 'james', 'jamespassword'),
(3, 'stacy', 'stacypassword'),
(4, 'fake_agomez@example.com', 'password');


CREATE TABLE `transactions` (
  `id` INT NOT NULL AUTO_INCREMENT, 
  `user_id` VARCHAR(30) NOT NULL, 
  `amount` DECIMAL NOT NULL, 
  `period` INT NOT NULL, 
  `installments` DECIMAL NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `transactions_countryx` (
  `id` INT NOT NULL AUTO_INCREMENT, 
  `user_id` VARCHAR(30) NOT NULL, 
  `amount` DECIMAL NOT NULL, 
  `period` INT NOT NULL, 
  `installments` DECIMAL NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO `transactions_countryx` (`id`, `user_id`, `amount`, `period`, `installments`) VALUES
(1, 'emmanuel', 100, 4, 25),
(2, 'james', 100, 1, 0),
(3, 'stacy', 100, 100, 1);


CREATE USER IF NOT EXISTS 'fintech'@'%' IDENTIFIED BY 'wC!viIkBek@6';
GRANT SELECT, INSERT ON `fintechdb`.* TO 'fintech'@'%';
