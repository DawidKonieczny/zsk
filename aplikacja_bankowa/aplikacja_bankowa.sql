-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Mar 2022, 19:45
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `aplikacja_bankowa`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `historia`
--

CREATE TABLE `historia` (
  `id_history` float NOT NULL,
  `endowed` varchar(26) NOT NULL COMMENT 'nr konta osoby która dostała przelew',
  `title` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `generous` varchar(26) NOT NULL COMMENT 'nr konta osoby która wysłała przelew'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `historia`
--

INSERT INTO `historia` (`id_history`, `endowed`, `title`, `amount`, `date`, `generous`) VALUES
(1, '10001234567891234567894443', 'TestowyPrzelew', 1, '2022-03-17', '10001234567891234567894444'),
(2, '10001234567891234567894444', 'Smoki', 2, '2022-03-27', '1000193240664962621954');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta`
--

CREATE TABLE `konta` (
  `id` char(26) NOT NULL COMMENT 'numer konta',
  `username` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `type` int(1) NOT NULL COMMENT '0-klient 1-moderator\r\n2-admin',
  `amount` varchar(57) NOT NULL COMMENT 'ilość środków na koncie',
  `name` varchar(57) NOT NULL,
  `surname` varchar(28) NOT NULL,
  `home` text NOT NULL,
  `pesel` char(11) NOT NULL,
  `D_czy_P` char(1) NOT NULL COMMENT 'Dowód czy Paszport',
  `doc_nr` char(9) NOT NULL COMMENT 'numer dokumentu',
  `date_account` date NOT NULL DEFAULT current_timestamp() COMMENT 'data założenia konta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `konta`
--

INSERT INTO `konta` (`id`, `username`, `pwd`, `type`, `amount`, `name`, `surname`, `home`, `pesel`, `D_czy_P`, `doc_nr`, `date_account`) VALUES
('10000000000000000000000001', 'testModerator', '$argon2i$v=19$m=16,t=2,p=1$NUJCRWxxUEh0N2QzNDZweQ$FZ1fwLVBRC6IZ/srf6Bjhc', 1, '12', 'Zbigniew', 'Kowalski', 'blisko', '11111111117', 'P', 'zw1234563', '2022-03-16'),
('10000000000000000000000006', 'Testujemy', '$argon2i$v=19$m=65536,t=4,p=1$eEpwclNTN0hjRXd5dnZ2cQ$ehDgUpZumUGRFiKUXQ7aAx952BBKFsVJRAyFrgifGtE', 2, '98', 'Piotrek', 'Konieczny', 'tu i tam', '01501601419', 'D', 'xx1234568', '2022-03-01'),
('10001932406649626219545555', 'Testujem', '$argon2i$v=19$m=65533,t=2,p=1$ZUVwd2NsTlROMGhqUlhkNWRuWjJjUQ$kPI7tHp4Gi/CD206cNVs+Q', 2, '98', 'Dawid', 'Konieczny', 'tu', '01501601413', 'D', 'xx1234567', '2022-03-01'),
('10002065381862332620468148', 'HK12345678', '$argon2i$v=19$m=65536,t=4,p=1$R2ZrTDZUYzJ3aXVXSEtyaw$rY7po7LWiYAlstRLOmD4K79PBx3amIlzTfJGWehfy3w', 0, '0', 'Henry', 'Patyk', 'Dom', '02203467581', 'D', 'aa1234567', '2022-03-28'),
('1000744944906855504657', 'SmokWawel', '$argon2i$v=19$m=65536,t=4,p=1$MEJZanVGNUNPMlJ6UFJvZQ$iOXnSnKz5aaasT3UsmzBKSdlfXqq1c6kiz3L7DLBqMQ', 1, '', 'Smok', 'Wawelskii', 'Krawkowie', '12132312314', 'D', 'qw2345678', '2022-03-09'),
('10009319641722905540642469', 'HK123456782', '$argon2i$v=19$m=65536,t=4,p=1$VUVVa0hiYy5LTXZheXRDQQ$j2iBa7j7oflORMXRa4OOi6UKmtual/H08lgRHiuuZT4', 0, '0', 'Henry', 'Konieczny', 'Dom', '02303467581', 'D', 'aa1234567', '2022-03-28');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`id_history`);

--
-- Indeksy dla tabeli `konta`
--
ALTER TABLE `konta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `historia`
--
ALTER TABLE `historia`
  MODIFY `id_history` float NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
