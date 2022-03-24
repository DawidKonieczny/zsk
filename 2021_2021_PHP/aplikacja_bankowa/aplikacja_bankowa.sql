-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Mar 2022, 12:42
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
(1, '10001234567891234567894443', 'TestowyPrzelew', 1, '2022-03-17', '10001234567891234567894444');

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
('10000000000000000000000000', 'testAdmin', '$argon2i$v=19$m=16,t=2,p=1$NUJCRWxxUEh0N2QzNDZweQ$FZ1fwLVBRC6IZ/srf6Bjhw', 2, '10', 'Jan', 'Kowalski', 'dalek', '11111111111', 'P', 'zw1234567', '2022-03-15'),
('10000000000000000000000001', 'testModerator', '$argon2i$v=19$m=16,t=2,p=1$NUJCRWxxUEh0N2QzNDZweQ$FZ1fwLVBRC6IZ/srf6Bjhc', 1, '12', 'Zbigniew', 'Kowalski', 'blisko', '11111111117', 'P', 'zw1234563', '2022-03-16'),
('10001234567891234567894443', 'testklient2', '$argon2i$v=19$m=16,t=2,p=1159d5fc0b541442e8867fb2b7fa06387', 0, '101', 'Samson', 'Mały', 'puszcze', '11111111114', 'D', 'qwe444556', '2022-03-17'),
('10001234567891234567894444', 'testklient', '$argon2i$v=19$m=16,t=2,p=1159d5fc0b541442e8867fb2b7fa06387', 0, '100', 'Samson', 'Wielki', 'pustynie', '11111111113', 'D', 'qwe444555', '2022-03-16'),
('1000193240664962621954', 'Testujem', '$argon2i$v=19$m=65536,t=4,p=1$eEpwclNTN0hjRXd5dnZ2cQ$ehDgUpZumUGRFiKUXQ7aAx952BBKFsVJRAyFrgifGtE', 0, '0', 'Dawid', 'Konieczny', 'tu', '01501601413', 'D', 'xx1234567', '0000-00-00');

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
  MODIFY `id_history` float NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
