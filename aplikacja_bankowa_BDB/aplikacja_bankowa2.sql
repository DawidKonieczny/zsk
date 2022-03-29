-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Mar 2022, 10:23
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `id_history` bigint(20) UNSIGNED NOT NULL,
  `endowed` char(26) NOT NULL COMMENT 'nr konta osoby która dostała przelew',
  `title` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `generous` char(26) NOT NULL COMMENT 'nr konta osoby która wysłała przelew'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta`
--

CREATE TABLE `konta` (
  `id` char(26) NOT NULL COMMENT 'numer konta',
  `username` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `id_przywileju` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(57) NOT NULL COMMENT 'ilość środków na koncie',
  `date_account` date NOT NULL DEFAULT current_timestamp() COMMENT 'data założenia konta',
  `id_uzytkownika` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przywileje`
--

CREATE TABLE `przywileje` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nazwa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typy_dokumentow`
--

CREATE TABLE `typy_dokumentow` (
  `id` char(1) NOT NULL,
  `nazwa` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imie` varchar(128) NOT NULL,
  `nazwisko` varchar(64) NOT NULL,
  `pesel` char(11) NOT NULL,
  `id_typu_dokumentu` char(1) NOT NULL,
  `dokument_numer` char(9) NOT NULL,
  `domek` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`id_history`),
  ADD UNIQUE KEY `id_history` (`id_history`),
  ADD KEY `endowed` (`endowed`,`generous`),
  ADD KEY `generous` (`generous`);

--
-- Indeksy dla tabeli `konta`
--
ALTER TABLE `konta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`),
  ADD KEY `id_przywileju` (`id_przywileju`);

--
-- Indeksy dla tabeli `przywileje`
--
ALTER TABLE `przywileje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `typy_dokumentow`
--
ALTER TABLE `typy_dokumentow`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_typu_dokumentu` (`id_typu_dokumentu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `historia`
--
ALTER TABLE `historia`
  MODIFY `id_history` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `przywileje`
--
ALTER TABLE `przywileje`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `historia`
--
ALTER TABLE `historia`
  ADD CONSTRAINT `historia_ibfk_1` FOREIGN KEY (`endowed`) REFERENCES `konta` (`id`),
  ADD CONSTRAINT `historia_ibfk_2` FOREIGN KEY (`generous`) REFERENCES `konta` (`id`);

--
-- Ograniczenia dla tabeli `konta`
--
ALTER TABLE `konta`
  ADD CONSTRAINT `konta_ibfk_1` FOREIGN KEY (`id_uzytkownika`) REFERENCES `uzytkownicy` (`id`),
  ADD CONSTRAINT `konta_ibfk_2` FOREIGN KEY (`id_przywileju`) REFERENCES `przywileje` (`id`);

--
-- Ograniczenia dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`id_typu_dokumentu`) REFERENCES `typy_dokumentow` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
