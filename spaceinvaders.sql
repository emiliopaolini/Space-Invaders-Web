-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 08, 2019 alle 12:11
-- Versione del server: 10.1.32-MariaDB
-- Versione PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spaceinvaders`
--
CREATE DATABASE IF NOT EXISTS `spaceinvaders` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `spaceinvaders`;

-- --------------------------------------------------------

--
-- Struttura della tabella `buy`
--

CREATE TABLE `buy` (
  `userId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `equipped` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `buy`
--

INSERT INTO `buy` (`userId`, `itemId`, `equipped`) VALUES
(6, 1, 0),
(6, 2, 0),
(6, 3, 0),
(6, 4, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `msg_for_admin`
--

CREATE TABLE `msg_for_admin` (
  `msgId` int(11) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `msg_for_admin`
--

INSERT INTO `msg_for_admin` (`msgId`, `text`, `userId`) VALUES
(1, 'Ciao admin, bel gioco!', 6),
(2, 'Ei ciao admin, questo è un bel gioco!', 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `postId` int(11) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `userId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `post`
--

INSERT INTO `post` (`postId`, `text`, `userId`, `time`) VALUES
(2, 'Ciao, sono l\'admin! lascia un messaggio sul gioco!', 6, '2018-10-15 13:23:04'),
(7, 'Testo di prova!', 6, '2018-10-15 13:38:44'),
(8, 'Lorem Ipsum is simply dummy text of the printing.', 6, '2018-10-15 13:39:59'),
(13, 'Lorem Ipsum has been the industry\'s standard dummy text.', 6, '2018-10-15 14:33:33'),
(14, 'Ei ciao', 1, '2018-10-15 14:33:47');

-- --------------------------------------------------------

--
-- Struttura della tabella `shop`
--

CREATE TABLE `shop` (
  `itemId` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(300) NOT NULL,
  `cost` int(11) NOT NULL,
  `img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `shop`
--

INSERT INTO `shop` (`itemId`, `name`, `description`, `cost`, `img`) VALUES
(1, 'Shield', 'This item gives you a shield during the game. With the shield you are protected 5 times by the shots of the enemy', 10000, 'shieldItem.png'),
(2, 'Shield', 'This item gives you a shield during the game. With the shield you are protected 5 times by the shots of the enemy', 10000, 'shieldItem.png'),
(3, 'Shield', 'This item gives you a shield during the game. With the shield you are protected 5 times by the shots of the enemy', 10000, 'shieldItem.png'),
(4, 'Life', 'This item gives you an extra life during the game', 5000, 'heartItem.png');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `numeroPartite` int(11) NOT NULL,
  `best` int(11) NOT NULL,
  `coins` int(11) NOT NULL,
  `color` varchar(15) NOT NULL DEFAULT 'green',
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`userId`, `username`, `password`, `email`, `numeroPartite`, `best`, `coins`, `color`, `admin`) VALUES
(1, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@gmail.com', 12, 640, 62, 'red', 0),
(6, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 94, 3360, 30000, 'yellow', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`userId`,`itemId`);

--
-- Indici per le tabelle `msg_for_admin`
--
ALTER TABLE `msg_for_admin`
  ADD PRIMARY KEY (`msgId`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postId`);

--
-- Indici per le tabelle `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`itemId`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `msg_for_admin`
--
ALTER TABLE `msg_for_admin`
  MODIFY `msgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `shop`
--
ALTER TABLE `shop`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
