-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Mar 2022, 20:20
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
  `endowed` double NOT NULL COMMENT 'nr konta osoby która dostała przelew',
  `title` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `generous` double NOT NULL COMMENT 'nr konta osoby która wysłała przelew'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta`
--

CREATE TABLE `konta` (
  `id` char(26) NOT NULL COMMENT 'numer konta',
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(1) NOT NULL,
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

INSERT INTO `konta` (`id`, `username`, `password`, `type`, `amount`, `name`, `surname`, `home`, `pesel`, `D_czy_P`, `doc_nr`, `date_account`) VALUES
('2147483647', 'testAdmin', 'e51a8473cbf0a307f744f751fac4ab48', 2, '', 'Jan', 'Kowalski', 'daleko', '11111111111', 'P', 'zw1234567', '2022-03-15');

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
  MODIFY `id_history` float NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
